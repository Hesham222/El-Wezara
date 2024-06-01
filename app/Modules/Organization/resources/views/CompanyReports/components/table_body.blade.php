@if(count($records))
@foreach($records as $record)
    @if(count($record->hotelReservations) > 0)
            <tr id="tableRecord-{{$record->id}}">
                <td>{{$record->id?$record->id:"لا يوجد"}}</td>
                <td>{{$record->name?$record->name:"لا يوجد"}}</td>
                <td>{{$record->hotelReservations->sum('num_of_nights')}}</td>
                <td>{{$record->hotelReservations->sum('num_of_nights') - $record->hotelReservations->sum('num_of_children')}}</td>
                <td>{{$record->hotelReservations->sum('final_price')}}</td>
                <td>{{$record->hotelReservations->sum('paidAmount')}}</td>
                <td>
                    @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Hotel-View-Stocking'))

                        <a class="btn btn-sm btn-primary"
                           href="{{route('organizations.CompanyDetail.index',$record->id)}}"
                           data-id ="{{$record->id}}"
                           title="التفاصيل">
                            <i class="fa fa-eye" style="color: #fff"></i>
                        </a>
                    @endif

                </td>
            </tr>

    @endif
@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
