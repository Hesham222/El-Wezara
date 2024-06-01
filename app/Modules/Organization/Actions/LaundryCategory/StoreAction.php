<?php
namespace Organization\Actions\LaundryCategory;
use Illuminate\Http\Request;
use Organization\Models\{
    LaundryCategory
};
class StoreAction
{
    public function execute(Request $request)
    {

        $record =  LaundryCategory::create([
            'name'                      => $request->input('name'),
            'description'               => $request->input('description'),
        ]);

        return $record;
    }
}
