@if(count($records))
    @foreach($records as $record)
        <tr id="tableRecord-{{$record->id}}">
            <td>{{$record->id}}</td>
            <td>{{$record->payment_date}}</td>
            <td>{{$record->amount}}</td>
            <td>@if($record->status == 0) لم يتم السداد @else تم الدفع @endif</td>
            <td>@if($record->paidBy) {{ $record->paidBy }}@else - @endif</td>

                <td>{{ $record->updated_at }}</td>

                <td>
                    @if($record->rentContract)

{{ $record->rentContract->tenant?$record->rentContract->tenant->name:'--' }}

                    @else
'--'

                    @endif
                    
                </td>

            <td>
                 @if($record->rentContract)
                {{ $record->rentContract->rentSpace?$record->rentContract->rentSpace->name:'--' }}
                @else
'--'

                    @endif
            </td>

             <td>
                @if($record->approved == 1)
                <input type="checkbox" name="invoices[]" value="{{$record->id}}" />
                @endif
            </td>

            <td>
                @if($record->approved == 0)
                  <a href="{{route('organizations.report.rentBillsApprove', $record->id)}}" class="btn btn-primary">قبول</a>               
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
