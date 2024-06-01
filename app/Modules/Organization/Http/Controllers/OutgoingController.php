<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\outgoing\{
    FilterAction,
};
use Organization\Http\Requests\PointOfSaleShiftSheet\{
    FilterDateRequest
};
use Organization\Exports\outgoing\{
    ExportData,
};




use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;


use Organization\Models\HotelOrder;

use Organization\Models\InventoryOrder;
use Organization\Models\PointOfSaleOrder;
use Organization\Models\PreparationAreaOrder;

use Carbon\Carbon;

class OutgoingController extends JsonResponse
{
    use FileTrait;
    
    public function index(Request $request)
    {
        
        if($request->has('start_date')){



            $holet_orders = HotelOrder::where('status','received')->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))])->get();
            $inventory_orders = InventoryOrder::where('status','received')->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))])->get();
            $pos_orders = PointOfSaleOrder::where('status','received')->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))])->get();
            $prep_orders = PreparationAreaOrder::where('status','received')->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))])->get();
               
        }else{
            $holet_orders = HotelOrder::where('status','received')->get();
            $inventory_orders = InventoryOrder::where('status','received')->get();
            $pos_orders = PointOfSaleOrder::where('status','received')->get();
            $prep_orders = PreparationAreaOrder::where('status','received')->get();
        }

$total = 0;

foreach($holet_orders as $holet_order){

    $total += $holet_order->calc_total();

}


foreach($inventory_orders as $inventory_order){

    $total += $inventory_order->calc_total();

}


foreach($pos_orders as $pos_order){

    $total += $pos_order->calc_total();

}

foreach($prep_orders as $prep_order){

    $total += $prep_order->calc_total();

}

        return view('Organization::outgoings.index',compact('total','holet_orders','inventory_orders','pos_orders','prep_orders'));
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