<?php
namespace Organization\Actions\TicketCategory;
use Illuminate\Http\Request;
use Organization\Models\{
    TicketCategory
};
class StoreAction
{
    public function execute(Request $request)
    {
        $record =  TicketCategory::create([
            'name'       => $request->input('name'),
        ]);
        return $record;
    }
}
