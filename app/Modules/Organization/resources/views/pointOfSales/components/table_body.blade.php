@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    @if(request()->query('view')=='trash')
        <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
        <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
    @endif
    <td>{{$record->name?$record->name:"لا يوجد"}}</td>
    <td>{{$record->manager?$record->manager->name:"لا يوجد"}}</td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td>
        @if(request()->query('view')=='trash')
            <a
                class="btn btn-sm btn-primary"
                title="استرجاع"
                data-toggle="modal"
                data-target="#confirm-password-modal"
                onclick="injectModalData('{{$record->id}}', '{{route('organizations.pointOfSale.restore')}}', 'confirm-password-form', 'POST')"
            >
                <i class="fa fa-undo" style="color: #fff"></i>
            </a>
            <a
                class="btn btn-sm btn-danger"
                title="حذف نهائي"
                data-toggle="modal"
                data-target="#confirm-password-modal"
                onclick="injectModalData('{{$record->id}}', '{{route('organizations.pointOfSale.destroy', $record->id)}}', 'confirm-password-form', 'DELETE')"
            >
                <i class="fa fa-trash" style="color: #fff"></i>
            </a>
        @else
            @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PointOfSale-View-Inventories'))

            <a class="btn btn-sm btn-primary"
               href="{{route('organizations.pointOfSale.inventories',$record->id)}}"
               data-id ="{{$record->id}}"
               title="المخازن">
                المخازن
            </a>
            @endif
                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PointOfSale-View-Stocking'))

                    <a class="btn btn-sm btn-primary"
                       href="{{route('organizations.POStocking.index',$record->id)}}"
                       data-id ="{{$record->id}}"
                       title="الجرد">
                        الجرد
                    </a>
                @endif

            @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PointOfSale-Add-Order'))

                <a class="btn btn-sm btn-warning"
               href="{{route('organizations.pointOfSale.make.order',$record->id)}}"
               data-id ="{{$record->id}}"
               target="_blank"
               title="اضافة اوردر">
              اضافة اوردر
            </a>
                @endif
                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PointOfSale-View-OrdersInProgress'))

                <a class="btn btn-sm btn-warning"
               href="{{route('organizations.pointOfSale.orders',$record->id)}}"
               data-id ="{{$record->id}}"
               target="_blank"
               title="  الاوردرات قيض العمل">
                الاوردرات قيض العمل
            </a>
                @endif
                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PointOfSale-Edit'))

                <a
            href="{{route('organizations.pointOfSale.edit',$record->id)}}"
            title="تعديل"
            class="btn btn-sm btn-primary">
            <i class="fa fa-edit" style="color: #fff"></i>
        </a>
                @endif
                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PointOfSale-Delete'))

                <a
        class="btn btn-sm btn-danger"
        title="حذف"
        data-toggle="modal"
        data-target="#confirm-password-modal"
        onclick="injectModalData('{{$record->id}}', '{{route('organizations.pointOfSale.trash')}}', 'confirm-password-form', 'POST')" >
        <i class="fa fa-trash" style="color: #fff"></i>
        </a>
                @endif
                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PointOfSale-View-Payments'))

                <a
                href="{{route('organizations.pointOfSale.payments',$record->id)}}"
                title="المدفوعات"
                target="_blank"
                class="btn btn-sm btn-primary">
               المدفوعات
            </a>
                @endif
                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PointOfSale-Retrieval-Order'))

                <a class="btn btn-sm btn-primary"
               target="_blank"
               href="{{route('organizations.pointOfSale.create.retrieval.order',$record->id)}}"
               data-id ="{{$record->id}}"
               title="الجرد">
                طلب استرجاع
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
