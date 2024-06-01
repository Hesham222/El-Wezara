<?php
namespace Organization\Actions\SubAssetProduct;
use Illuminate\Http\Request;
use Organization\Models\{
    SubAssetProduct
};

class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                             = SubAssetProduct::find($id);

        $record->name                       = $request->input('name');
        $record->assetProduct_id            = $request->input('assetProduct_id');
        $record->start_value                = $request->input('start_value');
        $record->current_value              = $request->input('current_value');
        $record->entry_date                 = $request->input('entry_date');
        $record->save();

        return $record;
    }
}
