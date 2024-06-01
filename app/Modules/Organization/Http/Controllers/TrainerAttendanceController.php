<?php

namespace Organization\Http\Controllers;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Models\Schedule;
use Organization\Models\Training;
use Organization\Actions\TrainerAttendance\{
    StoreAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
};
use Organization\Http\Requests\TrainerAttendance\{
    StoreRequest,
    UpdateRequest,
    RemoveRequest,
    FilterDateRequest
};
use Organization\Exports\TrainerAttendance\{
    ExportData,
};
use Organization\Models\{
    TrainerAttendance
};

class TrainerAttendanceController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'TrainerAttendance-View')
        ){
            return view('Organization::trainerAttendances.index');

        }else
            return abort(401);
    }

    public function create()
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'TrainerAttendance-View-TodayTrainings')
        ){
            $date                  = Carbon::today();
            $d                     = new DateTime($date);
            $today_date             = $d->format('l');//Tuesday

            $trainersAttendances    = TrainerAttendance::where(['day'=>$today_date])->get();
            $tr  = array();

            foreach ($trainersAttendances as $attendance){
                $tr[]           =  $attendance->training_id;
            }

            $trainingsToday     = Schedule::where(['day'=>$today_date])->WhereNotIn('training_id',$tr)->get();


            return view('Organization::trainerAttendances.create',compact('trainingsToday'));
        }else
            return abort(401);
    }

    public function store(Request $request, StoreAction $storeAction)
    {

        DB::beginTransaction();
        try {
            $storeAction->execute($request);
            DB::commit();
            return redirect()->route('organizations.trainerAttendance.index')->with('success','Data has been saved successfully.');
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
        $result = view('Organization::trainerAttendances.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData($records), 'organization_trainer_Attendances_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }
}
