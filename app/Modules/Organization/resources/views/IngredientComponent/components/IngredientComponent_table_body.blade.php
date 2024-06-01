@if(count($records))
@foreach($records as $record)
    @if(count($record->manufactured) > 0)
        <h2>{{$record->name}}</h2>
        @foreach($record->manufactured as $manufacture)
            <tr id="tableRecord-{{$manufacture->id}}">
                    <td>{{$manufacture->id}}</td>
                    <td>{{$manufacture->name?$manufacture->name:"لا يوجد"}}</td>
                    <td>{{$manufacture->unit_of_measurement?$manufacture->unit_of_measurement->name:"لا يوجد"}}</td>
                    <td>{{$manufacture->quantity?$manufacture->quantity:"لا يوجد"}}</td>
                    <td>{{$manufacture->final_cost?$manufacture->final_cost:"لا يوجد"}}</td>
                    <td>{{$manufacture->final_cost * $manufacture->quantity}}</td>
                    <td>{{date('d M Y', strtotime($manufacture->created_at)) ." - ". date('h:i a', strtotime($manufacture->created_at))}}</td>

            </tr>
        @endforeach
    @endif
@endforeach

@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
