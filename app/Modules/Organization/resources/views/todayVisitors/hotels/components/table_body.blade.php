@if(count($records))
    @foreach($records as $record)
        <tr id="tableRecord-{{$record->id}}">
            <td>{{$record->id}}</td>
            <td>{{$record->Customer->name}}</td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="8" style="text-align:center;">
            لا توجد سجلات تطابق المدخلات الخاصة بك.
        </td>
    </tr>
@endif
