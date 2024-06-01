<?php
namespace Organization\Actions\Hotel;
use Illuminate\Http\Request;
use Organization\Models\{
    Hotel
};
class StoreAction
{
    public function execute(Request $request)
    {

        $record =  Hotel::create([
            'name'                      => $request->input('name'),
            'manager_id'                => $request->input('manager_id'),
        ]);

        return $record;
    }
}
