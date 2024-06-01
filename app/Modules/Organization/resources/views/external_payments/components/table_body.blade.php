@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    @if(request()->query('view')=='trash')
    <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
    <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
    @endif
    <td>{{$record->Subscriber?$record->Subscriber->name:"لا يوجد"}}</td>
    <td>{{$record->ExternalReservation->ExternalPricing->ActivityArea?$record->ExternalReservation->ExternalPricing->ActivityArea->name:"لا يوجد"}}</td>
    <td>{{$record->payment_amount?$record->payment_amount:"لا يوجد"}}</td>
    <td>{{$record->payment_method?$record->payment_method:"لا يوجد"}}</td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td>

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
