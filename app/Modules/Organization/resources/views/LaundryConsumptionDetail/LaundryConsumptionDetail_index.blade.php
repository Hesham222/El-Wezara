<x-organization::layout>
  <x-slot name="pageTitle">استهلاك المغسله تفصيليا | عرض</x-slot name="pageTitle">
  @section('LaundryConsumptions-active', 'm-menu__item--active')
  @section('LaundryConsumptions-view-active', 'm-menu__item--active')
    @section('LaundryConsumptions-active', 'm-menu__item--active m-menu__item--open')

    <x-slot name="style">
    <!-- Some styles -->
  </x-slot>
    <!-- Start page content -->
      <div class="m-subheader ">
        <div class="d-flex align-items-center">
          <div class="mr-auto">
            <h3 class="m-subheader__title ">
                استهلاك المغسله تفصيليا
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
                @include('Organization::LaundryConsumptionDetail.components.LaundryConsumptionDetailFilterForm')
                <div class="table-responsive">
                    <section class="content table-responsive">
                      <table id="data-table" class="table table-striped- table-bordered table-hover table-checkable" >
                          <thead>
                          <tr>
                              <th>التعريف</th>
                              <th>اسم مكون الوجبات</th>
                              <th> الكميه قبل الجرد</th>
                              <th> الكميه بعد الجرد</th>
                              <th> السعر قبل الجرد</th>
                              <th> السعر بعد الجرد</th>
                              <th>المستهلك</th>
                              <th>التفاصيل</th>
                              <th> نشأ في</th>

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
        render("{!! route('organizations.LaundryConsumptionDetail.data',['id'=>$record->id,'view' => request()->input('view',0)]) !!}");
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
            render("{!! route('organizations.LaundryConsumptionDetail.data',['id'=>$record->id,'view' => request()->input('view',0)]) !!}&column=" + $('#searchColumn').val() + '&value=' + $('#searchField').val()+ '&start_date=' + $('#startDateCol').val()+ '&end_date=' + $('#endDateCol').val());
        });
    });
  </script>
</x-slot>
</x-organization::layout>

