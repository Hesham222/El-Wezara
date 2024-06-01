<?php
namespace Organization\Actions\Employee;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Organization\Models\{EmployeeAttachment, OrganizationAdmin, Employee};
class StoreAction
{use FileTrait;
    public function execute(Request $request)
    {


          $record = new Employee();

          $record->name       = $request->input('name');
//        $record->email      = $request->input('email');
          $record->phone      = $request->input('phone');
          $record->department_id       = $request->input('department');
          $record->exemption_reason       = $request->input('exemption_reason');
          $record->training_description       = $request->input('training_description');
          $record->employee_type_id       = $request->input('employeeType');

          $record->employee_job_id       = $request->input('employeeJob');
          $record->vacation_balance      = $request->input('vacation_balance');
          $record->date_of_hiring      = $request->input('date_of_hiring');
          $record->birth_date      = $request->input('birth_date');
          $record->insurance_number      = $request->input('insurance_number');
          $record->military_status      = $request->input('military_status');
          $record->social_status      = $request->input('social_status');
          $record->address      = $request->input('address');
          $record->status      = $request->input('status');

          $record->sending_address      = $request->input('sending_address');
          $record->secondPhone      = $request->input('secondPhone');
          $record->medical_condition      = $request->input('medical_condition');
          $record->medications_in_emergecies      = $request->input('medications_in_emergecies');
          $record->insurance_date      = $request->input('insurance_date');
          $record->contract_end_date      = $request->input('contract_end_date');
          $record->health_certificate_end_date      = $request->input('health_certificate_end_date');

            $record->national_id_end_date      = $request->input('national_id_end_date');


            $record->first_year_ordinary_vacation      = $request->input('first_year_ordinary_vacation')?$request->input('first_year_ordinary_vacation'):0;
                $record->first_year_emergency_vacation      = $request->input('first_year_emergency_vacation')?$request->input('first_year_emergency_vacation'):0;
                  $record->next_years_ordinary_vacation      = $request->input('next_years_ordinary_vacation')?$request->input('next_years_ordinary_vacation'):0;
                  $record->next_years_emergency_vacation      = $request->input('next_years_emergency_vacation')?$request->input('next_years_emergency_vacation'):0;


                      $record->hours_per_days      = $request->input('hours_per_days');
                        $record->start_hour      = $request->input('start_hour');
                          $record->end_hour      = $request->input('end_hour');
                            $record->extra_hour_price      = $request->input('extra_hour_price');
       // $record->current_vacations =   $request->input('current_vacations');
        $record->remaining_vacs =   $request->input('remaining_vacs');
        $record->vacation_renew_date =   $request->input('vacation_renew_date');
        $record->age = $record->calc_age($request->input('birth_date'));



    if ($request->has('isDelegated'))
    {
        $record->delegated      = 1;
        $record->functional_class      = $request->input('functional_class');
        $record->functional_class_date      = $request->input('functional_class_date');
        $record->functional_class_type      = $request->input('functional_class_type');
        $record->delegated_area      = $request->input('delegated_area');

    }


        if ($request->has('is_disabled'))
        {
            $record->is_disabled      = 1;
            $record->disabled_desc      = $request->input('disabled_desc');

        }




        //upload  id  file
        if ($request->has('attachment'))
//            $file = $request->file('attachment')->store('employee_attachments');
        $file = FileTrait::storeSingleFile($request->file('attachment'),'employee_attachments');

        //$this->storeSingleFile($request->file('attachment'),'employee_attachments');
        else
            $file = null;

        $record->attachment = $file;
        $record->save();

        //upload anther   files
        if ($request->has('ather_attachment')){
            $count = 0;
           // return count($request->ather_attachment);
            foreach ($request->file('ather_attachment') as $an_file){
             //   return dd('das');
                $new_file = new EmployeeAttachment();
                $new_file->employee_id = $record->id;
//              $new_file->attachment = $request->file('ather_attachment')[$count]->store('other_employee_attachments');
                $new_file->attachment = FileTrait::storeSingleFile($request->file('ather_attachment')[$count],'other_employee_attachments');
                //$this->storeSingleFile($an_file,'other_employee_attachments');
                $new_file->save();
                $count++;
            }

        }

        if ($request->has('isSystemUser')){
            $record->isSystemUser      = 1;
            $record->save();

            $org_admin = new OrganizationAdmin();
            $org_admin->name = $request->input('user_name');
            $org_admin->password = bcrypt($request->input('password')) ;
            $org_admin->role_id  = $request->input('role');
            $org_admin->employee_id  = $record->id;
            $org_admin->organization_id  = auth('organization_admin')->user()->organization_id;
            $org_admin->save();
        }
    }
}
