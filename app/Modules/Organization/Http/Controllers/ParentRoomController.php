<?php

namespace Organization\Http\Controllers;
use function Google\Auth\Cache\get;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

use Organization\Models\CustomerType;
use Organization\Models\GuestType;
use Organization\Models\Hotel;
use Organization\Models\RoomType;
use Organization\Actions\ParentRoom\{
    StoreAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
    DayPricingStoreAction,
    PricingStoreAction,
    DayPricingUpdateAction,
    PricingUpdateAction,
    RoomStoreAction,
    RoomUpdateAction,
};
use Organization\Http\Requests\ParentRoom\{
    StoreRequest,
    UpdateRequest,
    RemoveRequest,
    FilterDateRequest
};
use Organization\Exports\ParentRoom\{
    ExportData,
};
use Organization\Models\{
    ParentRoom
};

class ParentRoomController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'ParentRoom-View')
        ){
            return view('Organization::parentRooms.index');

        }else
            return abort(401);
    }

    public function create()
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'ParentRoom-Add')
        ){
            $guestTypes     = CustomerType::select(['id','name'])->get();
            $roomTypes      = RoomType::select(['id','name'])->get();
            $hotels = Hotel::select(['id','name'])->get();
            return view('Organization::parentRooms.create',compact('guestTypes','roomTypes','hotels'));
        }else
            return abort(401);
    }

    public function getDayPricingRow()
    {
        $guestTypes     = CustomerType::select(['id','name'])->get();
        $roomTypes      = RoomType::select(['id','name'])->get();

        $results = view('Organization::parentRooms.components.dayPricing.row',compact('guestTypes','roomTypes'),
            [

            ])->render();

        return $this->response(200, 'Day Pricing Row', 200, [], 0, ['responseHTML' => $results]);
    }

    public function getPricingRow()
    {
        $guestTypes     = CustomerType::select(['id','name'])->get();
        $roomTypes      = RoomType::select(['id','name'])->get();

        $results = view('Organization::parentRooms.components.pricing.row',compact('guestTypes','roomTypes'),
            [

            ])->render();

        return $this->response(200, 'Pricing Row', 200, [], 0, ['responseHTML' => $results]);
    }


    public function store(StoreRequest $request, StoreAction $storeAction,PricingStoreAction $pricingStoreAction,DayPricingStoreAction $dayPricingStoreAction,RoomStoreAction $roomStoreAction)
    {
        DB::beginTransaction();
        try {
            $record         =   $storeAction->execute($request);
            $pricingStoreAction->execute($request,$record);
            $dayPricingStoreAction->execute($request,$record);
            $roomStoreAction->execute($request,$record);

            DB::commit();
            return redirect()->route('organizations.parentRoom.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }

    public function edit($id)
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'ParentRoom-Edit')
        ){
            $record        = ParentRoom::find($id);
            $guestTypes     = CustomerType::select(['id','name'])->get();
            $roomTypes      = RoomType::select(['id','name'])->get();
            $hotels = Hotel::select(['id','name'])->get();
            return view('Organization::parentRooms.edit',compact('record','guestTypes','roomTypes','hotels'));
        }else
            return abort(401);
    }

    public function update(UpdateRequest $request, UpdateAction $updateAction,PricingUpdateAction $pricingUpdateAction,DayPricingUpdateAction $dayPricingUpdateAction,RoomUpdateAction $roomUpdateAction, $id)
    {
        DB::beginTransaction();
        try {
            $record         =   $updateAction->execute($request, $id);
            $pricingUpdateAction->execute($request,$record);
            $dayPricingUpdateAction->execute($request,$record);
            $roomUpdateAction->execute($request,$record);

            DB::commit();
            return redirect()->route('organizations.parentRoom.index')->with('success','Data has been saved successfully.');
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
        $result = view('Organization::parentRooms.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData($records), 'organization_parent_Rooms_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function trash(RemoveRequest $request, TrashAction $trashAction)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'ParentRoom-Delete')
        ){
            DB::beginTransaction();
            try {
                $record =  $trashAction->execute($request);
                if(!$record)
                    return $this->response(500, 'Failed, This record is not found .', 200);
                DB::commit();
                return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'parentRooms', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'parentRooms', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'parentRooms', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    private function countTrashes()
    {
        return ParentRoom::onlyTrashed()->count();
    }
}
