@if(count($records))
@foreach($records as $record)


<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>

    <td>{{$record->vendor?$record->vendor->name:"لا يوجد"}}</td>

   <td>

    <ul>

        @foreach ( $record->items as $item )
            <li>
                الاسم : {{ $item->item->name }} ,
                الكمية : {{ $item->ordered_quantity }} ,
                وحده القياس : {{ $item->item->unit_of_measurement->name }} ,
                السعر : {{ $item->item->final_cost }}

            </li>
        @endforeach

    </ul>

   </td>
    <td>{{ $record->total }}</td>

    <td>{{$record->created_at}}</td>

</tr>
@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
