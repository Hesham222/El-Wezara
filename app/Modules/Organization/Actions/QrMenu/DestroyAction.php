<?php
namespace Organization\Actions\QrMenu;;
use Illuminate\Http\Request;

use Organization\Models\{
    QrMenu
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = QrMenu::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
