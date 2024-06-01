<?php
namespace Organization\Actions\employeeVacationType;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Organization\Models\EmployeeVacationType;


class FilterAction
{
    public function execute(Request $request)
    {
        return EmployeeVacationType::when($request->input('view') == 'trash', function ($query) use ($request) {
            return $query->onlyTrashed();
        })->with(['deletedBy' => function ($query) use ($request) {
            $query->select(['id','name']);
        }])

            ->select(['id','type', 'description','vacation_type','deleted_by','deleted_at','created_at'])
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
                    ->when($request->input('column') == 'type', function ($query) use ($request){
                        return $query->where('type', 'like', '%' . $request->input('value') . '%');

                    });
            });

    }
}
