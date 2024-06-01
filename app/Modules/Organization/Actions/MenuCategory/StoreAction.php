<?php
namespace Organization\Actions\MenuCategory;
use Illuminate\Http\Request;
use Organization\Models\{MenuCategory};
class StoreAction
{
    public function execute(Request $request)
    {

        $record =  MenuCategory::create([
            'name'                      => $request->input('name'),
            'description'               => $request->input('description'),
        ]);

        return $record;
    }
}
