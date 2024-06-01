<x-admin::layout>
@if(request()->input('view')=='trash')
  <x-slot name="pageTitle">المشرفين | سلة المهملات</x-slot name="pageTitle">
  @section('calendar-view-active', 'm-menu__item--active')
@else
  <x-slot name="pageTitle">المشرفين | عرض</x-slot name="pageTitle">
  @section('calendar-view-active', 'm-menu__item--active')
@endif
@section('calendar-view-active', 'm-menu__item--active m-menu__item--open')
@include('Admin::_modals.confirm_password')
@include('Admin::_modals.reset_admin_password')
  <x-slot name="style">
    <!-- Some styles -->
  </x-slot>
    <!-- Start page content -->
      <div class="m-subheader ">
        <div class="d-flex align-items-center">
          <div class="mr-auto">
            <h3 class="m-subheader__title ">
                المشرفين
            </h3>
          </div>
        </div>
      </div>
      <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
          <div class="m-portlet__body">
              <div id="calendar"></div>
          </div>
        </div>
      </div>

    <div class="modal fade" id="ReservationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reservation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="m-portlet__body">
                        <div class="all-content-wrapper">
                            <!-- Single pro tab start-->
                            <div class="single-product-tab-area mg-t-0 mg-b-30">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="single-product-pr">
                                                <div class="row">
                                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                                        <div class="single-product-details res-pro-tb">
                                                            <h4><span style="font-weight: bold">Title</span> : <span id="booking_user"></span></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single pro tab End-->
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {{--                                        <button type="button" class="btn btn-primary">Save changes</button>--}}
                </div>
            </div>
        </div>
    </div>

    <!-- End page content -->
<x-slot name="scripts">


    <script>
        $(document).ready(function (){
            var bookings = [
                {title: 'Event 1', start: '2022-07-05 12:00', end: '2022-07-05 02:00'},
                {title: 'Event 4', start: '2022-07-05 12:00', end: '2022-07-05 02:00'},
                {title: 'Event 5', start: '2022-07-05 12:00', end: '2022-07-05 02:00'},
                {title: 'Event 2', start: '2022-07-06 02:00', end: '2022-07-06 03:00'},
                {title: 'Event 3', start: '2022-07-07 12:00', end: '2022-07-07 01:00'}
            ]
            $('#calendar').fullCalendar({
                header:{
                    left:'prev,next today',
                    center:'title',
                    right:'month,agendaWeek,agendaDay'
                },
                events:bookings,
                eventClick: function(event){
                    console.log(event)
                    $('#booking_user').append().html(event.title);
                    $('#ReservationModal').modal('show');
                }
            })
        })
    </script>


</x-slot>
</x-admin::layout>
