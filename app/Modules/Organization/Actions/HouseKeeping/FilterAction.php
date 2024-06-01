<?php
namespace Organization\Actions\HouseKeeping;
use Illuminate\Http\Request;
use Organization\Models\RoomHouseKeeping;
use Carbon\Carbon;
class FilterAction
{
    public function execute(Request $request)
    {
        return RoomHouseKeeping::select(['id','room_id','status','occupied_date'])
        ->when(( ($request->input('start_date') && $request->input('start_date') <= date('Y-m-d'))), function ($query) use ($request) {
            return $query->where('occupied_date',$request->input('start_date'));
        })
        //sub query used in search field
        ->when($request->input('column') && $request->input('value'), function ($query) use ($request){
            return $query->when($request->input('column') == '_id', function ($query) use ($request){
                    return $query->where('id',  $request->input('value') );
                })
                ->when($request->input('column') == 'room', function ($query) use ($request){
                    return $query->whereHas('room', function ($query) use ($request) {
                        $query->where('room_num',$request->input('value'));
                    });
                });
        })
        ->when($request->input('column') == 'hotel' , function ($query) use ($request){
            return $query->whereHas('room.ParentRoom.hotel', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->input('value') . '%');
            });
        });

    }
}
