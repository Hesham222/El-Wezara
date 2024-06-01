@if(count($records))
@foreach($records as $record)
            <tr id="tableRecord-{{$record->id}}">
                <td>{{$record->Room?$record->Room->room_num:"لا يوجد"}}</td>
                <td>{{$record->Customer?$record->Customer->name:"لا يوجد"}}</td>
                <td>{{$record->checkIn == 1? "IN":"EXP"}}</td>
                <td>{{$record->arrival_date?$record->arrival_date:"لا يوجد"}}</td>
                <td>{{$record->departure_date?$record->departure_date:"لا يوجد"}}</td>
                <td>{{$record->num_of_nights?$record->num_of_nights - $record->num_of_children:"0"}}</td>
                <td>{{$record->num_of_children?$record->num_of_children:"0"}}</td>
                <td>{{$record->RoomType?$record->RoomType->name:"لا يوجد"}}</td>
                <td>{{$record->supplier?$record->supplier->name:"لا يوجد"}}</td>
                <td>{{$record->final_price?$record->final_price:"0"}}</td>
                <td>{{$record->paidAmount?$record->paidAmount:"0"}}</td>
            </tr>
@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
