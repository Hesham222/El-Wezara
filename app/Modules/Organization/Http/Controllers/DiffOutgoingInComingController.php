<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\diffOutgoingInComing\{
    FilterAction,
};
use Organization\Http\Requests\PointOfSaleShiftSheet\{
    FilterDateRequest
};
use Organization\Exports\diffOutgoingInComing\{
    ExportData,
};




use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;


use Organization\Models\HotelOrder;

use Organization\Models\InventoryOrder;
use Organization\Models\PointOfSaleOrder;
use Organization\Models\PreparationAreaOrder;

use Carbon\Carbon;

class DiffOutgoingInComingController extends JsonResponse
{
    use FileTrait;
    
    public function index(Request $request)
    {
        
        if($request->has('start_date')){



            $reseved_holet_orders = HotelOrder::where('status','received')->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))])->get();
            $reseved_inventory_orders = InventoryOrder::where('status','received')->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))])->get();
            $reseved_pos_orders = PointOfSaleOrder::where('status','received')->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))])->get();
            $reseved_prep_orders = PreparationAreaOrder::where('status','received')->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))])->get();
               


            $canceled_holet_orders = HotelOrder::where('status','cancelled')->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))])->get();
            $canceled_inventory_orders = InventoryOrder::where('status','cancelled')->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))])->get();
            $canceled_pos_orders = PointOfSaleOrder::where('status','cancelled')->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))])->get();
            $canceled_prep_orders = PreparationAreaOrder::where('status','cancelled')->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))])->get();



        }else{
            $reseved_holet_orders = HotelOrder::where('status','received')->get();
            $reseved_inventory_orders = InventoryOrder::where('status','received')->get();
            $reseved_pos_orders = PointOfSaleOrder::where('status','received')->get();
            $reseved_prep_orders = PreparationAreaOrder::where('status','received')->get();



            $canceled_holet_orders = HotelOrder::where('status','cancelled')->get();
            $canceled_inventory_orders = InventoryOrder::where('status','cancelled')->get();
            $canceled_pos_orders = PointOfSaleOrder::where('status','cancelled')->get();
            $canceled_prep_orders = PreparationAreaOrder::where('status','cancelled')->get();



        }
        return view('Organization::diffOutgoingInComing.index',compact('reseved_holet_orders','reseved_inventory_orders','reseved_pos_orders','reseved_prep_orders',
    'canceled_holet_orders','canceled_inventory_orders','canceled_pos_orders','canceled_prep_orders'
    ));
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
        $result = view('Organization::outgoings.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }



    public function export(FilterDateRequest $request)
    {
        // try{
           
            return Excel::download(new ExportData($request), 'outGoing.csv');
        // }
        // catch (\Exception $ex){
            // return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        // }
    }

   


}