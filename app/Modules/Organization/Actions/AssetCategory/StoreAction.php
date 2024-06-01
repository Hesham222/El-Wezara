<?php
namespace Organization\Actions\AssetCategory;
use Illuminate\Http\Request;
use Organization\Models\{
    AssetCategory
};
class StoreAction
{
    public function execute(Request $request)
    {

        $record =  AssetCategory::create([
            'name'                      => $request->input('name'),
            'percentage'                => $request->input('percentage'),
            'duration'                  => $request->input('duration'),
        ]);

        return $record;
    }
}
