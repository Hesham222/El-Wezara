<?php
namespace Organization\Actions\ClubSport;
use Illuminate\Http\Request;
use Organization\Models\{
    ClubSport
};
class StoreAction
{
    public function execute(Request $request)
    {
        $record =  ClubSport::create([
            'name'          => $request->input('name'),
            'description'   => $request->input('description'),
        ]);
        return $record;
    }
}
