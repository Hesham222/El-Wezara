@if(count($records))

@foreach($records as $record)

     <tr id="tableRecord-{{$record->id}}">
         <td>{{$record->Room->room_num}}</td>
         <td>{{$record->Customer?$record->Customer->name:"لا يوجد"}}</td>
         <td>{{$record->checkIn?"IN":" EXP"}}</td>
         <td>{{$record->arrival_date}}</td>
         <td>{{$record->departure_date}}</td>

         <td>{{$record->num_of_children}}</td>
         <td>{{$record->num_of_extra_beds}}</td>
         <td>{{$record->RoomType?$record->RoomType->name:"لا يوجد"}}</td>
         <td>{{$record->supplier?$record->supplier->name:"لا يوجد" }}</td>
         <td>BB</td>
     </tr>

@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif