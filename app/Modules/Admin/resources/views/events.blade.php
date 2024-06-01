
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
                    المناسبات
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
                                    لوحة التحكم المناسابات
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
                                                        <p class="card-title"> {{$stats['halls']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#">
                                            <div class="card-footer ">
                                                <a href="#">
                                                    <div class="stats" style="color:#fff;font-weight: bold;"><i
                                                            class="fa fa-calendar-o"></i>عدد القاعات
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
                                                        <p class="card-title">{{$stats['vendors']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <div class="stats" style="font-weight: bold;"><i
                                                    class="fa fa-calendar-o"></i>عدد الموردين
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
                                                        <p class="card-title">{{$stats['vendor_services']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <div class="stats" style="font-weight: bold;"><i
                                                    class="fa fa-calendar-o"></i>عدد خدمات الموردين
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
{{--                                <div class="col-lg-4 col-md-6 col-sm-6">--}}
{{--                                    <div class="card card-stats">--}}
{{--                                        <div class="card-body ">--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-5 col-md-4">--}}
{{--                                                    <div style="margin-top: 10px;" class="icon-big  icon-warning"><i--}}
{{--                                                            class="fa fa-gift"></i></div>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-7 col-md-8">--}}
{{--                                                    <div class="numbers">--}}
{{--                                                        <p class="card-title">45</p>--}}
{{--                                                        <p></p>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <a href="#">--}}
{{--                                            <div class="card-footer ">--}}
{{--                                                <a href="#">--}}
{{--                                                    <div class="stats" style="color:#fff;font-weight: bold;"><i--}}
{{--                                                            class="fa fa-calendar-o"></i>عدد المعدات--}}
{{--                                                    </div>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
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
                                                        <p class="card-title">{{$stats['events']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <div class="stats" style="font-weight: bold;"><i
                                                    class="fa fa-calendar-o"></i>عدد المناسبات
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
                                                        <p class="card-title">{{$stats['packs']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <div class="stats" style="font-weight: bold;"><i
                                                    class="fa fa-calendar-o"></i>عدد الباكدج
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
                                                            class="fa fa-calendar-o"></i>الربح المتوقع من المناسبات
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
                                                        <p class="card-title">{{$stats['resceved_mony']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <div class="stats" style="font-weight: bold;"><i
                                                    class="fa fa-calendar-o"></i>الربح المجمع من المناسبات
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
                                                        <p class="card-title">{{$stats['all_vendor_mony']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#">
                                            <div class="card-footer ">
                                                <a href="#">
                                                    <div class="stats" style="color:#fff;font-weight: bold;"><i
                                                            class="fa fa-calendar-o"></i>المبالغ المستحقه للموردين
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
                                                        <p class="card-title">{{$stats['wanted_mony']}}</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <div class="stats" style="font-weight: bold;"><i
                                                    class="fa fa-calendar-o"></i>المبالغ المستحقه من المناسبات
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
                    label: 'Number of events',
                    backgroundColor: 'rgb(255, 255, 255)',
                    borderColor: 'rgb(255, 255, 255)',
                    data:['5','0','3','2','5','10','5','0','0','0','0','0'],
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
                    label: 'Revenue from events',
                    backgroundColor: 'rgb(255, 255, 255)',
                    borderColor: 'rgb(255, 255, 255)',
                    data:['1000','4000','3000','2000','5000','5000','500','0','0','0','0','0'],
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
                    label: 'Payments from events',
                    backgroundColor: 'rgb(255, 255, 255)',
                    borderColor: 'rgb(255, 255, 255)',
                    data:['100','700','300','200','500','300','500','0','0','0','0','0'],
                }]
            };
            const config3 = {
                type: 'line',
                data: data3,
                options: {}
            };
        </script>
        <script>
            const myTrainings = new Chart(
                document.getElementById('myTrainings'),
                config3
            );
        </script>

    </x-slot>
</x-admin::layout>
