@if(count($records))
@foreach($records as $record)
        <h2>{{$record->name}}</h2>
        <p>{{$record->generalTotal()}}</p>
        @foreach($record->childs as $child)
            @if(count($record->childs) > 0)
                <tr id="tableRecord-{{$child->id}}">
                <td>{{$child->name?$child->name:"لا يوجد"}}</td>
                <td>{{$child->total()}}</td>
            </tr>
            @endif
        @endforeach
@endforeach
@foreach($records as $record)
    @if(count($record->ingredients) <= 0)
        <h2>{{$record->name}}</h2>
        <tr>
           <td>{{"لا يوجد مكونات وجبات"}}</td>
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
