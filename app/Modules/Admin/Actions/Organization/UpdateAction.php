<?php
namespace Admin\Actions\Organization;
use Illuminate\Http\Request;
use Admin\Models\{
    Organization
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record             = Organization::find($id);
        $record->name       = $request->input('name');
        $record->address      = $request->input('address');
        $record->save();
        return $record;
    }
}
