<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\PointOfSaleShiftSheet\{
    FilterAction,
};
use Organization\Http\Requests\PointOfSaleShiftSheet\{
    FilterDateRequest,BankSupplyRequest
};
use Organization\Exports\PointOfSaleShiftSheet\{
    ExportData,
};

use Illuminate\Support\Facades\DB;
use Organization\Models\PointOfSaleOrderSheet;
use Organization\Models\SafeReceipt;
use Organization\Models\BankSupply;

use Organization\Actions\safe\{
    SafeFilterAction,
    BankSupplyFilterAction
};
use App\Http\Traits\FileTrait;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;


class SafeController extends JsonResponse
{
    use FileTrait;

    public function index()
    {
        return view('Organization::safes.index');
    }

    public function receiptsIndex()
    {
        return view('Organization::safes.receiptsIndex');

    }


    public function bankSupply()
    {
        return view('Organization::safes.bankSupplyIndex');

    }

    public function data(FilterDateRequest $request, FilterAction $filterAction)
    {
        $records = $filterAction->execute($request)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),

            ]);
        $result = view('Organization::safes.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }


    public function receiptsData(FilterDateRequest $request, SafeFilterAction $filterAction)
    {
        $records = $filterAction->execute($request)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),

            ]);
        $result = view('Organization::safes.components.receipts_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }


    public function bankSupplyData(FilterDateRequest $request, BankSupplyFilterAction $filterAction)
    {
        $records = $filterAction->execute($request)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),

            ]);
        $result = view('Organization::safes.components.bank_supply_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }


    // public function export(FilterDateRequest $request, FilterAction $filterAction)
    // {
    //     try{
    //         $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
    //         return Excel::download(new ExportData($records), 'organization_pointOfSaleShiftSheets_data.csv');
    //     }
    //     catch (\Exception $ex){
    //         return redirect()->back()->with('error', 'Error occurred, Please try again later.');
    //     }
    // }


    public function downloadBankSupply($id)
    {


        $bank_supply = BankSupply::FindOrFail($id);

        return Storage::download($bank_supply->file);

         try {

             if ($bank_supply) {
                 //return Storage::disk('public')->download($company_info->national_id);
                 //  return Storage::disk('public')->readStream($company_info->national_id);
                 //return response()->file(asset('storage/'.$company_info->national_id));
                 $pdfContent = Storage::get($bank_supply->file);
                 $filePath = $bank_supply->file;
                 $type = Storage::mimeType($filePath);
                 $fileName = 'jbjj';//Storage::name($filePath);

                 return Response::make($pdfContent, 200, [
                     'Content-Type' => $type,
                     'Content-Disposition' => 'inline; filename="' . $fileName . '"'
                 ]);
                 //return redirect($company_info->national_id);
             } else {
                 return back();
             }
         }catch (\Exception $exception) {
             return back()->with('error','Please Upload file again and try to show it');
         }

    }


    public function reserve($id)
    {
        DB::beginTransaction();
        try {
            $po_sheet = PointOfSaleOrderSheet::FindOrFail($id);
            $po_sheet->received = 1;
            $po_sheet->save();

            // add recipt record
            $SafeReceipt = new SafeReceipt();
            $SafeReceipt->created_by = auth('organization_admin')->user()->id ;
            $SafeReceipt->point_of_sale_order_sheet_id = $po_sheet->id ;
            $SafeReceipt->total = $po_sheet->ordersAmount + $po_sheet->start_balance ;
            $SafeReceipt->save();

            DB::commit();
            return back()->with('success','تم اضافة ايصال الخزنة');
            //redirect()->route('organizations.sportArea.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }

    public function supply($id)
    {

        $safe_receipt = SafeReceipt::FindOrFail($id);
        return view('Organization::safes.bank_supply',compact('safe_receipt'));

    }



    public function storeSupply(BankSupplyRequest $request)
    {
        DB::beginTransaction();
        try {
            $safe_receipt = SafeReceipt::FindOrFail($request->safe_receipt);
            $safe_receipt->sent_to_the_bank = 1;
            $safe_receipt->save();

            // add supply record
            $supply = new BankSupply();
            $supply->created_by = auth('organization_admin')->user()->id ;
            $supply->safe_receipt_id = $safe_receipt->id ;
            $supply->total = $safe_receipt->total  ;

$file = null;
            if ($request->has('file'))
                    $file = FileTrait::storeSingleFile($request->file('file'),'bank_supplies');


             $supply->file = $file  ;
            $supply->save();

            DB::commit();

            return redirect()->route('organizations.safe.receiptsIndex')->with('success','تم اضافة ايصال الايداع');
            //redirect()->route('organizations.sportArea.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }


}
