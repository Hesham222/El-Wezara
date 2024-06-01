@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    @if(request()->query('view')=='trash')
    <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
    <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
    @endif
    <td>{{$record->customer_name? $record->customer_name:"لا يوجد"}}</td>

    <td>{{$record->customer_mobile? $record->customer_mobile:"لا يوجد"}}</td>

    <td>{{$record->total_price? $record->total_price:"لا يوجد"}}</td>
    <td>{{$record->paid_amount? $record->paid_amount:"لا يوجد"}}</td>
    <td>{{$record->remaining_amount? $record->remaining_amount:"لا يوجد"}}</td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td>
    @if(request()->query('view')=='trash')
        <a
        class="btn btn-sm btn-primary"
        title="استرجاع"
        data-toggle="modal"
        data-target="#confirm-password-modal"
        onclick="injectModalData('{{$record->id}}', '{{route('organizations.laundryOrder.restore')}}', 'confirm-password-form', 'POST')"
        >
        <i class="fa fa-undo" style="color: #fff"></i>
        </a>
        <a
            class="btn btn-sm btn-danger"
            title="حذف نهائي"
            data-toggle="modal"
            data-target="#confirm-password-modal"
            onclick="injectModalData('{{$record->id}}', '{{route('organizations.laundryOrder.destroy', $record->id)}}', 'confirm-password-form', 'DELETE')"
        >
            <i class="fa fa-trash" style="color: #fff"></i>
        </a>
    @else
            @if ($record->remaining_amount != 0)
                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'LaundryOrder-Add-Payment'))

                <a
                    href="{{route('organizations.laundryOrder.payment',$record->id)}}"
                    title="دفع"
                    class="btn btn-sm btn-primary">
                    <i class="fa fa-credit-card" style="color: #fff"></i>

                </a>
                @endif
            @endif
                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'LaundryOrder-View-Details'))

            <a
                    href="{{route('organizations.laundryOrder.details',$record->id)}}"
                    title="عرض التفاصيل"
                    class="btn btn-sm btn-primary">
                <i class="m-menu__link-bullet m-menu__link-icon fa fa-eye" style="color: #fff"></i>

                </a>
                @endif
                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'LaundryOrder-Edit'))

                <a
            href="{{route('organizations.laundryOrder.edit',$record->id)}}"
            title="تعديل"
            class="btn btn-sm btn-primary">
            <i class="fa fa-edit" style="color: #fff"></i>
        </a>
                @endif
{{--        <a--}}
{{--        class="btn btn-sm btn-danger"--}}
{{--        title="حذف"--}}
{{--        data-toggle="modal"--}}
{{--        data-target="#confirm-password-modal"--}}
{{--        onclick="injectModalData('{{$record->id}}', '{{route('organizations.laundryOrder.trash')}}', 'confirm-password-form', 'POST')" >--}}
{{--        <i class="fa fa-trash" style="color: #fff"></i>--}}
{{--        </a>--}}
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
