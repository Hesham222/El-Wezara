<?php
namespace Organization\Actions\Ingredient;
use Illuminate\Http\Request;
use Organization\Models\Ingredient;

class TrashAction
{
    public function execute(Request $request)
    {
        $record = Ingredient::find($request->resource_id);
        if(!$record)
            return false;
       /*
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
       */
        $record->forceDelete();
        return $request->resource_id;
    }
}
