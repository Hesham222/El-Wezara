<?php
namespace Organization\Actions\CompanyReport;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Organization\Models\Supplier;

class FilterAction
{
    public function execute(Request $request)
    {
        return Supplier::
            select(['id','name','phone','speciality','deleted_by','deleted_at', 'created_at'])

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
                ->when($request->input('column') == 'name', function ($query) use ($request){
                    return $query->where('name', 'like', '%' . $request->input('value') . '%');
                });
        })->whereHas('hotelReservations',function ($query) use ($request) {
                $query->whereBetween('created_at', [$request->input('date_from'), $request->input('date_to')]);
            });

    }
}
