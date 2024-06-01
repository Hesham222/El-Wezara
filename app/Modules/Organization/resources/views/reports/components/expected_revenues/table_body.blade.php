@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->eventType->id}}</td>
    <td>{{$record->contact_name}}</td>
    <td>{{$record->contact_phone}}</td>
    <td>{{$record->booking_date}}</td>
    <td>{{$record->actual_price}}</td>
    <td>{{$record->remaining_amount}}</td>
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
