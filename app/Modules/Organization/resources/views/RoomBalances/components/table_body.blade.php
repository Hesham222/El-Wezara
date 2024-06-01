@if(count($records))
@foreach($records as $record)
            <tr id="tableRecord-{{$record->id}}">
                <td>{{$record->room?$record->room->room_num:"لا يوجد"}}</td>
                <td>{{$record->Customer?$record->Customer->name:"لا يوجد"}}</td>
                <td>{{$record->arrival_date?$record->arrival_date:"لا يوجد"}}</td>
                <td>{{$record->departure_date?$record->departure_date:"لا يوجد"}}</td>
                <td>{{$record->paidAmount?$record->paidAmount:"0"}}</td>
                <td>{{$record->final_price?$record->final_price:"0"}}</td>
            </tr>
@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
