<?php
namespace Organization\Actions\TicketCategory;
use Illuminate\Http\Request;
use Organization\Models\{
    TicketCategory
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record             = TicketCategory::find($id);
        $record->name       = $request->input('name');
        $record->save();
        return $record;
    }
}
