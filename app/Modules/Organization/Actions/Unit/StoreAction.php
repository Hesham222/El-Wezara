<?php
namespace Organization\Actions\Unit;
use Illuminate\Http\Request;
use Organization\Models\{
    UnitMeasurement
};
class StoreAction
{
    public function execute(Request $request): void
    {
        $record =  UnitMeasurement::create([
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
