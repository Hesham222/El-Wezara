@if(count($records))
@foreach($records as $record)
    @if($record->parent_id == 0)
        <h2>{{$record->name}}</h2>
        @foreach($record->childs as $child)
            <tr id="tableRecord-{{$child->id}}">
                <td>{{$child->id?$child->id:"لا يوجد"}}</td>
                <td>{{$child->name?$child->name:"لا يوجد"}}</td>
                <td>{{$child->IngredientOrderTotal()}}</td>
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
