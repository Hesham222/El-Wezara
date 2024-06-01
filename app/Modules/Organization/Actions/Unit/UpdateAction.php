<?php
namespace Organization\Actions\Unit;
use Illuminate\Http\Request;
use Organization\Models\{
    UnitMeasurement
};
class UpdateAction
{
    public function execute(Request $request,$id): void
    {
        $record        = UnitMeasurement::find($id);
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
