<?php
namespace Organization\Actions\VacationRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Organization\Models\EmployeeType;
use Organization\Models\VacationRequest;


class FilterEmpAction
{
    public function execute(Request $request)
    {
        return VacationRequest::
        whereHas('employee', function ($query) use ($request) {
            $query->where('id',$request->id);
        })

            ->select(['id','employee_id', 'employee_vacation_type_id','start_date','end_date','note','status','vacation_duration','created_at'])
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
                    })
                    ->when($request->input('column') == 'employeeVacationType', function ($query) use ($request){
                        return $query->whereHas('vacation_type', function ($query) use ($request) {
                            $query->where('name->en', 'like', '%' . $request->input('value') . '%')->orWhere('name->ar', 'like', '%' . $request->input('value') . '%');
                        });
                    });
            });

    }
}
