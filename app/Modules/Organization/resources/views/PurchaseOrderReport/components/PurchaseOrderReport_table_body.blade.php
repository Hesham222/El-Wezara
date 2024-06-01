@if(count($records))
@foreach($records as $record)
        @foreach($record->items as $item)
            <tr id="tableRecord-{{$item->id}}">
                <td>{{$item->id}}</td>
                <td>{{$item->item->name?$item->item->name:"لا يوجد"}}</td>
                <td>{{$item->item->unit_of_measurement?$item->item->unit_of_measurement->name:"لا يوجد"}}</td>
                <td>{{$item->received_quantity?$item->received_quantity:"لا يوجد"}}</td>
                <td>{{$item->item->last_selling_price?$item->item->last_selling_price:"لا يوجد"}}</td>
                <td>{{$item->final_cost?$item->final_cost:"لا يوجد"}}</td>
                <td>{{$item->total?$item->total:"لا يوجد"}}</td>

                <td>{{date('d M Y', strtotime($item->created_at)) ." - ". date('h:i a', strtotime($item->created_at))}}</td>
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
