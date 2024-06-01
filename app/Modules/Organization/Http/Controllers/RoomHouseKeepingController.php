<?php

namespace Organization\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\HouseKeeping\{
    UpdateAction,
    FilterAction,
};

use Organization\Http\Requests\HouseKeeping\{
    UpdateRequest,
    FilterDateRequest
};
use Organization\Exports\HouseKeeping\{
    ExportData,
};
use Organization\Models\RoomHouseKeeping;

class RoomHouseKeepingController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'HouseKeeping-View')
        ){
            return view('Organization::houseKeeping.index');
        }else
            return abort(401);
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
        $result = view('Organization::houseKeeping.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function edit($id)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'HouseKeeping-Edit')
        ){
            $record = RoomHouseKeeping::findOrFail($id);
            return view('Organization::houseKeeping.edit', compact('record'));
        }else
            return abort(401);
    }

    public function update(UpdateRequest $request, UpdateAction $updateAction, $id)
    {
        DB::beginTransaction();
        try {
            $updateAction->execute($request, $id);
            DB::commit();
            return redirect()->route('organizations.housekeeping.index')->with('success', 'Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error', 'Error occurred, Please try again later.')->withInput();
        }
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData($records), 'organization_house_keeping_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function show($id)
    {

    }
}
