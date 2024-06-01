<?php
namespace Organization\Actions\Ticket;
use Illuminate\Http\Request;
use Organization\Models\Ticket;
use Carbon\Carbon;
class FilterAction
{
    public function execute(Request $request)
    {
        return Ticket::when($request->input('view') == 'trash', function ($query) use ($request) {
            return $query->onlyTrashed();
        })->with(['deletedBy' => function ($query) use ($request) {
            $query->select(['id','name']);
        }])->with(['createdBy' => function ($query) use ($request) {
            $query->select(['id','name']);
        }])->with(['details' => function ($query) use ($request) {
            $query->select(['id','ticket_category_id','ticket_sub_category_id','price']);
        }])->with(['gate' => function ($query) use ($request) {
            $query->select(['id','name']);
        }])
        ->select(['id','ticket_price_id', 'gate_id', 'price','created_by','deleted_by','deleted_at', 'created_at'])
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
                    return $query->where('price',  $request->input('value') );
                })
                ->when($request->input('column') == 'createdBy' , function ($query) use ($request){
                    return $query->whereHas('createdBy', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->input('value') . '%');
                    });
                });
        });

    }
}
