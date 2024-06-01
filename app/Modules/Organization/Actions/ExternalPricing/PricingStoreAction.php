<?php
namespace Organization\Actions\ExternalPricing;
use Illuminate\Http\Request;
use Organization\Models\{
    External
};

class PricingStoreAction
{
    public function execute(Request $request,$record)
    {
        $data = $request->all();

        foreach ($data['subscriber_type_id'] as $key => $value) {

            if(!empty($value)){

                $pricing = new External();
                $pricing->external_pricing_id  = $record->id;
                $pricing->subscriber_type_id   = $value;
                $pricing->price_per_hour       = $data['price_per_hour'][$key];
                $pricing->save();
            }
        }
    }
}
