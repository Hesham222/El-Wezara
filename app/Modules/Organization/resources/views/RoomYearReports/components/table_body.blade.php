@if(count($records))
@foreach($records as $record)
    <tr>
        <td> <h5>this year {{date('Y')}}</h5> </td>
    </tr>
            <tr id="tableRecord-{{$record->id}}">
                <td></td>
                <td>{{$record->adults()}}</td>
                <td>{{$record->children()}}</td>
                <td>{{$record->rooms()}}</td>
                <td>{{$record->rooms_checked()}}</td>
                <td>{{$record->profits()}}</td>
                <td>{{$record->revenues()}}</td>
                @break($record)
            </tr>

@endforeach
@foreach($records as $record)
    <tr>
        <td> <h5>last year {{date('Y')-1}}</h5> </td>
    </tr>
            <tr id="tableRecord-{{$record->id}}">
                <td></td>
                <td>{{$record->last_adults()}}</td>
                <td>{{$record->last_children()}}</td>
                <td>{{$record->last_rooms()}}</td>
                <td>{{$record->last_rooms_checked()}}</td>
                <td>{{$record->last_profits()}}</td>
                <td>{{$record->last_revenues()}}</td>
                @break($record)
            </tr>

@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
