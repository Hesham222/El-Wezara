<?php
namespace Organization\Actions\LaundryService;
use Illuminate\Http\Request;
use Organization\Models\{LaundryService, LService};

class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                 = LService::find($id);
        $record->name           = $request->input('name');
        $record->save();
        if ($request->input('laundries'))
        {
            $record->LaundryServices()->delete();
            foreach ($request->input('laundries') as $laundry)
            {
                LaundryService::create([
                    'l_service_id' => $record->id,
                    'laundry_id' => $laundry
                ]);
            }
        }


        return $record;
    }
}
