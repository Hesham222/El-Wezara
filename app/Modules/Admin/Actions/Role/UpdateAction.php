<?php
namespace Admin\Actions\Role;
use Admin\Models\RolePermission;
use Illuminate\Http\Request;
use Admin\Models\{
    Role
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record             = Role::find($id);
        $record->name       = $request->input('name');
        $record->save();
        $record->permissions()->delete();
        foreach ($request->input('permissions') as $permission)
        {
            RolePermission::create([
                'role_id' => $record->id,
                'permission_id' => $permission
            ]);
        }
        return $record;
    }
}
