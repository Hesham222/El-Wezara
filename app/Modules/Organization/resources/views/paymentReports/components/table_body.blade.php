@if(count($records))

@foreach($records as $record)
{{--   // {{dd($record)}}--}}
            <tr id="tableRecord-{{$record->id}}">
                <td>{{$record->Subscriber?$record->Subscriber->id:"لا يوجد"}}</td>
                <td>{{$record->Subscriber?$record->Subscriber->name:"لا يوجد"}}</td>
                <td>{{$record->Subscriber->phone}}</td>
                <td>{{$record->id?$record->id:"لا يوجد"}}</td>
                <td>{{$record->Subscription?$record->Subscription->id:"لا يوجد"}}</td>
                <td>{{$record->Subscription->Training?$record->Subscription->Training->name:"لا يوجد"}}</td>
                <td>{{$record->payment_amount?$record->payment_amount:"لا يوجد"}}</td>
                <td>{{$record->Subscription?$record->Subscription->paid_date:"لا يوجد"}}</td>

            </tr>
@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
