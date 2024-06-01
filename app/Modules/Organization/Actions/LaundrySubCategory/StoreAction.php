<?php
namespace Organization\Actions\LaundrySubCategory;
use Illuminate\Http\Request;
use Organization\Models\{LaundryCategory, LaundrySubCategory, LaundrySubCategoryService};
class StoreAction
{
    public function execute(Request $request)
    {

        $record =  LaundrySubCategory::create([
            'parent_id'                 => $request->input('parent_id'),
            'name'                      => $request->input('name'),
            'description'               => $request->input('description'),
        ]);

        if ($request->input('services')){
            $i  =   0 ;

            foreach ($request->input('services') as $service)
            {
                LaundrySubCategoryService::create([
                    'price'=>$request->input('service_price')[$i++],
                    'laundry_sub_category_id' => $record->id,
                    'laundry_service_id' => $service,
                ]);
            }
        }


        return $record;
    }
}
