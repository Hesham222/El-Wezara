<x-organization::layout>
    @if(request()->input('view')=='trash')
        <x-slot name="pageTitle">الحجوزات  | سله المهملات</x-slot name="pageTitle">
        @section('triple-sheet-report-active', 'm-menu__item--active')
    @else
        <x-slot name="pageTitle">الحجوزات | عرض</x-slot name="pageTitle">
        @section('triple-sheet-report-active', 'm-menu__item--active')
    @endif
    @section('triple-sheet-report-active', 'm-menu__item--active m-menu__item--open')
    @include('Organization::_modals.confirm_password')
    <x-slot name="style">
        <!-- Some styles -->
    </x-slot>
    <!-- Start page content -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    الحجوزات
                </h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <section class="content">
                    <div class="table-responsive">
                        <section class="content table-responsive">
                            <table id="data-table" class="table table-striped- table-bordered table-hover table-checkable" >
                                <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>اسم المورد</th>
                                    <th>السعر</th>
                                    <th>عموله النادي</th>
                                    <th>نشأ في</th>
                                </tr>
                                </thead>
                                <tbody id="data-table-body">
                                @if($records->count())
                                    @foreach($records as $record)
                                        @if ($record->supplierService)
                                            <tr>
                                                <td>{{$record->supplierService->name}}</td>
                                                <td>@if($record->supplierService->supplier) ? {{$record->supplierService->supplier->name}} @else - @endif</td>
                                                <td>{{$record->supplierService->price}}</td>
                                                <td>{{$record->supplierService->club_commission}}</td>
                                                <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" style="text-align:center;">
                                            لا توجد سجلات تطابق المدخلات الخاصة بك.
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            <div id="paginationLinksContainer" style="display: flex;justify-content: center;align-items: center;margin-top: 10px"></div>
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

