@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    @if(request()->query('view')=='trash')
    <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
    <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
    @endif
    <td>{{$record->name}}</td>
    <td>{{$record->email}}</td>
    <td>{{$record->phone}}</td>
    <td>{{$record->role->name?$record->role->name : "__"}}</td>
    <td>{{$record->createdBy ? $record->createdBy->name : "NONE"}}</td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td>
    @if(request()->query('view')=='trash')
        @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete'))
                <a
                    class="btn btn-sm btn-primary"
                    title="استرجاع"
                    data-toggle="modal"
                    data-target="#confirm-password-modal"
                    onclick="injectModalData('{{$record->id}}', '{{route('organizations.admin.restore')}}', 'confirm-password-form', 'POST')"
                >
                    <i class="fa fa-undo" style="color: #fff"></i>
                </a>
        @endif
        @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete'))
                <a
                    class="btn btn-sm btn-danger"
                    title="حذف نهائي"
                    data-toggle="modal"
                    data-target="#confirm-password-modal"
                    onclick="injectModalData('{{$record->id}}', '{{route('organizations.admin.destroy', $record->id)}}', 'confirm-password-form', 'DELETE')"
                >
                    <i class="fa fa-trash" style="color: #fff"></i>
                </a>
        @endif

    @else
        @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit'))
                <a
                    href="{{route('organizations.admin.edit',$record->id)}}"
                    title="تعديل"
                    class="btn btn-sm btn-primary">
                    <i class="fa fa-edit" style="color: #fff"></i>
                </a>
        @endif
            @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password'))
                <a
                    class="btn btn-sm btn-primary"
                    title="إعادة تعيين الباسورد"
                    data-toggle="modal"
                    data-target="#reset-admin-password-modal"
                    onclick="injectModalData('{{$record->id}}', '{{route('organizations.admin.reset.password')}}', 'reset-admin-password-form', 'POST')"
                >
                    <i class="fa fa-key" style="color: #fff"></i>
                </a>
            @endif
            @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete'))
                @if($record->id !==1 && $record->id != auth('organization_admin')->user()->id)
                    <a
                        class="btn btn-sm btn-danger"
                        title="حذف"
                        data-toggle="modal"
                        data-target="#confirm-password-modal"
                        onclick="injectModalData('{{$record->id}}', '{{route('organizations.admin.trash')}}', 'confirm-password-form', 'POST')" >
                        <i class="fa fa-trash" style="color: #fff"></i>
                    </a>
                @endif
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
