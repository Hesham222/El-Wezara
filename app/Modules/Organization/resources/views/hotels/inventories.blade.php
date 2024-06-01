<x-organization::layout>
    @if(request()->input('view')=='trash')
        <x-slot name="pageTitle">المخازن  | سله المهملات</x-slot name="pageTitle">
        @section('hotels-trash-active', 'm-menu__item--active')
    @else
        <x-slot name="pageTitle">المخازن | عرض</x-slot name="pageTitle">
        @section('hotels-view-active', 'm-menu__item--active')
    @endif
    @section('hotels-active', 'm-menu__item--active m-menu__item--open')
    @include('Organization::_modals.confirm_password')
    <x-slot name="style">
        <!-- Some styles -->
    </x-slot>
    <!-- Start page content -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    المخازن
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
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                        </li>
                    </ul>
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
                                    <th>الكميه</th>
                                    <th>الكمية الفعلية</th>
                                    <th>الفندق</th>
                                    <th>المكون</th>
                                    <th>نشأ في</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($inventories))
                                    @foreach($inventories as $inventory)
                                        <tr>
                                            <td>{{$inventory->id}}</td>
                                            <td>{{$inventory->quantity}}</td>
                                            <td>{{$inventory->quantity * $inventory->ingredient->quantity}} [{{$inventory->ingredient->unit_of_measurement->name}}]</td>
                                            <td>{{$inventory->hotel->name}}</td>
                                            <td>{{$inventory->ingredient->name}}</td>
                                            <td>{{$inventory->created_at}}</td>
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
                                    <a href="{{route('organizations.hotel.index')}}" class="btn btn-sm btn-primary">
                                        العوده للفنادق
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

