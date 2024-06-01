@if(count($records))
@foreach($records as $record)

@foreach($record->items as $item)
<tr id="tableRecord-{{$record->id}}">

    <td>{{$item->purchase_order_id}}</td>
    <td>{{$record->created_at}}</td>
   
    <td>{{$record->vendor->name }}</td>
    <td>{{$item->item->name }}</td>
    <td>{{$item->received_quantity }}</td>
    <td>{{$item->item->unit_of_measurement->name }}</td>
    <td>{{$item->item->final_cost?$item->item->final_cost:$item->item->cost }}</td>
    <td>{{ $item->item->final_cost? $item->item->final_cost* $item->received_quantity:$item->item->cost* $item->received_quantity }}</td>



   

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