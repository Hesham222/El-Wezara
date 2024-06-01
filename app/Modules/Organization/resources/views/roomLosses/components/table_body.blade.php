@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    <td>{{$record->room->ParentRoom->hotel->name}}</td>
    <td>{{$record->room->room_num}}</td>
    <td>{{$record->missingInfo}}</td>
    <td>{{$record->customer}}</td>
    <td>{{ $record->request_date }}</td>
    <td>@if(is_null($record->found_date))مفقودة@else تم العثور عليها@endif</td>
    <td>{{$record->createdBy ? $record->createdBy->name : "NONE"}}</td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td>
        @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'RoomLoss-Edit'))

        <a
            href="{{route('organizations.roomLoss.edit',$record->id)}}"
            title="تعديل"
            class="btn btn-sm btn-primary">
            <i class="fa fa-edit" style="color: #fff"></i>
        </a>
        @endif
            @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'RoomLoss-Show'))

            <a
            href="{{route('organizations.roomLoss.show',$record->id)}}"
            title="بيانات العثور"
            class="btn btn-sm btn-primary">
            <i class="fa fa-eye" style="color: #fff"></i>
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
