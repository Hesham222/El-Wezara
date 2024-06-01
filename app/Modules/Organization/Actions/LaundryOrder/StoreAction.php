<?php
namespace Organization\Actions\LaundryOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Organization\Models\{LaundryOrder,
    LaundryOrderService,
    LaundryOrderSubCategory,
    LService,
    LaundrySubCategoryService,
    Subscriber};
class StoreAction
{
    public function execute(Request $request)
    {
        $record =  LaundryOrder::create([
            'laundry_id'            => $request->input('laundry_id'),
            'customer_name'         => $request->input('name'),
            'customer_mobile'       => $request->input('mobile'),
            'total_price'           => $request->input('total_price'),
            'paid_amount'           => $request->input('paid_amount'),
            'remaining_amount'      => $request->input('remaining_amount'),
            'max_due_date'          => $request->input('max_due_date'),
            'payment_method'        => $request->input('payment_method'),
            'date'                  => Carbon::now()->toDateString(),
            'time'                  => Carbon::now()->toTimeString(),
        ]);

        if ($request->input('subCategories')){
            $i  =   0 ;

            foreach ($request->input('subCategories') as $category)
            {
                LaundryOrderSubCategory::create([
                    'laundry_order_id' => $record->id,
                    'laundry_sub_category_id' => $category,
                ]);
                $i++;
            }
        }

        if ($request->input('services')){
            $i  =   0 ;
            foreach ($request->input('services') as $service_id)
            {
                LaundryOrderService::create([
                    'quantity'=>$request->input('category_quantity')[$i],
                    'price'=>$request->input('category_price')[$i],
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
