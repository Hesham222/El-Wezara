<?php

namespace Organization\Http\Controllers;
use Admin\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\Ingredient\IngredientFilterAction;
use Organization\Models\Ingredient;
use Organization\Actions\Vendor\{
    StoreAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
    IngredientStoreAction,
    IngredientUpdateAction,
    IngredientDestroyAction
};
use Organization\Http\Requests\Vendor\{
    StoreRequest,
    IngredientStoreRequest,
    UpdateRequest,
    RemoveRequest,
    FilterDateRequest,
    MakeDeductionRequest,
    IngredientUpdateRequest,
    IngredientRemoveRequest
};
use Organization\Exports\Vendor\{
    ExportData,
    IngredientExportData
};
use Organization\Models\{PurchaseOrder,VendorIngredient, Vendor, VendorData, VendorInformation, VendorType,PurchaseOrderDeduction};

class VendorController extends JsonResponse
{
    public function index()
    {
        return view('Organization::vendors.index');
    }

    public function create()
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-View')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password')||
            checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Vendor-View')
        ){
            $vendorTypes = VendorType::all();
            return view('Organization::vendors.create',compact('vendorTypes'));
        }

        else
            return abort(401);
    }



    public function appendInformation(Request $request){
        try {
            if($request->ajax()){
                $data = $request->all();
                $vendor_information = VendorInformation::where(['vendorType_id'=>$data['vendorType_id']])->get();
                return view('Organization::vendors.components.append_information',compact('vendor_information'))->render();
            }
        } catch (\Exception $ex) {
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
        return $this->response(500, 'Failed, Please try again later.', 200);
    }

    public function store(StoreRequest $request, StoreAction $storeAction)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')
        ) {
            DB::beginTransaction();
            try {
                $storeAction->execute($request);
                DB::commit();
                return redirect()->route('organizations.vendor.index')->with('success', 'Data has been saved successfully.');
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
            checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Vendor-View')
        ) {
            $record = Vendor::findOrFail($id);
            $vendorData           = VendorData::where('vendor_id',$record->id)->get();
            $vendorTypes          = VendorType::with('information')->get();
            $vendorInformation    = VendorInformation::get();
            return view('Organization::vendors.edit', compact('record','vendorTypes','vendorData','vendorInformation'));
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
                return redirect()->route('organizations.vendor.index')->with('success', 'Data has been saved successfully.');
            } catch (\Exception $exception) {
                DB::rollback();
                return redirect()->back()->with('error', 'Failed, Please try again later.')->withInput();
            }
        }else
            return abort(401);
    }


public function showDeductionOrderForm($po_id)
{

    $po = PurchaseOrder::FindOrFail($po_id);
    return view('Organization::vendors.show_deduction_form', compact( 'po'));

}

public function deleteDeduction($deduction_id)
{
    if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
    checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')
) {
    DB::beginTransaction();
    try {

        $deduction = PurchaseOrderDeduction::FindOrFail($deduction_id);
   $po =  PurchaseOrder::FindOrFail($deduction->purchase_order_id);
        $po->total += $deduction->amount;
        $po->save();

        $deduction->delete();
        DB::commit();
        return redirect()->route('organizations.vendor.show',$po->vendor->id)->with('success', 'Data has been saved successfully.');
    } catch (\Exception $exception) {
        DB::rollback();
        return redirect()->back()->with('error', 'Failed, Please try again later.')->withInput();
    }
}else
    return abort(401);

}

public function showDeductionOrders($po_id)
{

    $po = PurchaseOrder::FindOrFail($po_id);

    return view('Organization::vendors.show_deductions', compact( 'po'));

}
    public function makeDeductionOrder(MakeDeductionRequest $request)
    {

        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
        checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')
    ) {
        DB::beginTransaction();
        try {
            $po = PurchaseOrder::FindOrFail($request->po_id);
            $amount = 0;
            if($request->type == 1)
            {
                if($request->value > 100)
                {
                    return redirect()->back()->with('error', 'يجب الا تتعدى النسبة 100')->withInput();

                }


                $amount = ($po->total * $request->value)/100 ;
                if($amount > $po->total)
                return redirect()->back()->with('error', 'يجب الا تتعدى قيمة الخصم قيمة امر الشراء ')->withInput();
            }else
            {
                if($request->value > $po->total)
                return redirect()->back()->with('error', 'يجب الا تتعدى قيمة الخصم قيمة امر الشراء ')->withInput();

                $amount = $request->value ;

            }

            $po->total -= $amount ;
            $po->save();

            // add record for deduction
            $new_deduction = new PurchaseOrderDeduction();
            $new_deduction->created_by = auth('organization_admin')->user()->id;
            $new_deduction->purchase_order_id = $po->id;
            $new_deduction->type = ($request->type == 1)?'per':'val';
            $new_deduction->amount = $amount;
            $new_deduction->reason = $request->reason;
            $new_deduction->save()
;
            DB::commit();
            return redirect()->route('organizations.vendor.show',$po->vendor->id)->with('success', 'Data has been saved successfully.');
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
        $result = view('Organization::vendors.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }


    public function trash(RemoveRequest $request, TrashAction $trashAction)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Vendor-View')
        ){
            DB::beginTransaction();
            try {
                $record =  $trashAction->execute($request);
                if(!$record)
                    return $this->response(500, 'Failed, This record is not found .', 200);
                DB::commit();
                return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'vendor', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'vendor', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'vendor', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    private function countTrashes()
    {
        return Vendor::onlyTrashed()->count();
    }



    public function downloadtTax_card($id)
    {

        try {
            $vendor = Vendor::where('id', $id)->first();
            if ($vendor) {

                $pdfContent = Storage::get($vendor->tax_card_attachment);
                $filePath = $vendor->tax_card_attachment;
                $type = Storage::mimeType($filePath);
                $fileName = 'jbjj';//Storage::name($filePath);

                return Response::make($pdfContent, 200, [
                    'Content-Type' => $type,
                    'Content-Disposition' => 'inline; filename="' . $fileName . '"'
                ]);
            } else {
                return back();
            }
        }catch (\Exception $exception) {
            return back()->with('error','Please Upload file again and try to show it');
        }

    }



    public function downloadCommercial_record($id)
    {

        try {
            $vendor = Vendor::where('id', $id)->first();
            if ($vendor) {

                $pdfContent = Storage::get($vendor->commercial_record_attachment);
                $filePath = $vendor->commercial_record_attachment;
                $type = Storage::mimeType($filePath);
                $fileName = 'jbjj';//Storage::name($filePath);

                return Response::make($pdfContent, 200, [
                    'Content-Type' => $type,
                    'Content-Disposition' => 'inline; filename="' . $fileName . '"'
                ]);
            } else {
                return back();
            }
        }catch (\Exception $exception) {
            return back()->with('error','Please Upload file again and try to show it');
        }

    }



    public function show($id)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Vendor-View')
        ){
            $vendor = Vendor::findOrFail($id);
            return view('Organization::vendors.show', compact( 'vendor'));
        }else
            return abort(401);

    }

    public function createIngredient($id)
    {
        $record                 = Vendor::findOrFail($id);
        $ingredients            = Ingredient::get();

        return view('Organization::vendors.ingredients.create',compact('record','ingredients'));
    }

    public function storeIngredient(IngredientStoreRequest $request, IngredientStoreAction $storeAction)
    {
            DB::beginTransaction();
            try {
                $record = $storeAction->execute($request);
                DB::commit();
                return redirect()->route('organizations.vendor.show.ingredient',$record->vendor_id)->with('success', 'Data has been saved successfully.');
            } catch (\Exception $exception) {
                DB::rollback();
                return redirect()->back()->with('error', 'Failed, Please try again later.')->withInput();
            }
    }
    public function showIngredients($id)
    {
        $record                 = Vendor::findOrFail($id);
        $ingredients            = Ingredient::get();

        return view('Organization::vendors.ingredients.index',compact('record','ingredients'));
    }
    public function ingredientData(FilterDateRequest $request, IngredientFilterAction $filterAction)
    {
        $records = $filterAction->execute($request)
            ->orderBy('id','DESC')
            ->where('vendor_id',$request->input('record_id'))
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),
                'ingredient' => $request->input('ingredient'),

            ]);
        $result = view('Organization::vendors.ingredients.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }
    public function editIngredient($id)
    {
        $record     = VendorIngredient::findOrFail($id);
        return view('Organization::vendors.ingredients.edit',compact('record'));
    }

    public function updateIngredient(IngredientUpdateRequest $request, IngredientUpdateAction $updateAction, $id)
    {
        DB::beginTransaction();
        try {
            $record = $updateAction->execute($request, $id);
            DB::commit();
            return redirect()->route('organizations.vendor.show.ingredient',$record->vendor_id)->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later Or check if the order number is repeated.')->withInput();
        }
    }
    public function exportIngredient(FilterDateRequest $request, IngredientFilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new IngredientExportData($records), 'vendor_ingredients_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }
    public function destroyIngredient(IngredientRemoveRequest $request, IngredientDestroyAction $destroyAction, $id)
    {
        DB::beginTransaction();
        try {
            $record =  $destroyAction->execute($request, $id);
            if(!$record)
                return $this->response(500, 'Failed, This record is not found .', 200);
            DB::commit();
            return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'projects', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }
}
