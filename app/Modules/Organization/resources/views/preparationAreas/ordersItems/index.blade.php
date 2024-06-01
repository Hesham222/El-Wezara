<x-organization::layout>
    @if(request()->input('view')=='trash')
  <x-slot name="pageTitle">المنتججات المطلوب تجهيزها | سله المهملات</x-slot name="pageTitle">
  @section('preparationAreas-trash-active', 'm-menu__item--active')
@else
  <x-slot name="pageTitle">المنتججات المطلوب تجهيزها | عرض</x-slot name="pageTitle">
  @section('preparationAreas-view-active', 'm-menu__item--active')
@endif
@section('preparationAreas-active', 'm-menu__item--active m-menu__item--open')
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
                المنتجات المطلوب تجهيزها
            </h3>
            <a style="margin-right: 898px;" href="{{ route('organizations.prepAreaNotification.index',$record->id) }}" class="btn btn-primary"><span>{{ $record->notification_count() }}</span><i class="fa fa-bell"></i></a>
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
                @include('Organization::preparationAreas.ordersItems.components.filterForm')
                <div class="table-responsive">
                    <section class="content table-responsive">
                      <table id="data-table" class="table table-striped- table-bordered table-hover table-checkable" >
                          <thead>
                          <tr>
                              <th>رقم تعريف المنتج </th>
                              <th>الاسم</th>
                              <th>الكمية</th>
                              <th>رقم تعريف الاوردر</th>
                              <th>  اسم نقطة البيع / مناسبات</th>
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
      <input type="hidden" name="area_id" id="area_id" value="{{ $record->id }}"/>
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
          var id = $("#area_id").val();
         // alert(id);
            firebase.database().ref('carts').on('value', function (snapshot) {
                snapshot.forEach(function (child) {
                    @if(auth('organization_admin')->user())
                    if (child.val()['area_id'] == id) {
                //  alert('done');
                        snapshot.ref.remove();
                        audio = document.getElementById('audio');
                        audio.play();
                        setTimeout(function () {
                            location.reload();
                            toastr.success(" تم اضافة وجبة الى قائمه الوجبات المراد تحضيرها ");
                        }, 2000);
                    }
                    @endif
                })
            })
        });
    </script>
  <script>
    $(function () {
        render("{!! route('organizations.preparationArea.orders.items.data',['id'=>$record->id,'view' => request()->input('view',0)]) !!}");
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
            render("{!! route('organizations.preparationArea.orders.items.data',['id'=>$record->id,'view' => request()->input('view',0)]) !!}&column=" + $('#searchColumn').val() + '&value=' + $('#searchField').val()+ '&start_date=' + $('#startDateCol').val()+ '&end_date=' + $('#endDateCol').val());
        });
    });
  </script>
</x-slot>
</x-organization::layout>

