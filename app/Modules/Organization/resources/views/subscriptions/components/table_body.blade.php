@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    @if(request()->query('view')=='trash')
    <td>{{$record->deletedBy ? $record->deletedBy->name : "لا يوجد"}}</td>
    <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
    @endif
    <td>{{$record->Subscriber?$record->Subscriber->name:"لا يوجد"}}</td>
    <td>{{$record->Training?$record->Training->name:"لا يوجد"}}</td>
    <td>{{$record->pricing_name?$record->pricing_name:"لا يوجد"}}</td>
    <td>{{$record->session_balance?$record->session_balance:"لا يوجد"}}</td>
    <td>{{$record->current_session?$record->current_session:"لا يوجد"}}</td>
    <td>{{$record->price?$record->price:"لا يوجد"}}</td>
    <td>{{$record->payment_balance?$record->payment_balance:"لا يوجد"}}</td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td>
    @if(request()->query('view')=='trash')
        <a
        class="btn btn-sm btn-primary"
        title="استرجاع"
        data-toggle="modal"
        data-target="#confirm-password-modal"
        onclick="injectModalData('{{$record->id}}', '{{route('organizations.subscription.restore')}}', 'confirm-password-form', 'POST')"
        >
        <i class="fa fa-undo" style="color: #fff"></i>
        </a>
        <a
            class="btn btn-sm btn-danger"
            title="حذف نهائي"
            data-toggle="modal"
            data-target="#confirm-password-modal"
            onclick="injectModalData('{{$record->id}}', '{{route('organizations.subscription.destroy', $record->id)}}', 'confirm-password-form', 'DELETE')"
        >
            <i class="fa fa-trash" style="color: #fff"></i>
        </a>
    @else
            @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Subscription-Edit'))
                <a
                href="{{route('organizations.subscription.edit',$record->id)}}"
                title="تعديل"
                class="btn btn-sm btn-primary">
                <i class="fa fa-edit" style="color: #fff"></i>
                </a>
            @endif
                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Subscription-Add-Payment'))
                    <a
                    href="{{route('organizations.payment.createPayment',$record->id)}}"
                    title="اضافه دفع"
                    class="btn btn-sm btn-primary">
                    <i class="fa fa-plus" style="color: #fff"></i>
                    </a>
                @endif
                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Subscription-Cancel-Reservation'))
                    <a
                    href="{{route('organizations.subscription.cancel',$record->id)}}"
                    title="الغاء الاشتراك"
                    class="btn btn-sm btn-danger">
                    <i class="fa flaticon-cancel" style="color: #fff"></i>
                    </a>
                @endif
                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Subscription-Delete'))
                <a
                    class="btn btn-sm btn-danger"
                    title="حذف"
                    data-toggle="modal"
                    data-target="#confirm-password-modal"
                    onclick="injectModalData('{{$record->id}}', '{{route('organizations.subscription.trash')}}', 'confirm-password-form', 'POST')" >
                    <i class="fa fa-trash" style="color: #fff"></i>
                </a>
                @endif
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
