@if(count($records))
@foreach($records as $record)
    @if(count($record->ingredient_quantities) > 0)
        @foreach($record->ingredient_quantities as $ingredient_quantity)
            <tr id="tableRecord-{{$ingredient_quantity->id}}">
                <td>{{$ingredient_quantity->id}}</td>
                <td>{{$ingredient_quantity->ingredient?$ingredient_quantity->ingredient->name:"لا يوجد"}}</td>
                <td>{{$ingredient_quantity->quantity?$ingredient_quantity->quantity:"لا يوجد"}}</td>
                <td>{{$ingredient_quantity->ingredient->unit_of_measurement?$ingredient_quantity->ingredient->unit_of_measurement->name:"لا يوجد"}}</td>
                <td>{{$ingredient_quantity->quantity * $ingredient_quantity->ingredient->final_cost}}</td>
                <td>{{$ingredient_quantity->expiration_date?$ingredient_quantity->expiration_date:"لا يوجد"}}</td>

                <td>{{date('d M Y', strtotime($ingredient_quantity->created_at)) ." - ". date('h:i a', strtotime($ingredient_quantity->created_at))}}</td>
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
