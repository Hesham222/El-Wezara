<x-organization::layout>
    <x-slot name="pageTitle">عرض  المنتجات المطلوبة</x-slot name="pageTitle">
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
                                <th> الاسم</th>
                                <th>الكمية المطلوبة</th>
                                <th> فى المخزن</th>
                                <th> المطلوب شرائه</th>
                                <th>عدد الاوردرات</th>
                                <th>اجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>

                            @foreach($ingredients as $ingredient)

                                <tr>
                                    <td style="display: none;">{{$i++}}</td>
                                    <td>{{$ingredient->name}}</td>

                                        <td>{{$ingredient->dataForOrders()['ordered']}}</td>
                                    <td>{{$ingredient->stock}}</td>
                                    <td>{{$ingredient->dataForOrders()['need_to_order']}}</td>

                                    <td>
                                        {{$ingredient->dataForOrders()['number_of_orders']}}
                                    </td>

                                    <td>
                                        @if($ingredient->dataForOrders()['need_to_order'] != 0 )
                                                <a target="_blank" href="{{route('organizations.po.create.order.ingredient',[$ingredient->id,'qnt'=>$ingredient->dataForOrders()['need_to_order']])}}" class="btn btn-warning">اضافه امر توريد جديد</a>
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
                //     $('#POs-table').on('click', 'tbody tr', function(e) {
                //         window.location=$(this).data('route')
                //     })
                //
            });


        </script>

    </x-slot>
</x-organization::layout>
