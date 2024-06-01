<x-admin::layout>
    <x-slot name="pageTitle">الرئيسية</x-slot name="pageTitle">
    @section('dashboard-active', 'm-menu__item--active')
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
                    الانشطه الرياضية
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
                                    لوحة التحكم الانشطة الرياضية
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <section class="content">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="card card-stats">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-5 col-md-4">
                                                    <div style="margin-top: 10px;" class="icon-big  icon-warning"><i
                                                            class="fa fa-gift"></i></div>
                                                </div>
                                                <div class="col-7 col-md-8">
                                                    <div class="numbers">
                                                        <p class="card-title">{{$stats['playings']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#">
                                            <div class="card-footer ">
                                                <a href="#">
                                                    <div class="stats" style="color:#fff;font-weight: bold;"><i
                                                            class="fa fa-calendar-o"></i>عدد الملاعب
                                                    </div>
                                                </a>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="card card-stats" style="background-color: black;">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-5 col-md-4">
                                                    <div style="margin-top: 10px;" class="icon-big  icon-warning"><i
                                                            class="fa fa-balance-scale"></i></div>
                                                </div>
                                                <div class="col-7 col-md-8">
                                                    <div class="numbers">
                                                        <p class="card-title">{{$stats['sports']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <div class="stats" style="font-weight: bold;"><i
                                                    class="fa fa-calendar-o"></i>عدد الرياضات
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="card card-stats">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-5 col-md-4">
                                                    <div style="margin-top: 10px;" class="icon-big  icon-warning"><i
                                                            class="fa fa-balance-scale"></i></div>
                                                </div>
                                                <div class="col-7 col-md-8">
                                                    <div class="numbers">
                                                        <p class="card-title">{{$stats['trainers']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <div class="stats" style="font-weight: bold;"><i
                                                    class="fa fa-calendar-o"></i>عدد المدربين
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="card card-stats">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-5 col-md-4">
                                                    <div style="margin-top: 10px;" class="icon-big  icon-warning"><i
                                                            class="fa fa-gift"></i></div>
                                                </div>
                                                <div class="col-7 col-md-8">
                                                    <div class="numbers">
                                                        <p class="card-title"> {{$stats['tranings']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#">
                                            <div class="card-footer ">
                                                <a href="#">
                                                    <div class="stats" style="color:#fff;font-weight: bold;"><i
                                                            class="fa fa-calendar-o"></i>عدد التدريبات
                                                    </div>
                                                </a>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="card card-stats" style="background-color: black;">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-5 col-md-4">
                                                    <div style="margin-top: 10px;" class="icon-big  icon-warning"><i
                                                            class="fa fa-balance-scale"></i></div>
                                                </div>
                                                <div class="col-7 col-md-8">
                                                    <div class="numbers">
                                                        <p class="card-title">{{$stats['subscribers']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <div class="stats" style="font-weight: bold;"><i
                                                    class="fa fa-calendar-o"></i>عدد المشتركين
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="card card-stats">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-5 col-md-4">
                                                    <div style="margin-top: 10px;" class="icon-big  icon-warning"><i
                                                            class="fa fa-balance-scale"></i></div>
                                                </div>
                                                <div class="col-7 col-md-8">
                                                    <div class="numbers">
                                                        <p class="card-title">{{$stats['subs']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <div class="stats" style="font-weight: bold;"><i
                                                    class="fa fa-calendar-o"></i>عدد الاشتراكات
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="card card-stats">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-5 col-md-4">
                                                    <div style="margin-top: 10px;" class="icon-big  icon-warning"><i
                                                            class="fa fa-gift"></i></div>
                                                </div>
                                                <div class="col-7 col-md-8">
                                                    <div class="numbers">
                                                        <p class="card-title"> {{$stats['exp_mony']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#">
                                            <div class="card-footer ">
                                                <a href="#">
                                                    <div class="stats" style="color:#fff;font-weight: bold;"><i
                                                            class="fa fa-calendar-o"></i>الربح المتوقع
                                                    </div>
                                                </a>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="card card-stats" style="background-color: black;">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-5 col-md-4">
                                                    <div style="margin-top: 10px;" class="icon-big  icon-warning"><i
                                                            class="fa fa-balance-scale"></i></div>
                                                </div>
                                                <div class="col-7 col-md-8">
                                                    <div class="numbers">
                                                        <p class="card-title">{{$stats['all_mony']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <div class="stats" style="font-weight: bold;"><i
                                                    class="fa fa-calendar-o"></i>الربح المجمع
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="card card-stats">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-5 col-md-4">
                                                    <div style="margin-top: 10px;" class="icon-big  icon-warning"><i
                                                            class="fa fa-balance-scale"></i></div>
                                                </div>
                                                <div class="col-7 col-md-8">
                                                    <div class="numbers">
                                                        <p class="card-title">{{$stats['resceved_mony']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <div class="stats" style="font-weight: bold;"><i
                                                    class="fa fa-calendar-o"></i>المستحق
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--                            <div class="row">--}}
                            {{--                                <div class="col-lg-6 col-md-6 col-sm-6">--}}
                            {{--                                    <div class="card card-stats">--}}
                            {{--                                        <canvas id="myOrders"></canvas>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                                <div class="col-lg-6 col-md-6 col-sm-6">--}}
                            {{--                                    <div class="card card-stats">--}}
                            {{--                                        <canvas id="myRevenue"></canvas>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="row">--}}
                            {{--                                <div class="col-lg-6 col-md-6 col-sm-6">--}}
                            {{--                                    <div class="card card-stats">--}}
                            {{--                                        <canvas id="myTrainings"></canvas>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                                <div class="col-lg-6 col-md-6 col-sm-6">--}}
                            {{--                                    <div class="card card-stats">--}}
                            {{--                                        <canvas id="myGates"></canvas>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="row">--}}
                            {{--                                <div id="calendar"></div>--}}
                            {{--                                <div class="modal fade" id="ReservationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
                            {{--                                    <div class="modal-dialog" role="document">--}}
                            {{--                                        <div class="modal-content">--}}
                            {{--                                            <div class="modal-header">--}}
                            {{--                                                <h5 class="modal-title" id="exampleModalLabel">Reservation</h5>--}}
                            {{--                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                            {{--                                                    <span aria-hidden="true">&times;</span>--}}
                            {{--                                                </button>--}}
                            {{--                                            </div>--}}
                            {{--                                            <div class="modal-body">--}}
                            {{--                                                <div class="m-portlet__body">--}}
                            {{--                                                    <div class="all-content-wrapper">--}}
                            {{--                                                        <!-- Single pro tab start-->--}}
                            {{--                                                        <div class="single-product-tab-area mg-t-0 mg-b-30">--}}
                            {{--                                                            <div class="container-fluid">--}}
                            {{--                                                                <div class="row">--}}
                            {{--                                                                    <div class="col-lg-12">--}}
                            {{--                                                                        <div class="single-product-pr">--}}
                            {{--                                                                            <div class="row">--}}
                            {{--                                                                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">--}}
                            {{--                                                                                    <div class="single-product-details res-pro-tb">--}}
                            {{--                                                                                        <h4><span style="font-weight: bold">Title</span> : <span id="booking_user"></span></h4>--}}
                            {{--                                                                                    </div>--}}
                            {{--                                                                                </div>--}}
                            {{--                                                                            </div>--}}
                            {{--                                                                        </div>--}}
                            {{--                                                                    </div>--}}
                            {{--                                                                </div>--}}
                            {{--                                                            </div>--}}
                            {{--                                                        </div>--}}
                            {{--                                                        <!-- Single pro tab End-->--}}
                            {{--                                                    </div>--}}
                            {{--                                                </div>--}}

                            {{--                                            </div>--}}
                            {{--                                            <div class="modal-footer">--}}
                            {{--                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                            {{--                                                --}}{{--                                        <button type="button" class="btn btn-primary">Save changes</button>--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}


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
            const labels1 = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            const data1 = {
                labels: labels1,
                datasets: [{
                    label: 'Events Revenue',
                    backgroundColor: 'rgb(255, 255, 255)',
                    borderColor: 'rgb(255, 255, 255)',
                    data:['300','400','300','300','600','900','100','0','0','0','0','0'],
                }]
            };
            const config1 = {
                type: 'line',
                data: data1,
                options: {}
            };
        </script>
        <script>
            const labels2 = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            const data2 = {
                labels: labels2,
                datasets: [{
                    label: 'Rent Revenue',
                    backgroundColor: 'rgb(255, 255, 255)',
                    borderColor: 'rgb(255, 255, 255)',
                    data:['100','400','300','200','500','500','50','0','0','0','0','0'],
                }]
            };
            const config2 = {
                type: 'line',
                data: data2,
                options: {}
            };
        </script>
        <script>
            const myOrders = new Chart(
                document.getElementById('myOrders'),
                config1
            );
        </script>
        <script>
            const myRevenue = new Chart(
                document.getElementById('myRevenue'),
                config2
            );
        </script>

        <script>
            const labels3 = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            const data3 = {
                labels: labels3,
                datasets: [{
                    label: 'Trainings Revenue',
                    backgroundColor: 'rgb(255, 255, 255)',
                    borderColor: 'rgb(255, 255, 255)',
                    data:['400','350','400','200','500','300','500','0','0','0','0','0'],
                }]
            };
            const config3 = {
                type: 'line',
                data: data3,
                options: {}
            };
        </script>
        <script>
            const labels4 = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            const data4 = {
                labels: labels4,
                datasets: [{
                    label: 'Gates Revenue',
                    backgroundColor: 'rgb(255, 255, 255)',
                    borderColor: 'rgb(255, 255, 255)',
                    data:['100','100','300','150','500','400','200','0','0','0','0','0'],
                }]
            };
            const config4 = {
                type: 'line',
                data: data4,
                options: {}
            };
        </script>
        <script>
            const myTrainings = new Chart(
                document.getElementById('myTrainings'),
                config3
            );
        </script>
        <script>
            const myGates = new Chart(
                document.getElementById('myGates'),
                config4
            );
        </script>

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
