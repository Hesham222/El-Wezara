<x-organization::layout>
    <x-slot name="pageTitle">عرض طلبات الشراء</x-slot name="pageTitle">
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
                                <th>اسم الطالب</th>
                                <th>تاريخ الطلب</th>
                                <th>اجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            @foreach($hotel_orders as $hotel_order)
                                @php
                                        $route = route('organizations.po.order.detail',[$hotel_order->id,'type'=>'hotel']);
                                @endphp
                                <tr style="cursor: pointer;" data-route="{{$route}}" id="tr-{{$hotel_order->id}}">
                                    <td style="display: none;">{{$i++}}</td>
                                    <td>HO-{{$hotel_order->id}}</td>
                                    @if($hotel_order->status)
                                        <td id="status-td-{{$hotel_order->id}}"><span style="font-size:12px;padding: 2px 4px;font-weight: 500;border: 2px solid #fff;">{{$hotel_order->status}}</span></td>
                                    @else
                                        <td>--</td>
                                    @endif
                                    <td>{{$hotel_order->hotel?$hotel_order->hotel->name:'-'}}</td>
                                    <td>{{$hotel_order->created_at}}</td>

                                    <td>
                                        @if($hotel_order->status == 'pending')
                                            @if($hotel_order->calc_fullFillOrder() && $hotel_order->calc_exp_date_order())
                                                <a href="{{route('organizations.po.fullFill.order',[$hotel_order->id,'type'=>'hotel'])}}" class="btn btn-primary">تلبيه الطلب</a>
                                            @else
                                                <a target="_blank" href="{{route('organizations.po.create.order',[$hotel_order->id,'type'=>'hotel'])}}" class="btn btn-warning">اضافه امر توريد جديد</a>
                                            @endif
                                            <a href="{{route('organizations.po.refuse.order',[$hotel_order->id,'type'=>'hotel'])}}" class="btn btn-primary"> رفض اذن الصرف</a>


                                         @endif
                                    </td>
                                </tr>
                            @endforeach


                            @foreach($laundry_orders as $laundry_order)
                                @php
                                    $route = route('organizations.po.order.detail',[$laundry_order->id,'type'=>'laundry']);
                                @endphp
                                <tr style="cursor: pointer;" data-route="{{$route}}" id="tr-{{$laundry_order->id}}">
                                    <td style="display: none;">{{$i++}}</td>
                                    <td>LA-{{$laundry_order->id}}</td>
                                    @if($laundry_order->status)
                                        <td id="status-td-{{$laundry_order->id}}"><span style="font-size:12px;padding: 2px 4px;font-weight: 500;border: 2px solid #fff;">{{$laundry_order->status}}</span></td>
                                    @else
                                        <td>--</td>
                                    @endif
                                    <td>{{$laundry_order->laundry?$laundry_order->laundry->name:'-'}}</td>
                                    <td>{{$laundry_order->created_at}}</td>

                                    <td>
                                        @if($laundry_order->status == 'pending')
                                            @if($laundry_order->calc_fullFillOrder() && $laundry_order->calc_exp_date_order())
                                                <a href="{{route('organizations.po.fullFill.order',[$laundry_order->id,'type'=>'laundry'])}}" class="btn btn-primary">تلبيه الطلب</a>
                                            @else
                                                <a target="_blank" href="{{route('organizations.po.create.order',[$laundry_order->id,'type'=>'laundry'])}}" class="btn btn-warning">اضافه امر توريد جديد</a>
                                            @endif
                                            <a href="{{route('organizations.po.refuse.order',[$laundry_order->id,'type'=>'laundry'])}}" class="btn btn-primary"> رفض اذن الصرف</a>

                                        @endif
                                    </td>
                                </tr>
                            @endforeach



                            @foreach($point_of_sale_orders as $point_of_sale_order)
                                @php
                                    $route = route('organizations.po.order.detail',[$point_of_sale_order->id,'type'=>'point']);
                                @endphp
                                <tr style="cursor: pointer;" data-route="{{$route}}" id="tr-{{$point_of_sale_order->id}}">
                                    <td style="display: none;">{{$i++}}</td>
                                    <td>PO-Sale-{{$point_of_sale_order->id}}</td>
                                    @if($point_of_sale_order->status)
                                        <td id="status-td-{{$point_of_sale_order->id}}"><span style="font-size:12px;padding: 2px 4px;font-weight: 500;border: 2px solid #fff;">{{$point_of_sale_order->status}}</span></td>
                                    @else
                                        <td>--</td>
                                    @endif
                                    <td>{{$point_of_sale_order->PointOfSale?$point_of_sale_order->PointOfSale->name:'-'}}</td>
                                    <td>{{$point_of_sale_order->created_at}}</td>

                                    <td>
                                        @if($point_of_sale_order->status == 'pending')
                                            @if($point_of_sale_order->calc_fullFillOrder() && $point_of_sale_order->calc_exp_date_order())
                                                <a href="{{route('organizations.po.fullFill.order',[$point_of_sale_order->id,'type'=>'point'])}}" class="btn btn-primary">تلبيه الطلب</a>
                                            @else
                                                <a target="_blank" href="{{route('organizations.po.create.order',[$point_of_sale_order->id,'type'=>'point'])}}" class="btn btn-warning">اضافه امر توريد جديد</a>
                                            @endif
                                            <a href="{{route('organizations.po.refuse.order',[$point_of_sale_order->id,'type'=>'point'])}}" class="btn btn-primary"> رفض اذن الصرف</a>

                                        @endif
                                    </td>
                                </tr>
                            @endforeach



                            @foreach($prepration_area_orders as $prepration_area_order)
                                @php
                                    $route = route('organizations.po.order.detail',[$prepration_area_order->id,'type'=>'prepration']);
                                @endphp
                                <tr style="cursor: pointer;" data-route="{{$route}}" id="tr-{{$prepration_area_order->id}}">
                                    <td style="display: none;">{{$i++}}</td>
                                    <td>Pep-Area-{{$prepration_area_order->id}}</td>
                                    @if($prepration_area_order->status)
                                        <td id="status-td-{{$prepration_area_order->id}}"><span style="font-size:12px;padding: 2px 4px;font-weight: 500;border: 2px solid #fff;">{{$prepration_area_order->status}}</span></td>
                                    @else
                                        <td>--</td>
                                    @endif
                                    <td>{{$prepration_area_order->area?$prepration_area_order->area->name:'-'}}</td>
                                    <td>{{$prepration_area_order->created_at}}</td>

                                    <td>
                                        @if($prepration_area_order->status == 'pending')
                                            {{$prepration_area_order->calc_exp_date_order()}}
                                            @if($prepration_area_order->calc_fullFillOrder() && $prepration_area_order->calc_exp_date_order())
                                                <a href="{{route('organizations.po.fullFill.order',[$prepration_area_order->id,'type'=>'prepration'])}}" class="btn btn-primary">تلبيه الطلب</a>
                                            @else
                                                <a target="_blank" href="{{route('organizations.po.create.order',[$prepration_area_order->id,'type'=>'prepration'])}}" class="btn btn-warning">اضافه امر توريد جديد</a>
                                            @endif
                                            <a href="{{route('organizations.po.refuse.order',[$prepration_area_order->id,'type'=>'prepration'])}}" class="btn btn-primary"> رفض اذن الصرف</a>

                                        @endif
                                    </td>
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
