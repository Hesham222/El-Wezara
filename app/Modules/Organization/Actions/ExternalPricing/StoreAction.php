<?php
namespace Organization\Actions\ExternalPricing;
use Illuminate\Http\Request;
use Organization\Models\{
    ExternalPricing
};
class StoreAction
{
    public function execute(Request $request)
    {
        $record =  ExternalPricing::create([
            'activity_area_id'      => $request->input('activity_area_id'),

        ]);
        return $record;
    }
}
