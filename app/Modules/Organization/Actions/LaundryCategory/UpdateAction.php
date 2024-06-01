<?php
namespace Organization\Actions\LaundryCategory;
use Illuminate\Http\Request;
use Organization\Models\{
    LaundryCategory
};

class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                             = LaundryCategory::find($id);

        $record->name                       = $request->input('name');
        $record->description                = $request->input('description');
        $record->save();

        return $record;
    }
}
