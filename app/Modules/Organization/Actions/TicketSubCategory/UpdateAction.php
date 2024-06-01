<?php
namespace Organization\Actions\TicketSubCategory;
use Illuminate\Http\Request;
use Organization\Models\{
    TicketSubCategory
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record             = TicketSubCategory::find($id);
        $record->name       = $request->input('name');
        $record->save();
        return $record;
    }
}
