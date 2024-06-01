@if(count($records))

@foreach($records as $record)
    @foreach($record->Training->ClubSport->freelanceTrainings as $trainer)

     <tr id="tableRecord-{{$record->id}}">
         <td>{{$trainer->id?$trainer->id:"لا يوجد"}}</td>
         <td>{{$trainer->name?$trainer->name:"لا يوجد"}}</td>

     </tr>
    @endforeach

@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
