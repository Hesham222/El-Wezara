<x-organization::layout>

  <x-slot name="pageTitle">العميل | عرض</x-slot name="pageTitle">
  @section('customers-view-active', 'm-menu__item--active')

@section('customers-active', 'm-menu__item--active m-menu__item--open')
@include('Organization::_modals.confirm_password')
  <x-slot name="style">
    <!-- Some styles -->
  </x-slot>
    <!-- Start page content -->
      <div class="m-subheader ">
        <div class="d-flex align-items-center">
          <div class="mr-auto">
            <h3 class="m-subheader__title ">
                العميل
            </h3>
          </div>
        </div>
      </div>
    <div class="m-content">
        <div class="row">
            <div class="col-xl-6">
                <div class="m-portlet m-portlet--full-height " >
                    <div class="m-portlet__head" style="background:#212529;">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text" style="color:#fff">
                                    بيانات العميل
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <section class="content">
                            <ul class="personal_info">
                                <li>
                                    <span style="font-weight:bold">الاسم : </span>
                                    {{$record->name?$record->name:"لا يوجد" }}
                                </li>
                                <li>
                                    <span style="font-weight:bold">نوع العميل : </span>
                                    {{$record->CustomerType?$record->CustomerType->name:"لا يوجد"}}
                                </li>
                                <li>
                                    <span style="font-weight:bold">رقم التليفون : </span>
                                    {{$record->phone?$record->phone:"لا يوجد"}}
                                </li>
                                <li>
                                    <span style="font-weight:bold"> البريد الالكتروني : </span>
                                    {{$record->email?$record->email :"لا يوجد"}}
                                </li>
                                <li>
                                    <span style="font-weight:bold">النوع : </span>
                                    {{$record->gender?$record->gender:"لا يوجد"}}
                                </li>
                                <li>
                                    <span style="font-weight:bold">العنوان : </span>
                                    {{$record->address?$record->address:"لا يوجد"}}
                                </li>
                                <li>
                                    <span style="font-weight:bold"> تاريخ الميلاد : </span>
                                    {{$record->date_of_birth?$record->date_of_birth:"لا يوجد"}}
                                </li>
                                <li>
                                    <span style="font-weight:bold">جنسية: </span>
                                     {{$record->nationality?$record->nationality:"لا يوجد"}}
                                </li>
                                <li>
                                    <span style="font-weight:bold">اجمالي المبالغ المتبقيه: </span>
                                    {{$total_remaining}}
                                </li>
                            </ul>
                        </section>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="m-portlet m-portlet--full-height " >
                    <div class="m-portlet__head" style="background:#212529;">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text" style="color:#fff">
                                    الملفات المرفوعه
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <section class="content">
                            <div class="row">
                                <div class="col-md-3">
                                    <table>
                                        <thead>
                                            <tr>
                                                @foreach($record->CustomerType->information as $info)
                                                    <th>{{$info->title}}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            @foreach($record->CustomerData as $data)
                                                @if($data)
                                                    @if(pathinfo($data->attachment, PATHINFO_EXTENSION) == 'pdf')
                                                        <td>

                                                            <a target="_blank" href="{{asset('storage'.DS().$data->attachment)}}">View pdf</a>
                                                            <input type="hidden" name="pdf" value="{{ $data->attachment}}">
                                                        </td>
                                                    @else
                                                        @if(filter_var($data->attachment, FILTER_VALIDATE_URL))
                                                            <td>
                                                                <img src="{{ $data->attachment }}" alt="image-not-uploaded" width="100"></td>

                                                            </td>
                                                        @else
                                                            <td>
                                                                <img src="{{asset('storage'.DS().$data->attachment)}}" alt="image-not-uploaded" width="100"></td>

                                                            </td>
                                                        @endif
                                                    @endif
                                                @endif

                                            @endforeach
                                                @foreach($record->CustomerData as $data)
                                                    <td>
                                                    @if(isset($data->text))
                                                        {{$data->text}}
                                                    @endif
                                                    </td>
                                                @endforeach
                                        </tr>
                                        </tbody>
                                    <tbody>

                                    </tbody>
                                    </table>
{{--                                    <ul class="personal_info">--}}
{{--                                        @foreach($record->CustomerData as $data)--}}
{{--                                                @if($data)--}}
{{--                                                    @if(pathinfo($data->attachment, PATHINFO_EXTENSION) == 'pdf')--}}
{{--                                                    <li>--}}

{{--                                                        <a target="_blank" href="{{asset('storage'.DS().$data->attachment)}}">View pdf</a>--}}
{{--                                                        <input type="hidden" name="pdf" value="{{ $data->attachment}}">--}}
{{--                                                    </li>--}}
{{--                                                    @else--}}
{{--                                                        @if(filter_var($data->attachment, FILTER_VALIDATE_URL))--}}
{{--                                                            <img src="{{ $data->attachment }}" alt="image-not-uploaded" width="100"></td>--}}
{{--                                                        @else--}}
{{--                                                            <img src="{{asset('storage'.DS().$data->attachment)}}" alt="image-not-uploaded" width="100"></td>--}}
{{--                                                        @endif--}}
{{--                                                    @endif--}}
{{--                                                @endif--}}



{{--                                        @endforeach--}}
{{--                                    </ul>--}}
{{--                                    <ul>--}}
{{--                                            @foreach($record->CustomerData as $data)--}}

{{--                                            @if(isset($data->text))--}}
{{--                                                    {{$data->text}}--}}
{{--                                            @endif--}}
{{--                                        @endforeach--}}
{{--                                    </ul>--}}
                                </div>

{{--                                <ul class="personal_info">--}}
{{--                                    @foreach($record->CustomerType->information as $info)--}}
{{--                                        <li>{{$info->title}}</li>--}}
{{--                                    @endforeach--}}

{{--                                </ul>--}}
                            </div>

                        </section>
                    </div>
                </div>
            </div>
        </div>
        <div class="dataTables_wrapper">
            <div class="row">
                <div class="col-xl-12">
                    <div class="m-portlet m-portlet--full-height " >
                        <div class="m-portlet__body">
                            <section  class="content">
                                <div  class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li style="margin-left: 10px" class="active"><a href="#tab_1" data-toggle="tab">الفندق</a></li>

                                        <li style="margin-left: 10px"><a href="#tab_2" data-toggle="tab">المناسبات</a></li>

                                        <li style="margin-left: 10px"><a href="#tab_3" data-toggle="tab">الانشطه الرياضيه</a></li>
                                        <li style="margin-left: 10px"><a href="#tab_4" data-toggle="tab">الحجوزات الخارجيه</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1">
                                            <table style="border-spacing: 10px; border-collapse:separate">
                                                <thead>
                                                    <tr>
                                                        <th>التعريف </th>
                                                        <th>نوع الغرفه</th>
                                                        <th>تاريخ الوصول</th>
                                                        <th>تاريخ المغادره</th>
                                                        <th>عدد الليالي </th>
                                                        <th>رقم الغرفه </th>
                                                        <th> نشأ في</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($record->HotelReservations as $reservation)
                                                <tr>
                                                    <td>{{$reservation->id?$reservation->id:"لا يوجد"}}</td>
                                                    <td>{{$reservation->RoomType?$reservation->RoomType->name:"لا يوجد"}}</td>
                                                    <td>{{$reservation->arrival_date?$reservation->arrival_date:"لا يوجد"}}</td>
                                                    <td>{{$reservation->departure_date?$reservation->departure_date :"لا يوجد"}}</td>
                                                    <td>{{$reservation->num_of_nights?$reservation->num_of_nights:"لا يوجد"}}</td>
                                                    <td>{{$reservation->Room?$reservation->Room->room_num:"لا يوجد"}}</td>
                                                    <td>{{ date('M d, Y', strtotime($reservation->created_at)) .'-'.date('h:i a', strtotime($reservation->created_at)) }}</td>

                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="tab_2">
                                            <table style="border-spacing: 10px; border-collapse:separate">
                                                <thead>
                                                <tr>
                                                    <th>التعريف </th>
                                                    <th>اسم الحزمه</th>
                                                    <th>نوع المناسبه</th>
                                                    <th>تاريخ الحجز</th>
                                                    <th>تاريخ الاستحقاق </th>
                                                    <th>من </th>
                                                    <th>الى </th>
                                                    <th> نشأ في</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($record->Reservations as $reservation)
                                                    <tr>
                                                        <td>{{$reservation->id?$reservation->id:"لا يوجد"}}</td>
                                                        <td>{{$reservation->package?$reservation->package->name:"لا يوجد"}}</td>
                                                        <td>{{$reservation->eventType?$reservation->eventType->name:"لا يوجد"}}</td>
                                                        <td>{{$reservation->booking_date?$reservation->booking_date :"لا يوجد"}}</td>
                                                        <td>{{$reservation->payment_due_date?$reservation->payment_due_date:"لا يوجد"}}</td>
                                                        <td>{{$reservation->from?$reservation->from:"لا يوجد"}}</td>
                                                        <td>{{$reservation->to?$reservation->to:"لا يوجد"}}</td>
                                                        <td>{{ date('M d, Y', strtotime($reservation->created_at)) .'-'.date('h:i a', strtotime($reservation->created_at)) }}</td>

                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="tab_3">
                                            <table style="border-spacing: 10px; border-collapse:separate">
                                                <thead>
                                                <tr>
                                                    <th>التعريف </th>
                                                    <th>اسم التدريب</th>
                                                    <th>تاريخ الاشتراك</th>
                                                    <th>عدد الجلسات</th>
                                                    <th> نشأ في</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($record->Subscriptions as $subscription)
                                                    <tr>
                                                        <td>{{$subscription->id?$subscription->id:"لا يوجد"}}</td>
                                                        <td>{{$subscription->Training?$subscription->Training->name:"لا يوجد"}}</td>
                                                        <td>{{$subscription->pricing_name?$subscription->pricing_name:"لا يوجد"}}</td>
                                                        <td>{{$subscription->session_balance?$subscription->session_balance:"لا يوجد"}}</td>
                                                        <td>{{ date('M d, Y', strtotime($subscription->created_at)) .'-'.date('h:i a', strtotime($subscription->created_at)) }}</td>

                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                        <!-- /.tab-pane -->
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="tab_4">
                                            <table style="border-spacing: 10px; border-collapse:separate">
                                                <thead>
                                                <tr>
                                                    <th>التعريف </th>
                                                    <th>مساحه النشاط الرياضي</th>
                                                    <th>عدد الساعات</th>
                                                    <th>التاريخ</th>
                                                    <th>بدايه التوقيت</th>
                                                    <th>نهايه التوقيت</th>
                                                    <th> نشأ في</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($record->ExternalReservations as $reservation)
                                                    <tr>
                                                        <td>{{$reservation->id?$reservation->id:"لا يوجد"}}</td>
                                                        <td>{{$reservation->ExternalPricing->ActivityArea?$reservation->ExternalPricing->ActivityArea->name:"لا يوجد"}}</td>
                                                        <td>{{$reservation->num_of_hours?$reservation->num_of_hours:"لا يوجد"}}</td>
                                                        <td>{{$reservation->date?$reservation->date:"لا يوجد"}}</td>
                                                        <td>{{$reservation->start_time?$reservation->start_time:"لا يوجد"}}</td>
                                                        <td>{{$reservation->end_time?$reservation->end_time:"لا يوجد"}}</td>
                                                        <td>{{ date('M d, Y', strtotime($reservation->created_at)) .'-'.date('h:i a', strtotime($reservation->created_at)) }}</td>

                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div>
                            </section>
                        </div>
                    </div>

                </div>

                <!-- nav-tabs-custom -->

            </div>
        </div>

    </div>

    <!-- End page content -->
<x-slot name="scripts">
  <script>
    $(function () {
        render("{!! route('organizations.trainingReport.data',['view' => request()->input('view',0)]) !!}");
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
            render("{!! route('organizations.trainingReport.data',['view' => request()->input('view',0)]) !!}&column=" + $('#searchColumn').val() + '&value=' + $('#searchField').val()+ '&start_date=' + $('#startDateCol').val()+ '&end_date=' + $('#endDateCol').val()+'&day=' + $('#dayCol').val());
        });
    });
  </script>
</x-slot>
</x-organization::layout>

