@if(count($records))

@foreach($records as $record)

     <tr id="tableRecord-{{$record->id}}">
         <td>{{$record->Training->ActivityArea?$record->Training->ActivityArea->name:"لا يوجد"}}</td>
         <td>{{$record->Training?$record->Training->name:"لا يوجد"}}</td>
         <td>{{$record->start_time?$record->start_time:"لا يوجد"}}</td>
         <td>{{$record->end_time?$record->end_time:"لا يوجد"}}</td>
     </tr>

@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
