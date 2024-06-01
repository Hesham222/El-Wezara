@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    @if(request()->query('view')=='trash')
    <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
    <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
    @endif
    <td>{{$record->hotel?$record->hotel->name:"لا يوجد"}}</td>
    <td>{{$record->quantity?$record->quantity:"لا يوجد"}}</td>
    <td>{{$record->start_room_num?$record->start_room_num:"لا يوجد"}}</td>
    <td>{{$record->child_price?$record->child_price:"لا يوجد"}}</td>
    <td>{{$record->extra_price?$record->extra_price:"لا يوجد"}}</td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td>
    @if(request()->query('view')=='trash')
        <a
        class="btn btn-sm btn-primary"
        title="استرجاع"
        data-toggle="modal"
        data-target="#confirm-password-modal"
        onclick="injectModalData('{{$record->id}}', '{{route('organizations.parentRoom.restore')}}', 'confirm-password-form', 'POST')"
        >
        <i class="fa fa-undo" style="color: #fff"></i>
        </a>
{{--        <a--}}
{{--            class="btn btn-sm btn-danger"--}}
{{--            title="حذف نهائي"--}}
{{--            data-toggle="modal"--}}
{{--            data-target="#confirm-password-modal"--}}
{{--            onclick="injectModalData('{{$record->id}}', '{{route('organizations.parentRoom.destroy', $record->id)}}', 'confirm-password-form', 'DELETE')"--}}
{{--        >--}}
{{--            <i class="fa fa-trash" style="color: #fff"></i>--}}
{{--        </a>--}}
    @else
            @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'ParentRoom-Edit'))

            <a
            href="{{route('organizations.parentRoom.edit',$record->id)}}"
            title="تعديل"
            class="btn btn-sm btn-primary">
            <i class="fa fa-edit" style="color: #fff"></i>
        </a>
            @endif
                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'ParentRoom-Delete'))

                <a
        class="btn btn-sm btn-danger"
        title="حذف"
        data-toggle="modal"
        data-target="#confirm-password-modal"
        onclick="injectModalData('{{$record->id}}', '{{route('organizations.parentRoom.trash')}}', 'confirm-password-form', 'POST')" >
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
