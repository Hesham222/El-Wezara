<?php
namespace Organization\Actions\TicketPrice;
use Illuminate\Http\Request;
use Organization\Models\{
    TicketPrice
};
class StoreAction
{
    public function execute(Request $request)
    {
        foreach ($request->input('prices') as $key => $price)
        {
            TicketPrice::create([
                'ticket_category_id' => $request->input('category'),
                'ticket_sub_category_id'       => $key,
                'price'       => $price,
                'created_by' => auth('organization_admin')->user()->id,
            ]);
        }
        return "success";
    }
}
