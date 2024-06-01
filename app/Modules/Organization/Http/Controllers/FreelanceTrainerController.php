<?php

namespace Organization\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Models\ClubSport;
use Organization\Models\Customer;
use Organization\Models\Pricing;
use Organization\Models\TrainerAttendance;
use Organization\Actions\FreelanceTrainer\{
    StoreAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
};
use Organization\Http\Requests\FreelanceTrainer\{
    StoreRequest,
    UpdateRequest,
    RemoveRequest,
    FilterDateRequest
};
use Organization\Exports\FreelanceTrainer\{
    ExportData,
};
use Organization\Models\{
    FreelanceTrainer
};

class FreelanceTrainerController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FreelanceTrainer-View')
        ){
            return view('Organization::freelanceTrainers.index');

        }else
            return abort(401);
    }

    public function create()
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FreelanceTrainer-Add')
        ){
            $clubSports = ClubSport::select(['id','name'])->get();
            return view('Organization::freelanceTrainers.create',compact('clubSports'));
        }else
            return abort(401);
    }

    public function store(StoreRequest $request, StoreAction $storeAction)
    {

        DB::beginTransaction();
        try {
            $storeAction->execute($request);
            DB::commit();
            return redirect()->route('organizations.freelanceTrainer.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }

    public function edit($id)
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FreelanceTrainer-Edit')
        ){
            $record = FreelanceTrainer::findOrFail($id);
            $clubSports = ClubSport::select(['id','name'])->get();

            return view('Organization::freelanceTrainers.edit', compact('record','clubSports'));
        }else
            return abort(401);
    }
    public function show($id)
    {
        $record_id = $id;

        return view('Organization::freelanceTrainers.show', compact('record_id'));
    }
    public function appendTable(Request $request){

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FreelanceTrainer-Show-ProfitRatios')
        ){
            try {
                if($request->ajax()){
                    $data       = $request->all();
                    $record_id  = $request->input('record_id');
                    $date_from  = $request->input('date_from');
                    $date_to    = $request->input('date_to');
                    //dd($record_id);

                    // get records for this trainer in specific time range
                    $old_records = TrainerAttendance::whereBetween('created_at', [$request->input('date_from'), $request->input('date_to')])->whereHas(
                        'Training',function ($query) use ($request) {
                        $query->where('freelance_trainer_id',$request->input('record_id'));
                    }
                    )->get();
                    $training_ids = array();
                    $records = array();

                    //confirm records not repeated
                    foreach ($old_records as $record) {
                        if (!in_array($record->training_id, $training_ids)) {
                            $records [] = $record;
                            $training_ids [] = $record->training_id;

                        } else {
                            continue;
                        }
                    }


                    return view('Organization::freelanceTrainers.components.append_table',compact('records'))->render();
                }
            } catch (\Exception $ex) {
                return $this->response(500, 'Failed, Please try again later.', 200);
            }
            return $this->response(500, 'Failed, Please try again later.', 200);
        }else
            return abort(401);

    }
    public function update(UpdateRequest $request, UpdateAction $updateAction, $id)
    {
        DB::beginTransaction();
        try {
            $updateAction->execute($request, $id);
            DB::commit();
            return redirect()->route('organizations.freelanceTrainer.index')->with('success','Data has been saved successfully.');
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
        $result = view('Organization::freelanceTrainers.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData($records), 'organization_freelance_trainers_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function trash(RemoveRequest $request, TrashAction $trashAction)
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FreelanceTrainer-Delete')
        ){
            DB::beginTransaction();
            try {
                $record =  $trashAction->execute($request);
                if(!$record)
                    return $this->response(500, 'Failed, This record is not found .', 200);
                DB::commit();
                return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'freelanceTrainers', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'freelanceTrainers', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'freelanceTrainers', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    private function countTrashes()
    {
        return FreelanceTrainer::onlyTrashed()->count();
    }
}
