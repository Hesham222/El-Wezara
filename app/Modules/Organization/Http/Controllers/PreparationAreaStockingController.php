<?php
namespace Organization\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\PreparationArea\FilterStockingAction;
use Organization\Actions\PreparationArea\StoreStockingAction;
use Organization\Http\Requests\Admin\FilterDateRequest;
use Organization\Http\Requests\PreparationArea\StoreStockingRequest;
use Organization\Models\PreparationArea;
use Organization\Models\PreparationAreaStocking;


class PreparationAreaStockingController extends JsonResponse
{
    
    public function index($id)
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PreparationArea-View-Stocking')
        ){
            $area = PreparationArea::FindOrFail($id);
            return view('Organization::PreparationAreaStockings.index',compact('area'));
        }else
            return abort(401);
    }

    public function create($id)
    {
        $area = PreparationArea::FindOrFail($id);
        return view('Organization::PreparationAreaStockings.create',compact('area'));
    }

    public function detail($id)
    {
        $stocking_area = PreparationAreaStocking::FindOrFail($id);
        return view('Organization::PreparationAreaStockings.detail',compact('stocking_area'));

    }

    public function store(StoreStockingRequest $request, StoreStockingAction $storeAction)
    {
        DB::beginTransaction();
        try {
            $storeAction->execute($request);
            DB::commit();
            return redirect()->route('organizations.PreparationAreaStocking.index',$request->area_id)->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }

    public function data(FilterDateRequest $request, FilterStockingAction $filterAction,$id)
    {
        $records = $filterAction->execute($request,$id)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),

            ]);
        $result = view('Organization::PreparationAreaStockings.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }






}
