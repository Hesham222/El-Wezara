<div class="col-xl-12">
    <!--begin:: Widgets/Best Sellers-->
    <div class="m-portlet m-portlet--full-height ">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        عرض طلبات الشراء
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
                       id="vendors-pos-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>الحالة</th>
                        <th>تاريخ الطلب</th>
                        <th>متوقع</th>
                        <th>تاريخ الوصول</th>
                        <th>تاريخ الانتهاء</th>
                        <th>حالة الدفع</th>
                        <th>المجموع</th>
                        <th>اذن الخصم</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($vendor->purchaseOrders as $PO)
                        <tr id="tr-{{$PO->id}}">
                            <td>{{ $loop->index + 1 }}</td>
                            @if($PO->status)
                                <td id="status-td-{{$PO->id}}"><span style="font-size:12px;padding: 2px 4px;font-weight: 500;border: 2px solid #fff;background-color: {{$PO->status->color}};border-color:{{$PO->status->color}};color: #fff">{{$PO->status->name}}</span></td>
                            @else
                                <td>--</td>
                            @endif
                            <td>{{$PO->ordered_date}}</td>
                            <td>{{$PO->expected}}</td>
                            <td id="arrival-tr-{{$PO->id}}">{{$PO->arrival_date}}</td>
                            <td>{{$PO->completed_date}}</td>
                            <td>{!! $PO->remaining?'<span style="color:red;font-weight:bold">لم تكتمل </span>':'<span style="color:green;font-weight:bold">اكتملت</span>' !!}</td>
                            <td>{{number_format($PO->total)}} EGP</td>
                            <td> <a
                                href="{{route('organizations.vendor.show.deduction.form',$PO->id)}}"
                                title="عمل اذن خصم"
                                class="btn btn-sm btn-primary">
                                <i class="fa fa-plus" style="color: #fff"></i>
                            </a>

                            <a
                            href="{{route('organizations.vendor.show.deductions',$PO->id)}}"
                            title="كل اذونات الخصم"
                            class="btn btn-sm btn-primary">
                            <i class="fa fa-file" style="color: #fff"></i>
                        </a>

                            </td>
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
