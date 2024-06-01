<?php

namespace Organization\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        if ($this->request->has('isSystemUser')){
            return [
                'name' => 'required|string|min:4|max:191',
                'email' => 'nullable|email|regex:/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/|unique:organization_admins|max:191',
                'department' => 'required|exists:departments,id',
                'employeeType' => 'required|exists:employee_types,id',
                'employeeJob' => 'required|exists:employee_jobs,id',
                'vacation_balance' => 'required|numeric',
                'phone' => 'required|string|regex:/^\+?\d+$/|unique:employees|min:10|max:15',
                'date_of_hiring' => 'required|date',
                'birth_date' => 'required|date',
                'insurance_number' => 'required|numeric',
                'military_status' => 'required|string',
                'social_status' => 'required|string',
                'address' => 'required|string',
               // 'gross_salary' => 'required|numeric',
               // 'taxes_type' => 'required|string',
               // 'taxes_value' => 'required|numeric',
               // 'insurance_type' => 'required|string',
               // 'insurance_value' => 'required|numeric',
                'attachment'=>'nullable',
                'ather_attachment.*'=>'nullable',
                'status' => 'required|string',

                'user_name'=>'required_with_all:isSystemUser|string',
                'password' => 'required_with_all:isSystemUser|alpha_num|max:191|min:6',
                'role' => 'required_with_all:isSystemUser|exists:roles,id',


                'functional_class' => 'nullable|string',
                'functional_class_type' => 'nullable|string',
                'delegated_area' => 'nullable|string',
                'functional_class_date' => 'nullable|date',


                'sending_address' => 'nullable|string',
                'secondPhone' => 'nullable|numeric',

  'medical_condition' => 'nullable|string',
    'medications_in_emergecies' => 'nullable|string',

    'insurance_date' => 'nullable|date',
      'contract_end_date' => 'nullable|date',
      'health_certificate_end_date' => 'nullable|date',
        'national_id_end_date' => 'nullable|date',


//          'first_year_ordinary_vacation' => 'nullable|numeric',
//            'first_year_emergency_vacation' => 'nullable|numeric',
//
//            'next_years_ordinary_vacation' => 'nullable|numeric',
//              'next_years_emergency_vacation' => 'nullable|numeric',

                'hours_per_days' => 'nullable|numeric',
                  'start_hour' => 'nullable|numeric',

                    'end_hour' => 'nullable|numeric',
                      'extra_hour_price' => 'nullable|numeric',

            ];
        }else{

            return [
                'name' => 'required|string|regex:/^[\pL\s\-]+$/u|min:4|max:191',
                'email' => 'nullable|email|regex:/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/|unique:organization_admins|max:191',
                'department' => 'required|exists:departments,id',
                'employeeType' => 'required|exists:employee_types,id',
                'employeeJob' => 'required|exists:employee_jobs,id',
                'vacation_balance' => 'required|numeric',
                'phone' => 'required|string|regex:/^\+?\d+$/|unique:employees|min:10|max:15',
                'date_of_hiring' => 'required|date',
                'birth_date' => 'required|date',
                'insurance_number' => 'required|numeric',
                'military_status' => 'required|string',
                'social_status' => 'required|string',
                'address' => 'required|string',
              //  'gross_salary' => 'required|numeric',
                //'taxes_type' => 'required|string',
             //   'taxes_value' => 'required|numeric',
               // 'insurance_type' => 'required|string',
               // 'insurance_value' => 'required|numeric',
                'attachment'=>'nullable',
                'ather_attachment.*'=>'nullable',

                'sending_address' => 'nullable|string',
                'secondPhone' => 'nullable|numeric',



                'functional_class' => 'nullable|string',
                'functional_class_type' => 'nullable|string',
                'delegated_area' => 'nullable|string',
                'functional_class_date' => 'nullable|date',


  'medical_condition' => 'nullable|string',
    'medications_in_emergecies' => 'nullable|string',

    'insurance_date' => 'nullable|date',
      'contract_end_date' => 'nullable|date',
      'health_certificate_end_date' => 'nullable|date',
        'national_id_end_date' => 'nullable|date',


//          'first_year_ordinary_vacation' => 'nullable|numeric',
//            'first_year_emergency_vacation' => 'nullable|numeric',
//
//            'next_years_ordinary_vacation' => 'nullable|numeric',
//              'next_years_emergency_vacation' => 'nullable|numeric',

                'hours_per_days' => 'nullable|numeric',
                  'start_hour' => 'nullable|numeric',

                    'end_hour' => 'nullable|numeric',
                      'extra_hour_price' => 'nullable|numeric',

            ];
        }

    }
}
