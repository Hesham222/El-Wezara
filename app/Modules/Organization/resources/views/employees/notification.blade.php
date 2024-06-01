<x-organization::layout>
  <x-slot name="pageTitle">الاشعارات | عرض</x-slot name="pageTitle">
    @section('employee-active', 'm-menu__item--active m-menu__item--open')
  <x-slot name="style">
    <!-- Some styles -->
  </x-slot>
    <!-- Start page content -->
      <div class="m-subheader ">
        <div class="d-flex align-items-center">
          <div class="mr-auto">
            <h3 class="m-subheader__title ">
                الاشعارات
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
                                  @if(isset($national_remain))
                                      <th>متبقي على انتهاء الرقم القومي</th>
                                  @endif
                                  @if(isset($health_remain))
                                      <th>متبقي على انتهاء الشهاده الصحية</th>
                                  @endif
                                  @if(isset($contract_remain))
                                      <th>متبقي على انتهاء عقد الموظف</th>
                                  @endif
                                  @if(isset($vacation_end))
                                      <th>متبقي على الاجازه  </th>
                                  @endif
                          </tr>
                          </thead>

                          @if(isset($record))

                                  <tr id="tableRecord-{{$record->id}}">
                                      @if(isset($national_remain))
                                          <td>{{$national_remain}}  - يوم</td>
                                      @endif
                                      @if(isset($health_remain))
                                          <td>{{$health_remain}}  - يوم</td>
                                      @endif
                                      @if(isset($contract_remain))
                                          <td> {{$contract_remain}}  - يوم</td>
                                      @endif
                                      @if(isset($vacation_end))
                                          <td> {{$vacation_end}}  - يوم</td>
                                      @endif
                                  </tr>

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

</x-slot>
</x-organization::layout>

