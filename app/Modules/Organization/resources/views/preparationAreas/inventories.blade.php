<x-organization::layout>
    @if(request()->input('view')=='trash')
        <x-slot name="pageTitle">مناطق التحضير  | سله المهملات</x-slot name="pageTitle">
        @section('preparationAreas-trash-active', 'm-menu__item--active')
    @else
        <x-slot name="pageTitle">مناطق التحضير | عرض</x-slot name="pageTitle">
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
                    @if (count($inventories))
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a target="_blank" href="{{route('organizations.PreparationAreaStocking.create',$inventories[0]->area_id)}}" class="btn btn-primary">عمل جرد</a>
                        </li>
                    </ul>
                        @endif
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
                                    <th>الكميه الفعلية</th>
                                    <th>منطقة التحضير</th>
                                    <th>المكون</th>
                                    <th>نشأ في</th>
                                    <th> اجراءات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($inventories))
                                    @foreach($inventories as $inventory)
                                        <tr>
                                            <td>{{$inventory->id}}</td>
                                            <td>{{$inventory->quantity}}</td>
                                            <td>{{$inventory->quantity * $inventory->ingredient->quantity}} [{{$inventory->ingredient->unit_of_measurement->name}}]</td>
                                            <td>{{$inventory->area->name}}</td>
                                            <td>{{$inventory->ingredient->name}}</td>
                                            <td>{{$inventory->created_at}}</td>
                                            <td>
                                                @if($inventory->area->hasManufactured == 1 && count($inventory->ingredient->manufactured) > 0)
                                                <a href="{{route('organizations.preparationArea.manufactured.ingredent',$inventory->id)}}" class="btn btn-sm btn-primary">
                                                    تصنيع
                                                </a>
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
                                    <a href="{{route('organizations.preparationArea.index')}}" class="btn btn-sm btn-primary">
                                        العوده لمناطق التحضير
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

