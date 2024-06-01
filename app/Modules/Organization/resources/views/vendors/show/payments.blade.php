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
            </div>
        </div>
        <div class="m-portlet__body">
            <!--begin::Content-->
            <section class="content">
                <table class="table table-striped- table-bordered table-hover table-checkable"
                       id="vendors-payments-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>معرف طلب الشراء</th>
                        <th>المبلغ</th>
                        <th>النوع</th>
                        <th>نوع الدفع</th>
                        <th>المشرف</th>
                        <th>الرقم القومى</th>
                        <th>تاريخ الدفع</th>
                        {{-- <th>@lang('validation.attributes.created_at')</th> --}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($vendor->payments as $purchaseOrderPayment)
                        <tr id="tr-{{$purchaseOrderPayment->id}}">
                            <td>{{ $loop->index + 1 }}</td>
                            <td>#{{$purchaseOrderPayment->purchaseOrder->id}}</td>
                            <td>{{$purchaseOrderPayment->amount}}</td>
                            <td>{{$purchaseOrderPayment->type}}</td>
                            <td>{{$purchaseOrderPayment->payment_type}}</td>
                            <td>{{$purchaseOrderPayment->admin->name}} {{$purchaseOrderPayment->admin->last_name}}</td>
                            <td>{{$purchaseOrderPayment->reference_number}}</td>
                            <td>{{$purchaseOrderPayment->date}}</td>
                            {{-- <td>{{$purchaseOrderPayment->created_at}}</td> --}}
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
