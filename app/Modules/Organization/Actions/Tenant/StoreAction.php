<?php
namespace Organization\Actions\Tenant;
use App\Http\Traits\FileTrait;
use App\Models\File;
use Illuminate\Http\Request;
use Organization\Models\TenantAttachment;
use Organization\Models\{
    Tenant
};
class StoreAction
{

    public function execute(Request $request)
    {
        $record =  Tenant::create([
            'name'       => $request->input('name'),
            'primary_name'       => $request->input('primaryName'),
            'primary_phone'       => $request->input('primaryPhone'),
            'notes'       => $request->input('notes'),
            'created_by'       => auth('organization_admin')->user()->id,
        ]);
        return $record;
    }
}
