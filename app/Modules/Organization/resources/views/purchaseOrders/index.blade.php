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
    <!-- Start page content -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">

            </div>
        </div>
    </div>
    <div class="m-content">
        <div style="display: none;" class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30" role="alert">
            <div class="m-alert__icon">
                <i class="flaticon-exclamation m--font-brand">
                </i>
            </div>
        </div>
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <a href="{{ route('organizations.po.create') }}" class="btn btn-primary">انشاء امر شراء</a>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="table-responsive">
                    <section class="content">


                        <table class="table table-striped- table-bordered table-hover table-checkable"
                               id="POs-table">
                            <thead>
                            <tr>
                                <th style="display: none;">#</th>
                                <th>الرقم التعريفى</th>
                                <th>الحالة</th>
                                <th>البائع</th>
                                <th>تاريخ الطلب</th>
                                <th>متوقع</th>
                                <th>تاريخ الوصول</th>
                                <th>تاريخ الانتهاء</th>
                                <th>حالة الدفع</th>
                                <th>المجموع</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            @foreach($POs as $PO)
                                @php
                                    if($POsManagement AND ($PO->status?$PO->status->id==1 or $PO->status->id==3 :0))
                                        $route = route('organizations.po.edit',$PO->id);
                                    else
                                        $route = route('organizations.po.show',$PO->id);
                                @endphp
                                <tr style="cursor: pointer;" data-route="{{$route}}" id="tr-{{$PO->id}}">
                                    <td style="display: none;">{{$i++}}</td>
                                    <td>PO-{{$PO->id}}</td>
                                    @if($PO->status)
                                        <td id="status-td-{{$PO->id}}"><span style="font-size:12px;padding: 2px 4px;font-weight: 500;border: 2px solid #fff;background-color: {{$PO->status->color}};border-color:{{$PO->status->color}};color: #fff">{{$PO->status->name}}</span></td>
                                    @else
                                        <td>--</td>
                                    @endif
                                    <td>{{$PO->vendor?$PO->vendor->name:'-'}}</td>
                                    <td>{{$PO->ordered_date}}</td>
                                    <td>{{$PO->expected}}</td>
                                    <td id="arrival-tr-{{$PO->id}}">{{$PO->arrival_date}}</td>
                                    <td>{{$PO->completed_date}}</td>
                                    <td>{!! $PO->remaining>0?'<span style="color:red;font-weight:bold">لم تكتمل</span>':'<span style="color:green;font-weight:bold">اكتملت</span>' !!}</td>
                                    <td>{{number_format($PO->total)}} EGP</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>



                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- end page content -->
    <x-slot name="scripts">
        <script type="text/javascript">
            $(document).ready(function () {
                //call datatabel

                $('#POs-table').dataTable({
                    "order": [[ 0, "desc" ]]
                });
                $('#POs-table').on('click', 'tbody tr', function(e) {
                    window.location=$(this).data('route')
                })

            });


        </script>

    </x-slot>
</x-organization::layout>
