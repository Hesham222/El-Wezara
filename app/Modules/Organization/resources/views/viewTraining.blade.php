<x-organization::layout>

  <x-slot name="pageTitle">التدريب | عرض</x-slot name="pageTitle">

@include('Organization::_modals.confirm_password')
  <x-slot name="style">
    <!-- Some styles -->
  </x-slot>
    <!-- Start page content -->
      <div class="m-subheader ">
        <div class="d-flex align-items-center">
          <div class="mr-auto">
            <h3 class="m-subheader__title ">
                التدريب
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
                              <th>اسم التدريب</th>
                              <th>اسم المدرب</th>
                              <th>عدد المشتركين </th>

                          </tr>
                          </thead>
                          <tbody id="spinner">
                            <tr>
                                <td style="height: 100px;text-align: center;line-height: 100px;" colspan="8">
                                    <i class="fa fa-spinner fa-spin text-primary" style="font-size: 30px"aria-hidden="true"></i>
                                </td>
                            </tr>
                          </tbody>
                                  <tr id="tableRecord">
                                      @foreach($record as $training)
                                      <td>{{$training->id}}</td>
                                      <td>{{$training->name}}</td>
                                      <td>{{$training->FreelanceTrainer->name}}</td>
                                      <td>{{$no_subscribers}}</td>
                                      @endforeach
                                  </tr>

                     </table>
                        <br>
                      <table id="data-table" class="table table-striped- table-bordered table-hover table-checkable" >
                            <thead>
                            <tr>
                                <th>اليوم </th>
                                <th>وقت البدايه </th>
                                <th>وقت النهايه </th>
                                <th>التاريخ </th>
                            </tr>
                            </thead>
                            @if(count($record))
                                @foreach($record as $tr)
                                    @foreach($tr->Schedules as $schedule)

                                    <tr id="tableRecord}">
                                        <td>{{$schedule->day}}</td>
                                        <td>{{$schedule->start_time}}</td>
                                        <td>{{$schedule->end_time}}</td>
                                        <td>{{$schedule->date}}</td>
                                    </tr>
                                    @endforeach
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

