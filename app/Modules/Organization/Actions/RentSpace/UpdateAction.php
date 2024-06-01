<?php
namespace Organization\Actions\RentSpace;
use Illuminate\Http\Request;
use Organization\Models\{
    RentSpace
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record             = RentSpace::find($id);
        $record->name       = $request->input('name');
        $record->description       = $request->input('description');
        $record->save();
        return $record;
    }
}
