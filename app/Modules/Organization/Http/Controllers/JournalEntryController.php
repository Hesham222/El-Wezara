<?php

namespace Organization\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Models\Payment;
use Organization\Models\RentContractPayment;
use Organization\Models\HotelReservationPayment;
use Organization\Models\GateShiftSheet;
use Organization\Models\ReservationPayment;
use Organization\Models\LaundryOrderPayment;
use Organization\Models\OrderPayment;

use Organization\Models\Account;
use Organization\Models\SubAccount;
use Organization\Actions\JournalEntry\{
    StoreAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
    DebitStoreAction,
    CreditStoreAction,
    DebitUpdateAction,
    CreditUpdateAction,

};
use Organization\Http\Requests\JournalEntry\{
    StoreRequest,
    UpdateRequest,
    RemoveRequest,
    FilterDateRequest
};
use Organization\Exports\JournalEntry\{
    ExportData,
};
use Organization\Models\{
    JournalEntry
};

class JournalEntryController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FinancialJournalEntry-View')
        ){
            return view('Organization::journalEntries.index');
        }else
            return abort(401);
    }


    public function invoices(Request $request)

    {

       // return $request->all();

         $accounts           = Account::select(['id','name'])->get();
         $invoicesIds = $request->invoicesIds;

    $ids = [];
    foreach (explode(',', $invoicesIds[0]) as $info) {
        # code...
    array_push($ids, $info);
    }

         $type = $request->type;
         $invoiceType = $request->invoiceType;



    if ($invoiceType == 'sportsActivities') {

    $invoicePrice = Payment::whereIn('id',$ids)->sum('payment_balance');
    }else if($invoiceType == 'RentContractPayment'){

    $invoicePrice = RentContractPayment::whereIn('id',$ids)->sum('amount');

    }elseif ($invoiceType == 'HotelReservationPayment') {
        $invoicePrice = HotelReservationPayment::whereIn('id',$ids)->sum('amount');
    }
    elseif ($invoiceType == 'GateShiftSheet') {
        $invoicePrice = GateShiftSheet::whereIn('id',$ids)->sum('ticketsAmount');
    }
    elseif ($invoiceType == 'ReservationPayment') {
        $invoicePrice = ReservationPayment::whereIn('id',$ids)->sum('paid_amount');
    }

    elseif ($invoiceType == 'LaundryOrderPayment') {
        $invoicePrice = LaundryOrderPayment::whereIn('id',$ids)->sum('paid_amount');
    }

    elseif ($invoiceType == 'OrderPayment') {
        $invoicePrice = OrderPayment::whereIn('id',$ids)->sum('amount');
    }
    $invoicesIds = implode(',', $invoicesIds);

    // $output = array(
    //     'accounts'=>$accounts,'ids'=>$ids,'type'=>$type,'invoiceType'=>$invoiceType,'invoicePrice'=>$invoicePrice,'invoicesIds'=>$invoicesIds
    // );


    // session('output', $output);
    //  return redirect()->route('organizations.journalEntry.createWithInvoice');

            return view('Organization::journalEntries.create',compact('accounts','ids','type','invoiceType','invoicePrice','invoicesIds'));
    }
    public function create()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FinancialJournalEntry-Add')
        ){
            $accounts           = Account::select(['id','name'])->get();
            return view('Organization::journalEntries.create',compact('accounts'));
        }else
            return abort(401);
    }

    public function getDebitRow()
    {
        $accounts           = Account::select(['id','name'])->get();

        $results = view('Organization::journalEntries.components.debit.row',compact('accounts'),
            [

            ])->render();

        return $this->response(200, 'Debit Row', 200, [], 0, ['responseHTML' => $results]);
    }

    public function getCreditRow()
    {
        $accounts           = Account::select(['id','name'])->get();

        $results = view('Organization::journalEntries.components.credit.row',compact('accounts'),
            [

            ])->render();

        return $this->response(200, 'Credit Row', 200, [], 0, ['responseHTML' => $results]);
    }


    public function appendSubAccounts(Request $request){
        try {
            if($request->ajax()){

                $data = $request->all();
                $subAccounts = SubAccount::where(['account_id'=>$data['account_id']])->select(['id','name'])->get();

                return view('Organization::journalEntries.components.debit.append_sub_accounts',compact('subAccounts'))->render();
            }
        } catch (\Exception $ex) {
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
        return $this->response(500, 'Failed, Please try again later.', 200);
    }
    public function appendSubAccountsCredit(Request $request){
        try {
            if($request->ajax()){

                $data = $request->all();
                $subAccounts = SubAccount::where(['account_id'=>$data['account_id']])->select(['id','name'])->get();

                return view('Organization::journalEntries.components.credit.append_sub_accounts',compact('subAccounts'))->render();
            }
        } catch (\Exception $ex) {
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
        return $this->response(500, 'Failed, Please try again later.', 200);
    }

    public function store(Request $request, StoreAction $storeAction,DebitStoreAction $debitStoreAction,CreditStoreAction $creditStoreAction)
    {
        DB::beginTransaction();
         try {
            $record         =   $storeAction->execute($request);
            if(!$record){
                return redirect()->route('organizations.journalEntry.create')->with('error','Debit total amount must be equal Credit total amount.');
            }else{
                $debitStoreAction->execute($request,$record);
                $creditStoreAction->execute($request,$record);
            }


            DB::commit();
            return redirect()->route('organizations.journalEntry.index')->with('success','Data has been saved successfully.');
         } catch (\Exception $exception) {
            DB::rollback();
             return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
         }
    }

    public function edit($id)
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FinancialJournalEntry-Edit')
        ){
            $record             = JournalEntry::find($id);
            $accounts           = Account::with('SubAccounts')->get();
            $sub_accounts       = SubAccount::select(['id','name'])->get();
            return view('Organization::journalEntries.edit',compact('record','accounts','sub_accounts'));
        }else
            return abort(401);
    }

    public function update(Request $request, UpdateAction $updateAction,DebitUpdateAction $debitUpdateAction,CreditUpdateAction $creditUpdateAction, $id)
    {

        DB::beginTransaction();
        try {
            $record         =   $updateAction->execute($request, $id);
            if(!$record){
                return redirect()->route('organizations.journalEntry.create')->with('error','Debit total amount must be equal Credit total amount.');
            }else{
                $debitUpdateAction->execute($request,$record);
                $creditUpdateAction->execute($request,$record);
            }
            DB::commit();
            return redirect()->route('organizations.journalEntry.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
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
        $result = view('Organization::journalEntries.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData($records), 'organization_journal_entries_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function trash(RemoveRequest $request, TrashAction $trashAction)
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FinancialJournalEntry-Delete')
        ){
            DB::beginTransaction();
            try {
                $record =  $trashAction->execute($request);
                if(!$record)
                    return $this->response(500, 'Failed, This record is not found .', 200);
                DB::commit();
                return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'journalEntries', 'trashesCount' => $this->countTrashes()]);
            } catch (\Exception $ex) {
                DB::rollBack();
                return $this->response(500, 'Failed, Please try again later.', 200);
            }
        }else
            return abort(401);
    }

    public function destroy(Request $request, DestroyAction $destroyAction, $id)
    {

        DB::beginTransaction();
        try {
            if ($id === 1)
                return $this->response(500, 'Failed, You can not delete this record.', 200);

            $record =  $destroyAction->execute($request, $id);
            if(!$record)
                return $this->response(500, 'Failed, This record is not found .', 200);
            DB::commit();
            return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'journalEntries', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    public function restore(RemoveRequest $request, RestoreAction $restoreAction)
    {
        DB::beginTransaction();
        try {
            $record =  $restoreAction->execute($request);
            DB::commit();
            return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'journalEntries', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    private function countTrashes()
    {
        return JournalEntry::onlyTrashed()->count();
    }
}
