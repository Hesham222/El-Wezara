<?php

namespace Organization\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\RoomLoss\{
    UpdateAction,
    FilterAction,
    StoreAction,
    FoundAction
};
use Organization\Http\Requests\RoomLoss\{
    UpdateRequest,
    FilterDateRequest,
    StoreRequest,
    FoundRequest
};
use Organization\Exports\RoomLoss\{
    ExportData,
};
use Organization\Models\Hotel;
use Organization\Models\RoomLoss;

class RoomLossController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'RoomLoss-View')
        ){
            return view('Organization::roomLosses.index');
        }else
            return abort(401);
    }

    public function create()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'RoomLoss-Add')
        ){
            $hotels = Hotel::all();
            return view('Organization::roomLosses.create',compact('hotels'));
        }else
            return abort(401);
    }

    public function store(StoreRequest $request, StoreAction $storeAction)
    {
        DB::beginTransaction();
        try {
            $storeAction->execute($request);
            DB::commit();
            return redirect()->route('organizations.roomLoss.index')->with('success','Data has been saved successfully.');
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
        $result = view('Organization::roomLosses.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function edit($id)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'RoomLoss-Edit')
        ){
            $record = RoomLoss::findOrFail($id);
            $hotels = Hotel::all();
            return view('Organization::roomLosses.edit', compact('record','hotels'));
        }else
            return abort(401);
    }

    public function update(UpdateRequest $request, UpdateAction $updateAction, $id)
    {
        DB::beginTransaction();
        try {
            $updateAction->execute($request, $id);
            DB::commit();
            return redirect()->route('organizations.roomLoss.index')->with('success', 'Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error', 'Error occurred, Please try again later.')->withInput();
        }
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData($records), 'organization_room_losses_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function show($id)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'RoomLoss-Show')
        ){
            $record = RoomLoss::findOrFail($id);
            return view('Organization::roomLosses.show', compact('record'));
        }else
            return abort(401);
    }

    public function lossFound(FoundRequest $request, FoundAction $foundAction, $id)
    {
        DB::beginTransaction();
        try {
            $foundAction->execute($request, $id);
            DB::commit();
            return redirect()->route('organizations.roomLoss.index')->with('success', 'Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error', 'Error occurred, Please try again later.')->withInput();
        }
    }
}
