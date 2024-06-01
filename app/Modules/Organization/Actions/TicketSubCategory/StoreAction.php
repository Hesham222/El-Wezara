<?php
namespace Organization\Actions\TicketSubCategory;
use Illuminate\Http\Request;
use Organization\Models\{
    TicketSubCategory
};
class StoreAction
{
    public function execute(Request $request)
    {
        $record =  TicketSubCategory::create([
            'name'       => $request->input('name'),
        ]);
        return $record;
    }
}
