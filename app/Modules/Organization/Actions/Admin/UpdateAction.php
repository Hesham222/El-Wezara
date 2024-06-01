<?php
namespace Organization\Actions\Admin;
use Illuminate\Http\Request;
use Organization\Models\{
    OrganizationAdmin
};
class UpdateAction
{
    public function execute(Request $request,$id): void
    {
        $record             = OrganizationAdmin::find($id);
        $record->name       = $request->input('name');
        $record->email      = $request->input('email');
        $record->phone      = $request->input('phone');
        $record->role_id    = $request->input('role');
        $record->save();
    }
}
