@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    @if(request()->query('view')=='trash')
    <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
    <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
    @endif
    <td>{{$record->supplier?$record->supplier->name:"لا يوجد"}}</td>
    <td>{{$record->hotel?$record->hotel->name:"لا يوجد"}}</td>
    <td>{{$record->Customer->name?$record->Customer->name:"لا يوجد"}}</td>
    <td>{{$record->RoomType?$record->RoomType->name:"لا يوجد"}}</td>
    <td>{{$record->arrival_date?$record->arrival_date:"لا يوجد"}}</td>
    <td>{{$record->departure_date?$record->departure_date :"لا يوجد"}}</td>
    <td>{{$record->num_of_nights?$record->num_of_nights:"لا يوجد"}}</td>
    <td>{{$record->amount_due}}</td>
    <td>{{$record->amount_future}}</td>
    <td>{{$record->Room?$record->Room->room_num:"لا يوجد"}}</td>
    <td>{{$record->remainingAmount}}</td>
    <td>{{$record->paidAmount}}</td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td>
    @if(request()->query('view')=='trash')
        <a
        class="btn btn-sm btn-primary"
        title="استرجاع"
        data-toggle="modal"
        data-target="#confirm-password-modal"
        onclick="injectModalData('{{$record->id}}', '{{route('organizations.hotelReservation.restore')}}', 'confirm-password-form', 'POST')"
        >
        <i class="fa fa-undo" style="color: #fff"></i>
        </a>
        <a
            class="btn btn-sm btn-danger"
            title="حذف نهائي"
            data-toggle="modal"
            data-target="#confirm-password-modal"
            onclick="injectModalData('{{$record->id}}', '{{route('organizations.hotelReservation.destroy', $record->id)}}', 'confirm-password-form', 'DELETE')"
        >
            <i class="fa fa-trash" style="color: #fff"></i>
        </a>
    @else
            @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'HotelReservation-View-Invoices'))

            <a
            href="{{route('organizations.hotelReservation.invoices',$record->id)}}"
            title="الفواتير"
            class="btn btn-sm btn-primary">
            <i class="fa fa-list-alt" style="color: #fff"></i>
        </a>
            @endif
                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'HotelReservation-View-Payments'))

                <a
            href="{{route('organizations.hotelReservation.payments',$record->id)}}"
            title="المدفوعات"
            class="btn btn-sm btn-primary">
            <i class="fa fa-credit-card" style="color: #fff"></i>
        </a>
                @endif
                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'HotelReservation-Edit'))

                <a
            href="{{route('organizations.hotelReservation.edit',$record->id)}}"
            title="تعديل"
            class="btn btn-sm btn-primary">
            <i class="fa fa-edit" style="color: #fff"></i>
        </a>
                @endif
                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'HotelReservation-Add-Damage'))

                <a
                href="{{route('organizations.hotelReservation.damage',$record->id)}}"
                title="اضف ضرر للغرفه"
                class="btn btn-sm btn-primary">
                <i class="fa fa-plus" style="color: #fff"></i>
            </a>
                @endif
                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'HotelReservation-View-Damages'))

                <a
                href="{{route('organizations.hotelReservation.damages',$record->id)}}"
                title="الاضرار"
                class="btn btn-sm btn-primary">
                <i class="fa fa-eye" style="color: #fff"></i>
            </a>
                @endif
            @if($record->checkIn == 0 && $record->arrival_date == date('Y-m-d'))
                    @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'HotelReservation-CheckIn'))

                    <a
                    class="btn btn-sm btn-primary"
                    title="check in"
                    data-toggle="modal"
                    data-target="#confirm-password-modal"
                    onclick="injectModalData('{{$record->id}}', '{{route('organizations.hotelReservation.checkIn')}}', 'confirm-password-form', 'POST')"
                >
                    <i class="fa fa-check" style="color: #fff"></i>
                </a>
                    @endif
            @endif
            @if( ($record->checkIn == 1 && $record->departure_date >= date('Y-m-d')) || $record->arrival_date >= date('Y-m-d'))
                    @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'HotelReservation-Edit-Dates'))

                    <a
                    href="{{route('organizations.hotelReservation.edit.dates',$record->id)}}"
                    title="تعديل تواريخ"
                    class="btn btn-sm btn-primary">
                    <i class="fa fa-calendar" style="color: #fff"></i>
                </a>
            @endif
            @endif
                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'HotelReservation-Delete'))

                <a
        class="btn btn-sm btn-danger"
        title="حذف"
        data-toggle="modal"
        data-target="#confirm-password-modal"
        onclick="injectModalData('{{$record->id}}', '{{route('organizations.hotelReservation.trash')}}', 'confirm-password-form', 'POST')" >
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
