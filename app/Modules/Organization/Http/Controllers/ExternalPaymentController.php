<?php

namespace Organization\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Models\Customer;
use Organization\Models\ExternalReservation;
use Organization\Models\Subscription;
use Organization\Actions\ExternalPayment\{
    StoreAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
    BalanceAction,
};
use Organization\Http\Requests\ExternalPayment\{
    StoreRequest,
    UpdateRequest,
    RemoveRequest,
    FilterDateRequest
};
use Organization\Exports\ExternalPayment\{
    ExportData,
};
use Organization\Models\{
    ExternalPayment
};

class ExternalPaymentController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'ExternalReservationPayment-View')
        ){
            $subscribers    = Customer::select(['id','name'])->get();
            return view('Organization::external_payments.index',compact('subscribers'));
        }else
            return abort(401);
    }

    public function create()
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'ExternalReservationPayment-Add')
        ){
            $subscribers            = Customer::has('ExternalReservations')->get();

            return view('Organization::external_payments.create',compact('subscribers'));
        }else
            return abort(401);
    }

    public function createPayment($id)
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'ExternalReservationPayment-Add')
        ){
            $reservation = ExternalReservation::find($id);

            return view('Organization::external_payments.createPayment',compact('reservation'));
        }else
            return abort(401);
    }

    public function store(StoreRequest $request, StoreAction $storeAction)
    {
        DB::beginTransaction();
        try {
            if (ExternalPayment::where(['external_reservation_id'=>$request['external_reservation_id'],'subscriber_id'=>$request['subscriber_id']])->exists()){

                return redirect()->route('organizations.external_payment.create')->with('error','خطأ, لا يوجد مبلغ للسداد لهذا العميل.')->withInput();
            }else{
                $record = $storeAction->execute($request);
            }

            DB::commit();

                return redirect()->route('organizations.external_payment.index')->with('success','Data has been saved successfully.');
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
                'subscriber' => $request->input('subscriber'),

            ]);
        $result = view('Organization::external_payments.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function appendSubscription(Request $request){
        try {
            if($request->ajax()){

                $data = $request->all();
                $subscriptions = ExternalReservation::where(['subscriber_id'=>$data['subscriber_id']])->get();

                return view('Organization::external_payments.components.append_subscriptions',compact('subscriptions'))->render();
            }
        } catch (\Exception $ex) {
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
        return $this->response(500, 'Failed, Please try again later.', 200);
    }
    public function appendBalance(Request $request){
        try {
            if($request->ajax()){

                $data = $request->all();

                if (ExternalPayment::where(['external_reservation_id'=>$data['external_reservation_id'],'subscriber_id'=>$data['subscriber_id']])->exists()){
                    $total = '0';
                }else{
                    $payment_balance = ExternalReservation::where(['id'=>$data['external_reservation_id'],'subscriber_id'=>$data['subscriber_id']])->select(['total'])->get();

                    foreach ($payment_balance as $pay_balance){
                        $total = $pay_balance->total;
                    }
                }
                return view('Organization::external_payments.components.appendBalance',compact('total'))->render();
            }
        } catch (\Exception $ex) {
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
        return $this->response(500, 'Failed, Please try again later.', 200);
    }
    public function appendOverPrice(Request $request){
        try {

            if($request->ajax()){
                $data = $request->all();

                if (isset($request->status)){
                    $payment_amount = $request->payment_amount;

                    $overpriced = $payment_amount * 12/100 + $payment_amount;
                    //dd($overprice);
                    return view('Organization::external_payments.components.appendBalance',compact('overpriced'))->render();
                }else{

                    if (ExternalPayment::where(['external_reservation_id'=>$data['external_reservation_id'],'subscriber_id'=>$data['subscriber_id']])->exists()){
                        $total = '0';
                    }else{
                        $payment_balance = ExternalReservation::where(['id'=>$data['external_reservation_id'],'subscriber_id'=>$data['subscriber_id']])->select(['total'])->get();

                        foreach ($payment_balance as $pay_balance){
                            $overpriced = $pay_balance->total;
                        }
                    }
                    return view('Organization::external_payments.components.appendBalance',compact('overpriced'))->render();

                }

            }
        } catch (\Exception $ex) {
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
        return $this->response(500, 'Failed, Please try again later.', 200);
    }
    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData($records), 'organization_external_payments_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

}
