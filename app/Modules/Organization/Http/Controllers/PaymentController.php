<?php

namespace Organization\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Models\Customer;
use Organization\Models\Subscriber;
use Organization\Models\Subscription;
use Organization\Actions\Payment\{
    StoreAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
    BalanceAction,
};
use Organization\Http\Requests\Payment\{
    StoreRequest,
    UpdateRequest,
    RemoveRequest,
    FilterDateRequest
};
use Organization\Exports\Payment\{
    ExportData,
};
use Organization\Models\{
    Payment
};

class PaymentController extends JsonResponse
{
    public function index()
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Payment-View')
        ){
            $subscribers    = Customer::select(['id','name'])->get();
            $pricing        = Subscription::select(['id','pricing_name'])->get();
            return view('Organization::payments.index',compact('subscribers','pricing'));
        }else
            return abort(401);
    }

    public function create()
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Payment-Add')
        ){
            $subscribers    = Customer::has('Subscriptions')->get();
            $subscriptions  = Subscription::select(['id','pricing_name'])->get();

            return view('Organization::payments.create',compact('subscribers'));
        }else
            return abort(401);

    }

    public function createPayment($id)
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Payment-Add')
        ){
            $subscription = Subscription::find($id);

            return view('Organization::payments.createPayment',compact('subscription'));
        }else
            return abort(401);

    }

    public function store(StoreRequest $request, StoreAction $storeAction,BalanceAction $balanceAction)
    {
        DB::beginTransaction();
        try {
            $record = $storeAction->execute($request);
            $balance = $balanceAction->execute($request,$record);
            DB::commit();
            if(!$balance){
                return redirect()->back()->with('error','Failed, Payment Amount is larger than Payment Balance.')->withInput();
            }else
            {
                return redirect()->route('organizations.payment.index')->with('success','Data has been saved successfully.');
            }
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
                'price_name' => $request->input('price_name'),

            ]);
        $result = view('Organization::payments.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function appendSubscription(Request $request){
        try {
            if($request->ajax()){

                $data = $request->all();
                $subscriptions = Subscription::where(['subscriber_id'=>$data['subscriber_id']])->select(['id','pricing_name'])->get();
                return view('Organization::payments.components.append_subscriptions',compact('subscriptions'))->render();
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
                $payment_balance = Subscription::where(['id'=>$data['subscription_id']])->select(['id','payment_balance'])->get();

                foreach ($payment_balance as $pay_balance){
                    $balance = $pay_balance->payment_balance;
                }
                return view('Organization::payments.components.appendBalance',compact('balance'))->render();
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
            return Excel::download(new ExportData($records), 'organization_payments_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

}
