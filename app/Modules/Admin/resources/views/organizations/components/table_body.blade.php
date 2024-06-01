@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    @if(request()->query('view')=='trash')
    <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
    <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
    @endif
    <td>{{$record->name}}</td>
    <td>{{$record->address}}</td>
    <td style="font-weight: bold;">{{$record->servicesAsString()}}</td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td>
    @if(request()->query('view')=='trash')
        @if(checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Module')||checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Delete'))
                <a
                    class="btn btn-sm btn-primary"
                    title="استرجاع"
                    data-toggle="modal"
                    data-target="#confirm-password-modal"
                    onclick="injectModalData('{{$record->id}}', '{{route('admins.organization.restore')}}', 'confirm-password-form', 'POST')"
                >
                    <i class="fa fa-undo" style="color: #fff"></i>
                </a>
        @endif
            @if(checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Module')||checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Delete'))
                <a
                    class="btn btn-sm btn-danger"
                    title="حذف نهائي"
                    data-toggle="modal"
                    data-target="#confirm-password-modal"
                    onclick="injectModalData('{{$record->id}}', '{{route('admins.organization.destroy', $record->id)}}', 'confirm-password-form', 'DELETE')"
                >
                    <i class="fa fa-trash" style="color: #fff"></i>
                </a>
            @endif
    @else
            @if(checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Module')||checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Edit'))
                <a
                    href="{{route('admins.organization.edit',$record->id)}}"
                    title="تعديل"
                    class="btn btn-sm btn-primary">
                    <i class="fa fa-edit" style="color: #fff"></i>
                </a>
            @endif
                @if(checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Module')||checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Delete'))
                    <a
                    class="btn btn-sm btn-danger"
                    title="حذف"
                    data-toggle="modal"
                    data-target="#confirm-password-modal"
                    onclick="injectModalData('{{$record->id}}', '{{route('admins.organization.trash')}}', 'confirm-password-form', 'POST')" >
                    <i class="fa fa-trash" style="color: #fff"></i>
                    </a>
                @endif

        @endif
    </td>
</tr>
@endforeach
@else
<tr>
    <td colspan="25" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
