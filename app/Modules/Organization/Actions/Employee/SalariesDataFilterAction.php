<?php
namespace Organization\Actions\Employee;
use Illuminate\Http\Request;
use Organization\Models\Employee;
use Carbon\Carbon;
class SalariesDataFilterAction
{
    public function execute(Request $request)
    {
        return Employee::when($request->input('view') == 'trash', function ($query) use ($request) {
                return $query->onlyTrashed();
            })->with(['deletedBy' => function ($query) use ($request) {
                $query->select(['id','name']);
            }])

            ->select(['id','name', 'phone','department_id','employee_type_id',
                'employee_job_id','date_of_hiring','birth_date','insurance_number','social_status','military_status'
                ,'gross_salary','net_salary','annual_increase_rate',
                'deleted_by','deleted_at', 'created_at'])
            ->when($request->input('start_date') && $request->input('end_date'), function ($query) use ($request) {
                return $query->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))]);
            })
            //sub query used in search field
            ->when($request->input('column') && $request->input('value'), function ($query) use ($request){
                return $query->when($request->input('column') == 'createdBy', function ($query) use ($request) {

                })
                    ->when($request->input('column') == 'deletedBy' , function ($query) use ($request){
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


                    ->when($request->input('column') == 'department' , function ($query) use ($request){
                        return $query->whereHas('department', function ($query) use ($request) {
                            $query->where('name->en', 'like', '%' . $request->input('value') . '%')->orWhere('name->ar', 'like', '%' . $request->input('value') . '%');
                        });
                    })


                    ->when($request->input('column') == 'employee_type' , function ($query) use ($request){
                        return $query->whereHas('employee_type', function ($query) use ($request) {
                            $query->where('name->en', 'like', '%' . $request->input('value') . '%')->orWhere('name->ar', 'like', '%' . $request->input('value') . '%');
                        });
                    })


                    ->when($request->input('column') == 'employee_job' , function ($query) use ($request){
                        return $query->whereHas('employee_job', function ($query) use ($request) {
                            $query->where('name->en', 'like', '%' . $request->input('value') . '%')->orWhere('name->ar', 'like', '%' . $request->input('value') . '%');
                        });
                    })

                    ->when($request->input('column') == 'phone', function ($query) use ($request){
                        return $query->where('phone', 'like', '%' . $request->input('value') . '%');
                    });
            });

    }
}
