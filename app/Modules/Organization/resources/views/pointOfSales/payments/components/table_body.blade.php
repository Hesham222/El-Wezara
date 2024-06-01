@if(count($records))0
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    @if(request()->query('view')=='trash')
        <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
        <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
    @endif
    <td>{{$record->order->admin?$record->order->admin->employee?$record->order->admin->employee->name:'-':'-'}}</td>
    <td>{{$record->order->point_of_sale->name}}</td>
    <td>{{$record->type}}</td>
    <td>{{$record->amount}}</td>
    <td>{{$record->order->table_number?$record->order->table_number:'-'}}</td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>

</tr>
@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
