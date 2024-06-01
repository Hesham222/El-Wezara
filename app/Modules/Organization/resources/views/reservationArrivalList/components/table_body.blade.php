@if(count($records))

@foreach($records as $record)

     <tr id="tableRecord-{{$record->id}}">
        <td>{{$record->Customer?$record->Customer->id:"لا يوجد"}}</td>
         <td>{{$record->Customer?$record->Customer->name:"لا يوجد"}}</td>
         <td>{{$record->arrival_date}}</td>
         <td>{{$record->departure_date}}</td>

         <td>1</td>
         <td>{{$record->id}}</td>
         <td>{{$record->Customer?$record->Customer->phone:"لا يوجد"}}</td>
     
     
     </tr>

@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif