@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    <td>{{$record->payment_date}}</td>
    <td>{{$record->amount}}</td>
    <td>@if($record->status == 0) لم يتم السداد @else تم الدفع @endif</td>
    <td>@if($record->paidBy) {{ $record->paidBy }}@else - @endif</td>
    @if($record->status == 1)
        <td>{{ $record->updated_at }}</td>
        <td>-</td>
    @else
        <td>-</td>
        <td>
            <a class="btn btn-sm btn-dark"
                title="دفع"
                data-toggle="modal"
                data-target="#confirm-rent-payment-modal"
                onclick="injectModalData('{{$record->id}}', '{{route('organizations.rentContractPayment.pay')}}', 'confirm-rentPayment-form', 'POST')" >
                <i class="fa fa-usd" style="color: #fff"></i>
            </a>
        </td>
    @endif
</tr>
@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
