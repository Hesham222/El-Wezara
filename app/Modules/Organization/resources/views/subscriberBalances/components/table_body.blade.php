{{--@if(count($records))--}}

{{--@foreach($records as $record)--}}
{{--    @foreach($record->Training->Subscriptions as $subscription)--}}

{{--     <tr id="tableRecord-{{$record->id}}">--}}
{{--         <td>{{$subscription->Subscriber?$subscription->Subscriber->id:"لا يوجد"}}</td>--}}
{{--         <td>{{$subscription->Subscriber?$subscription->Subscriber->name:"لا يوجد"}}</td>--}}
{{--         <td>{{$subscription->Subscriber?$subscription->Subscriber->phone:"لا يوجد"}}</td>--}}
{{--         <td>{{$subscription->Subscriber->Payments->sum('payment_balance')}}</td>--}}

{{--        <td>--}}
{{--            <a--}}
{{--                href="{{route('organizations.subscriberBalance.show',$record->Training->id)}}"--}}
{{--                title="Show Subscriptions"--}}
{{--                style="margin:5px"--}}
{{--                class="btn btn-sm btn-primary">--}}
{{--                <i class="fa fa-eye" style="color: #fff"></i>--}}
{{--            </a>--}}
{{--        </td>--}}
{{--     </tr>--}}
{{--    @endforeach--}}

{{--@endforeach--}}
{{--@else--}}
{{--<tr>--}}
{{--    <td colspan="8" style="text-align:center;">--}}
{{--        لا توجد سجلات تطابق المدخلات الخاصة بك.--}}
{{--    </td>--}}
{{--</tr>--}}
{{--@endif--}}
