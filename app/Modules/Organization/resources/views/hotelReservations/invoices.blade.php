<x-organization::layout>
    @if(request()->input('view')=='trash')
        <x-slot name="pageTitle">الفواتير  | سله المهملات</x-slot name="pageTitle">
        @section('hotelReservations-trash-active', 'm-menu__item--active')
    @else
        <x-slot name="pageTitle">الفواتير | عرض</x-slot name="pageTitle">
        @section('hotelReservations-view-active', 'm-menu__item--active')
    @endif
    @section('hotelReservations-active', 'm-menu__item--active m-menu__item--open')
    @include('Organization::_modals.confirm_password')
    <x-slot name="style">
        <!-- Some styles -->
    </x-slot>
    <!-- Start page content -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    الفواتير
                </h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{request()->input('view')=='trash' ? 'سله المهملات' :  'عرض'}}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <section class="content">
                    @include('Organization::hotelReservations.components.filterForm')
                    @include('Organization::hotelReservations.components.changeReservation')
                    <div class="table-responsive">
                        <section class="content table-responsive">
                            <table id="data-table" class="table table-striped- table-bordered table-hover table-checkable" >
                                <thead>
                                <tr>
                                    <th>التعريف</th>
                                    <th>رقم الغرفة</th>
                                    <th>أسم العميل</th>
                                    <th>الفاتورة</th>
                                    <th>الاجمالي</th>
                                    <th>تاريخ الفاتورة</th>
                                    <th>الحالة</th>
                                    <th>نشأ في</th>
                                    <th>أجراءات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($record->invoices))
                                    @foreach($record->invoices as $invoice)
                                        <tr id="tableRecord-{{$invoice->id}}">
                                            <td>{{$invoice->id}}</td>
                                            <td>{{$record->Room?$record->Room->room_num:"لا يوجد"}}</td>
                                            <td>{{$record->Customer->name?$record->Customer->name:"لا يوجد"}}</td>
                                            <td>{{$invoice->model_type}}</td>
                                            <td>{{$invoice->amount}}</td>
                                            <td>{{$invoice->invoice_date}}</td>
                                            <td>{{$invoice->status}}</td>
                                            <td>{{ date('M d, Y', strtotime($invoice->created_at)) .'-'.date('h:i a', strtotime($invoice->created_at)) }}</td>
                                            <td>
                                                <a
                                                    class="btn btn-sm btn-dark"
                                                    title="تعديل حجز"
                                                    data-toggle="modal"
                                                    data-target="#change-invoice-reservation-modal"
                                                    onclick="injectModalData('{{$invoice->id}}', '{{route('organizations.hotelReservation.change.reservation')}}', 'change-reservation-form', 'POST')" >
                                                <i class="fa fa-pencil-square" style="color: #fff"></i>
                                                </a>
                                                @if($invoice->status == "System Confirmed")
                                                    @if($invoice->model_type == "HotelReservation")
                                                        <a
                                                            href="{{route('organizations.hotelReservation.edit.invoice',$invoice->id)}}"
                                                            title="تعديل"
                                                            class="btn btn-sm btn-primary">
                                                            <i class="fa fa-edit" style="color: #fff"></i>
                                                        </a>
                                                    @endif
                                                    <a
                                                        href="{{route('organizations.hotelReservation.confirm.invoice',$invoice->id)}}"
                                                        title="قبول"
                                                        class="btn btn-sm btn-primary"
                                                        onclick="return confirm('هل انت متأكد من تأكيد حجز الليلة؟')">
                                                        <i class="fa fa-check" style="color: #fff"></i>
                                                    </a>
                                                @elseif($invoice->status == "Admin Confirmed" && !is_null($invoice->hotelInvoiceExtra))
                                                    <a
                                                        href="{{route('organizations.hotelReservation.edit.invoice',$invoice->id)}}"
                                                        title="تعديل"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="fa fa-edit" style="color: #fff"></i>
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
                                </tbody>
                                <tbody id="data-table-body"></tbody>
                            </table>
                            <div id="paginationLinksContainer" style="display: flex;justify-content: center;align-items: center;margin-top: 10px"></div>
                        </section>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- End page content -->
    <x-slot name="scripts">

    </x-slot>
</x-organization::layout>

