@if(count($records))
    @foreach($records as $record)
        <tr id="tableRecord-{{$record->id}}">
                <td>{{$record->name}}</td>
                <td>{{$record->id}}</td>
                <td>{{$record->employee_job->name}}</td>
                <td>{{$record->department->name}}</td>
                <td>{{$record->employee_type->name}}</td>
                <td>{{$record->phone}}</td>
                <td>{{$record->date_of_hiring}}</td>
{{--                <td>{{$record->gross_salary}}</td>--}}
{{--                <td>{{$record->taxes_type}}</td>--}}
{{--                <td>{{$record->taxes_value}}</td>--}}
{{--                <td>{{$record->insurance_type}}</td>--}}
{{--                <td>{{$record->insurance_value}}</td>--}}
                <td>{{$record->net_salary}}</td>
                @if(request()->has('start_date'))
                    <td>{{$record->monthly_salary(request()->start_date)['all_bonus_days_depen_on_salary']}}</td>
                <td>{{$record->monthly_salary(request()->start_date)['all_bonus_days_depen_on_bonus']}}</td>
                    <td>{{$record->monthly_salary(request()->start_date)['all_deduction_days_depen_on_salary']}}</td>
                <td>{{$record->monthly_salary(request()->start_date)['all_deduction_days_depen_on_bonus']}}</td>
                    <td>{{$record->monthly_salary(request()->start_date)['emp_finances']}}</td>
                    <td>{{$record->monthly_salary(request()->start_date)['total_month_salary']}}</td>
                @else
                <td>{{$record->monthly_salary(request()->start_date)['all_bonus_days_depen_on_salary']}}</td>
                <td>{{$record->monthly_salary(request()->start_date)['all_bonus_days_depen_on_bonus']}}</td>
                <td>{{$record->monthly_salary(request()->start_date)['all_deduction_days_depen_on_salary']}}</td>
                <td>{{$record->monthly_salary(request()->start_date)['all_deduction_days_depen_on_bonus']}}</td>
                    <td>{{$record->monthly_salary()['emp_finances']}}</td>
                    <td>{{$record->monthly_salary()['total_month_salary']}}</td>
                @endif


        </tr>
    @endforeach
@else
    <tr>
        <td colspan="8" style="text-align:center;">
            There are no records match your inputs.
        </td>
    </tr>
@endif
