@if(count($records))
@foreach($records as $record)
    @if($record->status == "confirmed")
        <tr  style="color: blue;"   id="tableRecord-{{$record->id}}">
            <td>{{$record->id}}</td>
            @if(request()->query('view')=='trash')
                <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
                <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
            @endif
            <td>{{$record->status}}</td>
            <td>{{$record->booking_date}}</td>
            <td>{{$record->from}}</td>
            <td>{{$record->to}}</td>

            @if($record->discount == null)
                <td>{{"في الانتظار"}}</td>
            @elseif($record->discount == 1)
                <td>{{"تم الخصم"}}</td>
            @else
                <td>{{"تم رفض الخصم"}}</td>
            @endif

            <td>{{$record->discountType()}}</td>
            <td>{{$record->discount_number?$record->discount_number : "لا يوجد"}}</td>
            <td>{{$record->actual_price}}</td>
            <td>{{$record->paid_amount}}</td>
            <td>{{$record->money_back?$record->money_back : "لا يوجد"}}</td>
            <td>{{$record->remaining_amount}}</td>
            <td>{{$record->payment_due_date}}</td>
            <td>{{$record->package ? $record->package->name: "لا يوجد"}}</td>
            <td>{{$record->eventType->name}}</td>
            @if(request()->query('view')=='trash')
                <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
                <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
            @endif
            <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
            <td>
                @if(request()->query('view')=='trash')
                    <a
                        class="btn btn-sm btn-primary"
                        title="استرجاع"
                        data-toggle="modal"
                        data-target="#confirm-password-modal"
                        onclick="injectModalData('{{$record->id}}', '{{route('organizations.reservation.restore')}}', 'confirm-password-form', 'POST')"
                    >
                        <i class="fa fa-undo" style="color: #fff"></i>
                    </a>
                    <a
                        class="btn btn-sm btn-danger"
                        title="حذف نهائي"
                        data-toggle="modal"
                        data-target="#confirm-password-modal"
                        onclick="injectModalData('{{$record->id}}', '{{route('organizations.reservation.destroy', $record->id)}}', 'confirm-password-form', 'DELETE')"
                    >
                        <i class="fa fa-trash" style="color: #fff"></i>
                    </a>
                @else
                    @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EventReservation-Edit'))

                        <a
                            href="{{route('organizations.reservation.edit',$record->id)}}"
                            title="تعديل"
                            class="btn btn-sm btn-primary">
                            <i class="fa fa-edit" style="color: #fff"></i>
                        </a>
                    @endif




                    @if($record->status == "tentative")
                        @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EventReservation-Confirm-Reservation'))
                            <a
                                href="{{route('organizations.reservation.confirm',$record->id)}}"
                                title="تاكيد الحجز"
                                class="btn btn-sm btn-primary">
                                <i class="fa fa-check" style="color: #fff"></i>
                            </a>
                        @endif
                        @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EventReservation-Cancel-Reservation'))

                            <a
                                href="{{route('organizations.reservation.cancel',$record->id)}}"
                                title="الغاء الحجز"
                                class="btn btn-sm btn-danger">
                                <i class="fa fa-archive" style="color: #fff"></i>
                            </a>
                        @endif

                    @endif

                    @if($record->discount == null)

                        <a
                            href="{{route('organizations.reservation.confirm.discount',$record->id)}}"
                            title="قبول الخصم"
                            class="btn btn-sm btn-accent">
                            <i class="fa fa-check" style="color: #fff"></i>
                        </a>
                        <a
                            href="{{route('organizations.reservation.cancel.discount',$record->id)}}"
                            title="رفض الخصم"
                            class="btn btn-sm btn-danger">
                            <i class="fa fa-check" style="color: #fff"></i>
                        </a>
                    @endif
                    <a
                        href="{{route('organizations.reservation.money.back',$record->id)}}"
                        title="استرداد مقدم الحجز"
                        class="btn btn-sm btn-focus">
                        <i class="fa fa-money-bill-alt" style="color: #fff"></i>

                    </a>
                    <a
                        href="{{route('organizations.reservation.print_reservation',$record->id)}}"
                        title="طباعه"
                        onclick="confirmAction()"
                        class="btn btn-sm btn-success">
                        <i class="fa fa-print" style="color: #fff"></i>

                    </a>
                    @if ($record->remaining_amount != 0 )
                        @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EventReservation-Add-Payment'))

                            <a
                                href="{{route('organizations.reservation.payment',$record->id)}}"
                                title="دفع"
                                class="btn btn-sm btn-primary">
                                <i class="fa fa-credit-card" style="color: #fff"></i>

                            </a>
                        @endif
                    @endif
                    @if ($record->supplier_remaining_amount == 0 )
                        @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EventReservation-Add-SupplierPayment'))

                            <a
                                href="{{route('organizations.reservation.supplier.payment',$record->id)}}"
                                title="دفع للموردين"
                                class="btn btn-sm btn-primary">
                                <i class="fa fa-credit-card" style="color: #fff"></i>

                            </a>
                        @endif
                    @endif


                @endif

                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EventReservation-Delete'))

                    <a
                        class="btn btn-sm btn-danger"
                        title="حذف"
                        data-toggle="modal"
                        data-target="#confirm-password-modal"
                        onclick="injectModalData('{{$record->id}}', '{{route('organizations.reservation.trash')}}', 'confirm-password-form', 'POST')" >
                        <i class="fa fa-trash" style="color: #fff"></i>
                    </a>
                @endif
            </td>
        </tr>
    @elseif($record->status == "cancelled")
        <tr  style="color: red;"   id="tableRecord-{{$record->id}}">
            <td>{{$record->id}}</td>
            @if(request()->query('view')=='trash')
                <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
                <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
            @endif
            <td>{{$record->status}}</td>
            <td>{{$record->booking_date}}</td>
            <td>{{$record->from}}</td>
            <td>{{$record->to}}</td>

            @if($record->discount == null)
                <td>{{"في الانتظار"}}</td>
            @elseif($record->discount == 1)
                <td>{{"تم الخصم"}}</td>
            @else
                <td>{{"تم رفض الخصم"}}</td>
            @endif

            <td>{{$record->discountType()}}</td>
            <td>{{$record->discount_number?$record->discount_number : "لا يوجد"}}</td>
            <td>{{$record->actual_price}}</td>
            <td>{{$record->paid_amount}}</td>
            <td>{{$record->money_back?$record->money_back : "لا يوجد"}}</td>
            <td>{{$record->remaining_amount}}</td>
            <td>{{$record->payment_due_date}}</td>
            <td>{{$record->package ? $record->package->name: "لا يوجد"}}</td>
            <td>{{$record->eventType->name}}</td>
            @if(request()->query('view')=='trash')
                <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
                <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
            @endif
            <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
            <td>
                @if(request()->query('view')=='trash')
                    <a
                        class="btn btn-sm btn-primary"
                        title="استرجاع"
                        data-toggle="modal"
                        data-target="#confirm-password-modal"
                        onclick="injectModalData('{{$record->id}}', '{{route('organizations.reservation.restore')}}', 'confirm-password-form', 'POST')"
                    >
                        <i class="fa fa-undo" style="color: #fff"></i>
                    </a>
                    <a
                        class="btn btn-sm btn-danger"
                        title="حذف نهائي"
                        data-toggle="modal"
                        data-target="#confirm-password-modal"
                        onclick="injectModalData('{{$record->id}}', '{{route('organizations.reservation.destroy', $record->id)}}', 'confirm-password-form', 'DELETE')"
                    >
                        <i class="fa fa-trash" style="color: #fff"></i>
                    </a>
                @else
                    @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EventReservation-Edit'))

                        <a
                            href="{{route('organizations.reservation.edit',$record->id)}}"
                            title="تعديل"
                            class="btn btn-sm btn-primary">
                            <i class="fa fa-edit" style="color: #fff"></i>
                        </a>
                    @endif




                    @if($record->status == "tentative")
                        @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EventReservation-Confirm-Reservation'))
                            <a
                                href="{{route('organizations.reservation.confirm',$record->id)}}"
                                title="تاكيد الحجز"
                                class="btn btn-sm btn-primary">
                                <i class="fa fa-check" style="color: #fff"></i>
                            </a>
                        @endif
                        @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EventReservation-Cancel-Reservation'))

                            <a
                                href="{{route('organizations.reservation.cancel',$record->id)}}"
                                title="الغاء الحجز"
                                class="btn btn-sm btn-danger">
                                <i class="fa fa-archive" style="color: #fff"></i>
                            </a>
                        @endif

                    @endif

                    @if($record->discount == null)

                        <a
                            href="{{route('organizations.reservation.confirm.discount',$record->id)}}"
                            title="قبول الخصم"
                            class="btn btn-sm btn-accent">
                            <i class="fa fa-check" style="color: #fff"></i>
                        </a>
                        <a
                            href="{{route('organizations.reservation.cancel.discount',$record->id)}}"
                            title="رفض الخصم"
                            class="btn btn-sm btn-danger">
                            <i class="fa fa-check" style="color: #fff"></i>
                        </a>
                    @endif
                    <a
                        href="{{route('organizations.reservation.money.back',$record->id)}}"
                        title="استرداد مقدم الحجز"
                        class="btn btn-sm btn-focus">
                        <i class="fa fa-money-bill-alt" style="color: #fff"></i>

                    </a>
                    <a
                        href="{{route('organizations.reservation.print_reservation',$record->id)}}"
                        title="طباعه"
                        onclick="confirmAction()"
                        class="btn btn-sm btn-success">
                        <i class="fa fa-print" style="color: #fff"></i>

                    </a>
                    @if ($record->remaining_amount != 0 )
                        @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EventReservation-Add-Payment'))

                            <a
                                href="{{route('organizations.reservation.payment',$record->id)}}"
                                title="دفع"
                                class="btn btn-sm btn-primary">
                                <i class="fa fa-credit-card" style="color: #fff"></i>

                            </a>
                        @endif
                    @endif
                    @if ($record->supplier_remaining_amount == 0 )
                        @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EventReservation-Add-SupplierPayment'))

                            <a
                                href="{{route('organizations.reservation.supplier.payment',$record->id)}}"
                                title="دفع للموردين"
                                class="btn btn-sm btn-primary">
                                <i class="fa fa-credit-card" style="color: #fff"></i>

                            </a>
                        @endif
                    @endif


                @endif

                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EventReservation-Delete'))

                    <a
                        class="btn btn-sm btn-danger"
                        title="حذف"
                        data-toggle="modal"
                        data-target="#confirm-password-modal"
                        onclick="injectModalData('{{$record->id}}', '{{route('organizations.reservation.trash')}}', 'confirm-password-form', 'POST')" >
                        <i class="fa fa-trash" style="color: #fff"></i>
                    </a>
                @endif
            </td>
        </tr>
    @else
        <tr   id="tableRecord-{{$record->id}}">
            <td>{{$record->id}}</td>
            @if(request()->query('view')=='trash')
                <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
                <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
            @endif
            <td>{{$record->status}}</td>
            <td>{{$record->booking_date}}</td>
            <td>{{$record->from}}</td>
            <td>{{$record->to}}</td>

            @if($record->discount == null)
                <td>{{"في الانتظار"}}</td>
            @elseif($record->discount == 1)
                <td>{{"تم الخصم"}}</td>
            @else
                <td>{{"تم رفض الخصم"}}</td>
            @endif

            <td>{{$record->discountType()}}</td>
            <td>{{$record->discount_number?$record->discount_number : "لا يوجد"}}</td>
            <td>{{$record->actual_price}}</td>
            <td>{{$record->paid_amount}}</td>
            <td>{{$record->money_back?$record->money_back : "لا يوجد"}}</td>
            <td>{{$record->remaining_amount}}</td>
            <td>{{$record->payment_due_date}}</td>
            <td>{{$record->package ? $record->package->name: "لا يوجد"}}</td>
            <td>{{$record->eventType->name}}</td>
            @if(request()->query('view')=='trash')
                <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
                <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
            @endif
            <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
            <td>
                @if(request()->query('view')=='trash')
                    <a
                        class="btn btn-sm btn-primary"
                        title="استرجاع"
                        data-toggle="modal"
                        data-target="#confirm-password-modal"
                        onclick="injectModalData('{{$record->id}}', '{{route('organizations.reservation.restore')}}', 'confirm-password-form', 'POST')"
                    >
                        <i class="fa fa-undo" style="color: #fff"></i>
                    </a>
                    <a
                        class="btn btn-sm btn-danger"
                        title="حذف نهائي"
                        data-toggle="modal"
                        data-target="#confirm-password-modal"
                        onclick="injectModalData('{{$record->id}}', '{{route('organizations.reservation.destroy', $record->id)}}', 'confirm-password-form', 'DELETE')"
                    >
                        <i class="fa fa-trash" style="color: #fff"></i>
                    </a>
                @else
                    @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EventReservation-Edit'))

                        <a
                            href="{{route('organizations.reservation.edit',$record->id)}}"
                            title="تعديل"
                            class="btn btn-sm btn-primary">
                            <i class="fa fa-edit" style="color: #fff"></i>
                        </a>
                    @endif




                    @if($record->status == "tentative")
                        @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EventReservation-Confirm-Reservation'))
                            <a
                                href="{{route('organizations.reservation.confirm',$record->id)}}"
                                title="تاكيد الحجز"
                                class="btn btn-sm btn-primary">
                                <i class="fa fa-check" style="color: #fff"></i>
                            </a>
                        @endif
                        @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EventReservation-Cancel-Reservation'))

                            <a
                                href="{{route('organizations.reservation.cancel',$record->id)}}"
                                title="الغاء الحجز"
                                class="btn btn-sm btn-danger">
                                <i class="fa fa-archive" style="color: #fff"></i>
                            </a>
                        @endif

                    @endif

                    @if($record->discount == null)

                        <a
                            href="{{route('organizations.reservation.confirm.discount',$record->id)}}"
                            title="قبول الخصم"
                            class="btn btn-sm btn-accent">
                            <i class="fa fa-check" style="color: #fff"></i>
                        </a>
                        <a
                            href="{{route('organizations.reservation.cancel.discount',$record->id)}}"
                            title="رفض الخصم"
                            class="btn btn-sm btn-danger">
                            <i class="fa fa-check" style="color: #fff"></i>
                        </a>
                    @endif
                    <a
                        href="{{route('organizations.reservation.money.back',$record->id)}}"
                        title="استرداد مقدم الحجز"
                        class="btn btn-sm btn-focus">
                        <i class="fa fa-money-bill-alt" style="color: #fff"></i>

                    </a>
                    <a
                        href="{{route('organizations.reservation.print_reservation',$record->id)}}"
                        title="طباعه"
                        onclick="confirmAction()"
                        class="btn btn-sm btn-success">
                        <i class="fa fa-print" style="color: #fff"></i>

                    </a>
                    @if ($record->remaining_amount != 0 )
                        @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EventReservation-Add-Payment'))

                            <a
                                href="{{route('organizations.reservation.payment',$record->id)}}"
                                title="دفع"
                                class="btn btn-sm btn-primary">
                                <i class="fa fa-credit-card" style="color: #fff"></i>

                            </a>
                        @endif
                    @endif
                    @if ($record->supplier_remaining_amount == 0 )
                        @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EventReservation-Add-SupplierPayment'))

                            <a
                                href="{{route('organizations.reservation.supplier.payment',$record->id)}}"
                                title="دفع للموردين"
                                class="btn btn-sm btn-primary">
                                <i class="fa fa-credit-card" style="color: #fff"></i>

                            </a>
                        @endif
                    @endif


                @endif

                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EventReservation-Delete'))

                    <a
                        class="btn btn-sm btn-danger"
                        title="حذف"
                        data-toggle="modal"
                        data-target="#confirm-password-modal"
                        onclick="injectModalData('{{$record->id}}', '{{route('organizations.reservation.trash')}}', 'confirm-password-form', 'POST')" >
                        <i class="fa fa-trash" style="color: #fff"></i>
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

<script>
function confirmAction() {
confirm("هل انت متأكد من طبع الحجز");
}
</script>
