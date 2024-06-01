<?php
namespace Organization\Actions\TicketPrice;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Organization\Models\TicketPrice;

class FilterAction
{
    public function execute(Request $request)
    {
        return TicketPrice::with(['createdBy' => function ($query) use ($request) {
            $query->select(['id','name']);
        }])
        ->select(['id','ticket_category_id','ticket_sub_category_id','price','created_by','created_at'])
        ->when($request->input('start_date') && $request->input('end_date'), function ($query) use ($request) {
            return $query->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))]);
        })
        //sub query used in search field
        ->when($request->input('column') && $request->input('value'), function ($query) use ($request){
            return $query->when($request->input('column') == 'createdBy' , function ($query) use ($request){
                    return $query->whereHas('createdBy', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->input('value') . '%');
                    });
                })
                ->when($request->input('column') == 'category' , function ($query) use ($request){
                    return $query->whereHas('category', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->input('value') . '%');
                    });
                })
                ->when($request->input('column') == '_id', function ($query) use ($request){
                    return $query->where('id',  $request->input('value') );
                })
                ->when($request->input('column') == 'subCategory' , function ($query) use ($request){
                    return $query->whereHas('subCategory', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->input('value') . '%');
                    });
                });
        });

    }
}
