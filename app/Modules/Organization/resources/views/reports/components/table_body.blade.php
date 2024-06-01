@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
{{--    <td>{{$record->id}}</td>--}}
    <td>{{$record->contact_title}}</td>
    <td>{{$record->contact_name}}</td>
    <td>{{$record->contact_phone}}</td>
    <td>{{$record->contact_address}}</td>
    <td>{{$record->contact_national_id}}</td>
    <td>{{$record->eventType->name}}</td>
    <td>{{$record->package->name}}</td>
    <td>{{$record->booking_date}}</td>
    <td>{{$record->from}}</td>
    <td>{{$record->actual_price}}</td>
    <td>{{$record->paid_amount}}</td>
    <td>{{$record->remaining_amount}}</td>
    <td>{{$record->payment_due_date}}</td>
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
