<x-organization::layout>
<x-slot name="pageTitle">الرئيسية</x-slot name="pageTitle">
    @section('events-dashboard-active', 'm-menu__item--active m-menu__item--open')
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
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    الصفحة الرئيسية
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
                                    لوحة التحكم
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <section class="content">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="card card-stats">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-5 col-md-4">
                                                    <div style="margin-top: 10px;" class="icon-big  icon-warning"><i
                                                            class="fa fa-gift"></i></div>
                                                </div>
                                                <div class="col-7 col-md-8">
                                                    <div class="numbers">
                                                        <p class="card-title">{{$statistics['weeklyReservations']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#">
                                            <div class="card-footer ">
                                                <a href="#">
                                                    <div class="stats" style="color:#fff;font-weight: bold;"><i
                                                            class="fa fa-calendar-o"></i>حجوزات الاسبوع
                                                    </div>
                                                </a>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="card card-stats" style="background-color: black;">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-5 col-md-4">
                                                    <div style="margin-top: 10px;" class="icon-big  icon-warning"><i
                                                            class="fa fa-balance-scale"></i></div>
                                                </div>
                                                <div class="col-7 col-md-8">
                                                    <div class="numbers">
                                                        <p class="card-title">{{$statistics['weeklyEvents']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <div class="stats" style="font-weight: bold;"><i
                                                    class="fa fa-calendar-o"></i>حفالات الاسبوع
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="card card-stats">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-5 col-md-4">
                                                    <div style="margin-top: 10px;" class="icon-big  icon-warning"><i
                                                            class="fa fa-gift"></i></div>
                                                </div>
                                                <div class="col-7 col-md-8">
                                                    <div class="numbers">
                                                        <p class="card-title">{{$statistics['monthlyActual']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#">
                                            <div class="card-footer ">
                                                <a href="#">
                                                    <div class="stats" style="color:#fff;font-weight: bold;"><i
                                                            class="fa fa-calendar-o"></i>مبلغ الحجوزات شهريا
                                                    </div>
                                                </a>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="card card-stats" style="background-color: black;">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-5 col-md-4">
                                                    <div style="margin-top: 10px;" class="icon-big  icon-warning"><i
                                                            class="fa fa-balance-scale"></i></div>
                                                </div>
                                                <div class="col-7 col-md-8">
                                                    <div class="numbers">
                                                        <p class="card-title">{{$statistics['monthlyPaid']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <div class="stats" style="font-weight: bold;"><i
                                                    class="fa fa-calendar-o"></i>المدفوعات شهريا
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="card card-stats">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-5 col-md-4">
                                                    <div style="margin-top: 10px;" class="icon-big  icon-warning"><i
                                                            class="fa fa-gift"></i></div>
                                                </div>
                                                <div class="col-7 col-md-8">
                                                    <div class="numbers">
                                                        <p class="card-title">{{$statistics['monthlyRemaining']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#">
                                            <div class="card-footer ">
                                                <a href="#">
                                                    <div class="stats" style="color:#fff;font-weight: bold;"><i
                                                            class="fa fa-calendar-o"></i>المبالغ المستحقه شهريا
                                                    </div>
                                                </a>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="card card-stats" style="background-color: black;">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-5 col-md-4">
                                                    <div style="margin-top: 10px;" class="icon-big  icon-warning"><i
                                                            class="fa fa-balance-scale"></i></div>
                                                </div>
                                                <div class="col-7 col-md-8">
                                                    <div class="numbers">
                                                        <p class="card-title">{{$statistics['supplier_remaining_amount']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <div class="stats" style="font-weight: bold;"><i
                                                    class="fa fa-calendar-o"></i>المبالغ المستحقه للموردين شهريا
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div id="calendar"></div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--    modal--}}
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

                                                            <h4><span style="font-weight: bold">رقم الحجز</span> : <span id="booking_workspace"></span></h4>
                                                            @if(isset($booking))

                                                                {{--                                                        {{$booking->room->name}}--}}
                                                                {{--{{$booking->room->name}}--}}
                                                            @endif
                                                            <h4><span style="font-weight: bold">تاريخ المناسبه</span> : <span id="booking_room"></span></h4>



                                                            <h4><span style="font-weight: bold">بدايه التوقيت</span> : <span id="booking_start"></span></h4>
                                                            @if(isset($booking))

                                                                {{--                                                        {{$booking->endDate}}--}}
                                                            @endif
                                                            <h4><span style="font-weight: bold">نهايه التوقيت</span> : <span id="booking_end"></span></h4>
                                                            @if(isset($booking))
                                                                {{--                                                        {{$booking->price}}--}}
                                                            @endif
                                                            <h4><span style="font-weight: bold">المبلغ المدفوع</span> : <span id="paid_price"></span></h4>
                                                            <h4><span style="font-weight: bold">المبلغ التبقي</span> : <span id="remaining_amount"></span></h4>
                                                            <h4><span style="font-weight: bold">المبلغ الفعلي</span> : <span id="actual_price"></span></h4>
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
    {{--    modal--}}

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
                            url:'{{route('organizations.events.show.Reservation')}}',
                            type:'post',
                            data:{"event_id":event.id},
                            dataType:'json',
                            success:function (res){
                                $('#booking_workspace').append().html(res.id);
                                $('#booking_room').append().html(res.booking_date);
                                $('#booking_start').append().html(res.from);
                                $('#booking_end').append().html(res.to);
                                $('#paid_price').append().html(res.paid_amount);
                                $('#remaining_amount').append().html(res.remaining_amount);
                                $('#actual_price').append().html(res.actual_price);
                                $('#booking_created_at').append().html(res.created_at =new Date().toDateString());

                            }
                        });
                        $('#ReservationModal').modal('show');

                    },
                })
            })
        </script>
    </x-slot>
    </x-organization::layout>
