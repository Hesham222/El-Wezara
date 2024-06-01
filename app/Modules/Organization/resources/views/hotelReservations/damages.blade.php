<x-organization::layout>
  <x-slot name="pageTitle">اضرار الغرفه | عرض</x-slot name="pageTitle">
  @section('damage-view-active', 'm-menu__item--active')
@section('damage-active', 'm-menu__item--active m-menu__item--open')
  <x-slot name="style">
    <!-- Some styles -->
  </x-slot>
    <!-- Start page content -->
      <div class="m-subheader ">
        <div class="d-flex align-items-center">
          <div class="mr-auto">
            <h3 class="m-subheader__title ">
                اضرار الغرفه
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
                              @if(request()->query('view')=='trash')
                              <th>مسح بواسطه</th>
                              <th>مسح في</th>
                              @endif
                              <th>الضرر</th>
                              <th>التكلفه</th>
                              <th> المسؤول</th>
                              <th>نشأ في</th>
                          </tr>
                          </thead>

                          <tbody>
                              @foreach($records as $record)
                                  <tr>
                                      <td>{{$record ->id}}</td>
                                      <td>{{$record ->damage}}</td>
                                      <td>{{$record ->amount}}</td>
                                      <td>{{$record->createdBy?$record->createdBy->name:"لا يوجد"}}</td>
                                      <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>

                                  </tr>
                              @endforeach

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

</x-slot>
</x-organization::layout>

