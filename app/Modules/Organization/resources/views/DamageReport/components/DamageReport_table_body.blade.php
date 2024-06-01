@if(count($records))
@foreach($records as $record)
            <tr id="tableRecord-{{$record->id}}">
                <td>{{$record->id}}</td>
                <td>{{$record->ingredient?$record->ingredient->name:"لا يوجد"}}</td>
                <td>{{$record->ingredient->unit_of_measurement?$record->ingredient->unit_of_measurement->name:"لا يوجد"}}</td>
                <td>{{$record->quantity?$record->quantity:"لا يوجد"}}</td>
                <td>{{$record->ingredient?$record->ingredient->final_cost:"لا يوجد"}}</td>
                <td>{{$record->quantity * $record->ingredient->final_cost}}</td>

                <td>{{date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))}}</td>
            </tr>
@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
