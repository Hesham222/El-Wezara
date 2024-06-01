<?php

namespace Organization\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\Item\{
    StoreAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    AssignIngredientsVariantAction,
    StoreVariantAction,
    FilterAction,
    AssignIngredientsAction,
};
use Organization\Http\Requests\Item\{
    StoreRequest,
    UpdateRequest,
    RemoveRequest,
    StoreVriantRequest,
    FilterDateRequest
};
//use Admin\Exports\DiscountGroup\{
//    ExportData,
//};
use Organization\Models\{Ingredient, ItemDetail, Item, ItemVariant, MenuCategory, Setting};

class ItemController extends JsonResponse
{
    public function index()
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-View')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password')||
            checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Item-View')
        )
        return view('Organization::items.index');
        else
            return abort(401);
    }



    public function create()
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')||
            checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Item-Add')
        ) {
            $ingredients = Ingredient::select(['id', 'name', 'quantity','final_cost','unit_measurement_id','cost'])->get();
            $items = Item::select(['id', 'name','final_cost','cost'])->get();
            $variant_item_ids = Item::where('type', 'Variant')->pluck('id');
            $item_variants = ItemVariant::whereIn('item_id', $variant_item_ids)->select(['id', 'name','final_cost' ,'cost'])->get();
            $setting = Setting::first();
           $menu_categories = MenuCategory::all();
            if (!$setting){
                $setting = new Setting();
                $setting->dynamic_percentage = 1;
                $setting->save();
            }
            return view('Organization::items.create', compact( 'items', 'item_variants', 'menu_categories','ingredients','setting'));
        }else
            return abort(401);
    }

    public function addVariant($id)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')||
            checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Item-Add-Variant')
        ) {
            $item = Item::FindOrFail($id);
            if ($item->type != 'Variant') {
                return redirect()->back()->with('error', 'Failed, This Item Not A Variant.');

            }
            $setting = Setting::first();
            if (!$setting){
                $setting = new Setting();
                $setting->dynamic_percentage = 1;
                $setting->save();
            }
            return view('Organization::items.addVariant', compact('item','setting'));
        }else
            return abort(401);
    }


    public function store(StoreRequest $request,StoreAction $storeAction, AssignIngredientsAction $assignIngredientsAction)
    {
        // return $request->all();
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')
        ) {
            DB::beginTransaction();
        try {
            $record = $storeAction->execute($request);

            $assignIngredientsAction->execute($request, $record);

            DB::commit();
            return redirect()->route('organizations.item.index')->with('success', 'Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
        }else
            return abort(401);
    }


    public function storeVariant(StoreVriantRequest $request,StoreVariantAction $storeVariantAction, AssignIngredientsVariantAction $assignIngredientsVariantAction)
    {

        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')
        ) {

            DB::beginTransaction();
            try {
                $record = $storeVariantAction->execute($request);
                $assignIngredientsVariantAction->execute($request, $record);
                DB::commit();
                return redirect()->route('organizations.item.index')->with('success', 'Data has been saved successfully.');
            } catch (\Exception $exception) {
                DB::rollback();
                return redirect()->back()->with('error', 'Failed, Please try again later.')->withInput();
            }
        }else
            return abort(401);
    }


    public function allVariant($id)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')||
            checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Item-Show-Variant')

        ) {
            $item = Item::FindOrFail($id);
            if ($item->type != 'Variant') {
                return redirect()->back()->with('error', 'Failed, This Item Not A Variant.');

            }
            return view('Organization::items.allVariant', compact('item'));
        }else
            return abort(401);
    }


    public function showDetail($id)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')
        ) {
            $item = Item::FindOrFail($id);
            if (!$item) {
                return redirect()->back()->with('error', 'Failed, This Item Not found.');

            }
            return view('Organization::items.detail', compact('item'));
        }else
            return abort(401);
    }

    public function showVariantDetail($id)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')
        ) {
            $variant = ItemVariant::FindOrFail($id);
            if (!$variant) {
                return redirect()->back()->with('error', 'Failed, This Item Variant Not found.');

            }

            return view('Organization::items.variantDetail', compact('variant'));
        }else
            return abort(401);
    }

    public function deleteVariant($id)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')
        ) {
            $item_variant = ItemVariant::FindOrFail($id);
            $item_variant->delete();
            return redirect()->back()->with('success', 'Item Variant Deleted.');
        }else
            return abort(401);
    }

    public function edit($id)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')||
            checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Item-Edit')
        ) {
            $item = Item::FindOrFail($id);
            $ingredients = Ingredient::all();
            $items = Item::where('id', '!=', $item->id)->select(['id', 'name','final_cost', 'cost'])->get();
            $variant_item_ids = Item::where('type', 'Variant')->pluck('id');
            $item_variants = ItemVariant::whereIn('item_id', $variant_item_ids)->select(['id', 'name', 'final_cost','cost'])->get();
            $menu_categories = MenuCategory::all();
            $setting = Setting::first();
            if (!$setting){
                $setting = new Setting();
                $setting->dynamic_percentage = 1;
                $setting->save();
            }
            return view('Organization::items.edit', compact('item', 'items','menu_categories', 'item_variants', 'setting','ingredients'));
        }else
            return abort(401);
    }

    public function update(UpdateRequest $request, UpdateAction $updateAction,AssignIngredientsAction $assignIngredientsAction, $id)
    {

        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')
        ) {
            DB::beginTransaction();
            try {
                $record = $updateAction->execute($request, $id);
                $assignIngredientsAction->execute($request, $record);
                DB::commit();
                return redirect()->route('organizations.item.index')->with('success', 'Data has been saved successfully.');
            } catch (\Exception $exception) {
                DB::rollback();
                return redirect()->back()->with('error', 'Failed, Please try again later.')->withInput();
            }
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
        $result = view('Organization::items.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData($records), 'discountGroups_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occured, Please try again later.');
        }
    }

    public function trash(RemoveRequest $request, TrashAction $trashAction)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||
            checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Item-DeleteIngredient-View')
        ) {
            DB::beginTransaction();
            try {
                $record = $trashAction->execute($request);
                if (!$record)
                    return $this->response(500, 'Failed, This record is not found .', 200);
                DB::commit();
                return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'item', 'trashesCount' => $this->countTrashes()]);
            } catch (\Exception $ex) {
                DB::rollBack();
                return $this->response(500, 'Failed, Please try again later.', 200);
            }
        }else
            return abort(401);
    }

    public function destroy(RemoveRequest $request, DestroyAction $destroyAction, $id)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')
        ) {
            DB::beginTransaction();
            try {
                $record = $destroyAction->execute($request, $id);
                if (!$record)
                    return $this->response(500, 'Failed, This record is not found .', 200);
                DB::commit();
                return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'item', 'trashesCount' => $this->countTrashes()]);
            } catch (\Exception $ex) {
                DB::rollBack();
                return $this->response(500, 'Failed, Please try again later.', 200);
            }
        }else
            return abort(401);
    }

    public function restore(RemoveRequest $request, RestoreAction $restoreAction)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')
        ) {
            DB::beginTransaction();
            try {
                $record = $restoreAction->execute($request);
                if (!$record)
                    return $this->response(500, 'Failed, You can not restore this record, restore the parent subscription first.', 200);
                DB::commit();
                return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'item', 'trashesCount' => $this->countTrashes()]);
            } catch (\Exception $ex) {
                DB::rollBack();
                return $this->response(500, 'Failed, Please try again later.', 200);
            }
        }else
            return abort(401);
    }

    public function getIngredientsRow(Request $request)
    {
        $ingredients = Ingredient::select(['id','name','quantity','final_cost','unit_measurement_id','cost'])->get();

            $variant_item_ids = Item::where('type','Variant')->pluck('id');
            $item_variants = ItemVariant::whereIn('item_id',$variant_item_ids)->select(['id','name','final_cost','cost'])->get();
            $items = Item::whereNotIn('id',[$request->item_id])->select(['id','name','cost','final_cost'])->get();


        $results = view('Organization::items.components.ingredients.row',
            [
                'items'=>$items,
                'item_variants'=>$item_variants,
                'ingredients' => $ingredients ,
            ])->render();

        return $this->response(200, 'Ingredients Row', 200, [], 0, ['responseHTML' => $results]);
    }

    public function getIngredientsTags(Request $request)
    {

        $tags_array =[];
        $cost = 0;
        $cal = 0;
        for ($i =0; $i < count($request->val1) ;$i++){

            if ($request->val3[$i] == 2){
                $ing = Item::find($request->val1[$i]);
            }elseif ($request->val3[$i] == 3){
                $ing = ItemVariant::find($request->val1[$i]);
            }
            else{
                $ing = Ingredient::find($request->val1[$i]);
            }

            if ($request->val2[$i] == null){
                if ($ing->final_cost == null){
                    $cost += 1 * $ing->cost;
                }else{
                    $cost += 1 * $ing->final_cost;
                }


            }else{

                if ($ing->final_cost == null){
                    $cost += $request->val2[$i] * $ing->cost;
                }else{
                    $cost += $request->val2[$i] * $ing->final_cost;

                }



            }


        }


        $data = array('cost'=>$cost,'cal'=>$cal);
        return $data;

    }

    public function getItemCalcus(Request $request)
    {
         $auxiliary_materials = $request->cost * (10/100);
         $mortal = $request->cost * (5/100);
          $variable_ratio = $request->cost * (Setting::first()->dynamic_percentage/100);
          $final_cost = $request->cost  +  $auxiliary_materials + $mortal + $variable_ratio;

        $data = array('auxiliary_materials'=>$auxiliary_materials,
            'mortal'=>$mortal,
        'variable_ratio'=>$variable_ratio,
        'final_cost'=>$final_cost,
        );
        return $data;
    }

    private function countTrashes()
    {
        return Item::onlyTrashed()->count();
    }
}
