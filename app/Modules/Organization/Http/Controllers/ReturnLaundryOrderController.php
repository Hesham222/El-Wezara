<?php

namespace Organization\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Models\Employee;
use Organization\Actions\LaundryOrder\{
    StoreAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
};
use Organization\Http\Requests\LaundryOrder\{
    StoreRequest,
    UpdateRequest,
    RemoveRequest,
    FilterDateRequest
};
use Organization\Exports\LaundryOrder\{
    ExportData,
};
use Organization\Models\{laundry,
    LaundryCategory,
    LaundryOrder,
    LService,
    LaundrySubCategory,
    LaundrySubCategoryService};

class ReturnLaundryOrderController extends JsonResponse
{
    public function index()
    {
        return view('Organization::returnLaundryOrders.index');
    }

    public function create()
    {
        $categories = LaundryCategory::all();
        $orders = LaundryOrder::all();
        return view('Organization::returnLaundryOrders.create',compact('categories','orders'));
    }

    public function store(StoreRequest $request, StoreAction $storeAction)
    {
        DB::beginTransaction();
        try {
            $storeAction->execute($request);
            DB::commit();
            return redirect()->route('organizations.returnLaundryOrder.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }

    public function edit($id)
    {
        $record = LaundryOrder::findOrFail($id);
        $services = LService::all();
        $categories = LaundryCategory::all();
        $subCategories = LaundrySubCategory::all();
        return view('Organization::laundryOrders.edit', compact('services','categories','subCategories','record'));
    }

    public function update(UpdateRequest $request, UpdateAction $updateAction, $id)
    {
        DB::beginTransaction();
        try {
            $updateAction->execute($request, $id);
            DB::commit();
            return redirect()->route('organizations.laundryOrder.index')->with('success','Data has been saved successfully.');
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
        $result = view('Organization::laundryOrders.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData($records), 'organization_laundryOrders_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function trash(RemoveRequest $request, TrashAction $trashAction)
    {
        DB::beginTransaction();
        try {
            $record =  $trashAction->execute($request);
            if(!$record)
                return $this->response(500, 'Failed, This record is not found .', 200);
            DB::commit();
            return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'laundryOrders', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
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
            return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'laundryOrders', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'laundryOrders', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    private function countTrashes()
    {
        return laundryOrder::onlyTrashed()->count();
    }

    public function getServiceRow()
    {
        $categories = LaundryCategory::all();

        $results = view('Organization::returnLaundryOrders.components.service.row',compact('categories'),
            [
            ])->render();

        return $this->response(200, 'Service Row', 200, [], 0, ['responseHTML' => $results]);
    }

    public function getSubCategories(Request $request){
        $subCategories = LaundrySubCategory::where('parent_id',$request->input('id'))->pluck('name','id');
        return $this->response(200, 'Sub Categories', 200, [], 0, $subCategories);

    }

    public function getSubCategoriesServices(Request $request){
        $subCategory = LaundrySubCategory::find($request->input('id'));
        $services = [];
        foreach ($subCategory->laundrySubCategoryServices as $object){
            $service = LService::where('id',$object->laundry_service_id)->pluck('id','name');
            array_push($services, $service);
        }

        return $this->response(200, 'Sub Categories', 200, [], 0, $services);

    }

    public function getSubCategoryServicePrice(Request $request){
        $price = LaundrySubCategoryService::where('laundry_service_id',$request->input('id'))->first();

        return $this->response(200, 'sub category Price', 200, [], 0, $price);

    }

    public function getOrderDetails(Request $request){
        $order = LaundryOrder::find($request->input('id'));
        $laundry = $order->laundry->name;
        $laundryOrderServices = array();

        foreach ($order->laundryOrderServices as $object){
//            $service = LaundryService::where('id',$object->laundry_service_id)->pluck('id','name');
            array_push($laundryOrderServices, $object);

        }

        return $this->response(200, 'order details', 200, [], 0, ['order'=>$order , 'laundry'=>$laundry,'laundryOrderServices'=>$laundryOrderServices]);
    }
}
