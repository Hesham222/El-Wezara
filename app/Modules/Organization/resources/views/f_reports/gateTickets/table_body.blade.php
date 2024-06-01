@if(count($records))
    @foreach($records as $record)
        <tr id="tableRecord-{{$record->id}}">
            <td>{{$record->id}}</td>
            <td>{{$record->shift_date}}</td>
            <td>{{$record->gateAdmin->name}}</td>
            <td>{{$record->gate->name}}</td>
            <td>{{$record->shift_start}}</td>
            <td>{{$record->start_balance}}</td>
            <td>{{$record->shift_end}}</td>
            <td>{{$record->end_balance}}</td>
            <td>{{$record->no_of_tickets}}</td>
            <td>{{$record->ticketsAmount}}</td>
            <td>{{$record->ticketsAmount + $record->start_balance}}</td>
            <td>{{ $record->end_balance - ($record->ticketsAmount + $record->start_balance) }}</td>
            <td>
                @if($record->approved == 1)
                <input type="checkbox" name="invoices[]" value="{{$record->id}}" />
                @endif
            </td>

            <td>
                @if($record->approved == 0)
                  <a href="{{route('organizations.report.gateTicketsReservationApprove', $record->id)}}" class="btn btn-primary">قبول</a>               
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

