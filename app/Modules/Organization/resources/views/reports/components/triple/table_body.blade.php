@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->eventType->id}}</td>
    <td>{{$record->contact_name}}</td>
    <td>{{$record->contact_title}}</td>
    <td>{{$record->contact_phone}}</td>
    <td>{{$record->eventType->name}}</td>
    <td>{{$record->package->name}}</td>
    <td>{{$record->package->capacity}}</td>
    <td>{{$record->booking_date}}</td>
    <td>{{$record->actual_price}}</td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td>
        <a
            href="{{route('organizations.report.triple_services',$record->id)}}"
            title="الخدامات"
            class="btn btn-sm btn-primary">
            <i class="fa fa-table" style="color: #fff"></i>
        </a>

    </td>
</tr>
@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
