@if(count($records))

@foreach($records as $record)

     <tr id="tableRecord-{{$record->id}}">
        <td>{{$record->room->room_num}}</td>
        <td>{{$record->notes}}</td>
         <td>{{$record->created_at}}</td>
         <td>{{$record->employee?$record->employee->name:"لا يوجد"}}</td>
    
     
     
     </tr>

@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif