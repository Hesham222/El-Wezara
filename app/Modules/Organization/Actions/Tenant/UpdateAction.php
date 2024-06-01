<?php
namespace Organization\Actions\Tenant;
use Illuminate\Http\Request;
use Organization\Models\{
    Tenant
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record             = Tenant::find($id);
        $record->name       = $request->input('name');
        $record->primary_name       = $request->input('primaryName');
        $record->primary_phone       = $request->input('primaryPhone');
        $record->notes       = $request->input('notes');
        $record->save();
        return $record;
    }
}
