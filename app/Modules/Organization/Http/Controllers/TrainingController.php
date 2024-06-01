<?php

namespace Organization\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Models\ClubSport;
use Organization\Models\CustomerType;
use Organization\Models\FreelanceTrainer;
use Organization\Models\SportActivityAreas;
use Organization\Actions\Training\{
    StoreAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
    ScheduleStoreAction,
    PricingStoreAction,
    ScheduleUpdateAction,
    PricingUpdateAction,
};
use Organization\Http\Requests\Training\{
    StoreRequest,
    UpdateRequest,
    RemoveRequest,
    FilterDateRequest
};
use Organization\Exports\Training\{
    ExportData,
};
use Organization\Models\{
    Training
};

class TrainingController extends JsonResponse
{
    public function index()
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Training-View')
        ){
            $clubSports     = ClubSport::has('Trainings')->select(['id','name'])->get();
            $areas          = SportActivityAreas::has('Trainings')->select(['id','name'])->get();
            $trainers       = FreelanceTrainer::has('Trainings')->select(['id','name'])->get();
            return view('Organization::trainings.index',compact('clubSports','areas','trainers'));
        }else
            return abort(401);
    }

    public function create()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Training-Add')
        ){
            $clubSports         = ClubSport::select(['id','name'])->get();
            $activityAreas      = SportActivityAreas::select(['id','name'])->get();
            $subscriberTypes    = CustomerType::select(['id','name'])->get();

            return view('Organization::trainings.create',compact('clubSports','activityAreas','subscriberTypes'));
        }else
            return abort(401);
    }

    public function getScheduleRow()
    {

        $results = view('Organization::trainings.components.schedule.row',
            [

            ])->render();

        return $this->response(200, 'Schedules Row', 200, [], 0, ['responseHTML' => $results]);
    }

    public function getPricingRow()
    {
        $subscriberTypes    = CustomerType::select(['id','name'])->get();

        $results = view('Organization::trainings.components.pricing.row',compact('subscriberTypes'),
            [

            ])->render();

        return $this->response(200, 'Pricing Row', 200, [], 0, ['responseHTML' => $results]);
    }

    private function generateDateRange(Carbon $start_date, Carbon $end_date)
    {
        $dates = [];

        for($date = $start_date->copy(); $date->lte($end_date); $date->addDay()) {
            $dates[] = $date->format('Y-m-d');
        }

        return $dates;
    }

    public function store(StoreRequest $request, StoreAction $storeAction,ScheduleStoreAction $scheduleStoreAction ,PricingStoreAction $pricingStoreAction)
    {
        DB::beginTransaction();

        try {
            $record =   $storeAction->execute($request);
            if(!$record)
                return $this->response(500, 'Failed, This record is not found .', 200);
            $schedule = $scheduleStoreAction->execute($request,$record);
           if(!$schedule)
               return redirect()->back()->with('error','... يجب ان يكون وقت النهايه اكبر من وقت البدء في الجداول .')->withInput();

            $pricing =  $pricingStoreAction->execute($request,$record);
            DB::commit();
            return redirect()->route('organizations.training.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }

    public function edit($id)
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Training-Edit')
        ){
            $record = Training::with(['Schedules'=>function($query){
                $query->select(['id','training_id','day','start_time','end_time']);
            }])->find($id);
            $clubSports         = ClubSport::select(['id','name'])->get();
            $activityAreas      = SportActivityAreas::select(['id','name'])->get();
            $subscriberTypes    = CustomerType::select(['id','name'])->get();
            $freelance_trainers = FreelanceTrainer::select(['id','name'])->get();
            return view('Organization::trainings.edit', compact('record','freelance_trainers','clubSports','activityAreas','subscriberTypes'));
        }else
            return abort(401);
    }

    public function update(Request $request, UpdateAction $updateAction,ScheduleUpdateAction $scheduleUpdateAction ,PricingUpdateAction $pricingUpdateAction, $id)
    {
        DB::beginTransaction();
        try {
            $record = $updateAction->execute($request, $id);

            $schedule = $scheduleUpdateAction->execute($request,$record);

            $pricing =  $pricingUpdateAction->execute($request,$record);
            DB::commit();
            return redirect()->route('organizations.training.index')->with('success','Data has been saved successfully.');
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
                'clubSport'  => $request->input('clubSport'),
                'area'       => $request->input('area'),
                'trainer'    => $request->input('trainer'),
                'type'       => $request->input('type'),

            ]);
        $result = view('Organization::trainings.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }
    public function appendTrainers(Request $request){
        try {
            if($request->ajax()){
                $data = $request->all();
                $trainers = FreelanceTrainer::where(['club_sport_id'=>$data['club_sport_id']])->select(['id','name'])->get();
                return view('Organization::trainings.components.append_trainers',compact('trainers'))->render();
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
            return Excel::download(new ExportData($records), 'organization_trainings_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function trash(RemoveRequest $request, TrashAction $trashAction)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Training-Delete')
        ){
            DB::beginTransaction();
            try {
                $record =  $trashAction->execute($request);
                if(!$record)
                    return $this->response(500, 'Failed, This record is not found .', 200);
                DB::commit();
                return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'trainings', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'trainings', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'trainings', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    private function countTrashes()
    {
        return Training::onlyTrashed()->count();
    }
}
