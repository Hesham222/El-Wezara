<?php
namespace Organization\Actions\QrMenu;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Organization\Models\{
    QrMenu
};

class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                             = QrMenu::find($id);
        $attachment = $record->menu;
        if($request->file('menu'))
        {
            FileTrait::RemoveSingleFile($attachment);
            $attachment = FileTrait::storeSingleFile($request->file('menu'), 'qrMenus');
        }
        $record->name                       = $request->input('name');
        $record->menu                       = $attachment;
        $record->save();

        return $record;
    }
}
