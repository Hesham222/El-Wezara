<x-organization::layout>
    @if(request()->input('view')=='trash')
  <x-slot name="pageTitle">التذاكر  | سله المهملات</x-slot name="pageTitle">
  @section('tickets-trash-active', 'm-menu__item--active')
@else
  <x-slot name="pageTitle">التذاكر | عرض</x-slot name="pageTitle">
  @section('tickets-view-active', 'm-menu__item--active')
@endif
@section('tickets-active', 'm-menu__item--active m-menu__item--open')
@include('Organization::_modals.confirm_password')
  <x-slot name="style">
    <!-- Some styles -->
  </x-slot>
        <audio id="audio">
            <source
                src="{{asset('audios/finish.mp3')}}"
                type="audio/mp3">
            Your browser does not support the audio element.
        </audio>
    <!-- Start page content -->
      <div class="m-subheader ">
        <div class="d-flex align-items-center">
          <div class="mr-auto">
            <h3 class="m-subheader__title ">
                 التذاكر
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
                  @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Ticket-Add'))
                  <li class="m-portlet__nav-item">
                  <a href="{{route('organizations.ticket.create')}}"
                    class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                    <span>
                      <i class="la la-plus">
                      </i>
                      <span>أضف تذكرة جديد</span>
                    </span>
                  </a>
                </li>
                  @endif
              </ul>
            </div>
          </div>
          <div class="m-portlet__body">
             <section class="content">
                @include('Organization::tickets.components.filterForm')
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
                              <th>فئة التذكرة الرئيسية</th>
                              <th>فئة التذكرة</th>
                              <th>البوابة</th>
                              <th>السعر</th>
                              <th>نشأ بواسطه</th>
                              <th>نشأ في</th>
                              <th>أجراءات</th>
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
    <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase.js"></script>
    <!-- TODO: Add SDKs for Firebase products that you want to use
         https://firebase.google.com/docs/web/setup#available-libraries -->
    <script>
        const firebaseConfig = {
            apiKey: "AIzaSyC8DLRFXYnXOIzArR6J8scaEDCV04Mhjwg",
            authDomain: "elwezara-f65c8.firebaseapp.com",
            databaseURL: "https://elwezara-f65c8-default-rtdb.europe-west1.firebasedatabase.app",
            projectId: "elwezara-f65c8",
            storageBucket: "elwezara-f65c8.appspot.com",
            messagingSenderId: "786098861409",
            appId: "1:786098861409:web:fe7269d4a3e1f461b0c120"
        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);


        $(document).ready(function () {
            firebase.database().ref('carts').on('value', function (snapshot) {
                snapshot.forEach(function (child) {
                    @if(auth('organization_admin')->user())
                    if (child.val()['order'] == 1) {
                        snapshot.ref.remove();
                        audio = document.getElementById('audio');
                        audio.play();
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    }
                    @endif
                })
            })
        });
    </script>
  <script>
    $(function () {
        render("{!! route('organizations.ticket.data',['view' => request()->input('view',0)]) !!}");
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
            render("{!! route('organizations.ticket.data',['view' => request()->input('view',0)]) !!}&column=" + $('#searchColumn').val() + '&value=' + $('#searchField').val()+ '&start_date=' + $('#startDateCol').val()+ '&end_date=' + $('#endDateCol').val());
        });
    });
  </script>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
</x-slot>
</x-organization::layout>

