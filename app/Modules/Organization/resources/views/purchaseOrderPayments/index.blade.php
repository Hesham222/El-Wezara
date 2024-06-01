<x-organization::layout>
    <x-slot name="pageTitle">عرض اوامر الشراء</x-slot name="pageTitle">
    @section('inventory-active', 'm-menu__item--active m-menu__item--open')
    <x-slot name="style">
        <!-- Some styles -->

        <style type="text/css">
            .swal2-confirm {
                background: #3085d6 !important;
                border: #3085d6 !important;
            }

            .swal2-cancel {
                background: #f12143 !important;
                color: #fff !important;
            }
        </style>
    </x-slot>



    <div class="m-content">
        <!--Begin::Section-->
        <div class="row">
            <div class="col-xl-12">
                <!--begin:: Widgets/Best Sellers-->
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    عرض مدفوعات طلبات الشراء

                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <a href="{{ route('organizations.purchaseOrderPayment.create') }}"
                               class="btn btn-primary">اضافة</a>
                            <a style="margin-left: 5px" href="{{ route('organizations.purchaseOrderPayment.index')}}"
                               class="btn btn-{{(!request()->has('made'))? "accent": 'secondary' }}">الكل</a>
                            <a style="margin-left: 5px"
                               href="{{ route('organizations.purchaseOrderPayment.index').'?made=1' }}"
                               class="btn btn-{{(request()->has('made') && request()->input('made') == 1)? "accent": 'secondary' }}">تم الدفع</a>
                            <a style="margin-left: 5px"
                               href="{{ route('organizations.purchaseOrderPayment.index').'?made=0' }}"
                               class="btn btn-{{(request()->has('made') && request()->input('made') == 0)? "accent": 'secondary' }}">تم استلام الدفعة</a>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin::Content-->
                        <section class="content table-responsive">
                            <table class="table table-striped- table-bordered table-hover table-checkable"
                                   id="purchaseOrderPayments-table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>معرف طلب الشراء</th>
                                    <th>المبلغ</th>
                                    <th>النوع</th>
                                    <th>نوع الدفع</th>
                                    <th>المشرف</th>
                                    <th>البائع</th>
                                    <th>الرقم القومى</th>
                                    <th>تاريخ الدفع</th>
                                    <th>انشأ فى </th>
{{--                                    <th>اجراءات</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                @foreach($purchaseOrderPayments as $purchaseOrderPayment)
                                    <tr id="tr-{{$purchaseOrderPayment->id}}">
                                        <td>{{$i++}}</td>
                                        <td>#{{$purchaseOrderPayment->purchaseOrder->id}}</td>
                                        <td>{{$purchaseOrderPayment->amount}}</td>
                                        <td>{{$purchaseOrderPayment->type}}</td>
                                        <td>{{$purchaseOrderPayment->payment_type}}</td>
                                        <td>{{$purchaseOrderPayment->admin->name}} {{$purchaseOrderPayment->admin->last_name}}</td>
                                        <td>{{($purchaseOrderPayment->purchaseOrder && $purchaseOrderPayment->purchaseOrder->vendor)?$purchaseOrderPayment->purchaseOrder->vendor->name:'-'}}</td>
                                        <td>{{$purchaseOrderPayment->reference_number}}</td>
                                        <td>{{$purchaseOrderPayment->date}}</td>
                                        <td>{{$purchaseOrderPayment->created_at}}</td>

{{--                                        <td>--}}
{{--                                            <a href="{{route('organizations.purchaseOrderPayment.edit',$purchaseOrderPayment->id)}}"--}}
{{--                                               class="btn btn-sm btn-warning"><i class="fa fa-edit"--}}
{{--                                                                                 style="color: #fff"></i></a>--}}
{{--                                        </td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </section>
                        <!--end::Content-->
                    </div>
                </div>
                <!--end:: Widgets/Best Sellers-->
            </div>
        </div>
        <!--End::Section-->
    </div>

    <!-- end page content -->
    <x-slot name="scripts">
        <script type="text/javascript">
            $(document).ready(function () {
                dataTableInitlize('#purchaseOrderPayments-table');
            });
        </script>

    </x-slot>
</x-organization::layout>
