<x-organization::layout>
    @if(request()->input('view')=='trash')
        <x-slot name="pageTitle">نقط البيع   | سله المهملات</x-slot name="pageTitle">
        @section('preparationAreas-trash-active', 'm-menu__item--active')
    @else
        <x-slot name="pageTitle">نقط البيع | طلبات الارجاع</x-slot name="pageTitle">
        @section('preparationAreas-view-active', 'm-menu__item--active')
    @endif
    @section('preparationAreas-active', 'm-menu__item--active m-menu__item--open')
    @include('Organization::_modals.confirm_password')
    <x-slot name="style">
        <!-- Some styles -->
    </x-slot>
    <!-- Start page content -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    طلبات الارجاع
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
                <div class="m-portlet__head-tools">

                </div>
            </div>
            <div class="m-portlet__body">
                <section class="content">
                    <div class="table-responsive">
                        <section class="content table-responsive">
                            <table id="data-table" class="table table-striped- table-bordered table-hover table-checkable" >
                                <thead>
                                <tr>
                                    <th>التعريف</th>
                                    <th>الطلب من نقطة </th>
                                    <th> الطلب الى نقطة / المخزن الرئيسى</th>
                                    <th>المكونات</th>
                                    <th>الحالة</th>
                                    <th>نشأ في</th>
                                    <th> اجراءات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($orders))
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->sender->name}}</td>
                                            <td>@if($order->resever){{$order->resever->name}}@else المخزن الرئيسى @endif</td>
                                            <td>
                                            @if(count($order->orderIngredents) > 0)
                                                <ul>
                                                    @foreach($order->orderIngredents as $orderIngredent)
                                                    <li>
                                                        <p>اسم المكون : {{ $orderIngredent->Ingredent->name }}</p>
                                                        <p>الكمية : {{$orderIngredent->quantity}}</p>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </td>
                                            <td>{{$order->status}}</td>
                                            <td>{{$order->created_at}}</td>
                                            <td>
                                                @if($order->status == 'pending')
                                                <a href="{{route('organizations.pointOfSale.approve.retrieval.order',$order->id)}}" class="btn btn-sm btn-success">
                                                    قبول الاسترجاع
                                                </a>

                                                <a href="{{route('organizations.pointOfSale.cancel.retrieval.order',$order->id)}}" class="btn btn-sm btn-danger">
                                                    رفض الاسترجاع
                                                </a>
                                                @else
                                                    ---

                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            <div id="paginationLinksContainer" style="display: flex;justify-content: center;align-items: center;margin-top: 10px"></div>
                            <div class="row">
                                <div class="col-lg-6">
                                </div>
                                <div class="col-lg-6 m--align-right">
                                    <a href="{{route('organizations.pointOfSale.index')}}" class="btn btn-sm btn-primary">
                                        العوده لنقاط البيع
                                    </a>
                                </div>
                            </div>
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

