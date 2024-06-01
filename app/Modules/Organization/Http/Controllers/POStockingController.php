<?php
namespace Organization\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Organization\Actions\PointOfSale\FilterStockingAction;
use Organization\Actions\PointOfSale\StoreStockingAction;
use Organization\Http\Requests\Admin\FilterDateRequest;
use Organization\Http\Requests\PointOfSale\StoreStockingRequest;
use Organization\Models\PointOfSale;
use Organization\Models\PoStoking;


class POStockingController extends JsonResponse
{
    public function index($id)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PointOfSale-View-Stocking')
        ){
            $area = PointOfSale::FindOrFail($id);
            return view('Organization::PointOfSaleStockings.index',compact('area'));
        }else
            return abort(401);
    }

    public function create($id)
    {
        $area = PointOfSale::FindOrFail($id);
        return view('Organization::PointOfSaleStockings.create',compact('area'));
    }

    public function detail($id)
    {
        $stocking_area = PoStoking::FindOrFail($id);
        return view('Organization::PointOfSaleStockings.detail',compact('stocking_area'));

    }

    public function store(StoreStockingRequest $request, StoreStockingAction $storeAction)
    {
        DB::beginTransaction();
       try {
            $storeAction->execute($request);
            DB::commit();
            return redirect()->route('organizations.POStocking.index',$request->area_id)->with('success','Data has been saved successfully.');
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
        $result = view('Organization::PointOfSaleStockings.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }
}
