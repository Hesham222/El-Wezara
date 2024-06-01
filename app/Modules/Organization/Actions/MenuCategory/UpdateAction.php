<?php
namespace Organization\Actions\MenuCategory;
use Illuminate\Http\Request;
use Organization\Models\{MenuCategory};

class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                             = MenuCategory::find($id);

        $record->name                       = $request->input('name');
        $record->description                = $request->input('description');
        $record->save();

        return $record;
    }
}
