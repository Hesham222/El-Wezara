<?php
namespace Organization\Actions\Ingredient;;
use Illuminate\Http\Request;
use Organization\Models\Ingredient;


class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = Ingredient::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
