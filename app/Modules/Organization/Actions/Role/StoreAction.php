<?php
namespace Organization\Actions\Role;
use Organization\Models\RolePermission;
use Illuminate\Http\Request;
use Organization\Models\{
    Role
};
class StoreAction
{
    public function execute(Request $request)
    {
        $record =  Role::create([
            'name'       => $request->input('name'),
            'created_by' => auth('organization_admin')->user()->id,
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
