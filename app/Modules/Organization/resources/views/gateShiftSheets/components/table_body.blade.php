@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    <td>{{$record->shift_date?$record->shift_date:"لا يوجد"}}</td>
    <td>{{$record->gateAdmin?$record->gateAdmin->name:"لا يوجد"}}</td>
    <td>{{$record->gate?$record->gate->name:"لا يوجد"}}</td>
    <td>{{$record->shift_start?$record->shift_start:"لا يوجد"}}</td>
    <td>{{$record->start_balance?$record->start_balance:"لا يوجد"}}</td>
    <td>{{$record->shift_end?$record->shift_end:"لا يوجد"}}</td>
    <td>{{$record->end_balance?$record->end_balance:"لا يوجد"}}</td>
    <td>{{$record->no_of_tickets?$record->no_of_tickets:"لا يوجد"}}</td>
    <td>{{$record->ticketsAmount?$record->ticketsAmount:"لا يوجد"}}</td>
    <td>{{$record->ticketsAmount + $record->start_balance}}</td>
    <td @if(($record->end_balance - ($record->ticketsAmount + $record->start_balance)) < 0)
            style="color: red"
        @endif
    >{{ $record->end_balance - ($record->ticketsAmount + $record->start_balance) }}</td>

</tr>
@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
