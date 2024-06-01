<x-organization::layout>
    @if(request()->input('view')=='trash')
        <x-slot name="pageTitle">المدفوعات  | سله المهملات</x-slot name="pageTitle">
        @section('hotelReservations-trash-active', 'm-menu__item--active')
    @else
        <x-slot name="pageTitle">المدفوعات | عرض</x-slot name="pageTitle">
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
                    المدفوعات
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
                @if($record->remainingAmount > 0)
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="{{route('organizations.hotelReservation.create.payment',$record->id)}}"
                                   class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                    <span>
                                      <i class="la la-plus">
                                      </i>
                                      <span>أضف دفع جديد</span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
            <div class="m-portlet__body">
                <section class="content">
                    @include('Organization::hotelReservations.components.filterForm')
                    <div class="table-responsive">
                        <section class="content table-responsive">
                            <table id="data-table" class="table table-striped- table-bordered table-hover table-checkable" >
                                <thead>
                                <tr>
                                    <th>التعريف</th>
                                    <th>رقم الغرفة</th>
                                    <th>أسم العميل</th>
                                    <th>الاجمالي</th>
                                    <th>نشأ في</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($record->payments))
                                    @foreach($record->payments as $payment)
                                        <tr id="tableRecord-{{$payment->id}}">
                                            <td>{{$payment->id}}</td>
                                            <td>{{$record->Room?$record->Room->room_num:"لا يوجد"}}</td>
                                            <td>{{$record->Customer->name?$record->Customer->name:"لا يوجد"}}</td>
                                            <td>{{$payment->amount}}</td>
                                            <td>{{ date('M d, Y', strtotime($payment->created_at)) .'-'.date('h:i a', strtotime($payment->created_at)) }}</td>
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

