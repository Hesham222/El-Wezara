<?php
namespace Organization\Actions\RentSpace;
use Illuminate\Http\Request;
use Organization\Models\{
    RentSpace
};
class StoreAction
{
    public function execute(Request $request)
    {
        $record =  RentSpace::create([
            'name'       => $request->input('name'),
            'description'       => $request->input('description'),
        ]);
        return $record;
    }
}
