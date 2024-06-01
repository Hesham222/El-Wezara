<?php
namespace Organization\Actions\ExternalPricing;
use Illuminate\Http\Request;
use Organization\Models\{
    ExternalPricing
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                         = ExternalPricing::find($id);
        $record->activity_area_id       = $request->input('activity_area_id');
        $record->save();
        return $record;
    }
}
