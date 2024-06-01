<?php
namespace Organization\Actions\SportArea;
use Illuminate\Http\Request;
use Organization\Models\{
    SportActivityAreas
};
class StoreAction
{
    public function execute(Request $request)
    {
        $record =  SportActivityAreas::create([
            'name'          => $request->input('name'),
            'description'   => $request->input('description'),
        ]);
        return $record;
    }
}
