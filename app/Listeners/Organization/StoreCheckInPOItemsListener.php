<?php

namespace App\Listeners\Organization;

use App\Events\Organization\StoreCheckInPOItemsEvent;
use Organization\Models\IngredentQuantity;
use Organization\Models\PurchaseOrderItem;
use Organization\Models\PurchaseOrder;
class StoreCheckInPOItemsListener
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
     * @param  StoreCheckInPOItemsEvent  $event
     * @return void
     */
    public function handle(StoreCheckInPOItemsEvent $event)
    {
        $po = PurchaseOrder::find($event->po_id);
        $input = request()->all();
        $subtotal = 0;
        $receivedQtys = 0;
        $shippingCost = $input['shippingCost'];
        if(request()->has('items')){
            for ($i=0; $i <count($input['items']) ; $i++) {
                $poItem = PurchaseOrderItem::where('purchase_order_id',$event->po_id)->findOrFail($input['items'][$i]);
                $receivedQtys += $input['received_qty'][$i];
                $cost       = $input['cost'][$i];
                $finalCost  = $receivedQtys?($cost+($shippingCost/$receivedQtys)):0;
              
              
              
                $poItem->update([
                    'selling_price'      => $input['selling_price'][$i],
                    'received_quantity'  => $input['received_qty'][$i],
                    'cost'               => $cost,
                    'final_cost'         => $finalCost,
                    'total'              => $finalCost*$input['received_qty'][$i],
                    'subtotal'           => $cost*$input['received_qty'][$i],
                    'status'             => $input['item_statues'][$i],
                ]);
                $subtotal+=($cost*$input['received_qty'][$i]);
                $poItem->save();
                if($po->status_id==4){
                    $item  = $poItem->item;
                    //update  selling price of main item
                    $item->selling_price     = (($item->selling_price*$item->quantity)+($poItem->selling_price*$poItem->received_quantity))/($item->quantity+$poItem->received_quantity);

                    $item->last_selling_price = $poItem->total / $input['received_qty'][$i] ;

                    //update  cost of main item
                   // $item->cost     = (($item->cost*$item->quantity)+($poItem->cost*$poItem->received_quantity))/($item->quantity+$poItem->received_quantity);
                    //update quantity of main item
                    $item->stock += $poItem->received_quantity;
                    $item->save();
                    // add expiration date for quantities
                    $exp_quantity = new IngredentQuantity();
                    $exp_quantity->ingredient_id = $item->id;
                    $exp_quantity->quantity = $poItem->received_quantity;
                    $exp_quantity->expiration_date = $input['itemDate'][$i] ;
                    $exp_quantity->save();
                }
            }
            //calculate payment section
            $po->subtotal             =  $subtotal;
            $po->discount_amount      =  $input['shippingDisc'];
            $po->total_disc           =  $subtotal-($subtotal*($input['shippingDisc']/100));
            $po->shipping_cost        =  $input['shippingCost'];
            $totalAfterShipping       = ($subtotal-($subtotal*($input['shippingDisc']/100)))+$input['shippingCost'];
            $po->total_after_shipping = $totalAfterShipping ;
            $po->vat                  =  $input['vat'];
            $po->total                = $totalAfterShipping/100*$input['vat']+($totalAfterShipping);
            $po->save();
        }
    }
}
