<?php
namespace Organization\Actions\Hall;
use Illuminate\Http\Request;
use Organization\Models\{
    Hall
};
class StoreAction
{
    public function execute(Request $request)
    {
        $record =  Hall::create([
            'name'          => $request->input('name'),
            'minimum'          => $request->input('minimum'),
            'maximum'          => $request->input('maximum'),
            'description'   => $request->input('description'),
        ]);
        return $record;
    }
}
