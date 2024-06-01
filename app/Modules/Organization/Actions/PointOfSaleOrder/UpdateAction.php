<?php
namespace Organization\Actions\PointOfSaleOrder;
use Illuminate\Http\Request;
use Organization\Models\{laundry, laundryOrder, LaundryOrderService, LaundrySubCategoryService};
use Organization\Models\LaundryEmployee;

class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                             = laundryOrder::find($id);
        $record->customer_name              = $request->input('name');
        $record->customer_mobile            = $request->input('mobile');
        $record->laundry_id                 = $request->input('laundry_id');
        $record->time                       = $request->input('time');
        $record->date                       = $request->input('date');
        $record->total_price                = $request->input('total_price');
        $record->remaining_amount           = $request->input('remaining_amount');
        $record->save();

        if ($request->input('services')){
            $i  =   0 ;
            $record->laundaryOrderServices()->delete();
            foreach ($request->input('services') as $service_id)
            {
                LaundryOrderService::create([
                    'laundry_order_id'          =>  $record->id,
                    'laundry_sub_category_id'   =>  $request->input('subCategories')[$i],
                    'laundry_service_id'        =>  $service_id,
                ]);
                $i++;
            }
        }

        return $record;
    }
}
