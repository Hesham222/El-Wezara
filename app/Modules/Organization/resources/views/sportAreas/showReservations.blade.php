<x-organization::layout>

<x-slot name="pageTitle">الحجوزات | عرض</x-slot name="pageTitle">
@section('sport-areas-view-active', 'm-menu__item--active')

@section('sport-areas-active', 'm-menu__item--active m-menu__item--open')
@include('Organization::_modals.confirm_password')
    <x-slot name="style">
        <style type="text/css">
            .card {
                border-radius: 12px;
                box-shadow: 0 6px 10px -4px rgba(0, 0, 0, .15);
                background-color: gray;
                color: #fff;
                margin-bottom: 20px;
                position: relative;
                border: 0;
                transition: box-shadow .2s ease, -webkit-transform .3s cubic-bezier(.34, 2, .6, 1);
                transition: transform .3s cubic-bezier(.34, 2, .6, 1), box-shadow .2s ease;
                transition: transform .3s cubic-bezier(.34, 2, .6, 1), box-shadow .2s ease, -webkit-transform .3s cubic-bezier(.34, 2, .6, 1);
            }
            .card {
                display: flex;
                flex-direction: column;
                min-width: 0;
                word-wrap: break-word;
                background-clip: border-box;
            }
            .card-stats .card-body
            {
                padding: 15px 15px 0;
            }
            .card .card-body
            {
                padding: 15px 15px 10px;
            }
            .card-stats
            {
                position: relative;
                top: 0;
                transition: top ease 0.5s;
            }
            .card-stats:hover
            {
                top: -10px;
            }
            .card-body
            {
                flex: 1 1 auto;
                padding: 1.25rem;
            }
            .card-stats .card-body .numbers
            {
                text-align: right;
                font-size: 2em;
            }
            .card .numbers
            {
                font-size: 2em;
            }
            .card-stats .card-body .numbers .card-category
            {
                color: #9a9a9a;
                font-size: 16px;
                line-height: 1.4em;
            }
            .card-stats .card-body .numbers p
            {
                margin-bottom: 0;
            }
            .card-category
            {
                font-size: 1em;
            }

            .card-category,.category {
                text-transform: capitalize;
                font-weight: 400;
                color: #9a9a9a;
                font-size: .7142em;
            }

            .card-stats .card-body .numbers p
            {
                margin-bottom: 0;
            }
            .card-title
            {
                margin-bottom: .75rem;
            }
        </style>
    </x-slot>
    <!-- Start page content -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    الحجوزات
                </h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="row">
            <div class="col-xl-12">
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                   الحجوزات
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <section class="content">
                            <div class="row">
                                <div id="calendar"></div>
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
                                                                                        @if(isset($booking))

                                                                                        {{$booking->ExternalPricing->ActivityArea->name}}
                                                                                        @endif
                                                                                        <h4><span style="font-weight: bold">رقم الحجز</span> : <span id="booking_workspace"></span></h4>
                                                                                            @if(isset($booking))

                                                                                            {{--                                                        {{$booking->room->name}}--}}
                                                                                        {{--{{$booking->room->name}}--}}
                                                                                            @endif
                                                                                            <h4><span style="font-weight: bold">التاريخ</span> : <span id="booking_room"></span></h4>

                                                                                        <h4><span style="font-weight: bold">بدايه التوقيت</span> : <span id="booking_start"></span></h4>
                                                                                            @if(isset($booking))

                                                                                            {{--                                                        {{$booking->endDate}}--}}
                                                                                            @endif
                                                                                        <h4><span style="font-weight: bold">نهايه التوقيت</span> : <span id="booking_end"></span></h4>
                                                                                        <h4><span style="font-weight: bold">عدد الساعات</span> : <span id="num_of_hours"></span></h4>
                                                                                            @if(isset($booking))
                                                                                        {{--                                                        {{$booking->price}}--}}
                                                                                            @endif
                                                                                        <h4><span style="font-weight: bold">اجمالي السعر</span> : <span id="booking_price"></span></h4>
                                                                                            @if(isset($booking))
                                                                                        {{--                                                        {{$booking->created_at->diffForHumans()}}--}}
                                                                                            @endif
                                                                                        <h4><span style="font-weight: bold">نشأ في</span> : <span id="booking_created_at"></span></h4>
                                                                                            @if(isset($booking))

                                                                                            {{--                                                            <div>--}}
                                                                                        {{--                                                                <a href="{{ route('owners.reservation.destroy',$booking->id)}}" class="btn btn-primary">@lang('site.delete')</a>--}}
                                                                                        {{--                                                            </div>--}}
                                                                                            @endif
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
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="scripts">
        <!-- Some JS -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            $(document).ready(function (){
                 var bookings = @json($events) ;
                 //console.log( @json($events));
                $('#calendar').fullCalendar({
                    header:{
                        left:'prev,next today',
                        center:'title',
                        right:'month,agendaWeek,agendaDay'
                    },
                    events:bookings,
                    eventClick: function(event){
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url:'{{route('organizations.sportArea.show.Reservation')}}',
                            type:'post',
                            data:{"event_id":event.id},
                            dataType:'json',
                            success:function (res){
                                $('#booking_workspace').append().html(res.id);
                                $('#booking_room').append().html(res.date);
                                $('#booking_start').append().html(res.start_time);
                                $('#booking_end').append().html(res.end_time);
                                $('#num_of_hours').append().html(res.num_of_hours);
                                $('#booking_price').append().html(res.total);
                                $('#booking_created_at').append().html(res.created_at =new Date().toDateString());

                            }
                        });
                        $('#ReservationModal').modal('show');

                    },
                })
            })
        </script>





    </x-slot>
    <!-- End page content -->


</x-organization::layout>

