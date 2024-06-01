<x-organization::layout>
    @if(request()->input('view')=='trash')
  <x-slot name="pageTitle">المدفوعات  | سله المهملات</x-slot name="pageTitle">
  @section('payments-trash-active', 'm-menu__item--active')
@else
  <x-slot name="pageTitle">المدفوعات | عرض</x-slot name="pageTitle">
  @section('payments-view-active', 'm-menu__item--active')
@endif
@section('payments-active', 'm-menu__item--active m-menu__item--open')
@include('Organization::_modals.confirm_password')
  <x-slot name="style">
    <!-- Some styles -->
  </x-slot>
    <!-- Start page content -->
      <div class="m-subheader ">
        <div class="d-flex align-items-center">
          <div class="mr-auto">
            <h3 class="m-subheader__title ">
                المدفوعات
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
                  @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Subscription-Add'))
                  <li class="m-portlet__nav-item">
                      <a href="{{route('organizations.payment.create')}}"
                        class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                          <i class="la la-plus">
                          </i>
                          <span>إضافة الدفع</span>
                        </span>
                      </a>
                    </li>
                  @endif
              </ul>
            </div>
          </div>
          <div class="m-portlet__body">
             <section class="content">
                @include('Organization::payments.components.filterForm')
                <div class="table-responsive">
                    <section class="content table-responsive">
                      <table id="data-table" class="table table-striped- table-bordered table-hover table-checkable" >
                          <thead>
                          <tr>
                              <th>التعريف</th>
                              @if(request()->query('view')=='trash')
                              <th>مسح بواسطه</th>
                              <th>مسح في</th>
                              @endif
                              <th>اسم المشترك</th>
                              <th>اسم الاشتراك</th>
                              <th>مبلغ السداد </th>
                              <th>مبلغ الدفع</th>
                              <th>طريقة الدفع او السداد </th>
                              <th>أنشئت في</th>
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
        render("{!! route('organizations.payment.data',['view' => request()->input('view',0)]) !!}");
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
            render("{!! route('organizations.payment.data',['view' => request()->input('view',0)]) !!}&column=" + $('#searchColumn').val() + '&value=' + $('#searchField').val()+ '&start_date=' + $('#startDateCol').val()+ '&end_date=' + $('#endDateCol').val()+ '&subscriber=' + $('#subscriberColumn').val()+ '&price_name=' + $('#price_nameColumn').val());
        });
    });
  </script>
</x-slot>
</x-organization::layout>

