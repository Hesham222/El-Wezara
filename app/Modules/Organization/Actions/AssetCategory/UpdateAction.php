<?php
namespace Organization\Actions\AssetCategory;
use Illuminate\Http\Request;
use Organization\Models\{
    AssetCategory
};

class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                             = AssetCategory::find($id);

        $record->name                       = $request->input('name');
        $record->percentage                 = $request->input('percentage');
        $record->duration                   = $request->input('duration');
        $record->save();

        return $record;
    }
}
