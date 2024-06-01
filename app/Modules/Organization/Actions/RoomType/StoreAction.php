<?php
namespace Organization\Actions\RoomType;
use Illuminate\Http\Request;
use Organization\Models\{
    RoomType
};
class StoreAction
{
    public function execute(Request $request)
    {

        $record =  RoomType::create([
            'name'                      => $request->input('name'),
            'num_of_persons'            => $request->input('num_of_persons'),
        ]);

        return $record;
    }
}
