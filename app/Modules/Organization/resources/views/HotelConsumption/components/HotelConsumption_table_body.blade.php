@if(count($records))
@foreach($records as $record)
            <tr id="tableRecord-{{$record->id}}">
                <td>{{$record->id}}</td>
                <td>{{$record->createdBy?$record->createdBy->name:"لا يوجد"}}</td>
                <td>{{$record->hotel?$record->hotel->name:"لا يوجد"}}</td>
                <td>{{$record->totalBefore()}}</td>
                <td>{{$record->totalAfter()}}</td>
                <td>{{$record->totalBefore() - $record->totalAfter()}}</td>
                <td>
                    @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Hotel-View-Stocking'))

                        <a class="btn btn-sm btn-primary"
                           href="{{route('organizations.HotelConsumptionDetail.index',$record->id)}}"
                           data-id ="{{$record->id}}"
                           title="التفاصيل">
                            التفاصيل
                        </a>
                    @endif

                </td>
                <td>{{date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))}}</td>
            </tr>
@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
