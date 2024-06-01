<?php
namespace Organization\Actions\HotelConsumptionDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Organization\Models\HotelStoking;
use Organization\Models\HotelStokingIngredient;

class HotelConsumptionDetailFilterAction
{
    public function execute(Request $request,$id)
    {
        return HotelStokingIngredient::where('stocking_id',$id)->when($request->input('start_date') && $request->input('end_date'), function ($query) use ($request) {
            return $query->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))]);
        })
        //sub query used in search field
        ->when($request->input('column') && $request->input('value'), function ($query) use ($request){
            return $query->when($request->input('column') == '_id', function ($query) use ($request){
                    return $query->where('id',  $request->input('value') );
            });
        });
    }
}
