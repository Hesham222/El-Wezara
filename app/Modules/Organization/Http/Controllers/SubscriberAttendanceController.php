<?php

namespace Organization\Http\Controllers;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Models\Schedule;
use Organization\Models\TrainerAttendance;
use Organization\Actions\SubscriberAttendance\{
    StoreAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
};
use Organization\Http\Requests\SubscriberAttendance\{
    StoreRequest,
    UpdateRequest,
    RemoveRequest,
    FilterDateRequest
};
use Organization\Exports\SubscriberAttendance\{
    ExportData,
};
use Organization\Models\{
    SubscriberAttendance
};

class SubscriberAttendanceController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'SubscriberAttendance-View')
        ){
            return view('Organization::subscriberAttendances.index');

        }else
            return abort(401);
    }

    public function create()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'SubscriberAttendance-View-TodayTrainings')
        ){
            $date                       = Carbon::today();
            $d                          = new DateTime($date);
            $today_date                 = $d->format('l');
            $subscribersAttendances   = SubscriberAttendance::where(['day'=>$today_date])->get();

            $subscriber     = array();
            foreach ($subscribersAttendances as $subscriberAttend){
                $subscriber[]           =  $subscriberAttend->subscriber_id;
            }
            $trainingsToday            = Schedule::where(['day'=>$today_date])->whereHas('Training',function ($q)use ($subscriber)
            {
                $q->whereHas('Subscriptions',function ($f) use ($subscriber){
                    $f->WhereNotIn('subscriber_id',$subscriber)->where('cancelled', 0)->where('current_session','>',0)->orWhere('start_date','<=',Carbon::now())->orWhere('end_date','=>',Carbon::now());
                });
            })->get();
            //return $trainingsToday;

            return view('Organization::subscriberAttendances.create',compact('trainingsToday'));
        }else
            return abort(401);

    }

    public function store(Request $request, StoreAction $storeAction)
    {

        DB::beginTransaction();
        try {
            $storeAction->execute($request);
            DB::commit();
            return redirect()->route('organizations.subscriberAttendance.index')->with('success','Data has been saved successfully.');
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
        $result = view('Organization::subscriberAttendances.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData($records), 'organization_subscriber_Attendances_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }
}
