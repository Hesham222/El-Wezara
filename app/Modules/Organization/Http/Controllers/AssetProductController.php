<?php

namespace Organization\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Models\AssetCategory;
use Organization\Actions\AssetProduct\{
    StoreAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
};
use Organization\Http\Requests\AssetProduct\{
    StoreRequest,
    UpdateRequest,
    RemoveRequest,
    FilterDateRequest
};
use Organization\Exports\AssetProduct\{
    ExportData,
};
use Organization\Models\{
    AssetProduct,
};

class AssetProductController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'AssetProduct-View')
        ){
            return view('Organization::assetProducts.index');

        }else
            return abort(401);
    }

    public function create()
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'AssetProduct-Add')
        ){
            $assetCategories = AssetCategory::select(['id','name'])->get();
            return view('Organization::assetProducts.create',compact('assetCategories'));
        }else
            return abort(401);
    }

    public function store(StoreRequest $request, StoreAction $storeAction)
    {
        DB::beginTransaction();
        try {
            $storeAction->execute($request);
            DB::commit();
            return redirect()->route('organizations.assetProduct.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }

    public function edit($id)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'AssetProduct-Edit')
        ){
            $record = AssetProduct::findOrFail($id);
            $assetCategories = AssetCategory::select(['id','name'])->get();

            return view('Organization::assetProducts.edit', compact('record','assetCategories'));
        }else
            return abort(401);
    }

    public function update(UpdateRequest $request, UpdateAction $updateAction, $id)
    {
        DB::beginTransaction();
        try {
            $updateAction->execute($request, $id);
            DB::commit();
            return redirect()->route('organizations.assetProduct.index')->with('success','Data has been saved successfully.');
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
        $result = view('Organization::assetProducts.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData($records), 'organization_asset_products_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function trash(RemoveRequest $request, TrashAction $trashAction)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'AssetProduct-Delete')
        ){
            DB::beginTransaction();
            try {
                $record =  $trashAction->execute($request);
                if(!$record)
                    return $this->response(500, 'Failed, This record is not found .', 200);
                DB::commit();
                return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'assetProducts', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'assetProducts', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'assetProducts', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    private function countTrashes()
    {
        return AssetProduct::onlyTrashed()->count();
    }
}
