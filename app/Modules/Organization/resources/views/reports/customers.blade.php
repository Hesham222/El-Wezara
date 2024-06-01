<x-organization::layout>
    @if(request()->input('view')=='trash')
        <x-slot name="pageTitle">تقارير المبالغ المتبقيه للعملاء  | سله المهملات</x-slot name="pageTitle">
        @section('customers-remaining-amounts-active', 'm-menu__item--active')
    @else
        <x-slot name="pageTitle">تقارير المبالغ المتبقيه للعملاء | عرض</x-slot name="pageTitle">
        @section('customers-remaining-amounts-active', 'm-menu__item--active')
    @endif
    @section('customers-remaining-amounts-active', 'm-menu__item--active m-menu__item--open')
    @include('Organization::_modals.confirm_password')
    <x-slot name="style">
        <!-- Some styles -->
    </x-slot>
    <!-- Start page content -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    تقارير المبالغ المتبقيه للعملاء
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
                    @include('Organization::reports.components.customers.filterForm')
                    <div class="table-responsive">
                        <section class="content table-responsive">
                            <table id="data-table" class="table table-striped- table-bordered table-hover table-checkable" >
                                <thead>
                                <tr>
                                    <th>الحفله</th>
                                    <th>الاسم</th>
                                    <th>الموبيل</th>
                                    <th>المبلغ المتبقي</th>
                                    <th>تاريخ الاستحقاق</th>
                                    <th>نشأ في</th>
                                </tr>
                                </thead>
                                <tbody id="spinner">
                                <tr>
                                    <td style="height: 100px;text-align: center;line-height: 100px;" colspan="8">
                                        <i class="fa fa-spinner fa-spin text-primary" style="font-size: 30px"aria-hidden="true"></i>
                                    </td>
                                </tr>
                                </tbody>
                                <tbody id="data-table-body"></tbody>
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
        <script>
            $(function () {
                render("{!! route('organizations.report.data_customers') !!}");
                /**
                 * When Click on the pagination buttons, calling this script.
                 *
                 * */
                $('#paginationLinksContainer').on('click', 'a.page-link', function (event) {
                    event.stopPropagation();
                    render($(this).attr('href'));
                    return false;
                });
                /**
                 * When Click on the search button, calling this script.
                 *
                 * */
                $('#searchButton').on('click', function (event) {
                    event.stopPropagation();
                    render("{!! route('organizations.report.data_customers',['view' => request()->input('view',0)]) !!}&column=" + $('#searchColumn').val() + '&value=' + $('#searchField').val()+ '&start_date=' + $('#startDateCol').val()+ '&end_date=' + $('#endDateCol').val());
                });
            });
        </script>
    </x-slot>
</x-organization::layout>

