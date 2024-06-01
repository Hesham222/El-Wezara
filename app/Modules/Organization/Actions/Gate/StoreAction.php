<?php
namespace Organization\Actions\Gate;
use Illuminate\Http\Request;
use Organization\Models\{
    Gate
};
class StoreAction
{
    public function execute(Request $request)
    {
        $record =  Gate::create([
            'name'       => $request->input('name'),
        ]);
        return $record;
    }
}
