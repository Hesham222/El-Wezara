@if(count($records))
@foreach($records as $record)
<h2>{{ $record->name }}</h2>
@foreach($record->childs as $child)

@foreach($child->ingredients as $ingredient)
<tr id="tableRecord-{{$ingredient->id}}">

    <td>{{$ingredient->name}}</td>
    <td>{{$ingredient->outgoing() * $ingredient->quantity }} {{ $ingredient->unit_of_measurement->name }}</td>
   
    <td>{{ $ingredient->quantity }} {{ $ingredient->unit_of_measurement->name }}</td>
    <td>{{$ingredient->quantity * $ingredient->final_cost }}</td>


</tr>
@endforeach
@endforeach

@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif