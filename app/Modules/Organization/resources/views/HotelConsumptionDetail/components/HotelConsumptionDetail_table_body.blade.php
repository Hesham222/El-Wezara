@if(count($records))
@foreach($records as $record)
            <tr id="tableRecord-{{$record->id}}">
                <td>{{$record->id}}</td>
                <td>{{$record->ingredient?$record->ingredient->name:"لا يوجد"}}</td>
                <td>{{$record->quantity_before?$record->quantity_before:"لا يوجد"}}</td>
                <td>{{$record->quantity_after?$record->quantity_after:"لا يوجد"}}</td>
                <td>{{$record->quantity_before * $record->ingredient->final_cost}}</td>
                <td>{{$record->quantity_after * $record->ingredient->final_cost}}</td>
                <td>{{($record->quantity_before * $record->ingredient->final_cost) - ($record->quantity_after * $record->ingredient->final_cost)}}</td>
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
