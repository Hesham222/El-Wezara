<?php
namespace Organization\Actions\QrMenu;
use Illuminate\Http\Request;
use Organization\Models\{
    QrMenu
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = QrMenu::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
