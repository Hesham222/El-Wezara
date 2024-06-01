<x-organization::layout>
    <x-slot name="pageTitle">عرض  الطلب</x-slot name="pageTitle">
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
                                <th>تفاصيل</th>
                                <th>اجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>

                              @if($type == 'hotel')
                                <tr >
                                    <td style="display: none;">{{$i++}}</td>
                                    <td>HO-{{$order->id}}</td>
                                    @if($order->status)
                                        <td id="status-td-{{$order->id}}"><span style="font-size:12px;padding: 2px 4px;font-weight: 500;border: 2px solid #fff;">{{$order->status}}</span></td>
                                    @else
                                        <td>--</td>
                                    @endif
                                    <td>{{$order->hotel?$order->hotel->name:'-'}}</td>
                                    <td>{{$order->created_at}}</td>

                                    <td>

                                        @if($order->hotelOrderIngredients)
                                            <ul>
                                                @foreach($order->hotelOrderIngredients as $orderIng)
                                                    <li>{{$orderIng->ingredient->name}} - االكمية : {{$orderIng->quantity}}</li>
                                                @endforeach
                                            </ul>
                                            @endif
                                    </td>

                                    <td>
                                        @if($order->status == 'pending')
                                         @if($order->calc_fullFillOrder()  && $order->calc_exp_date_order())
                                            <a href="{{route('organizations.po.fullFill.order',[$order->id,'type'=>'hotel'])}}" class="btn btn-primary">FullFill</a>
                                            @else
                                                <a target="_blank" href="{{route('organizations.po.create.order',[$order->id,'type'=>'hotel'])}}" class="btn btn-warning">اضافه امر توريد جديد</a>
                                             @endif
                                        @endif
                                    </td>
                                </tr>
                              @endif

                            @if($type == 'laundry')
                                <tr>
                                    <td style="display: none;">{{$i++}}</td>
                                    <td>LA-{{$order->id}}</td>
                                    @if($order->status)
                                        <td id="status-td-{{$order->id}}"><span style="font-size:12px;padding: 2px 4px;font-weight: 500;border: 2px solid #fff;">{{$order->status}}</span></td>
                                    @else
                                        <td>--</td>
                                    @endif
                                    <td>{{$order->laundry?$order->laundry->name:'-'}}</td>
                                    <td>{{$order->created_at}}</td>

                                    <td>

                                        @if($order->inventoryOrderIngredients)
                                            <ul>
                                                @foreach($order->inventoryOrderIngredients as $orderIng)
                                                    <li>{{$orderIng->ingredient->name}} - االكمية : {{$orderIng->quantity}}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                    <td>
                                        @if($order->status == 'pending')
                                            @if($order->calc_fullFillOrder()  && $order->calc_exp_date_order())
                                                <a href="{{route('organizations.po.fullFill.order',[$order->id,'type'=>'laundry'])}}" class="btn btn-primary">FullFill</a>
                                            @else
                                                <a target="_blank" href="{{route('organizations.po.create.order',[$order->id,'type'=>'laundry'])}}" class="btn btn-warning">اضافه امر توريد جديد</a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endif



                            @if($type == 'point')

                                <tr>
                                    <td style="display: none;">{{$i++}}</td>
                                    <td>PO-Sale-{{$order->id}}</td>
                                    @if($order->status)
                                        <td id="status-td-{{$order->id}}"><span style="font-size:12px;padding: 2px 4px;font-weight: 500;border: 2px solid #fff;">{{$order->status}}</span></td>
                                    @else
                                        <td>--</td>
                                    @endif
                                    <td>{{$order->PointOfSale?$order->PointOfSale->name:'-'}}</td>
                                    <td>{{$order->created_at}}</td>

                                    <td>

                                        @if($order->PointOrderIngredients)
                                            <ul>
                                                @foreach($order->PointOrderIngredients as $orderIng)
                                                    <li>{{$orderIng->ingredient->name}} - االكمية : {{$orderIng->quantity}}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                    <td>
                                        @if($order->status == 'pending')
                                            @if($order->calc_fullFillOrder() && $order->calc_exp_date_order())
                                                <a href="{{route('organizations.po.fullFill.order',[$order->id,'type'=>'point'])}}" class="btn btn-primary">FullFill</a>
                                            @else
                                                <a target="_blank" href="{{route('organizations.po.create.order',[$order->id,'type'=>'point'])}}" class="btn btn-warning">اضافه امر توريد جديد</a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endif



                            @if($type == 'prepration')
                                <tr>
                                    <td style="display: none;">{{$i++}}</td>
                                    <td>Pep-Area-{{$order->id}}</td>
                                    @if($order->status)
                                        <td id="status-td-{{$order->id}}"><span style="font-size:12px;padding: 2px 4px;font-weight: 500;border: 2px solid #fff;">{{$order->status}}</span></td>
                                    @else
                                        <td>--</td>
                                    @endif
                                    <td>{{$order->area?$order->area->name:'-'}}</td>
                                    <td>{{$order->created_at}}</td>

                                    <td>

                                        @if($order->AreaOrderIngredients)
                                            <ul>
                                                @foreach($order->AreaOrderIngredients as $orderIng)
                                                    <li>{{$orderIng->ingredient->name}} - الكمية : {{$orderIng->quantity}}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                    <td>
                                        @if($order->status == 'pending')
                                            @if($order->calc_fullFillOrder() && $order->calc_exp_date_order())
                                                <a href="{{route('organizations.po.fullFill.order',[$order->id,'type'=>'prepration'])}}" class="btn btn-primary">FullFill</a>
                                            @else
                                                <a target="_blank" href="{{route('organizations.po.create.order',[$order->id,'type'=>'prepration'])}}" class="btn btn-warning">اضافه امر توريد جديد</a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endif




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
            //     $('#POs-table').on('click', 'tbody tr', function(e) {
            //         window.location=$(this).data('route')
            //     })
            //
            });


        </script>

    </x-slot>
</x-organization::layout>
