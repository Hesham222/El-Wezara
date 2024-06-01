@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    @if(request()->query('view')=='trash')
    <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
    <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
    @endif
    <td>{{$record->name?$record->name:"لا يوجد"}}</td>
    <td>{{$record->CustomerType?$record->CustomerType->name:"لا يوجد"}}</td>
    <td>{{$record->phone?$record->phone:"لا يوجد"}}</td>
    <td>{{$record->email?$record->email :"لا يوجد"}}</td>
    <td>{{$record->gender?$record->gender:"لا يوجد"}}</td>
    <td>{{$record->date_of_birth?$record->date_of_birth:"لا يوجد"}}</td>
    <td>{{$record->nationality?$record->nationality:"لا يوجد"}}</td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td>
    @if(request()->query('view')=='trash')
        <a
        class="btn btn-sm btn-primary"
        title="استرجاع"
        data-toggle="modal"
        data-target="#confirm-password-modal"
        onclick="injectModalData('{{$record->id}}', '{{route('organizations.customer.restore')}}', 'confirm-password-form', 'POST')"
        >
        <i class="fa fa-undo" style="color: #fff"></i>
        </a>
        <a
            class="btn btn-sm btn-danger"
            title="حذف نهائي"
            data-toggle="modal"
            data-target="#confirm-password-modal"
            onclick="injectModalData('{{$record->id}}', '{{route('organizations.customer.destroy', $record->id)}}', 'confirm-password-form', 'DELETE')"
        >
            <i class="fa fa-trash" style="color: #fff"></i>
        </a>
    @else
            @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Customer-Toggle-TroubleMaker'))
                <a
                    href="{{route('organizations.customer.toggle_trobble_maker',$record->id)}}"
                    title="تغيير الحالة"
                    @if($record->trouble_maker == 1) class="btn btn-sm btn-danger" @else class="btn btn-sm btn-primary" @endif>
                    <i class="fa fa-fire" style="color: #fff"></i>
                </a>
            @endif
                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Customer-Edit'))
                    <a
                        href="{{route('organizations.customer.edit',$record->id)}}"
                        title="تعديل"
                        class="btn btn-sm btn-primary">
                        <i class="fa fa-edit" style="color: #fff"></i>
                    </a>
                @endif
                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Customer-Show'))
                    <a
                    href="{{route('organizations.customer.show',$record->id)}}"
                    title="اظهار"
                    class="btn btn-sm btn-primary">
                    <i class="fa fa-eye" style="color: #fff"></i>
                @endif
        </a>
        <a
        class="btn btn-sm btn-danger"
        title="حذف"
        data-toggle="modal"
        data-target="#confirm-password-modal"
        onclick="injectModalData('{{$record->id}}', '{{route('organizations.customer.trash')}}', 'confirm-password-form', 'POST')" >
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
