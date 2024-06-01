<?php
namespace Organization\Actions\Vendor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Organization\Models\Vendor;


class FilterAction
{
    public function execute(Request $request)
    {
        return Vendor::when($request->input('view') == 'trash', function ($query) use ($request) {
            return $query->onlyTrashed();
        })->with(['deletedBy' => function ($query) use ($request) {
            $query->select(['id','name']);
        }])

            ->select(['id','name', 'company_name','tax_card','commercial_record','tax_card_attachment','commercial_record_attachment','deleted_at','created_at'])
            ->when($request->input('start_date') && $request->input('end_date'), function ($query) use ($request) {
                return $query->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))]);
            })
            //sub query used in search field
            ->when($request->input('column') && $request->input('value'), function ($query) use ($request){

                    $query->when($request->input('column') == 'deletedBy' , function ($query) use ($request){
                        return $query->whereHas('deletedBy', function ($query) use ($request) {
                            $query->where('name', 'like', '%' . $request->input('value') . '%');
                        });
                    })
                    ->when($request->input('column') == '_id', function ($query) use ($request){
                        return $query->where('id',  $request->input('value') );
                    })
                    ->when($request->input('column') == 'name', function ($query) use ($request){
                        return $query->where('name', 'like', '%' . $request->input('value') . '%');

                    })

                        ->when($request->input('column') == 'commercial_record', function ($query) use ($request){
                            return $query->where('commercial_record', 'like', '%' . $request->input('value') . '%');

                        })


                        ->when($request->input('column') == 'tax_card', function ($query) use ($request){
                            return $query->where('tax_card', 'like', '%' . $request->input('value') . '%');

                        })
                    ;
            });

    }
}
