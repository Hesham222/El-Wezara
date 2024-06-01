<?php
namespace Organization\Actions\EmployeeType;
use Illuminate\Http\Request;
use Organization\Models\{
    EmployeeType
};
class UpdateAction
{
    public function execute(Request $request,$id): void
    {
        $record        = EmployeeType::find($id);
        $record->fill([
            'name' => [
                'en' => $request->input('name_en'),
                'ar' => $request->input('name_ar'),
            ],
            'description'      => [
                'en' => $request->input('description_en'),
                'ar' => $request->input('description_ar'),
            ],
        ]);
        $record->save();
    }
}
