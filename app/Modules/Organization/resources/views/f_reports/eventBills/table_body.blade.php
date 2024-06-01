@if(count($records))
    @foreach($records as $record)
        <tr id="tableRecord-{{$record->id}}">
            <td>{{$record->id}}</td>
            <td>{{$record->reservation_id}}</td>
            <td>{{$record->reservation->contact_name}}</td>
            <td>{{$record->reservation->booking_date}}</td>
            <td>{{$record->reservation->eventType->name}}</td>
            <td>{{$record->method}}</td>
            <td>{{$record->paid_amount}}</td>
            <td>{{$record->created_at}}</td>
            <td>
                @if($record->approved == 1)
                <input type="checkbox" name="invoices[]" value="{{$record->id}}" />
                @endif
            </td>

            <td>
                @if($record->approved == 0)
                  <a href="{{route('organizations.report.eventBillsApprove', $record->id)}}" class="btn btn-primary">قبول</a>               
                @endif
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

