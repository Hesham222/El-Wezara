@if(count($records))
@foreach($records as $record)
@if($record->received == 1)
continue;

@endif
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    <td>{{$record->created_at}}</td>
    <td>{{$record->createdBy?$record->createdBy->name:"لا يوجد"}}</td>
    <td>{{$record->hotel?$record->hotel->name:"لا يوجد"}}</td>

   <td>

    <ul>

        @foreach ( $record->hotelOrderIngredients as $hotelOrderIngredient )
            <li>
                الاسم : {{ $hotelOrderIngredient->ingredient->name }} ,
                الكمية : {{ $hotelOrderIngredient->quantity }} ,
                وحده القياس : {{ $hotelOrderIngredient->ingredient->unit_of_measurement->name }} ,
                السعر : {{ $hotelOrderIngredient->ingredient->final_cost }}

            </li>
        @endforeach

    </ul>

   </td>
    <td>{{ $record->calc_total() }}</td>

</tr>
@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif