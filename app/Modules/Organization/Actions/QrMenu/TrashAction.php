<?php
namespace Organization\Actions\QrMenu;
use Illuminate\Http\Request;
use Organization\Models\{
    QrMenu
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = QrMenu::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
