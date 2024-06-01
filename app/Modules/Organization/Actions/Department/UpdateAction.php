<?php
namespace Organization\Actions\Department;
use Illuminate\Http\Request;
use Organization\Models\{
    Department
};
class UpdateAction
{
    public function execute(Request $request,$id): void
    {
        $record        = Department::find($id);

 if ($request->has('parent_id') && $request->input('parent_id') != null) {

        $record->fill([
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
        $record->save();


    }else{

 $record->fill([
            'name' => [
                'en' => $request->input('name_en'),
                'ar' => $request->input('name_ar'),
            ],
            'description'      => [
                'en' => $request->input('description_en'),
                'ar' => $request->input('description_ar'),
            ],
            'employee_id' => $request->input('employee'),
             'parent_id' => null,
        ]);
        $record->save();



    }




}
}
