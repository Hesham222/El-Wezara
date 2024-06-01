@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    <td>{{$record->name?$record->name:"لا يوجد"}}</td>
    <td>{{$record->manager?$record->manager->name:"لا يوجد"}}</td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td>
        @if(count($record->order_items) > 0)
            @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PreparationArea-Order-Items'))

            <a class="btn btn-sm btn-warning"
               href="{{route('organizations.preparationArea.orders.items',$record->id)}}"
               data-id ="{{$record->id}}"
               title="المنتجات المراد تحضيرها">
                <i class="m-menu__link-bullet m-menu__link-icon fa fa-eye" style="color: #fff"></i>
            </a>
            @endif
            @endif

            @if(count($record->order_items->where('order_id',null)) > 0)
                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PreparationArea-Reservation-Items'))

                <a class="btn btn-sm btn-success"
                   href="{{route('organizations.preparationArea.reservations.items',$record->id)}}"
                   data-id ="{{$record->id}}"
                   title="  منتجات الحجوزات">
                    المنتجات المراد تحضيرها
                </a>
            @endif
            @endif
            @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PreparationArea-View-Inventories'))

            <a class="btn btn-sm btn-primary"
           href="{{route('organizations.preparationArea.inventories',$record->id)}}"
           data-id ="{{$record->id}}"
           title="المخازن">
            المخزن
        </a>
            @endif
            @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PreparationArea-View-Stocking'))

            <a class="btn btn-sm btn-primary"
               href="{{route('organizations.PreparationAreaStocking.index',$record->id)}}"
               data-id ="{{$record->id}}"
               title="الجرد">
                الجرد
            </a>
            @endif
            @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PreparationArea-Retrieval-Order'))
                @if(count($record->PreparationAreaInventories) > 0)
            <a class="btn btn-sm btn-primary"
               target="_blank"
               href="{{route('organizations.preparationArea.create.retrieval.order',$record->id)}}"
               data-id ="{{$record->id}}"
               title="الجرد">
                طلب تحويل داخلى
            </a>
                @endif
            @endif
            @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PreparationArea-Edit'))

            <a
            href="{{route('organizations.preparationArea.edit',$record->id)}}"
            title="تعديل"
            class="btn btn-sm btn-primary">
            <i class="fa fa-edit" style="color: #fff"></i>
            </a>
            @endif
            @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PreparationArea-Delete'))
            <a
                class="btn btn-sm btn-danger"
                title="حذف"
                data-toggle="modal"
                data-target="#confirm-password-modal"
                onclick="injectModalData('{{$record->id}}', '{{route('organizations.preparationArea.trash')}}', 'confirm-password-form', 'POST')" >
                <i class="fa fa-trash" style="color: #fff"></i>
            </a>
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
