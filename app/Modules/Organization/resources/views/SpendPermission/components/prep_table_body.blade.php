@if(count($records))
@foreach($records as $record)

<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    <td>{{$record->created_at}}</td>
    <td>{{$record->createdBy?$record->createdBy->name:"لا يوجد"}}</td>
    <td>{{$record->area?$record->area->name:"لا يوجد"}}</td>

   <td>

    <ul>

        @foreach ( $record->AreaOrderIngredients as $AreaOrderIngredient )
            <li>
                الاسم : {{ $AreaOrderIngredient->ingredient->name }} ,
                الكمية : {{ $AreaOrderIngredient->quantity }} ,
                وحده القياس : {{ $AreaOrderIngredient->ingredient->unit_of_measurement->name }} ,
                السعر : {{ $AreaOrderIngredient->ingredient->final_cost }}

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
