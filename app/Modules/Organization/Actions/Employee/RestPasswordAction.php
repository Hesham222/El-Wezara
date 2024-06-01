<?php
namespace Organization\Actions\Admin;;
use Illuminate\Http\Request;
use Organization\Models\{
    OrganizationAdmin
};

class RestPasswordAction
{
    public function execute(Request $request): void
    {
        $record = OrganizationAdmin::find($request->resource_id);
        $record->password            = bcrypt($request->password);
        $record->save();
    }
}
