<?php
namespace Admin\Actions\Role;
use Admin\Models\RolePermission;
use Illuminate\Http\Request;
use Admin\Models\{
    Role
};
class StoreAction
{
    public function execute(Request $request)
    {
        $record =  Role::create([
            'name'       => $request->input('name'),
            'created_by' => auth('admin')->user()->id,
        ]);

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
