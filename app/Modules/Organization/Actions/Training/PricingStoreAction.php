<?php
namespace Organization\Actions\Training;
use Illuminate\Http\Request;
use Organization\Models\{
    Pricing
};
class PricingStoreAction
{
    public function execute(Request $request,$record)
    {
        $data = $request->all();

        foreach ($data['subscriber_type_id'] as $key => $value) {

            if(!empty($value)){

                $schedule = new Pricing();
                $schedule->training_id          = $record->id;
                $schedule->subscriber_type_id   = $value;
                $schedule->pricing_name         = $data['pricing_name'][$key];
                $schedule->num_of_sessions      = $data['num_of_sessions'][$key];
                $schedule->duration_in_days     = $data['duration_in_days'][$key];
                $schedule->price                = $data['price'][$key];
                $schedule->save();
            }
        }
    }
}
