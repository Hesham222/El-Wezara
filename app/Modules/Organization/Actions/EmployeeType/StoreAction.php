<?php
namespace Organization\Actions\EmployeeType;
use Illuminate\Http\Request;
use Organization\Models\{EmployeeType, EventItemType};
class StoreAction
{
    public function execute(Request $request): void
    {
        $record =  EmployeeType::create([
            'name' => [
                'en' => $request->input('name_en'),
                'ar' => $request->input('name_ar'),
            ],
            'description'      => [
                'en' => $request->input('description_en'),
                'ar' => $request->input('description_ar'),
            ],
        ]);

    }
}
