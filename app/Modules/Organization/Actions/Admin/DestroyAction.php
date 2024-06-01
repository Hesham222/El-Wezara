<?php
namespace Organization\Actions\Admin;;
use Illuminate\Http\Request;

use Organization\Models\{
    OrganizationAdmin
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = OrganizationAdmin::withTrashed()->where('id', '!=', auth('organization_admin')->user()->id)->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
