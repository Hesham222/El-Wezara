<?php
namespace Organization\Actions\Training;
use Illuminate\Http\Request;
use Organization\Models\{
    Pricing
};
class PricingUpdateAction
{
    public function execute(Request $request,$record)
    {

        $data = $request->all();

        Pricing::where('training_id',$record->id)->forceDelete();

        for ($i=0;$i<count($data['subscriber_type_id']);$i++) {

            $schedule = new Pricing();
            $schedule->training_id          = $record->id;
            $schedule->subscriber_type_id   = $request->subscriber_type_id[$i];
            $schedule->pricing_name         = $request->pricing_name[$i];
            $schedule->num_of_sessions      = $request->num_of_sessions[$i];
            $schedule->duration_in_days     = $request->duration_in_days[$i];
            $schedule->price                = $request->price[$i];
            $schedule->save();
        }
    }
}
