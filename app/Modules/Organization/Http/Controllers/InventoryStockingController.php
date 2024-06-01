<?php
namespace Organization\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Organization\Actions\Ingredient\FilterStockingAction;
use Organization\Actions\Ingredient\StoreStockingAction;
use Organization\Http\Requests\Admin\FilterDateRequest;
use Organization\Http\Requests\Ingredient\StoreStockingRequest;
use Organization\Models\Ingredient;
use Organization\Models\InventoryStoking;


class InventoryStockingController extends JsonResponse
{
    public function index($id)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Ingredient-View-Stocking')
        ){
            $area = Ingredient::FindOrFail($id);
            return view('Organization::InventoryStockings.index',compact('area'));
        }else
            return abort(401);
    }

    public function create($id)
    {
        $area = Ingredient::FindOrFail($id);
        return view('Organization::InventoryStockings.create',compact('area'));
    }

    public function detail($id)
    {
        $stocking_area = InventoryStoking::FindOrFail($id);
        return view('Organization::InventoryStockings.detail',compact('stocking_area'));

    }

    public function store(StoreStockingRequest $request, StoreStockingAction $storeAction)
    {
        DB::beginTransaction();
       try {
            $storeAction->execute($request);
            DB::commit();
            return redirect()->route('organizations.InventoryStocking.index',$request->area_id)->with('success','Data has been saved successfully.');
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
        $result = view('Organization::InventoryStockings.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }
}
