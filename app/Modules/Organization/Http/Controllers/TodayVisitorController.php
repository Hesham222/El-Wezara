<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;

use Organization\Actions\TodayVisitor\Rent\{
    FilterAction as RentFilterAction,
};
use Organization\Http\Requests\TodayVisitor\Rent\{
    FilterDateRequest as RentRequest
};
use Organization\Exports\TodayVisitor\Rent\{
    ExportData as RentExport,
};

use Organization\Actions\TodayVisitor\Inventory\{
    FilterAction as InventroyFilterAction,
};
use Organization\Http\Requests\TodayVisitor\Inventory\{
    FilterDateRequest as InventoryRequest
};
use Organization\Exports\TodayVisitor\Inventory\{
    ExportData as InventoryExport,
};

use Organization\Actions\TodayVisitor\Hotel\{
    FilterAction as HotelFilterAction,
};
use Organization\Http\Requests\TodayVisitor\Hotel\{
    FilterDateRequest as HotelRequest
};
use Organization\Exports\TodayVisitor\Hotel\{
    ExportData as HotelExport,
};

use Organization\Actions\TodayVisitor\Event\{
    FilterAction as EventFilterAction,
};
use Organization\Http\Requests\TodayVisitor\Event\{
    FilterDateRequest as EventRequest
};
use Organization\Exports\TodayVisitor\Event\{
    ExportData as EventExport,
};

use Organization\Actions\TodayVisitor\Sport\{
    FilterAction as SportFilterAction
};
use Organization\Http\Requests\TodayVisitor\Sport\{
    FilterDateRequest as SportRequest
};
use Organization\Exports\TodayVisitor\Sport\{
    ExportData as SportExport,
};

class TodayVisitorController extends JsonResponse
{
    public function indexRent()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'GateReport-View-RentalVisitors')
        ){
            return view('Organization::todayVisitors.rents.index');
        }else
            return abort(401);
    }

    public function dataRent(RentRequest $request, RentFilterAction $filterAction)
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
        $result = view('Organization::todayVisitors.rents.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function exportRent(RentRequest $request, RentFilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new RentExport($records), 'organization_rent_visitors_sheets_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function indexHotel()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'GateReport-View-HotelVisitors')
        ){
            return view('Organization::todayVisitors.hotels.index');
        }else
            return abort(401);
    }

    public function dataHotel(HotelRequest $request, HotelFilterAction $filterAction)
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
        $result = view('Organization::todayVisitors.hotels.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function exportHotel(HotelRequest $request, HotelFilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new HotelExport($records), 'organization_hotel_visitors_sheets_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function indexInventory()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'GateReport-View-InventoryVisitors')
        ){
            return view('Organization::todayVisitors.inventories.index');
        }else
            return abort(401);
    }

    public function dataInventory(InventoryRequest $request, InventroyFilterAction $filterAction)
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
        $result = view('Organization::todayVisitors.inventories.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function exportInventory(InventoryRequest $request, InventroyFilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new InventoryExport($records), 'organization_inventory_visitors_sheets_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function indexEvent()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'GateReport-View-EventsVisitors')
        ){
            return view('Organization::todayVisitors.events.index');
        }else
            return abort(401);
    }

    public function dataEvent(EventRequest $request, EventFilterAction $filterAction)
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
        $result = view('Organization::todayVisitors.events.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function exportEvent(EventRequest $request, EventFilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new EventExport($records), 'organization_event_visitors_sheets_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function indexSport()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'GateReport-View-SportVisitors')
        ){
            return view('Organization::todayVisitors.sports.index');
        }else
            return abort(401);
    }

    public function dataSport(SportRequest $request, SportFilterAction $filterAction)
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
        $result = view('Organization::todayVisitors.sports.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function exportSport(SportRequest $request, SportFilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new SportExport($records), 'organization_sport_visitors_sheets_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }
}
