<?php
namespace Organization\Actions\LaundryOrder;
use Illuminate\Http\Request;
use Organization\Models\{laundry,
    LaundryOrder,
    LaundryOrderService,
    LaundryOrderSubCategory,
    LaundrySubCategoryService};

class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                             = LaundryOrder::find($id);
        $record->customer_name              = $request->input('name');
        $record->max_due_date             = $request->input('max_due_date');
        $record->customer_mobile            = $request->input('mobile');
        $record->laundry_id                 = $request->input('laundry_id');
        $record->time                       = $request->input('time');
        $record->date                       = $request->input('date');
        $record->total_price                = $request->input('total_price');
        $record->remaining_amount           = $request->input('remaining_amount');
        $record->save();


        if ($request->input('subCategories')){
            $i  =   0 ;
            $record->laundryOrderSubCategories()->delete();
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
            $record->laundryOrderServices()->delete();
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
