@if(count($records))
@foreach($records as $record)
    @if(count($record->ingredients) > 0)
        <h2>{{$record->name}}</h2>
        @foreach($record->ingredients as $ingredient)
            <tr id="tableRecord-{{$ingredient->id}}">
                <td>{{$ingredient->id}}</td>
                <td>{{$ingredient->name?$ingredient->name:"لا يوجد"}}</td>
                <td>{{$ingredient->unit_of_measurement?$ingredient->unit_of_measurement->name:"لا يوجد"}}</td>
                <td>{{$ingredient->IngredientSumQuantity()}}</td>
                <td>{{$ingredient->final_cost}}</td>
                <td>{{ $ingredient->IngredientOrderTotal() }}</td>
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
