<x-organization::layout>

  <x-slot name="pageTitle">تفاصيل الأشتراكات | عرض</x-slot name="pageTitle">
  @section('revenueSports-view-active', 'm-menu__item--active')

@section('revenueSports-active', 'm-menu__item--active m-menu__item--open')
@include('Organization::_modals.confirm_password')
  <x-slot name="style">
    <!-- Some styles -->
  </x-slot>
    <!-- Start page content -->
      <div class="m-subheader ">
        <div class="d-flex align-items-center">
          <div class="mr-auto">
            <h3 class="m-subheader__title ">
                تفاصيل الأشتراكات
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
                              <th>اسم الاشتراك</th>
                              <th>اسم المشترك</th>
                              <th>اسم التدريب</th>
                          </tr>
                          </thead>
                          <tbody id="spinner">
                            <tr>
                                <td style="height: 100px;text-align: center;line-height: 100px;" colspan="8">
                                    <i class="fa fa-spinner fa-spin text-primary" style="font-size: 30px"aria-hidden="true"></i>
                                </td>
                            </tr>
                          </tbody>
                          @if(count($records))
                              @foreach($records as $record)

                                  <tr id="tableRecord-{{$record->id}}">
                                      <td>{{$record->id?$record->id:"لا يوجد"}}</td>
                                      <td>{{$record->pricing_name?$record->pricing_name:"لا يوجد"}}</td>
                                      <td>{{$record->Subscriber?$record->Subscriber->name:"لا يوجد"}}</td>
                                      <td>{{$record->Training?$record->Training->name:"لا يوجد"}}</td>

                                  </tr>
                              @endforeach
                          @else
                              <tr>
                                  <td colspan="8" style="text-align:center;">
                                      لا توجد سجلات تطابق المدخلات الخاصة بك.
                                  </td>
                              </tr>
                          @endif                      </table>
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
        render("{!! route('organizations.revenueSport.data',['view' => request()->input('view',0)]) !!}");
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
            render("{!! route('organizations.revenueSport.data',['view' => request()->input('view',0)]) !!}&column=" + $('#searchColumn').val() + '&value=' + $('#searchField').val()+ '&start_date=' + $('#startDateCol').val()+ '&end_date=' + $('#endDateCol').val()+'&day=' + $('#dayCol').val());
        });
    });
  </script>
</x-slot>
</x-organization::layout>

