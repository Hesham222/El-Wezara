<x-organization::layout>
  <x-slot name="pageTitle">احصائيات الشركه تفصيليا | عرض</x-slot name="pageTitle">
    @section('hotel-reports-active', 'm-menu__item--active m-menu__item--open')
    @section('companyReports-view-active', 'm-menu__item--active')
    <x-slot name="style">
    <!-- Some styles -->
  </x-slot>
    <!-- Start page content -->
      <div class="m-subheader">
        <div class="d-flex align-items-center">
          <div class="mr-auto">
            <h3 class="m-subheader__title">
                استهلاك الشركه تفصيليا
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
          </div>
          <div class="m-portlet__body">
             <section class="content">
                @include('Organization::CompanyDetail.components.CompanyDetailFilterForm')
                <div class="table-responsive">
                    <section class="content table-responsive">
                      <table id="data-table" class="table table-striped- table-bordered table-hover table-checkable" >
                          <thead>
                          <tr>
                              <th> عدد الغرف</th>
                              <th> البالغين</th>
                              <th> الاطفال</th>
                              <th>عدد الأسرة الإضافية</th>
                              <th> مجموع الارباح </th>
                              <th>صافي الإيرادات </th>
                              <th> مجموع المتبقي </th>

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
        render("{!! route('organizations.CompanyDetail.data',['id'=>$supplier->id,'view' => request()->input('view',0)]) !!}");
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
            render("{!! route('organizations.CompanyDetail.data',['id'=>$supplier->id,'view' => request()->input('view',0)]) !!}&column=" + $('#searchColumn').val() + '&value=' + $('#searchField').val()+ '&start_date=' + $('#startDateCol').val()+ '&end_date=' + $('#endDateCol').val());
        });
    });
  </script>
</x-slot>
</x-organization::layout>

