<?php

namespace Organization\Models;


use Carbon\Carbon;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;


class Employee extends Model
{
    use SoftDeletes ;
    //use HasTranslations;

//    public $translatable = ['name','description'];
    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function employee_type(){
        return $this->belongsTo(EmployeeType::class);
    }


    public function employee_job(){
        return $this->belongsTo(EmployeeJob::class);
    }

    public function org_admin(){
        return $this->hasOne(OrganizationAdmin::class);
    }

    public function attachments(){
        return $this->hasMany(EmployeeAttachment::class);
    }

    public function working_days(){
        return $this->hasMany(EmployeeWorkingDay::class);
    }

    public function notification(){

        $counter = 0;
        $today   = Carbon::now()->format('Y-m-d');
        $national_end_date = $this->national_id_end_date;


        $today_date   = \Carbon\Carbon::parse($today);
        $national_end = \Carbon\Carbon::parse($national_end_date);
        $health_end   = \Carbon\Carbon::parse($this->health_certificate_end_date);
        $contract_end = \Carbon\Carbon::parse($this->contract_end_date);

        //vacation counter
        $vacations = LeaveUnpaid::where('employee_id',$this->id)->get();

        foreach ($vacations as $vacation){
            $result_leave = $today_date->diffInDays(\Carbon\Carbon::parse($vacation->leave_return), false);  // leave_return - $today_date
            //return $result_leave;

            if ($result_leave == 1){
                $counter ++;
                break;
            }else{
                continue;
            }
        }
        // the rest of dates counter
        $result_national = $today_date->diffInDays($national_end, false);  // $national_end - $today_date
        $result_health   = $today_date->diffInDays($health_end, false);  // $health_end - $today_date
        $result_contract = $today_date->diffInDays($contract_end, false);  // $contract_end - $today_date

        if($result_national <= 30 && $national_end > $today_date && $result_national != 0){
            $counter ++;
        }
        if($result_health <= 30 && $health_end > $today_date && $result_health != 0){
            $counter ++;
        }
        if($result_contract <= 30 && $contract_end > $today_date && $result_contract != 0){
            $counter ++;
        }
        return $counter;

    }

    public function isHeadOfDept()
    {
        $dept = Department::where('id',$this->department_id)->first();
        if ($dept){

            if ($dept->employee_id == $this->id){
                return 1;
            }else{ return 0; }


        }else {
            return 0;
        }


    }

   public function number_unformat($number, $dec_point = '.', $thousands_sep = ',') {
    return (float)str_replace(array($thousands_sep, $dec_point),
                              array('', '.'),
                              $number);
}

    public function checkAttendanceDate($date)
    {
        $attendance = EmployeeAttendance::where('employee_id',$this->id)->where('date',$date)->first();
        if ($attendance){
            return $attendance;
        }else{ return 0; }

    }







public function checkAproovedHoursDate($date)
    {
        $attendance = EmployeeAttendance::where('employee_id',$this->id)->where('date',$date)->first();
        if ($attendance){

           if ($attendance->approveWorkingHours == 1 && $attendance->approveExtraHours == 1 ) {

             return 1;
           }

        }else{ return 0; }

    }



    public function checkIsVacation($date)
    {

$attendance = EmployeeAttendance::where('employee_id',$this->id)->where('date',$date)->first();
        if ($attendance){

                if ($attendance->vacation == 1) {
                    return 1 ;
                }else{

                    return 0;
                }

        }

    }


    public function checDesmissOverTime($date)
    {

$attendance = EmployeeAttendance::where('employee_id',$this->id)->where('date',$date)->first();
        if ($attendance){

                if ($attendance->dessmissExtraHours == 1) {
                    return 1 ;
                }else{

                    return 0;
                }

        }

    }

    public function workingHours($date)
    {
        $attendacne = $this->checkAttendanceDate($date);
        $hours = $this->number_unformat($attendacne->checkOut) - $this->number_unformat($attendacne->checkIn) ;
        return $hours ;
    }

    public function get_current_salary($working_days)
    {

        $amount_per_day = $this->gross_salary / 30 ;
        $current_salary = $working_days * $amount_per_day ;
        return $current_salary;

    }

    public function deduction_value($deduction_days)
    {
        $amount_per_day = $this->gross_salary / 30 ;
        $current_deduction = $deduction_days * $amount_per_day ;
        return $current_deduction;

    }

    public function bonus_value($bonus_days)
    {
        $amount_per_day = $this->gross_salary / 30 ;
        $current_bonus = $bonus_days * $amount_per_day ;
        return $current_bonus;

    }

    public function get_current_work_days($start_date = null)
    {
        $working_days = 0;
        if($start_date != null){
            foreach ($this->working_days as $working_day_record){
                if (date("m", strtotime($working_day_record->date)) == date("m",strtotime($start_date))){
                    $working_days = $working_day_record->working_days ;
                }else{continue;}
            }
        }else{
            foreach ($this->working_days as $working_day_record){
                if (date("m", strtotime($working_day_record->date)) == date("m",strtotime(date('Y-m-d')))){
                    $working_days = $working_day_record->working_days ;
                }else{continue;}
            }

        }



        return $working_days;
    }
    public function deduction_days($start_date = null)
    {
        $deduction_days = 0;
        $emp_deductions = EmployeeDeduction::where('employee_id',$this->id)
            ->where('status','OnSalary')
            ->get();
        if ($start_date != null){
            foreach ($emp_deductions as $emp_deduction){
                if (date("m", strtotime($emp_deduction->created_at)) == date("m",strtotime($start_date))){
                    $deduction_days += $emp_deduction->amount ;
                }else{continue;}
            }
        }else
        {
            foreach ($emp_deductions as $emp_deduction){
                if (date("m", strtotime($emp_deduction->created_at)) == date("m",strtotime(date('Y-m-d')))){
                    $deduction_days += $emp_deduction->amount ;
                }else{continue;}
            }
        }


        return $deduction_days;
    }

    public function bonus_days($start_date = null)
    {
        $bonus_days = 0;
        $emp_bonuses = EmployeeBonus::where('employee_id',$this->id)
            ->where('status','OnSalary')
            ->get();
        if ($start_date != null){
            foreach ($emp_bonuses as $emp_bonus){
                if (date("m", strtotime($emp_bonus->created_at)) == date("m",strtotime($start_date))){
                    $bonus_days+= $emp_bonus->amount ;
                }else{continue;}
            }
        }else{
            foreach ($emp_bonuses as $emp_bonus){
                if (date("m", strtotime($emp_bonus->created_at)) == date("m",strtotime(date('Y-m-d')))){
                    $bonus_days+= $emp_bonus->amount ;
                }else{continue;}
            }
        }


        return $bonus_days;
    }

    public function getOrders($start_date = null)
    {
        $order_aomunt = 0;
        $emp_orders = EmployeeOrder::where('employee_id',$this->id)
            ->get();
        if ($start_date != null){
            foreach ($emp_orders as $emp_order){
                if (date("m", strtotime($emp_order->created_at)) == date("m",strtotime($start_date))){
                    $order_aomunt+= $emp_order->order->total_amount ;
                }else{continue;}
            }
        }else{
            foreach ($emp_orders as $emp_order){
                if (date("m", strtotime($emp_order->created_at)) == date("m",strtotime(date('Y-m-d')))){
                    $order_aomunt+= $emp_order->order->total_amount ;
                }else{continue;}
            }
        }

        return $order_aomunt;
    }

    public function calc_damaa_tax($salary)
    {

        if ($salary >=51 && $salary <= 250){
            $salary = $salary * 0.006 ;
        }elseif ($salary >= 251 && $salary<=500){
            $salary = $salary * 0.0065 ;
        }elseif ($salary >= 510 && $salary<=100){
            $salary = $salary * 0.007 ;
        }elseif ($salary >= 1001 && $salary<=5000){
            $salary = $salary * 0.0075 ;
        }elseif ($salary>=5001 && $salary<=10000){
            $salary = $salary * 0.008 ;
        }elseif ($salary> 10000){
            $salary = $salary * 0.03 ;
        }else {
            $salary  = $salary ;
        }

        return $salary;
    }

    public function working_gain_for_nomations($salary)
    {
        $salary = $salary* 10/100 ;
        return $salary;
    }

    public function working_gain_for_officers($salary)
    {
        $salary = $salary* 10/100 ;
        return $salary;

    }

    public function working_gain_for_insured($salary)
    {
        $salaryX = $salary - ($salary * .11 +2500);

        if (1250 > $salaryX &&  $salaryX > 0){
            $salaryX = $salaryX * 2.5/100;
        }
        elseif (2500 > $salaryX && $salaryX > 1250 ){
            $salaryX = $salaryX * 10/100;
        }
        elseif (3750 > $salaryX && $salaryX >2500){

            $salaryX = $salaryX * 15/100;
        }elseif ($salaryX > 3750){

            $salaryX = $salaryX * 20/100;
        }

        return $salaryX;
    }

    public function working_gain_for_temp($salary)
    {
        $salaryX = $salary   -2500;
        if (1250 > $salaryX &&  $salaryX > 0){
            $salaryX = $salaryX * 2.5/100;
        }
        elseif (2500 > $salaryX && $salaryX > 1250 ){
            $salaryX = $salaryX * 10/100;
        }
        elseif (3750 > $salaryX && $salaryX >2500){

            $salaryX = $salaryX * 15/100;
        }elseif ($salaryX > 3750){

            $salaryX = $salaryX * 20/100;
        }

        return $salaryX;

    }

    public function monthly_salary($start_date = null )
    {

        if ($start_date != null ){

            $net_salary = $this->net_salary;
            $sumtion_of_bonuses = EmployeeBonus::where('employee_id',$this->id)->get();
            $valied_bonuses_ids = [];
            foreach ($sumtion_of_bonuses as $sumtion_of_bonus){
                if (date("m", strtotime($sumtion_of_bonus->created_at)) == date("m",strtotime($start_date))){
                    array_push($valied_bonuses_ids,$sumtion_of_bonus->id);
                }else{continue;}
            }

            $all_bonuses = EmployeeBonus::
            whereIn('id',$valied_bonuses_ids)->sum('amount');


            $sumtion_of_deductions = EmployeeDeduction::where('employee_id',$this->id)->get();

            $valied_deduction_ids = [];
            foreach ($sumtion_of_deductions as $sumtion_of_deduction){
                if (date("m", strtotime($sumtion_of_deduction->created_at)) == date("m",strtotime($start_date))){
                    array_push($valied_deduction_ids,$sumtion_of_deduction->id);
                }else{continue;}
            }

            $all_deductions = EmployeeDeduction::
            whereIn('id',$valied_deduction_ids)->sum('amount');


            $all_emp_finances = FinancialAdvanceRequest::
            where('employee_id',$this->id)->where('status','Approved')->get();
            $valied_FinancialAdvanceRequest_ids = [];
            foreach ($all_emp_finances as $all_emp_finance){
                if (date("m", strtotime($all_emp_finance->date)) == date("m",strtotime($start_date))){
                    array_push($valied_FinancialAdvanceRequest_ids,$all_emp_finance->id);
                }else{continue;}
            }

            $emp_finances = FinancialAdvanceRequest::
            whereIn('id',$valied_FinancialAdvanceRequest_ids)->sum('amount');

            $total_month_salary = ($net_salary +$all_bonuses) - ($all_deductions + $emp_finances);


        }else{

            $net_salary = $this->net_salary;
            $sumtion_of_bonuses = EmployeeBonus::where('employee_id',$this->id)->get();
            $valied_bonuses_ids = [];
            foreach ($sumtion_of_bonuses as $sumtion_of_bonus){
                if (date("m", strtotime($sumtion_of_bonus->created_at)) == date("m")){
                    array_push($valied_bonuses_ids,$sumtion_of_bonus->id);
                }else{continue;}
            }

            $all_bonuses = EmployeeBonus::
            whereIn('id',$valied_bonuses_ids)->sum('amount');


            $sumtion_of_deductions = EmployeeDeduction::where('employee_id',$this->id)->get();

            $valied_deduction_ids = [];
            foreach ($sumtion_of_deductions as $sumtion_of_deduction){
                if (date("m", strtotime($sumtion_of_deduction->created_at)) == date("m")){
                    array_push($valied_deduction_ids,$sumtion_of_deduction->id);
                }else{continue;}
            }

            $all_deductions = EmployeeDeduction::
            whereIn('id',$valied_deduction_ids)->sum('amount');

            $all_emp_finances = FinancialAdvanceRequest::
            where('employee_id',$this->id)->where('status','Approved')->get();


            $valied_FinancialAdvanceRequest_ids = [];
            foreach ($all_emp_finances as $all_emp_finance){
                if (date("m", strtotime($all_emp_finance->date)) == date("m")){
                    array_push($valied_FinancialAdvanceRequest_ids,$all_emp_finance->id);
                }else{continue;}
            }

            $emp_finances = FinancialAdvanceRequest::
            whereIn('id',$valied_FinancialAdvanceRequest_ids)->sum('amount');


            $total_month_salary = ($net_salary +$all_bonuses) - ($all_deductions + $emp_finances);


        }



        $all_bonus_days_depen_on_salary = EmployeeBonus::where('employee_id',$this->id)
            ->where('status','OnSalary')->sum('amount');

        $all_bonus_days_depen_on_bonus = EmployeeBonus::where('employee_id',$this->id)
            ->where('status','OnBonus')->sum('amount');



        $all_deduction_days_depen_on_salary = EmployeeDeduction::where('employee_id',$this->id)
            ->where('status','OnSalary')->sum('amount');

        $all_deduction_days_depen_on_bonus = EmployeeDeduction::where('employee_id',$this->id)
            ->where('status','OnBonus')->sum('amount');


        return [
            'net_salary'=>$net_salary,
            'all_bonuses'=>  $all_bonuses,
            'all_deductions'=>  $all_deductions,
            'emp_finances'=> $emp_finances,
            'total_month_salary'=> $total_month_salary,
            'all_bonus_days_depen_on_salary'=>$all_bonus_days_depen_on_salary,
            'all_bonus_days_depen_on_bonus'=>$all_bonus_days_depen_on_bonus,
            'all_deduction_days_depen_on_salary'=>$all_deduction_days_depen_on_salary,
            'all_deduction_days_depen_on_bonus'=>$all_deduction_days_depen_on_bonus
        ];
    }

    public function isHeadOfDepartment($id)
    {
        $dept = Department::where('id',$id)->first();
      //  return dd($dept,$id);
        if ($dept->employee_id == $this->id){
            return 1;
        }else{ return 0; }

    }


    public function hasHeadDept()
    {
        $dept = Department::where('employee_id',$this->id)->first();

        if ($dept){

            return $dept->id;
        }else{
            return 0;
        }

    }



    public function calc_age($date_of_birth)
    {
      return  Carbon::parse($date_of_birth)->age;

    }

}
