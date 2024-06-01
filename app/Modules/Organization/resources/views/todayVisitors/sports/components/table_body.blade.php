@if(count($records))
    @foreach($records as $record)
        @foreach($record->Training->Subscriptions as $subscription)
            <tr id="tableRecord-{{$record->id}}">
                <td>{{$subscription->Subscriber?$subscription->Subscriber->id:"لا يوجد"}}</td>
                <td>{{$subscription->Subscriber?$subscription->Subscriber->name:"لا يوجد"}}</td>
                <td>{{$subscription->Subscriber?$subscription->Training->name:"لا يوجد"}}</td>
            </tr>
        @endforeach
    @endforeach
@else
    <tr>
        <td colspan="8" style="text-align:center;">
            لا توجد سجلات تطابق المدخلات الخاصة بك.
        </td>
    </tr>
@endif
