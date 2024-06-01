<?php

namespace Organization\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Models\Customer;
use Organization\Models\Pricing;
use Organization\Models\Training;
use Organization\Actions\Subscription\{
    StoreAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
    CancelFilterAction,
    CancelAction
};
use Organization\Http\Requests\Subscription\{
    StoreRequest,
    UpdateRequest,
    RemoveRequest,
    FilterDateRequest,
    CancelRequest
};
use Organization\Exports\Subscription\{
    ExportData,
    CancelExportData,
};
use Organization\Models\{
    Subscription,
    Subscriber
};

class SubscriptionController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Subscription-View')
        ){
            $subscribers    = Customer::has('Subscriptions')->select(['id','name'])->get();
            $trainings      = Training::select(['id','name'])->get();
            $pricing        = Subscription::select(['id','pricing_name'])->get();

            return view('Organization::subscriptions.index',compact('subscribers','trainings','pricing'));
        }else
            return abort(401);
    }

    public function create()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Subscription-Add')
        ){
            $subscribers    = Customer::select(['id','name'])->get();
            $trainings      = Training::select(['id','name'])->get();
            return view('Organization::subscriptions.create',compact('subscribers','trainings'));
        }else
            return abort(401);
    }

    public function store(StoreRequest $request, StoreAction $storeAction)
    {

        DB::beginTransaction();
        try {
            $storeAction->execute($request);
            DB::commit();
            return redirect()->route('organizations.subscription.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }
    public function appendOverPrice(Request $request){
        try {

            if($request->ajax()){
                if (isset($request->status)){
                    $price = $request->price;

                    $overpriced = $price * 12/100 + $price;
                    //dd($overprice);
                    return view('Organization::subscriptions.components.appendOverPrice',compact('overpriced'))->render();
                }else{
                    $overpriced = null ;
                }

            }
        } catch (\Exception $ex) {
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
        return $this->response(500, 'Failed, Please try again later.', 200);
    }
    public function appendBalanceOverprice(Request $request){
        try {

            if($request->ajax()){
                if (isset($request->status)){
                    // 1 - get balance
                    $pricing_name = $request->pricing_name;
                    $payment_price = Pricing::where(['training_id'=>$request->input('training_id'),'pricing_name'=> $pricing_name])->select(['price'])->get();

                    foreach ($payment_price as $pay_price){
                        $price_balance = $pay_price->price;
                    }
                    //2 - get price
                    $price = $request->price;
                    // 3 - calculate over price for balance

                    $balanceOver = $price * 12/100 + $price_balance;
                    return view('Organization::subscriptions.components.appendBalance',compact('balanceOver'))->render();
                }else{


                    $balanceOver =  $request->price;
                    return view('Organization::subscriptions.components.appendBalance',compact('balanceOver'))->render();
                }

            }
        } catch (\Exception $ex) {
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
        return $this->response(500, 'Failed, Please try again later.', 200);
    }
    public function edit($id)
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Subscription-Edit')
        ){
            $record             = Subscription::findOrFail($id);

            $subscribers        = Customer::select(['id','name'])->get();
            $trainings          = Training::select(['id','name'])->get();

            return view('Organization::subscriptions.edit',compact('record','subscribers','trainings'));
        }else
            return abort(401);
    }
    public function cancels()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Subscription-View-CancelReservations')
        ){
            return view('Organization::subscriptions.cancels');
        }else
            return abort(401);



    }
    public function cancel($id)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Subscription-Cancel-Reservation')
        ){
            $record             = Subscription::findOrFail($id);

            $payment_amount     = $record->Payments->sum('payment_amount');

            $num_of_attendance  = $record->Subscriber->Attendances->count('attendance');

            $price_of_session   = round(($record->price / $record->session_balance),2);

            $attendance_price   = $num_of_attendance * $price_of_session ;

            $rest_of_paid       = $payment_amount - $attendance_price ;


            return view('Organization::subscriptions.cancel',compact('record','price_of_session','payment_amount','num_of_attendance','rest_of_paid','attendance_price'));
        }else
            return abort(401);

    }
    public function appendRefund(Request $request){
        try {

            if($request->ajax()){

                    $refund = $request->rest_of_paid - $request->rest_of_paid * ($request->commission / 100);

                    return view('Organization::subscriptions.components.appendRefund',compact('refund'))->render();

            }
        } catch (\Exception $ex) {
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
        return $this->response(500, 'Failed, Please try again later.', 200);
    }

    public function cancelSubscription(CancelRequest $request, CancelAction $cancelAction)
    {

        DB::beginTransaction();
        try {
            $cancelAction->execute($request);
            DB::commit();
            return redirect()->route('organizations.subscription.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }

    public function cancelData(FilterDateRequest $request, CancelFilterAction $filterAction)
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
        $result = view('Organization::subscriptions.components.cancel_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function exportCancel(FilterDateRequest $request, CancelFilterAction $filterAction)
    {

        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new CancelExportData($records), 'organization_cancel_subscriptions_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function update(UpdateRequest $request, UpdateAction $updateAction, $id)
    {
        DB::beginTransaction();
        try {
            $updateAction->execute($request, $id);
            DB::commit();
            return redirect()->route('organizations.subscription.index')->with('success','Data has been saved successfully.');
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
                'training'   => $request->input('training'),
                'price_name' => $request->input('price_name'),

            ]);
        $result = view('Organization::subscriptions.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function appendPricings(Request $request){
        try {

            if($request->ajax()){
                 $data = $request->all();
                 $record = $request->input('pricing_id');
                 $trainingId = $request->input('training_id');
                 $subType = $request->input('subscriber_id');

                 $ScriberT = Customer::where('id', $data['subscriber_id'])->select(['customerType_id'])->get();
                foreach ($ScriberT as $type){
                    $subscriberType = $type->customerType_id;
                }
                //return $subscriberType;
                 $pricings = Pricing::where(['training_id'=>$request->input('training_id'),'subscriber_type_id'=> $subscriberType])->get();

                return view('Organization::subscriptions.components.append_prices',compact('pricings','record'))->render();
            }
        } catch (\Exception $ex) {
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
        return $this->response(500, 'Failed, Please try again later.', 200);
    }
    public function appendTrainings(Request $request){
    try {

        if($request->ajax()){
        $data = $request->all();
        $training_record = $request->input('training_id');
        $ScriberT = Customer::where('id', $data['subscriber_id'])->select(['customerType_id'])->get();
        foreach ($ScriberT as $type){
            $subscriberType = $type->customerType_id;
        }

        $trainingsAll = Training::whereHas('pricings',function ($q) use ($subscriberType)
        {
            $q->where('subscriber_type_id',$subscriberType);
        })->get();

        return view('Organization::subscriptions.components.append_trainings',compact('trainingsAll','training_record','subscriberType'))->render();
    }
        } catch (\Exception $ex) {
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    return $this->response(500, 'Failed, Please try again later.', 200);
    }
    public function appendDurations(Request $request){
        try {

            if($request->ajax()){
                $data = $request->all();
                $record = $request->input('pricing_id');
                $trainingId = $request->input('training_id');
                // get session balance from price
                $pricing_balance = Pricing::where('pricing_name',$request->input('pricing_id'))->select(['num_of_sessions'])->get();

                foreach ($pricing_balance as $balance){
                    $sessionBalance = $balance->num_of_sessions;
                }
                //return $sessionBalance;
                //get training type from price
                 $training = Training::where('id',$request->input('training_id'))->select('type')->get();

                foreach ($training as $type){
                    $trainingType = $type->type;
                }
                return view('Organization::subscriptions.components.append_durations',compact('sessionBalance','trainingType'))->render();
            }
        } catch (\Exception $ex) {
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
        return $this->response(500, 'Failed, Please try again later.', 200);
    }

    public function appendDateDuration(Request $request){
        try {

            if($request->ajax()){
                $data = $request->all();
                $start_date     = $data['start_date'];
                $training_id    = $data['training_id'];
                $subscriber_id  = $data['subscriber_id'];

                $ScriberT = Customer::where('id', $data['subscriber_id'])->select(['customerType_id'])->get();
                foreach ($ScriberT as $type){
                    $subscriberType = $type->customerType_id;
                }
                 $training = Pricing::where(['training_id'=>$training_id ,'subscriber_type_id'=>$subscriberType])->select(['duration_in_days'])->get();
                foreach ($training as $day){
                    $duration_in_days = $day->duration_in_days;
                }
                $start_date = Carbon::parse($request['start_date']);

                $EndDate = $start_date->addDays($duration_in_days);
                $end_date = $EndDate->toDateString();
                return view('Organization::subscriptions.components.duration',compact('end_date'))->render();
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
                $pricing_name = $data['pricing_name'];

                 $payment_balance = Pricing::where(['training_id'=>$request->input('training_id'),'pricing_name'=> $pricing_name])->select(['price'])->get();

                foreach ($payment_balance as $pay_balance){
                    $balance = $pay_balance->price;
                }
                return view('Organization::subscriptions.components.appendBalance',compact('balance'))->render();
            }
        } catch (\Exception $ex) {
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
        return $this->response(500, 'Failed, Please try again later.', 200);
    }
    public function appendPrice(Request $request){
        try {

            if($request->ajax()){
                $data = $request->all();
                $pricing_name = $data['pricing_name'];

                 $payment_price = Pricing::where(['training_id'=>$request->input('training_id'),'pricing_name'=> $pricing_name])->select(['price'])->get();

                foreach ($payment_price as $pay_price){
                    $price = $pay_price->price;
                }
                return view('Organization::subscriptions.components.appendPrice',compact('price'))->render();
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
            return Excel::download(new ExportData($records), 'organization_subscriptions_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function trash(RemoveRequest $request, TrashAction $trashAction)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Subscription-Delete')
        ){
            DB::beginTransaction();
            try {
                $record =  $trashAction->execute($request);
                if(!$record)
                    return $this->response(500, 'Failed, This record is not found .', 200);
                DB::commit();
                return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'subscriptions', 'trashesCount' => $this->countTrashes()]);
            } catch (\Exception $ex) {
                DB::rollBack();
                return $this->response(500, 'Failed, Please try again later.', 200);
            }
        }else
            return abort(401);

    }

    public function destroy(RemoveRequest $request, DestroyAction $destroyAction, $id)
    {
        DB::beginTransaction();
        try {
            if ($id === 1)
                return $this->response(500, 'Failed, You can not delete this record.', 200);
            $record =  $destroyAction->execute($request, $id);
            if(!$record)
                return $this->response(500, 'Failed, This record is not found .', 200);
            DB::commit();
            return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'subscriptions', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'subscriptions', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    private function countTrashes()
    {
        return Subscription::onlyTrashed()->count();
    }
}
