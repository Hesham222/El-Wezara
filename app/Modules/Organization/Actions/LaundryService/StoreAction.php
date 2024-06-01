<?php
namespace Organization\Actions\LaundryService;
use Illuminate\Http\Request;
use Organization\Models\{LaundryService, LService};
class StoreAction
{
    public function execute(Request $request)
    {

        $record =  LService::create([
            'name'                      => $request->input('name'),
            'description'               => $request->input('description'),

        ]);

        foreach ($request->input('laundries') as $laundry)
        {
            LaundryService::create([
                'l_service_id' => $record->id,
                'laundry_id' => $laundry
            ]);
        }


        return $record;
    }
}
