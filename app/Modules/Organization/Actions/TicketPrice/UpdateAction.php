<?php
namespace Organization\Actions\TicketPrice;
use Illuminate\Http\Request;
use Organization\Models\TicketPrice;

class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record = TicketPrice::findorfail($id);
        $record->price = $request->input('price');
        $record->save();

        return $record;
    }
}
