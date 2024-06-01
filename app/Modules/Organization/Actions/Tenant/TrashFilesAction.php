<?php
namespace Organization\Actions\Tenant;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Organization\Models\TenantAttachment;
use Organization\Models\{
    Tenant
};
class TrashFilesAction
{
    public function execute(Request $request,$id)
    {
         $record = TenantAttachment::find($id);
        if(!$record)
            return false;
        if($record->attachment)
            FileTrait::RemoveSingleFile($record->attachment);
        $record->forceDelete();
        return $record->id;
    }
}
