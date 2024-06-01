<?php
namespace Organization\Actions\ExternalPricing;
use Illuminate\Http\Request;
use Organization\Models\{
    External
};

class PricingUpdateAction
{
    public function execute(Request $request,$record)
    {

        $data = $request->all();

        External::where('external_pricing_id',$record->id)->delete();

        for ($i=0;$i<count($data['subscriber_type_id']);$i++) {

            $schedule = new External();
            $schedule->external_pricing_id      = $record->id;
            $schedule->subscriber_type_id       = $request->subscriber_type_id[$i];
            $schedule->price_per_hour           = $request->price_per_hour[$i];
            $schedule->save();
        }
    }
}
