<?php
namespace Organization\Actions\QrMenu;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Organization\Models\{
    QrMenu
};
class StoreAction
{
    public function execute(Request $request)
    {
        $file = FileTrait::storeSingleFile($request->file('menu'),'qrMenus');

        $record =  QrMenu::create([
            'name'                      => $request->input('name'),
            'menu'                      => $file
        ]);

        return $record;
    }
}
