<?php
namespace Organization\Actions\LaundrySubCategory;
use Illuminate\Http\Request;
use Organization\Models\{LaundrySubCategory, LaundrySubCategoryService};

class UpdateAction
{
    public function execute(Request $request,$id)
    {

        $record                             = LaundrySubCategory::find($id);
        $record->parent_id                  = $request->input('parent_id');
        $record->name                       = $request->input('name');
        $record->description                = $request->input('description');
        $record->save();

        if ($request->input('services'))
        {
            $record->laundrySubCategoryServices()->delete();
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
