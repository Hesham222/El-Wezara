<?php
namespace Organization\Actions\Admin;
use Illuminate\Http\Request;
use Organization\Models\{
    OrganizationAdmin
};
class StoreAction
{
    public function execute(Request $request): void
    {
        $record =  OrganizationAdmin::create([
            'name'       => $request->input('name'),
            'email'      => $request->input('email'),
            'phone'      => $request->input('phone'),
            'role_id'    => $request->input('role'),
            'password'   => bcrypt($request->input('password')),
            'created_by' => auth('organization_admin')->user()->id,
        ]);

    }
}
