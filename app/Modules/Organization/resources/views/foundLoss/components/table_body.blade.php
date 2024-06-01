@if(count($records))

@foreach($records as $record)

     <tr id="tableRecord-{{$record->id}}">
        <td>{{$record->missingInfo}}</td>
        <td>{{$record->customer}}</td>
         <td>{{$record->request_date}}</td>
         <td>{{$record->room?$record->room->room_num:"لا يوجد"}}</td>
      
         <td>{{$record->room?$record->room->ParentRoom->hotel->name:"لا يوجد"}}</td>


         <td>{{$record->createdBy?$record->createdBy->name:"لا يوجد"}}</td>
     
     
     </tr>

@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif