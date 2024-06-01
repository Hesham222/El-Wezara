<?php

namespace App\Listeners\Organization;

use App\Events\Organization\StorePOItemsEvent;
use Organization\Models\PurchaseOrderItem;
use Organization\Models\PurchaseOrder;
class StorePOItemsListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  StorePOItemsEvent  $event
     * @return void
     */
    public function handle(StorePOItemsEvent $event)
    {
        $input = request()->all();
        $PO = PurchaseOrder::findOrFail($event->po_id);

        if(request()->has('items') and request('items')[0]){
            $orderQtys = 0;
            $finalCost = 0;
            $subtotal = 0;
            $totalAfterShipping = 0;
            $shippingCost =$input['shippingCost'];
            for ($i=0; $i <count($input['items']) ; $i++)
            {
                $orderQtys += $input['order_qty'][$i];
                // check if there if bounes or not 
                if($PO->bounes_quantity)
                {
                    if($PO->bounes_quantity == $orderQtys)
                    {
                        $orderQtys +=$PO->adding_bounes_quantity;

                    }elseif($PO->bounes_quantity < $orderQtys)
                    {
                        $num_of_deffretion = floor($orderQtys/$PO->bounes_quantity);
                        $orderQtys +=$PO->adding_bounes_quantity*$num_of_deffretion;

                    }

                }


                $cost       = $input['cost'][$i];
                $finalCost  = $cost+($shippingCost/$orderQtys);
                PurchaseOrderItem::create([
                    'purchase_order_id' => $event->po_id,
                    'ingredient_id'           => $input['items'][$i],
                    'selling_price'     => $input['selling_price'][$i],
                    'ordered_quantity'  => $orderQtys,//$input['order_qty'][$i],
                    'cost'              => $cost,
                    'final_cost'        => $finalCost,
                    'total'             => $finalCost*$input['order_qty'][$i],
                    'subtotal'          => $cost*$input['order_qty'][$i],
                ]);
                $subtotal+=($cost*$input['order_qty'][$i]);
            }
            //calculate payment section
            $PO->subtotal             =  $subtotal;
            $PO->discount_amount      =  $input['shippingDisc'];
            $PO->total_disc           =  $subtotal-($subtotal*($input['shippingDisc']/100));
            $PO->shipping_cost        =  $input['shippingCost'];
            $totalAfterShipping       = ($subtotal-($subtotal*($input['shippingDisc']/100)))+$input['shippingCost'];
            $PO->total_after_shipping = $totalAfterShipping ;
            $PO->vat                  =  $input['vat'];
            $PO->total                = $totalAfterShipping/100*$input['vat']+($totalAfterShipping);
            $PO->save();
        }
    }
}
