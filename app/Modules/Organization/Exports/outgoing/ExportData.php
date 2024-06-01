<?php

namespace Organization\Exports\outgoing;

use Maatwebsite\Excel\Concerns\FromCollection;




use Organization\Models\HotelOrder;

use Organization\Models\InventoryOrder;
use Organization\Models\PointOfSaleOrder;
use Organization\Models\PreparationAreaOrder;
use Carbon\Carbon;

class ExportData implements FromCollection
{
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
       // $records = $this->records;
       $holet_orders = HotelOrder::where('status','received')->whereBetween('created_at',[Carbon::parse( $this->request->start_date), Carbon::parse( $this->request->end_date)])->get();
       $inventory_orders = InventoryOrder::where('status','received')->whereBetween('created_at',[Carbon::parse( $this->request->start_date), Carbon::parse( $this->request->end_date)])->get();
       $pos_orders = PointOfSaleOrder::where('status','received')->whereBetween('created_at',[Carbon::parse( $this->request->start_date), Carbon::parse( $this->request->end_date)])->get();
       $prep_orders = PreparationAreaOrder::where('status','received')->whereBetween('created_at',[Carbon::parse( $this->request->start_date), Carbon::parse( $this->request->end_date)])->get();
        $data = collect([]);
        $data->push(['IngId','Ing Name', 'Quatity','Price','Total' ]);
        foreach($holet_orders as $holet_order) 
        {


            foreach ($holet_order->hotelOrderIngredients as $hotelOrderIngredient)
            {

                $data->push([
                    $hotelOrderIngredient->Ingredient->id,
                    $hotelOrderIngredient->Ingredient->name,
                    $hotelOrderIngredient->quantity .' / ' . $hotelOrderIngredient->Ingredient->unit_of_measurement->name,
                    $hotelOrderIngredient->Ingredient->final_cost,
                    $hotelOrderIngredient->quantity * $hotelOrderIngredient->Ingredient->final_cost ,
                    
                ]);

            }
                                                
                                        

        }




        foreach($inventory_orders as $inventory_order) 
        {


            foreach ($inventory_order->inventoryOrderIngredients as $inventoryOrderIngredient)
            {

                $data->push([
                    $inventoryOrderIngredient->Ingredient->id,
                    $inventoryOrderIngredient->Ingredient->name,
                    $inventoryOrderIngredient->quantity .' / ' . $inventoryOrderIngredient->Ingredient->unit_of_measurement->name,
                    $inventoryOrderIngredient->Ingredient->final_cost,
                    $inventoryOrderIngredient->quantity * $inventoryOrderIngredient->Ingredient->final_cost ,
                    
                ]);

            }
                                                
                                        

        }





        foreach($pos_orders as $pos_order) 
        {


            foreach ($pos_order->PointOrderIngredients as $PointOrderIngredient)
            {

                $data->push([
                    $PointOrderIngredient->Ingredient->id,
                    $PointOrderIngredient->Ingredient->name,
                    $PointOrderIngredient->quantity .' / ' . $PointOrderIngredient->Ingredient->unit_of_measurement->name,
                    $PointOrderIngredient->Ingredient->final_cost,
                    $PointOrderIngredient->quantity * $PointOrderIngredient->Ingredient->final_cost ,
                    
                ]);

            }
                                                
                                        

        }





        foreach($prep_orders as $prep_order) 
        {


            foreach ($prep_order->AreaOrderIngredients as $AreaOrderIngredient)
            {

                $data->push([
                    $AreaOrderIngredient->Ingredient->id,
                    $AreaOrderIngredient->Ingredient->name,
                    $AreaOrderIngredient->quantity .' / ' . $AreaOrderIngredient->Ingredient->unit_of_measurement->name,
                    $AreaOrderIngredient->Ingredient->final_cost,
                    $AreaOrderIngredient->quantity * $AreaOrderIngredient->Ingredient->final_cost ,
                    
                ]);

            }
                                                
                                        

        }

   

 
        return $data;
    }
}