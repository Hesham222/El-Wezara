<?php

namespace Organization\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Organization\Http\Middleware\OrganizationAdmin;
use Organization\Models\PointOfSaleOrderSheet;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $order_shift = PointOfSaleOrderSheet::where('id',$this->point_of_sale_order_sheet_id)->first();
        $shift = null;
        if ($order_shift){

            $shift_hours =Carbon::parse($order_shift->shift_start) ->format('H');

            if ($shift_hours < 12) {
                $shift =  'Morning';
            }
            else if ($shift_hours < 17) {
                $shift =  'Morning';
            }else{

            }
            $shift =  'Evening';
        }

        return [
            'id' => $this->id,
            'organization_admin' => \Organization\Models\OrganizationAdmin::where('id',$this->organization_admin_id)->first()->name ,//$this->admin?$this->admin->name:'-',
            'point_of_sale' => $this->point_of_sale?$this->point_of_sale->name:'-',
            'total_amount' => $this->total_amount,
            'status' => $this->status,
            'paidAmount' => $this->paidAmount,
            'remainingAmount' => $this->remainingAmount,
            'type' => ($this->type =='delivery')?'توصيل':'فى المطعم',
            'table_number' => $this->table_number,
             'order_payment' => $this->order_payment?$this->order_payment->type:'-',
             'order_items' => OrderItemResource::collection($this->order_items),
              'order_emp' => $this->order_emp?$this->order_emp->employee:'-',
              'created_at'=>\Carbon\Carbon::parse($this->created_at)->format('Y-m-d'),
            'opening_time'=>\Carbon\Carbon::parse($this->created_at)->format("H:i A"),
            'closing_time'=>\Carbon\Carbon::parse($this->updated_at)->format("H:i A"),
            'shift'=>$shift,
        ];
    }
}
