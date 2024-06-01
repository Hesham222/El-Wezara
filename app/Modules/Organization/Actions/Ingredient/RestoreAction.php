<?php
namespace Organization\Actions\Ingredient;;
use Illuminate\Http\Request;
use Organization\Models\Ingredient;


class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Ingredient::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
