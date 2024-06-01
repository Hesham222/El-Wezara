@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    @if(request()->query('view')=='trash')
    <td>{{$record->deletedBy ? $record->deletedBy->name : "لا يوجد"}}</td>
    <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
    @endif
    <td>{{$record->Subscriber?$record->Subscriber->name:"لا يوجد"}}</td>
    <td>{{$record->reason_of_cancelled?$record->reason_of_cancelled:"لا يوجد"}}</td>
    <td>{{$record->Training?$record->Training->name:"لا يوجد"}}</td>
    <td>{{$record->pricing_name?$record->pricing_name:"لا يوجد"}}</td>
    <td>{{$record->price?$record->price:"لا يوجد"}}</td>
    <td>{{$record->Payments?$record->Payments->sum('payment_amount'):"لا يوجد"}}</td>
    <td>{{$record->attendance?$record->attendance:"لا يوجد"}}</td>
    <td>{{$record->price?$record->Round():"لا يوجد"}}</td>
    <td>{{$record->attendance_price?$record->attendance_price:"لا يوجد"}}</td>
    <td>{{$record->rest_of_paid?$record->rest_of_paid:"لا يوجد"}}</td>
    <td>{{$record->commission?$record->commission:"لا يوجد"}}</td>
    <td>{{$record->amount_after_discount?$record->amount_after_discount:"لا يوجد"}}</td>
    <td>{{$record->cancelledBy?$record->cancelledBy->name :"لا يوجد"}}</td>
    <td>{{ date('M d, Y', strtotime($record-> cancelled_at)) .'-'.date('h:i a', strtotime($record->cancelled_at)) }}</td>
</tr>
@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
