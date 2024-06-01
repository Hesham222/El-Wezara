<?php

namespace Organization\Http\Controllers;
use Admin\Models\Admin;
use DateTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Helpers\UploadFile;
use App\Http\Traits\FileTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Organization\Models\LeaveUnpaid;
use Organization\Actions\Employee\{StoreAction,
    StoreDaysAction,
    StoreSalaryAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    StoreUnpaidVacationAction,
    DestroyAction,
    FilterAction};
use Organization\Http\Requests\Employee\{StoreAttachment,
    StoreContract,
    StoreDaysRequest,
    StoreUnpaidVacationRequest,
    StoreRequest,
    StoreSalaryRequest,
    UpdateRequest,
    RemoveRequest,
    FilterDateRequest};
use Organization\Exports\Employee\{
    ExportData,
};
use Organization\Models\{Department, Employee, EmployeeAttachment, EmployeeJob, EmployeeType, OrganizationAdmin, Role};

use App\Imports\EmpImport;

class EmployeeController extends JsonResponse
{
    use FileTrait;
    public function index()
    {

        return view('Organization::employees.index');
    }



public function import()
{
    if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
    checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-View')||
    checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')||
    checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||
    checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password')
)
return view('Organization::employees.import');
else
    return abort(401);

}



public function importExcelCSV(Request $request)
    {

        $validatedData = $request->validate([

            'file'          => 'required',
           // 'extension'      => 'required|in:doc,csv,xlsx,xls,docx,ppt,odt,ods,odp',
        ]);

        Excel::import(new EmpImport,$request->file('file'));


        return back()->with('success', 'تمت اضافه الموظفين بنجاح');
    }

    public function showData($id)
    {

        $emp = Employee::findOrFail($id);
        return view('Organization::employees.showData',compact('emp'));

    }

    public function showAttachmentsData($id)
    {
        $emp = Employee::findOrFail($id);
        return view('Organization::employees.showAttachmentsData',compact('emp'));

    }

    public function uploadAttachments($id)
    {
        $emp = Employee::findOrFail($id);
        return view('Organization::employees.uploadAttachments',compact('emp'));

    }

    public function uploadContract($id)
    {
        $emp = Employee::findOrFail($id);
        return view('Organization::employees.uploadContract',compact('emp'));

    }

    public function addSalary($id)
    {
        $emp = Employee::findOrFail($id);
        return view('Organization::employees.add_salary',compact('emp'));
    }
    public function addWorkingDays($id){
        $emp = Employee::findOrFail($id);
        return view('Organization::employees.add_days',compact('emp'));
    }

    public function uploadJobDescription($id)
    {
        $emp = Employee::findOrFail($id);
        return view('Organization::employees.uploadJobDescription',compact('emp'));

    }

    public function downloadJobDescription($id)
    {
        $emp = Employee::findOrFail($id);
        return view('Organization::employees.printJobDescription',compact('emp'));

    }

    public function storeAttachments(StoreAttachment $request,$id)
    {

        $emp = Employee::findOrFail($id);

        if ($request->has('ather_attachment')){
            $count = 0;
            // return count($request->ather_attachment);
            foreach ($request->file('ather_attachment') as $an_file){
                //   return dd('das');
                $new_file = new EmployeeAttachment();
                $new_file->employee_id = $emp->id;
                $new_file->attachment = $request->file('ather_attachment')[$count]->store('other_employee_attachments');

                //$this->storeSingleFile($an_file,'other_employee_attachments');
                $new_file->save();
                $count++;
            }

        }

        return back()->with('success','files stored successfully');
    }


   public function storecontract(StoreContract $request , $id)
   {

       $emp = Employee::findOrFail($id);

       if ($request->has('contract_attachments')){

               if ($emp->contract_attachments != null) {
                   $this->RemoveSingleFile($emp->contract_attachments);

               }
//           $emp->contract_attachments = $request->file('contract_attachments')->store('contract_attachments');
           $emp->contract_attachments = FileTrait::storeSingleFile($request->file('contract_attachments'),'contract_attachments');

           $emp->save();


       }

       return back()->with('success','file stored successfully');

   }



    public function storeJobDescription(StoreContract $request , $id)
    {

        $emp = Employee::findOrFail($id);

        if ($request->has('job_description_attachments')){

            if ($emp->job_description_attachments != null) {
                $this->RemoveSingleFile($emp->job_description_attachments);

            }
//            $emp->job_description_attachments = $request->file('job_description_attachments')->store('job_description_attachments');
            $emp->job_description_attachments = FileTrait::storeSingleFile($request->file('job_description_attachments'),'job_description_attachments');

            $emp->save();


        }

        return back()->with('success','file stored successfully');

    }

    public function downloadAttachment($id)
    {
        $emp_attachment = EmployeeAttachment::FindOrFail($id);
       // return Response::download($emp_attachment->attachment);
     //  return Storage::download($emp_attachment->attachment);
       // return response()->download(public_path($emp_attachment->attachment));




        try {
            $emp_attachment = EmployeeAttachment::FindOrFail($id);
            if ($emp_attachment) {
                //return Storage::disk('public')->download($company_info->national_id);
                //  return Storage::disk('public')->readStream($company_info->national_id);
                //return response()->file(asset('storage/'.$company_info->national_id));
                $pdfContent = Storage::get($emp_attachment->attachment);
                $filePath = $emp_attachment->attachment;
                $type = Storage::mimeType($filePath);
                $fileName = 'jbjj';//Storage::name($filePath);

                return Response::make($pdfContent, 200, [
                    'Content-Type' => $type,
                    'Content-Disposition' => 'inline; filename="' . $fileName . '"'
                ]);
                //return redirect($company_info->national_id);
            } else {
                return back();
            }
        }catch (\Exception $exception) {
            return back()->with('error','Please Upload file again and try to show it');
        }


    }




    public function downloadContract($id)
    {
        $emp = Employee::FindOrFail($id);
        // return Response::download($emp_attachment->attachment);
        //  return Storage::download($emp_attachment->attachment);
        // return response()->download(public_path($emp_attachment->attachment));




        try {
            $emp = Employee::FindOrFail($id);
            if ($emp) {
                //return Storage::disk('public')->download($company_info->national_id);
                //  return Storage::disk('public')->readStream($company_info->national_id);
                //return response()->file(asset('storage/'.$company_info->national_id));
                $pdfContent = Storage::get($emp->contract_attachments);
                $filePath = $emp->contract_attachments;
                $type = Storage::mimeType($filePath);
                $fileName = 'jbjj';//Storage::name($filePath);

                return Response::make($pdfContent, 200, [
                    'Content-Type' => $type,
                    'Content-Disposition' => 'inline; filename="' . $fileName . '"'
                ]);
                //return redirect($company_info->national_id);
            } else {
                return back();
            }
        }catch (\Exception $exception) {
            return back()->with('error','Please Upload file again and try to show it');
        }


    }



    public function deleteAttachment($id)
    {
        $emp_attachment = EmployeeAttachment::FindOrFail($id);
        UploadFile::RemoveFile($emp_attachment->attachment);
        $emp_attachment->delete();
        return back()->with('success','file deleted successfully');
    }

    public function create()
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-View')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password')
        ){
            $departments = Department::all();
            $employee_types = EmployeeType::all();
            $employee_jobs = EmployeeJob::all();
            $roles = Role::all();
            return view('Organization::employees.create',compact('departments','employee_types','employee_jobs','roles'));
        }

        else
            return abort(401);
    }

    public function store(StoreRequest $request, StoreAction $storeAction)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')
        ) {
            DB::beginTransaction();
          //  return $request->all();
            try {
                $storeAction->execute($request);
                DB::commit();
                return redirect()->route('organizations.employee.index')->with('success', 'Data has been saved successfully.');
            } catch (\Exception $exception) {
                DB::rollback();
                return redirect()->back()->with('error', 'Failed, Please try again later.')->withInput();
            }
        }else
            return abort(401);
    }




    public function storeSalary(StoreSalaryRequest $request, StoreSalaryAction $storeAction)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')
        ) {
            DB::beginTransaction();
            //  return $request->all();
            try {
                $storeAction->execute($request);
                DB::commit();
                return back()->with('success', 'Data has been saved successfully.');
            } catch (\Exception $exception) {
                DB::rollback();
                return redirect()->back()->with('error', 'Failed, Please try again later.')->withInput();
            }
        }else
            return abort(401);
    }


    public function approve($id)
    {

      if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
          checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')
      ) {
          DB::beginTransaction();
          //  return $request->all();
          try {
            $emp = Employee::FindOrFail($id) ;
            $emp->approved = 1 ;
            $emp->save();
              DB::commit();
              return back()->with('success', 'تم قبول المزظف');
          } catch (\Exception $exception) {
              DB::rollback();
              return redirect()->back()->with('error', 'Failed, Please try again later.')->withInput();
          }
      }else
          return abort(401);


    }



    public function refuse($id)
    {

      if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
          checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')
      ) {
          DB::beginTransaction();
          //  return $request->all();
          try {
            $emp = Employee::FindOrFail($id) ;
            $emp->approved = 2 ;
            $emp->save();
              DB::commit();
              return back()->with('success', ' تم رفض الموظف ');
          } catch (\Exception $exception) {
              DB::rollback();
              return redirect()->back()->with('error', 'Failed, Please try again later.')->withInput();
          }
      }else
          return abort(401);


    }


    public function storeDays(StoreDaysRequest $request, StoreDaysAction $storeAction)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')
        ) {
            DB::beginTransaction();
            //  return $request->all();
            try {
                $storeAction->execute($request);
                DB::commit();
                return back()->with('success', 'Data has been saved successfully.');
            } catch (\Exception $exception) {
                DB::rollback();
                return redirect()->back()->with('error', 'Failed, Please try again later.')->withInput();
            }
        }else
            return abort(401);
    }

    public function edit($id)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')
        ) {
            $departments = Department::all();
            $employee_types = EmployeeType::all();
            $employee_jobs = EmployeeJob::all();
            $roles = Role::all();
            $record = Employee::findOrFail($id);
            return view('Organization::employees.edit', compact('record','departments','employee_jobs','employee_types','roles'));
        }else
            return abort(401);
    }

    public function update(UpdateRequest $request, UpdateAction $updateAction, $id)
    {
     //   return dd($request->all());
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')
        ) {
            DB::beginTransaction();
            try {
                $updateAction->execute($request, $id);
                DB::commit();
                return redirect()->route('organizations.employee.index')->with('success', 'Data has been saved successfully.');
            } catch (\Exception $exception) {
                DB::rollback();
                return redirect()->back()->with('error', 'Failed, Please try again later.')->withInput();
            }
        }else
            return abort(401);
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
        $result = view('Organization::employees.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }
    public function appendExemptionDescription(Request $request){
        try {
            if($request->ajax()){
                $data = $request->all();
                $exemption   = $data['military_status'];

                return view('Organization::employees.components.append_extemption_desc',compact('exemption'))->render();
            }
        } catch (\Exception $ex) {
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
        return $this->response(500, 'Failed, Please try again later.', 200);
    }
    public function UnpaidVacation($id)
    {
            $record = Employee::findOrFail($id);
            return view('Organization::employees.UnpaidVacation', compact('record'));

    }
    public function StoreUnpaidVacation(StoreUnpaidVacationRequest $request, StoreUnpaidVacationAction $action)
    {
        DB::beginTransaction();
        try {
            $record = $action->execute($request);
            DB::commit();
            return redirect()->route('organizations.employee.index',$record->employee_id)->with('success','Data has been saved successfully.');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }
    public function ReturnVacation($id)
    {
            DB::beginTransaction();
            try {
                $record                                 = Employee::FindOrFail($id);
                $record->leave_unpaid_status = 0;
                $record->save();
                DB::commit();
                return redirect()->route('organizations.employee.index')->with('success','تم تأكيد العوده من الاجازه بنجاح');
            } catch (\Exception $exception) {
                DB::rollback();
                return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
            }
    }

    public function ViewNotification($id)
    {
        $record = Employee::findOrFail($id);

        $today   = Carbon::now()->format('Y-m-d');

        $today_date   = \Carbon\Carbon::parse($today);
        $national_end = \Carbon\Carbon::parse($record->national_id_end_date);
        $health_end   = \Carbon\Carbon::parse($record->health_certificate_end_date);
        $contract_end = \Carbon\Carbon::parse($record->contract_end_date);

        //vacation counter
        $vacation_end = null;
        $vacations = LeaveUnpaid::where('employee_id',$record->id)->get();

        foreach ($vacations as $vacation){
            $result_leave = $today_date->diffInDays(\Carbon\Carbon::parse($vacation->leave_return), false);  // leave_return - $today_date

            if ($result_leave == 1){
                $vacation_end = $result_leave;
                break;
            }else{
                continue;
            }
        }
        // the rest of dates counter

        $result_national = $today_date->diffInDays($national_end, false);  // $national_end - $today_date
        $result_health   = $today_date->diffInDays($health_end, false);  // $health_end - $today_date
        $result_contract = $today_date->diffInDays($contract_end, false);  // $contract_end - $today_date

        $national_remain = null;
        $health_remain   = null;
        $contract_remain = null;
        if($result_national <= 30 && $national_end > $today_date && $result_national != 0){
            $national_remain =   $result_national;
        }
        if($result_health <= 30 && $health_end > $today_date && $result_health != 0){
            $health_remain = $result_health;
        }
        if($result_contract <= 30 && $contract_end > $today_date && $result_contract != 0){
            $contract_remain = $result_contract;
        }
        return view('Organization::employees.notification', compact('record','vacation_end','national_remain','health_remain','contract_remain'));

    }


    public function lastVacations($id)
    {
        $record      = Employee::FindOrFail($id);
        if ($record->vacation_balance != 0)
        {
            return redirect()->route('organizations.employee.index')->with('error','  ما زال لديك رصيد اجازات   ');

        }
        DB::beginTransaction();
        try {

            $vacs = floor(($record->remaining_vacs)/3);
            $record->remaining_vacs = 0;
            $record->save();
            DB::commit();
            return redirect()->route('organizations.employee.index')->with('success','تم تأكيد اخذ الاجازات المتبقية   ');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }


    }
    public function trash(RemoveRequest $request, TrashAction $trashAction)
    {
        DB::beginTransaction();
        try {
            $record =  $trashAction->execute($request);
            if(!$record)
                return $this->response(500, 'Failed, This record is not found .', 200);
            DB::commit();
            return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'employee', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    public function destroy(RemoveRequest $request, DestroyAction $destroyAction, $id)
    {
        DB::beginTransaction();
        try {
            if ($id === 1)
                return $this->response(500, 'Failed, You can not delete this record.', 200);
            $record =  $destroyAction->execute($request, $id);
            if(!$record)
                return $this->response(500, 'Failed, This record is not found .', 200);
            DB::commit();
            return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'employee', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    public function restore(RemoveRequest $request, RestoreAction $restoreAction)
    {
        DB::beginTransaction();
        try {
            $record =  $restoreAction->execute($request);
            DB::commit();
            return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'employee', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    private function countTrashes()
    {
        return Employee::onlyTrashed()->count();
    }
}
