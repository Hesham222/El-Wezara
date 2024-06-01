@if(count($records))
@foreach($records as $record)
    @if(count($record->childs) > 0)
        <h2>{{$record->name}}</h2>
        @foreach($record->childs as $child)
            <tr id="tableRecord-{{$child->id}}">
                <td>{{$child->name?$child->name:"لا يوجد"}}</td>
            </tr>
            @foreach($child->ingredients as $ingredient)
                <tr id="tableRecord-{{$ingredient->id}}">
                    <td>{{$ingredient->id}}</td>
                    <td>{{$ingredient->name?$ingredient->name:"لا يوجد"}}</td>
                    <td>{{$ingredient->unit_of_measurement?$ingredient->unit_of_measurement->name:"لا يوجد"}}</td>
                    <td>{{$ingredient->stock?$ingredient->stock:"لا يوجد"}}</td>
                    <td>{{$ingredient->final_cost?$ingredient->final_cost:"لا يوجد"}}</td>
                    <td>{{$ingredient->final_cost * $ingredient->stock}}</td>
                    <td>{{date('d M Y', strtotime($ingredient->created_at)) ." - ". date('h:i a', strtotime($ingredient->created_at))}}</td>
                </tr>

            @endforeach
        @endforeach
    @endif
@endforeach
@foreach($records as $record)
    @if(count($record->childs) <= 0)
        <h2>{{$record->name}}</h2>
        <tr>
           <td>{{"لا يوجد اصناف لهذه الفئات"}}</td>
        </tr>
    @endif
@endforeach

@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
