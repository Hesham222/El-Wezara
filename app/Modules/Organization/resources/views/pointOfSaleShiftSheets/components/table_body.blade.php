@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    <td>{{$record->shift_date?$record->shift_date:"لا يوجد"}}</td>
    <td>{{$record->orgnization_admin?$record->orgnization_admin->name:"لا يوجد"}}</td>
    <td>{{$record->point_of_sale?$record->point_of_sale->name:"لا يوجد"}}</td>
    <td>{{$record->shift_start?$record->shift_start:"لا يوجد"}}</td>
    <td>{{$record->start_balance?$record->start_balance:"لا يوجد"}}</td>
    <td>{{$record->shift_end?$record->shift_end:"لا يوجد"}}</td>
    <td>{{$record->end_balance?$record->end_balance:"لا يوجد"}}</td>
    <td>{{$record->no_of_orders?$record->no_of_orders:"لا يوجد"}}</td>
    <td>{{$record->ordersAmount?$record->ordersAmount:"لا يوجد"}}</td>
    <td>{{$record->ordersAmount + $record->start_balance}}</td>
    <td @if(($record->end_balance - ($record->ordersAmount + $record->start_balance)) < 0)
            style="color: red"
            @endif
    >{{ $record->end_balance - ($record->ordersAmount + $record->start_balance) }}</td>

    <td>@if($record->received == 0) لم يتم تسليمه بعد @else تم التسليم @endif</td>

</tr>
@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
