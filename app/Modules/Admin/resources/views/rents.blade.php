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
                    الإيجارات
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
                                    لوحة التحكم الإيجارات
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
                                                        <p class="card-title"> {{$stats['rent_spaces']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#">
                                            <div class="card-footer ">
                                                <a href="#">
                                                    <div class="stats" style="color:#fff;font-weight: bold;"><i
                                                            class="fa fa-calendar-o"></i>المساحات المستاجره
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
                                                        <p class="card-title">{{$stats['renters']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <div class="stats" style="font-weight: bold;"><i
                                                    class="fa fa-calendar-o"></i>عدد المستأجرين
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
                                                        <p class="card-title">{{$stats['active_renters']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <div class="stats" style="font-weight: bold;"><i
                                                    class="fa fa-calendar-o"></i>عدد المستأجرين النشطين
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
                                                        <p class="card-title">{{$stats['contracts']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#">
                                            <div class="card-footer ">
                                                <a href="#">
                                                    <div class="stats" style="color:#fff;font-weight: bold;"><i
                                                            class="fa fa-calendar-o"></i>عدد العقود
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
                                                        <p class="card-title">{{$stats['active_contracts']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <div class="stats" style="font-weight: bold;"><i
                                                    class="fa fa-calendar-o"></i>عدد العقود الفعاله
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
                                                        <p class="card-title">{{$stats['end_contarcts']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <div class="stats" style="font-weight: bold;"><i
                                                    class="fa fa-calendar-o"></i>عدد العقود المنتهيه خلال الشهر
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
                                                        <p class="card-title">{{$stats['exp_mony']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#">
                                            <div class="card-footer ">
                                                <a href="#">
                                                    <div class="stats" style="color:#fff;font-weight: bold;"><i
                                                            class="fa fa-calendar-o"></i>إجمالي قيمة الإيجار
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
                                                    class="fa fa-calendar-o"></i>إجمالي إيرادات الإيجار
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
                                                    class="fa fa-calendar-o"></i>الاجمالي المستحق
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
                    label: 'Value of contracts per month ',
                    backgroundColor: 'rgb(255, 255, 255)',
                    borderColor: 'rgb(255, 255, 255)',
                    data:['100','700','300','200','500','300','500','0','0','0','0','0'],
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
                    label: 'Revenue from contracts ',
                    backgroundColor: 'rgb(255, 255, 255)',
                    borderColor: 'rgb(255, 255, 255)',
                    data:['300','450','325','235','500','500','450','0','0','0','0','0'],
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
                    label: 'Payments from contracts',
                    backgroundColor: 'rgb(255, 255, 255)',
                    borderColor: 'rgb(255, 255, 255)',
                    data:['100','300','500','450','400','300','650','0','0','0','0','0'],
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
                    data:['100','400','300','200','500','500','50','0','0','0','0','0'],
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
