@if(count($records))
@foreach($records as $record)


    @if(isset($type) && $type == "nominationSalaries")
        <tr id="tableRecord-{{$record->id}}">
            <td>{{$record->id}}</td>
            <td>{{$record->name}}</td>
            <td>{{$record->employee_job?$record->employee_job->name:'--'}}</td>
            <td>{{$record->get_current_work_days(request()->start_date)}}</td>
            <td>{{$record->gross_salary}}</td>
            <td>{{$record->get_current_salary($record->get_current_work_days(request()->start_date))}}</td>
            <td>{{$record->deduction_days(request()->start_date)}}</td>
            <td>{{$record->bonus_days(request()->start_date)}}</td>
            <td>{{$record->deduction_value($record->deduction_days(request()->start_date))}}</td>
            <td>{{$record->bonus_value($record->bonus_days(request()->start_date))}}</td>

            <td>{{$record->calc_damaa_tax($record->get_current_salary($record->get_current_work_days(request()->start_date)))}}</td>
            <td>{{$record->working_gain_for_nomations($record->get_current_salary($record->get_current_work_days(request()->start_date)))}}</td>

            <td>0</td>
            <td>@if(!$record->get_current_work_days(request()->start_date) == 0) {{ $total =  $record->get_current_salary($record->get_current_work_days(request()->start_date)) - ( $record->calc_damaa_tax($record->get_current_salary($record->get_current_work_days(request()->start_date))) +  $record->working_gain_for_nomations($record->get_current_salary($record->get_current_work_days(request()->start_date))) )}} @else 0 @endif</td>
            <td>{{$record->getOrders(request()->start_date)}}</td>
            <td>@if(!$record->get_current_work_days(request()->start_date) == 0) {{ $total - $record->deduction_value($record->deduction_days(request()->start_date)) + $record->bonus_value($record->bonus_days(request()->start_date)) - $record->getOrders(request()->start_date) }} @else 0 @endif</td>
        </tr>

    @elseif(isset($type) && $type == "TheInsuredSalaries")
        <tr id="tableRecord-{{$record->id}}">
            <td>{{$record->id}}</td>
            <td>{{$record->name}}</td>
            <td>{{$record->employee_job?$record->employee_job->name:'--'}}</td>
            <td>{{$record->get_current_work_days(request()->start_date)}}</td>
            <td>{{$record->gross_salary}}</td>
            <td>{{$record->get_current_salary($record->get_current_work_days(request()->start_date))}}</td>
            <td>{{$bild = $record->gross_salary * 18.75/100 }} منشأة :
                <br>
                {{$worker = $record->gross_salary * 11/100}}عامل :

            </td>
            <td> {{$totalTaameen = $bild + $worker}}</td>

            <td>{{$damaa = $record->calc_damaa_tax($record->get_current_salary($record->get_current_work_days(request()->start_date)))}}</td>
            <td>{{$working_gain = $record->working_gain_for_insured($record->get_current_salary($record->get_current_work_days(request()->start_date)))}}</td>
            <td>{{$total_tax = $damaa + $working_gain }}</td>
            <td>{{$totalTammenAndTax = $totalTaameen + $total_tax }}</td>
            <td>{{$record->deduction_days(request()->start_date)}}</td>
            <td>{{$record->bonus_days(request()->start_date)}}</td>
            <td>{{$d_value = $record->deduction_value($record->deduction_days(request()->start_date))}}</td>
            <td>{{$b_value =$record->bonus_value($record->bonus_days(request()->start_date))}}</td>



            <td>0</td>
            <td>@if(!$record->get_current_work_days(request()->start_date) == 0) {{ $total =  $record->get_current_salary($record->get_current_work_days(request()->start_date)) - $totalTammenAndTax - $d_value + $b_value  }} @else 0 @endif</td>
            <td>{{$record->getOrders(request()->start_date)}}</td>
            <td>@if(!$record->get_current_work_days(request()->start_date) == 0) {{ $total  - $record->getOrders(request()->start_date) }}@else 0 @endif</td>
        </tr>


    @elseif(isset($type) && $type == "temporarySalaries")
        <tr id="tableRecord-{{$record->id}}">
            <td>{{$record->id}}</td>
            <td>{{$record->name}}</td>
            <td>{{$record->employee_job?$record->employee_job->name:'--'}}</td>
            <td>{{$record->get_current_work_days(request()->start_date)}}</td>
            <td>{{$record->gross_salary}}</td>
            <td>{{$record->get_current_salary($record->get_current_work_days(request()->start_date))}}</td>
            <td>{{$record->deduction_days(request()->start_date)}}</td>
            <td>{{$record->bonus_days(request()->start_date)}}</td>
            <td>{{$d_value = $record->deduction_value($record->deduction_days(request()->start_date))}}</td>
            <td>{{$b_value =$record->bonus_value($record->bonus_days(request()->start_date))}}</td>

            <td>{{$damaa = $record->calc_damaa_tax($record->get_current_salary($record->get_current_work_days(request()->start_date)))}}</td>
            <td>{{$working_gain = $record->working_gain_for_temp($record->get_current_salary($record->get_current_work_days(request()->start_date)))}}</td>

            <td>0</td>
            <td>@if(!$record->get_current_work_days(request()->start_date) == 0) {{ $total =  $record->get_current_salary($record->get_current_work_days(request()->start_date)) - $damaa - $working_gain }}@else 0 @endif</td>
            <td>{{$record->getOrders(request()->start_date)}}</td>
            <td>@if(!$record->get_current_work_days(request()->start_date) == 0) {{ $total - $d_value + $b_value - $record->getOrders(request()->start_date) }}@else 0 @endif</td>
        </tr>

    @elseif(isset($type) && $type == "officerSalaries")
        <tr id="tableRecord-{{$record->id}}">
            <td>{{$record->id}}</td>
            <td>{{$record->name}}</td>
            <td>{{$record->employee_job?$record->employee_job->name:'--'}}</td>
            <td>{{$record->get_current_work_days(request()->start_date)}}</td>
            <td>{{$record->gross_salary}}</td>
            <td>{{$record->get_current_salary($record->get_current_work_days(request()->start_date))}}</td>

            <td>{{$damaa = $record->calc_damaa_tax($record->get_current_salary($record->get_current_work_days(request()->start_date)))}}</td>
            <td>{{$working_gain = $record->working_gain_for_officers($record->get_current_salary($record->get_current_work_days(request()->start_date)))}}</td>

            <td>0</td>
            <td>@if(!$record->get_current_work_days(request()->start_date) == 0) {{ $total =  $record->get_current_salary($record->get_current_work_days(request()->start_date)) - $damaa - $working_gain }}@else 0 @endif</td>
            <td>{{$record->getOrders(request()->start_date)}}</td>
            <td>@if(!$record->get_current_work_days(request()->start_date) == 0) {{ $total - $record->getOrders(request()->start_date) }}@else 0 @endif</td>
        </tr>

    @else

    <tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    @if(request()->query('view')=='trash')
    <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
    <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
    @endif
    <td>{{$record->name}} </td>
    <td>{{$record->employee_job?$record->employee_job->name:'--'}}</td>
    <td>{{$record->department?$record->department->name:'--'}}</td>
    <td>{{$record->employee_type?$record->employee_type->name:'--'}}</td>
    <td>{{$record->phone}}</td>
    <td>{{$record->date_of_hiring}}</td>
    <td>{{$record->birth_date}}</td>
    <td>{{$record->insurance_number}}</td>

    <td>
        @if($record->social_status == 'Single')
            اعزب
        @elseif($record->social_status == 'Engaged')
            مخطوب
        @elseif($record->social_status == 'Married')
            متزوج
        @elseif($record->social_status == 'Divorced')
            مطلق
        @endif


    </td>
    <td>

        @if($record->military_status == 'Postponed')
            مؤجل
        @elseif($record->military_status == 'Exempted')
            معافى
        @elseif($record->military_status == 'Done')
            اتم الخدمة
        @endif


    </td>
{{--    <td>{{$record->net_salary}}</td>--}}
    <td>{{$record->gross_salary}}</td>
    <td>{{$record->leave_unpaid_status == 1 ? "نعم" :"لا"}}</td>

    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td>
        @if(!str_contains(url()->current(), '/financial/employees'))
    @if(request()->query('view')=='trash')
        @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete'))
                <a
                    class="btn btn-sm btn-primary"
                    title="استرجاع"
                    data-toggle="modal"
                    data-target="#confirm-password-modal"
                    onclick="injectModalData('{{$record->id}}', '{{route('organizations.employee.restore')}}', 'confirm-password-form', 'POST')"
                >
                    <i class="fa fa-undo" style="color: #fff"></i>
                </a>
        @endif
        @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete'))
                <a
                    class="btn btn-sm btn-danger"
                    title="حذف نهائي"
                    data-toggle="modal"
                    data-target="#confirm-password-modal"
                    onclick="injectModalData('{{$record->id}}', '{{route('organizations.employee.destroy', $record->id)}}', 'confirm-password-form', 'DELETE')"
                >
                    <i class="fa fa-trash" style="color: #fff"></i>
                </a>
        @endif

    @else
        @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit'))
        @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Employee-Edit'))
                <a
                    href="{{route('organizations.employee.edit',$record->id)}}"
                    title="تعديل"
                    class="btn btn-sm btn-primary">
                    <i class="fa fa-edit" style="color: #fff"></i>
                </a>
        @endif


{{-- <a
                    href="{{route('organizations.employeeAttendance.show',$record->id)}}"
                    title="الحضور"
                    class="btn btn-sm btn-primary">
                    <i class="fa fa-bill" style="color: #fff"></i>
                </a> --}}

                  @if($record->approved == 0)
                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Employee-Approve'))

                <a
                    href="{{route('organizations.employee.approve',$record->id)}}"
                    title="الموافقة"
                    class="btn btn-sm btn-primary">
                    <i class="fa fa-plus" style="color: #fff"></i>
                </a>
                @endif
                    @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Employee-Refuse'))
                    <a
                    href="{{route('organizations.employee.refuse',$record->id)}}"
                    title="الرفض"
                    class="btn btn-sm btn-primary">
                    <i class="fa fa-trash" style="color: #fff"></i>
                </a>
                    @endif


@endif
            @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Employee-View-Data'))
                @if($record->leave_unpaid_status == 1)

                <a
                    href="{{route('organizations.employee.return',$record->id)}}"
                    title="تم العوده من الاجازه"
                    class="btn btn-sm btn-accent">
                    <i class="fa fa-check" style="color: #fff"></i>
                </a>
                @else
                    <a
                        href="{{route('organizations.employee.unpaid',$record->id)}}"
                        title="اضف اجازه بدون مرتب"
                        class="btn btn-sm btn-focus">
                        <i class="fa fa-plus" style="color: #fff"></i>
                    </a>
            @endif
            @endif

            <a class="fas fa-bell"
               style="width: 30px"
               href="{{route('organizations.employee.view.notification',$record->id)}}"
               data-id ="{{$record->id}}"
               title="الاشعارات">
                {{$record->notification()}}
            </a>
            @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Employee-View-Data'))

            <a target="_blank" class="btn btn-primary" href="{{route('organizations.employee.show.data',$record->id)}}">اذهب لبايانات الموظف</a>
            @endif
        @endif
            @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password'))

            @endif
            @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete'))
                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Employee-Delete'))
                @if($record->id !==1 && $record->id != auth('organization_admin')->user()->id)
                    <a
                        class="btn btn-sm btn-danger"
                        title="حذف"
                        data-toggle="modal"
                        data-target="#confirm-password-modal"
                        onclick="injectModalData('{{$record->id}}', '{{route('organizations.employee.trash')}}', 'confirm-password-form', 'POST')" >
                        <i class="fa fa-trash" style="color: #fff"></i>
                    </a>
                @endif
            @endif
            @endif

    @endif

        @else
            @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Employee-Add-Salary'))

            <a target="_blank" class="btn btn-primary" href="{{route('organizations.employee.add.salary',$record->id)}}"> اضافة مرتب الموظف </a>
            @endif
                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Employee-Add-Working-Days'))
                <a target="_blank" class="btn btn-primary" href="{{route('organizations.employee.add.working.days',$record->id)}}"> اضافة ايام عمل للموظف </a>
                @endif

        @endif

        @if( $record->vacation_balance ==0)

                <a
                    href="{{route('organizations.employee.last.vacations',$record->id)}}"
                    title="اضف المتبقى من الرصيد السابق للاجازات   "
                    class="btn btn-sm btn-focus">
                    <i class="fa fa-plus" style="color: #fff"></i>
                </a>

            @endif


    </td>
</tr>
    @endif

@endforeach


@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
