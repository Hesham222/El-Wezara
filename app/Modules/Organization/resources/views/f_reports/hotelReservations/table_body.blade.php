@if(count($records))
    @foreach($records as $payment)
        <tr id="tableRecord-{{$payment->id}}">
            <td>{{$payment->id}}</td>
            <td>{{$payment->reservation->Room?$payment->reservation->Room->room_num:"لا يوجد"}}</td>
            <td>{{$payment->reservation->Customer->name?$payment->reservation->Customer->name:"لا يوجد"}}</td>
            <td>{{$payment->amount}}</td>
            <td>{{ date('M d, Y', strtotime($payment->created_at)) .'-'.date('h:i a', strtotime($payment->created_at)) }}</td>
             <td>
                @if($payment->approved == 1)
                <input type="checkbox" name="invoices[]" value="{{$payment->id}}" />
                @endif
            </td>

            <td>
                @if($payment->approved == 0)
                  <a href="{{route('organizations.report.hotelReservationApprove', $payment->id)}}" class="btn btn-primary">قبول</a>               
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
