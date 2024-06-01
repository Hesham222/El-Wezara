<?php
namespace Organization\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\PreparationAreaOrder\{ChangeStatusAction,
    StoreAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction};
use Organization\Http\Requests\PreparationAreaOrder\{StoreRequest, UpdateRequest, RemoveRequest, FilterDateRequest};
use Organization\Exports\PreparationAreaOrder\{
    ExportData,
};
use Organization\Models\{Ingredient,
    InventoryOrder,
    laundry,
    LaundryInventory,
    PreparationArea,
    PreparationAreaInventory,
    PreparationAreaOrder};
use Organization\Models\LaundryCategory;
use Organization\Models\LaundryOrder;
use Organization\Models\LService;
use Organization\Models\LaundrySubCategory;

class PreparationAreaOrderController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PreparationAreaOrder-View')
        ){
            return view('Organization::PreparationAreaOrders.index');

        }else
            return abort(401);
    }

    public function create()
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PreparationAreaOrder-Add')
        ){
            $areas = PreparationArea::all();
            $ingredients = Ingredient::whereIn('type',['preprationArea','all'])->get();
            return view('Organization::PreparationAreaOrders.create',compact('areas','ingredients'));
        }else
            return abort(401);
    }

    public function store(StoreRequest $request, StoreAction $storeAction)
    {
        DB::beginTransaction();
        try {
            $storeAction->execute($request);
            DB::commit();
            return redirect()->route('organizations.preparationAreaOrder.index')->with('success','Data has been saved successfully.');
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
        $result = view('Organization::PreparationAreaOrders.components.table_body',compact('records'))->render();
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

    public function getServiceRow()
    {
        $ingredients = Ingredient::whereIn('type',['preprationArea','all'])->get();
        $results = view('Organization::PreparationAreaOrders.components.ingredient.row',compact('ingredients'),
            [
            ])->render();

        return $this->response(200, 'Service Row', 200, [], 0, ['responseHTML' => $results]);
    }

    public function cancelOrder(Request $request){
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PreparationAreaOrder-Cancel-Order')
        ){
            $record = PreparationAreaOrder::find($request->input('id'));
            if ($record->status == "approved"){
                if ($record->AreaOrderIngredients){

                    foreach ($record->AreaOrderIngredients as $order_ing){
                        $order_ing->ingredient->quantity +=$order_ing->quantity;
                        $order_ing->ingredient->save();
                    }

                }
            }
            $record->status = "cancelled";
            $record->save();
            return $this->response(200, 'cancel order', 200, [], 0, $record->status);
        }else
            return abort(401);


    }

    public function changeStatus(Request $request){
        $record = PreparationAreaOrder::find($request->input('id'));
        $area = PreparationArea::find($record->area_id);
        if($record->status === "approved"){
            $record->status = "received";
            $record->save();
        }

        if($record->status === "received"){
            foreach($record->AreaOrderIngredients as $object){
                $check = PreparationAreaInventory::
                where('ingredient_id',$object->ingredient_id)
                    ->where('area_id',$area->id)->first();
                if($check != null){

                    $check->quantity = $check->quantity +$object->quantity;
                    $check->save();
                }
                else{

                    PreparationAreaInventory::create([
                        'ingredient_id'     =>  $object->ingredient_id,
                        'quantity'          =>  $object->quantity,
                        'area_id'           =>  $area->id
                    ]);
                }

            }
        }

        return $this->response(200, 'change status', 200, [], 0, $record->status);

    }

    public function consumption($id){
        return view('Organization::PreparationAreaOrders.consumption');
    }


}
