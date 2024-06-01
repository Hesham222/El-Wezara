<?php

namespace Organization\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\Ingredient\{FilterReOrderAction,
    StoreAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
    FilterExecIngAction
};
use Organization\Http\Requests\Ingredient\{
    StoreRequest,
    UpdateRequest,
    RemoveRequest,

    FilterDateRequest
};

use Organization\Exports\Ingredient\{
    ExportData,ExportCardData
};

use App\Imports\IngImport;
use Organization\Models\{Ingredient, Setting, UnitMeasurement,IngredentExecutionSheet, IngredentQuantity, IngredientCategory};

class IngredientController extends JsonResponse
{
    public function index()
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-View')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password')||
            checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Ingredient-View')
        )
        return view('Organization::ingredients.index');
        else
            return abort(401);
    }


    public function import()
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-View')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password')||
            checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Ingredient-Add-Excel')
        )
        return view('Organization::ingredients.import');
        else
            return abort(401);
    }





    public function card($id)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-View')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password')||
            checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Ingredient-Add-Excel')
        ){
            $ing = Ingredient::FindOrFail($id);
            return view('Organization::ingredients.card',compact('ing'));
        }

        else
            return abort(401);
    }


    public function importExcelCSV(Request $request)
    {
        $validatedData = $request->validate([

           'file' => 'required|file|mimes:csv',

        ]);

        Excel::import(new IngImport,$request->file('file'));


        return back()->with('success', 'تمت اضافه المنتجات بنجاح');
    }


    public function executionIngredent($id)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
        checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-View')||
        checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')||
        checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||
        checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password')||
        checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Ingredient-View-ExecutionOrder')
    ){
        $ing = Ingredient::FindOrFail($id);
        return view('Organization::ingredients.execution',compact('ing'));
    }

    else
        return abort(401);

    }

    public function reOrderIndex()
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-View')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password')||
            checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Ingredient-View-ReOrder')
        )
            return view('Organization::ingredients.reOrderIndex');
        else
            return abort(401);

    }

    public function reOrderIndexData(FilterDateRequest $request, FilterReOrderAction $filterAction)
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
        $result = view('Organization::ingredients.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function execIndex()
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-View')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password')
        )
            return view('Organization::ingredients.execIndex');
        else
            return abort(401);

    }

    public function execIndexData(FilterDateRequest $request, FilterExecIngAction $filterAction)
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
        $result = view('Organization::ingredients.components.execIndextable_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }






    public function create()
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')||
            checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Ingredient-Add')
        ) {
            $units = UnitMeasurement::all();
            $categories = IngredientCategory::where('parent_id','!=',null)->get();
            $setting = Setting::first();
            if (!$setting){
                $setting = new Setting();
                $setting->dynamic_percentage = 1;
                $setting->save();
            }
            return view('Organization::ingredients.create',compact('units','setting','categories'));
        }else
            return abort(401);

    }

    public function store(StoreRequest $request, StoreAction $storeAction)
    {
        //return $request->all();
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')
        ) {
            DB::beginTransaction();
             try {
                $storeAction->execute($request);
                DB::commit();
                return redirect()->route('organizations.ingredient.index')->with('success', 'Data has been saved successfully.');
             } catch (\Exception $exception) {
                DB::rollback();
                 return redirect()->back()->with('error', 'Failed, Please try again later.')->withInput();
             }
        }else
            return abort(401);
    }


    public function execIng($id)
    {


//return $request->all();
if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')
) {
DB::beginTransaction();
try {

$ing_q = IngredentQuantity::FindOrFail($id);

$ing = Ingredient::FindOrFail($ing_q->ingredient_id);

$amount =0;

if(!$ing_q->quantity < $ing->stock){
$amount = $ing_q->quantity;
}


$new_exec = new IngredentExecutionSheet();
$new_exec->ingredient_id = $ing->id;
$new_exec->quantity = $amount;
$new_exec->expiration_date = $ing_q->expiration_date;
$new_exec->created_by = auth('organization_admin')->user()->id;
$new_exec->save();

$ing->stock -= $amount;
$ing->save();
$ing_q->delete();



    DB::commit();
    return redirect()->route('organizations.ingredient.index')->with('success', 'Data has been saved successfully.');
} catch (\Exception $exception) {
    DB::rollback();
    return redirect()->back()->with('error', 'Failed, Please try again later.')->withInput();
}
}else
return abort(401);


    }

    public function edit($id)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')||
            checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Ingredient-Edit')
        ) {
            $units = UnitMeasurement::all();
            $categories = IngredientCategory::where('parent_id','!=',null)->get();
            $record = Ingredient::findOrFail($id);
            $setting = Setting::first();
            if (!$setting){
                $setting = new Setting();
                $setting->dynamic_percentage = 1;
                $setting->save();
            }
            return view('Organization::ingredients.edit', compact('record','units','setting','categories'));
        }else
            return abort(401);
    }

    public function update(UpdateRequest $request, UpdateAction $updateAction, $id)
    {

        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')
        ) {
            DB::beginTransaction();
            try {
                $updateAction->execute($request, $id);
                DB::commit();
                return redirect()->route('organizations.ingredient.index')->with('success', 'Data has been saved successfully.');
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
        $result = view('Organization::ingredients.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }


    public function trash(RemoveRequest $request, TrashAction $trashAction)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||
            checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Ingredient-Delete')
        ) {
            DB::beginTransaction();
            try {
                $record = $trashAction->execute($request);
                if (!$record)
                    return $this->response(500, 'Failed, This record is not found .', 200);
                DB::commit();
                return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'ingredient', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'ingredient', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'ingredient', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }


    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData($records), 'ingredients_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occured, Please try again later.');
        }
    }


    public function exportCard($id)
    {

        try{
            $ing = Ingredient::FindOrFail($id);
            return Excel::download(new ExportCardData($ing), 'ingredients_card.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occured, Please try again later.');
        }

    }


    private function countTrashes()
    {
        return Ingredient::onlyTrashed()->count();
    }

    public function manufactured($id){

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Ingredient-Add-ManufacturingProducts')
        ){
            $record = Ingredient::FindOrFail($id);
            return view('Organization::ingredients.manufactured',compact('record'));
        }else
            return abort(401);
    }

    public function addManufactured($id)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Report-View-DailyVisitors')
        ){
            $record = Ingredient::FindOrFail($id);
            $categories = IngredientCategory::where('parent_id','!=',null)->get();
            $setting = Setting::first();
            if (!$setting){
                $setting = new Setting();
                $setting->dynamic_percentage = 1;
                $setting->save();
            }
            return view('Organization::ingredients.addManufactured',compact('record','setting','categories'));
        }else
            return abort(401);


    }
}
