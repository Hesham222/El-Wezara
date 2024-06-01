<?php
namespace Organization\Actions\EmployeeDeduction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Organization\Models\EmployeeDeduction;


class FilterAction
{
    public function execute(Request $request)
    {
        return EmployeeDeduction::
            orderBy('created_at','desc')->
            select(['id','employee_id', 'amount','note','created_at'])
            ->when($request->input('start_date') && $request->input('end_date'), function ($query) use ($request) {
                return $query->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))]);
            })
            //sub query used in search field
            ->when($request->input('column') && $request->input('value'), function ($query) use ($request){

                    $query->when($request->input('column') == 'name' , function ($query) use ($request){
                        return $query->whereHas('employee', function ($query) use ($request) {
                            $query->where('name', 'like', '%' . $request->input('value') . '%');
                        });
                    })
                    ->when($request->input('column') == '_id', function ($query) use ($request){
                        return $query->where('id',  $request->input('value') );
                    });

            });

    }
}
