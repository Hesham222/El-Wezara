<?php
namespace Organization\Actions\Tenant;
use App\Http\Traits\FileTrait;
use App\Models\File;
use Illuminate\Http\Request;
use Organization\Models\TenantAttachment;
use Organization\Models\{
    Tenant
};
class UpdateFilesAction
{
    public static function storeMultipleTenantFiles($files, $pathFolder,$tenantId)
    {
        foreach ((array)$files as $file)
        {
            $path         = $file->store($pathFolder, 'public');
            TenantAttachment::create([
                'attachment'   => $path,
                'tenant_id'    => $tenantId,
            ]);
        }
        return 1;
    }
    public function execute(Request $request,$record)
    {
        if($request->file('attachment'))
        {
            return $files = $this->storeMultipleTenantFiles($request->file('attachment'),'tenants',$record->id);
        }

    }

}
