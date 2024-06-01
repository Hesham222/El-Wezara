@if(count($records))
@foreach($records as $record)
            <tr id="tableRecord-{{$record->id}}">
                <td>{{$record->id}}</td>
                <td>{{$record->name?$record->name:"لا يوجد"}}</td>
                <td>{{$record->quantity?$record->quantity:"لا يوجد"}}</td>
                <td>{{$record->unit_of_measurement?$record->unit_of_measurement->name:"لا يوجد"}}</td>
                <td>{{$record->final_cost?$record->final_cost:"لا يوجد"}}</td>
                <td>{{$record->final_cost * $record->stock}}</td>
                <td>{{$record->re_order_quantity?$record->re_order_quantity:"لا يوجد"}}</td>
                <td>{{$record->stock?$record->stock:"لا يوجد"}}</td>
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
