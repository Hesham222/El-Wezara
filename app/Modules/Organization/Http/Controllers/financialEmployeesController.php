<?php

namespace Organization\Http\Controllers;
use Admin\Models\Admin;

use Organization\Models\{Department, Employee, EmployeeAttachment, EmployeeJob, EmployeeType, OrganizationAdmin, Role};
use Organization\Actions\Employee\NominationFilterAction;
use Organization\Actions\Employee\OfficerFilterAction;
use Organization\Actions\Employee\SalariesDataFilterAction;
use Organization\Actions\Employee\TemporaryFilterAction;
use Organization\Actions\Employee\TheInsuredFilterAction;
use Organization\Http\Requests\Admin\FilterDateRequest;
use Organization\Http\Requests\Employee\FilterSalaryDateRequest;

class financialEmployeesController extends JsonResponse
{

    public function nomination()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FinancialEmployee-View-Nomination')
        ){
            $type = 'emps-nomination';
            return view('Organization::employees.index',compact('type'));
        }else
            return abort(401);
    }

    public function nominationData(FilterDateRequest $request, NominationFilterAction $filterAction)
    {
        $records = $filterAction->execute($request)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),

            ]);
        $result = view('Organization::employees.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }




    public function TheInsured()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FinancialEmployee-View-TheInsured')
        ){
            $type = 'emps-TheInsured';
            return view('Organization::employees.index',compact('type'));
        }else
            return abort(401);
    }




    public function TheInsuredData(FilterDateRequest $request, TheInsuredFilterAction $filterAction)
    {
        $records = $filterAction->execute($request)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),

            ]);
        $result = view('Organization::employees.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }



    public function temporary()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FinancialEmployee-View-Temporary')
        ){
            $type = 'emps-temporary';
            return view('Organization::employees.index',compact('type'));
        }else
            return abort(401);
    }




    public function temporaryData(FilterDateRequest $request, TemporaryFilterAction $filterAction)
    {
        $records = $filterAction->execute($request)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),

            ]);
        $result = view('Organization::employees.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }



    public function officer()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FinancialEmployee-View-Officer')
        ){
            $type = 'emps-officer';
            return view('Organization::employees.index',compact('type'));
        }else
            return abort(401);
    }

    public function officerData(FilterDateRequest $request, OfficerFilterAction $filterAction)
    {
        $records = $filterAction->execute($request)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),

            ]);
        $result = view('Organization::employees.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }


    public function nominationSalaries()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FinancialEmployeeSalary-View-Nomination')
        ){
            $type = 'nominationSalaries';
            return view('Organization::employees.index',compact('type'));
        }else
            return abort(401);
    }




    public function nominationSalariesData(FilterSalaryDateRequest $request, NominationFilterAction $filterAction)
    {
        $records = $filterAction->execute($request)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),

            ]);
        $type = 'nominationSalaries';
        $result = view('Organization::employees.components.table_body',compact('records','type'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }


    public function TheInsuredSalaries()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FinancialEmployeeSalary-View-TheInsured')
        ){
            $type = 'TheInsuredSalaries';
            return view('Organization::employees.index',compact('type'));
        }else
            return abort(401);
    }




    public function TheInsuredSalariesData(FilterSalaryDateRequest $request, TheInsuredFilterAction $filterAction)
    {
        $records = $filterAction->execute($request)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),

            ]);
        $type = 'TheInsuredSalaries';
        $result = view('Organization::employees.components.table_body',compact('records','type'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }


    public function temporarySalaries()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FinancialEmployeeSalary-View-Temporary')
        ){
            $type = 'temporarySalaries';
            return view('Organization::employees.index',compact('type'));
        }else
            return abort(401);
    }




    public function temporarySalariesData(FilterSalaryDateRequest $request, TemporaryFilterAction $filterAction)
    {
        $records = $filterAction->execute($request)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),

            ]);
        $type = 'temporarySalaries';
        $result = view('Organization::employees.components.table_body',compact('records','type'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }


    public function officerSalaries()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FinancialEmployeeSalary-View-Officer')
        ){
            $type = 'officerSalaries';
            return view('Organization::employees.index',compact('type'));
        }else
            return abort(401);
    }

    public function officerSalariesData(FilterSalaryDateRequest $request, OfficerFilterAction $filterAction)
    {
        $records = $filterAction->execute($request)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),

            ]);
        $type = 'officerSalaries';
        $result = view('Organization::employees.components.table_body',compact('records','type'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }


}
