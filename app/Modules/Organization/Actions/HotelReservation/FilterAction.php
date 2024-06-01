<?php
namespace Organization\Actions\HotelReservation;
use Illuminate\Http\Request;
use Organization\Models\HotelReservation;
use Carbon\Carbon;
class FilterAction
{
    public function execute(Request $request)
    {
        return HotelReservation::when($request->input('view') == 'trash', function ($query) use ($request) {
            return $query->onlyTrashed();
        })->with(['deletedBy' => function ($query) use ($request) {
            $query->select(['id','name']);
        }])
        ->with(['Customer' => function ($query) use ($request) {
                $query->select(['id','name']);
        }])
        ->with(['hotel' => function ($query) use ($request) {
            $query->select(['id','name']);
        }])
        ->with(['RoomType' => function ($query) use ($request) {
             $query->select(['id','name']);
        }])->with('Room')
        ->select(['id','supplier_id','hotel_id','customer_id','roomType_id','arrival_date','departure_date','num_of_nights','room_id',
            'price_per_night','total_price_for_duration','num_of_children','num_of_extra_beds','final_price',
            'checkIn','deleted_by','deleted_at', 'created_at','remainingAmount','paidAmount'])
        ->when($request->input('start_date') && $request->input('end_date'), function ($query) use ($request) {
            return $query->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))]);
        })
        //sub query used in search field
        ->when($request->input('column') && $request->input('value'), function ($query) use ($request){
            return $query->when($request->input('column') == 'deletedBy' , function ($query) use ($request){
                    return $query->whereHas('deletedBy', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->input('value') . '%');
                    });
                })
                ->when($request->input('column') == '_id', function ($query) use ($request){
                    return $query->where('id',  $request->input('value') );
                })
                ->when($request->input('column') == 'name' , function ($query) use ($request){
                    return $query->whereHas('Customer', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->input('value') . '%');
                    });
                })
                ->when($request->input('column') == 'supplier' , function ($query) use ($request){
                    return $query->whereHas('supplier', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->input('value') . '%');
                    });
                })
                ->when($request->input('column') == 'hotel' , function ($query) use ($request){
                    return $query->whereHas('hotel', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->input('value') . '%');
                    });
                });
        });

    }
}
