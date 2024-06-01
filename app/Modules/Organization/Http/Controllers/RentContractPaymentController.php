<?php

namespace Organization\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\RentContractPayment\{
    PayAction,
    FilterAction,
};
use Organization\Http\Requests\RentContractPayment\{
    PayRequest,
    FilterDateRequest
};
use Organization\Exports\RentContractPayment\{
    ExportData,
};

class RentContractPaymentController extends JsonResponse
{
    public function index($id)
    {
        return view('Organization::rentContractPayments.index',compact('id'));
    }

    public function data(FilterDateRequest $request, FilterAction $filterAction)
    {
        $records = $filterAction->execute($request)
            ->orderBy('id','ASC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),

            ]);
        $result = view('Organization::rentContractPayments.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function pay(PayRequest $request, PayAction $payAction)
    {
        DB::beginTransaction();
        try {
            $record =  $payAction->execute($request);
            if(!$record)
                return $this->response(500, 'Failed, This record is not found .', 200);
            DB::commit();
            return $this->response(200, 'Rent Contract Payment Paid successfully.', 200,[],$record);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','ASC')->get();
            return Excel::download(new ExportData($records), 'organization_rent_contract_payments_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }
}
