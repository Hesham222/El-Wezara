<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\allOutgoing\{
    FilterAction,
};
use Organization\Http\Requests\PointOfSaleShiftSheet\{
    FilterDateRequest
};
use Organization\Exports\allOutgoing\{
    ExportData,
};




use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;


use Organization\Models\HotelOrder;

use Organization\Models\InventoryOrder;
use Organization\Models\PointOfSaleOrder;
use Organization\Models\PreparationAreaOrder;

use Carbon\Carbon;

class AllOutgoingController extends JsonResponse
{
    use FileTrait;
    
    public function index(Request $request)
    {
        
        if($request->has('start_date')){



           
               


            $canceled_holet_orders = HotelOrder::where('status','cancelled')->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))])->get();
            $canceled_inventory_orders = InventoryOrder::where('status','cancelled')->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))])->get();
            $canceled_pos_orders = PointOfSaleOrder::where('status','cancelled')->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))])->get();
            $canceled_prep_orders = PreparationAreaOrder::where('status','cancelled')->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))])->get();



        }else{
           



            $canceled_holet_orders = HotelOrder::where('status','cancelled')->get();
            $canceled_inventory_orders = InventoryOrder::where('status','cancelled')->get();
            $canceled_pos_orders = PointOfSaleOrder::where('status','cancelled')->get();
            $canceled_prep_orders = PreparationAreaOrder::where('status','cancelled')->get();



        }



        $total = 0; 

        foreach($canceled_holet_orders as $canceled_holet_order){

            $total += $canceled_holet_order->calc_total();

        }


        foreach($canceled_inventory_orders as $canceled_inventory_order){

            $total += $canceled_inventory_order->calc_total();

        }


        foreach($canceled_pos_orders as $canceled_pos_order){

            $total += $canceled_pos_order->calc_total();

        }

        foreach($canceled_prep_orders as $canceled_prep_order){

            $total += $canceled_prep_order->calc_total();

        }

        return view('Organization::allOutgoing.index',compact('canceled_holet_orders','canceled_inventory_orders','canceled_pos_orders','canceled_prep_orders'
    ,'total'
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
        $result = view('Organization::allOutgoing.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }



    public function export(FilterDateRequest $request)
    {
        // try{
           
            return Excel::download(new ExportData($request), 'allOutgoing.csv');
        // }
        // catch (\Exception $ex){
            // return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        // }
    }

   


}