<?php

namespace Organization\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\Package\DestroyAction;
use Organization\Actions\Package\FilterAction;
use Organization\Actions\Package\RestoreAction;
use Organization\Actions\Package\StoreAction;
use Organization\Actions\Package\TrashAction;
use Organization\Actions\Package\UpdateAction;
use Organization\Exports\Package\ExportData;
use Organization\Http\Requests\Package\FilterDateRequest;
use Organization\Http\Requests\Package\RemoveRequest;
use Organization\Http\Requests\Package\StoreRequest;
use Organization\Http\Requests\Package\UpdateRequest;
use Organization\Models\EventItem;
use Organization\Models\Hall;
use Organization\Models\Item;
use Organization\Models\ItemVariant;
use Organization\Models\Package;
use Organization\Models\SupplierService;

class PackageController extends JsonResponse
{

    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Package-View')
        ){
            return view('Organization::packages.index');

        }else
            return abort(401);
    }

    public function create()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Package-Add')
        ){
            $items      =   EventItem::all();
            $services   =   SupplierService::all();
            $halls      =   Hall::all();
            $products = Item::select(['id', 'name','final_cost','cost'])->get();
            $variant_item_ids = Item::where('type', 'Variant')->pluck('id');
            $item_variants = ItemVariant::whereIn('item_id', $variant_item_ids)->select(['id', 'name','final_cost' ,'cost'])->get();
            return view('Organization::packages.create',compact('items','services','halls','products','item_variants'));
        }else
            return abort(401);
    }

    public function store(StoreRequest $request, StoreAction $storeAction)
    {
        DB::beginTransaction();
        try {
            $storeAction->execute($request);
            DB::commit();
            return redirect()->route('organizations.package.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }

    public function edit($id)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Package-Edit')
        ){
            $record = Package::find($id);
            $items      = EventItem::all();
            $services   =   SupplierService::all();
            $halls      =   Hall::all();
            $products = Item::select(['id', 'name','final_cost','cost'])->get();
            $variant_item_ids = Item::where('type', 'Variant')->pluck('id');
            $item_variants = ItemVariant::whereIn('item_id', $variant_item_ids)->select(['id', 'name','final_cost' ,'cost'])->get();
            return view('Organization::packages.edit', compact('items','services','record','halls','products','item_variants'));
        }else
            return abort(401);
    }

    public function update(UpdateRequest $request, UpdateAction $updateAction, $id)
    {
        DB::beginTransaction();
        try {
            $updateAction->execute($request, $id);
            DB::commit();
            return redirect()->route('organizations.package.index')->with('success','Data has been saved successfully.');
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
        $result = view('Organization::packages.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData($records), 'organization_packages_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function trash(RemoveRequest $request, TrashAction $trashAction)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Package-Delete')
        ){
            DB::beginTransaction();
            try {
                $record =  $trashAction->execute($request);
                if(!$record)
                    return $this->response(500, 'Failed, This record is not found .', 200);
                DB::commit();
                return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'Package', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'Package', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'Package', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    private function countTrashes()
    {
        return Package::onlyTrashed()->count();
    }

    public function getItemRow()
    {
        $items      = EventItem::all();

        $results = view('Organization::packages.components.item.row',compact('items',),
            [
            ])->render();

        return $this->response(200, 'Item Row', 200, [], 0, ['responseHTML' => $results]);
    }


    public function getProductRow()
    {
        $products = Item::select(['id', 'name','final_cost','cost'])->get();
        $variant_item_ids = Item::where('type', 'Variant')->pluck('id');
        $item_variants = ItemVariant::whereIn('item_id', $variant_item_ids)->select(['id', 'name','final_cost' ,'cost'])->get();

        $results = view('Organization::packages.components.product.row',compact('products','item_variants'),
            [
            ])->render();

        return $this->response(200, 'Product Row', 200, [], 0, ['responseHTML' => $results]);

    }

    public function getHallCapacity(Request $request)
    {
        $hall= Hall::find($request->id);
        return $this->response(200, 'Hall Capacity', 200, [], 0, ['max'=>$hall->maximum,'min'=>$hall->minimum]);
    }

    public function getItemPrice(Request $request)
    {
        $price= EventItem::find($request->id)->price;
        return $this->response(200, 'Item Price', 200, [], 0, ['price'=>$price]);
    }


    public function getProductPrice(Request $request)
    {


        $id = strtok($request->id, ',');
        $type = substr($request->id, strpos($request->id, ",") + 1);

        if ($type == "Item"){
            $price= (Item::find($id)->price) * $request->cap;

        }else{
            $price= (ItemVariant::find($id)->price) * $request->cap;
        }

        return $this->response(200, 'Product Price', 200, [], 0, ['price'=>$price]);
    }

    public function getServicePrice(Request $request)
    {
        $price= SupplierService::find($request->id)->price;
        return $this->response(200, 'Service Price', 200, [], 0, ['price'=>$price]);
    }

    public function getServiceRow()
    {
        $services      = SupplierService::all();

        $results = view('Organization::packages.components.service.row',compact('services'),
            [
            ])->render();

        return $this->response(200, 'Service Row', 200, [], 0, ['responseHTML' => $results]);
    }


}
