<?php
namespace Organization\Actions\Department;
use Illuminate\Http\Request;
use Organization\Models\{
    Department
};
class StoreAction
{
    public function execute(Request $request): void
    {

        if ($request->has('parent_id') && $request->input('parent_id') != null) {
            
$record =  Department::create([
            'name' => [
                'en' => $request->input('name_en'),
                'ar' => $request->input('name_ar'),
            ],
            'description'      => [
                'en' => $request->input('description_en'),
                'ar' => $request->input('description_ar'),
            ],
            'employee_id' => $request->input('employee'),
            'parent_id' => $request->input('parent_id'),
        ]);


        }else
        {



$record =  Department::create([
            'name' => [
                'en' => $request->input('name_en'),
                'ar' => $request->input('name_ar'),
            ],
            'description'      => [
                'en' => $request->input('description_en'),
                'ar' => $request->input('description_ar'),
            ],
            'employee_id' => $request->input('employee'),
        ]);

        }

        

    }
}
