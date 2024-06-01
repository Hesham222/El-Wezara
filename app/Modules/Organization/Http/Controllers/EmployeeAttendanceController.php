<?php

namespace Organization\Http\Controllers;
use Admin\Models\Admin;

use App\Helpers\UploadFile;
use App\Http\Traits\FileTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Organization\Actions\Employee\{StoreAction,
    StoreDaysAction,
    StoreSalaryAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
    StoreAttendanaceAction

};
use Organization\Http\Requests\Employee\{StoreAttachment,
    StoreContract,
    StoreDaysRequest,
    StoreRequest,
    StoreSalaryRequest,
    UpdateRequest,
    RemoveRequest,
    FilterDateRequest,
StoreAttendanceRequest};
use Organization\Exports\Employee\{
    ExportData,
};
use Organization\Models\{Department, Employee, EmployeeAttachment, EmployeeJob, EmployeeType, OrganizationAdmin, Role,EmployeeAttendance};

use Carbon\Carbon;



class EmployeeAttendanceController extends JsonResponse
{
    use FileTrait;
    public function show()
    {
        
     
$today = today(); 
    $dates = []; 

    for($i=1; $i < $today->daysInMonth + 1; ++$i) {
        $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
    }

        return view('Organization::employees.attendance.index',compact('dates'));
    }




     public function data(FilterDateRequest $request, FilterAction $filterAction)
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
            $today = today(); 
    $dates = []; 

    for($i=1; $i < $today->daysInMonth + 1; ++$i) {
        $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
    }
        $result = view('Organization::employees.attendance.table_body',compact('records','dates'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }


public function storeAttendance(StoreAttendanceRequest $request, StoreAttendanaceAction $storeAction)
{

if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
          checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')
      ) {
          DB::beginTransaction();
    //    try {
          
 $storeAction->execute($request);

              DB::commit();
              return back()->with('success', '   تم تسجيل الحضور ');
        //   } catch (\Exception $exception) {
              DB::rollback();
            //   return redirect()->back()->with('error', 'Failed, Please try again later.')->withInput();
        //   }
      }else
          return abort(401);

}



public function vacation($id,$date)
{

if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
          checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')
      ) {
          DB::beginTransaction();
       // try {
          $today = today(); 
    $dates = []; 

    for($i=1; $i < $today->daysInMonth + 1; ++$i) {
        $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
    }

    $emp = Employee::FindOrFail($id);

    if (!in_array($date, $dates)) {
        return redirect()->back()->with('error', 'Failed, Please try again later.')->withInput();
    }


$attendanace = EmployeeAttendance::where('employee_id',$emp->id)
        ->where('date',$date)->first();
        if ( $attendanace) {
            $attendanace->vacation = 1;
            $attendanace->save();
        }else{
$attendanace = new EmployeeAttendance();
$attendanace->employee_id  = $emp->id;
$attendanace->date = $date;
$attendanace->vacation = 1;
$attendanace->save();



        }


              DB::commit();
              return back()->with('success', '     تم تسجيل اليوم ك اجازة للموظف ');
          // } catch (\Exception $exception) {
              DB::rollback();
              // return redirect()->back()->with('error', 'Failed, Please try again later.')->withInput();
          // }
      }else
          return abort(401);

}





public function dessmissOverTime($id,$date)
{

if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
          checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')
      ) {
          DB::beginTransaction();
       // try {
          $today = today(); 
    $dates = []; 

    for($i=1; $i < $today->daysInMonth + 1; ++$i) {
        $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
    }

    $emp = Employee::FindOrFail($id);

    if (!in_array($date, $dates)) {
        return redirect()->back()->with('error', 'Failed, Please try again later.')->withInput();
    }


$attendanace = EmployeeAttendance::where('employee_id',$emp->id)
        ->where('date',$date)->first();
        if ( $attendanace) {
            if ($attendanace->dessmissExtraHours == 1) {
                $attendanace->dessmissExtraHours = 0;
            }else{

              $attendanace->dessmissExtraHours = 1;  
            }
            
            $attendanace->save();
        }else{
$attendanace = new EmployeeAttendance();
$attendanace->employee_id  = $emp->id;
$attendanace->date = $date;
$attendanace->dessmissExtraHours = 1;
$attendanace->save();



        }


              DB::commit();
              return back()->with('success', '    تم تغيير حاله تجاهل الساعات الاضافية');
          // } catch (\Exception $exception) {
              DB::rollback();
              // return redirect()->back()->with('error', 'Failed, Please try again later.')->withInput();
          // }
      }else
          return abort(401);

}




public function approveHours($id,$date)
{

if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
          checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')
      ) {
          DB::beginTransaction();
       // try {
          $today = today(); 
    $dates = []; 

    for($i=1; $i < $today->daysInMonth + 1; ++$i) {
        $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
    }

    $emp = Employee::FindOrFail($id);

    if (!in_array($date, $dates)) {
        return redirect()->back()->with('error', 'Failed, Please try again later.')->withInput();
    }


$attendanace = EmployeeAttendance::where('employee_id',$emp->id)
        ->where('date',$date)->first();
        if ( $attendanace) {
            $attendanace->approveWorkingHours = 1;
            $attendanace->approveExtraHours = 1;
            $attendanace->save();
        }


              DB::commit();
              return back()->with('success', '   تمت الموافقة على تفاصيل اليوم   ');
          // } catch (\Exception $exception) {
              DB::rollback();
              // return redirect()->back()->with('error', 'Failed, Please try again later.')->withInput();
          // }
      }else
          return abort(401);

}

    

}

