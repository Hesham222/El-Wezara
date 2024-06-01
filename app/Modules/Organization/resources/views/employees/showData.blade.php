<x-organization::layout>
    @if(request()->input('view')=='trash')
        <x-slot name="pageTitle">بيانات الموظف| @lang('Organization::organization.trash')</x-slot name="pageTitle">
        @section('employee-trash-active', 'm-menu__item--active')
    @else
        <x-slot name="pageTitle">بيانات الموظف | @lang('Organization::organization.view')</x-slot name="pageTitle">
        @section('employee-active', 'm-menu__item--active')
    @endif
    @section('employee-active', 'm-menu__item--active m-menu__item--open')
    @include('Organization::_modals.confirm_password')
    <x-slot name="style">
        <!-- Some styles -->

        <style type="text/css">
            .card {
                border-radius: 12px;
                box-shadow: 0 6px 10px -4px rgba(0, 0, 0, .15);
                background-color: #002575;
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

            .card-stats .card-body {
                padding: 15px 15px 0;
            }

            .card .card-body {
                padding: 15px 15px 10px;
            }

            .card-stats {
                position: relative;
                top: 0;
                transition: top ease 0.5s;
            }

            .card-stats:hover {
                top: -10px;
            }

            .card-body {
                flex: 1 1 auto;
                padding: 1.25rem;
            }

            .card-stats .card-body .numbers {
                text-align: right;
                font-size: 2em;
            }

            .card .numbers {
                font-size: 2em;
            }

            .card-stats .card-body .numbers .card-category {
                color: #9a9a9a;
                font-size: 16px;
                line-height: 1.4em;
            }

            .card-stats .card-body .numbers p {
                margin-bottom: 0;
            }

            .card-category {
                font-size: 1em;
            }

            .card-category,
            .category {
                text-transform: capitalize;
                font-weight: 400;
                color: #9a9a9a;
                font-size: .7142em;
            }

            .card-stats .card-body .numbers p {
                margin-bottom: 0;
            }

            .card-title {
                margin-bottom: .75rem;
            }
        </style>

    </x-slot>
    <!-- Start page content -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    معلومات الموظف
                </h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">

                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">

                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">
                <section class="content">
                    <div>
                        <div class="mt-4">
                            <h5>   بيانات {{$emp->name}} </h5>
                            <hr>
                            <div class="d-flex flex-wrap flex-row bd-highlight mb-3">

                                <a href="{{route('organizations.employee.show.attachments.data',$emp->id)}}" class="menu_box">
                                    <center>
                                        <i class="fa fa-4x fa-file-invoice mt-4"></i>
                                        <h5 class="m-portlet__head-text mt-4"> ملفات الموظف</h5>
                                    </center>
                                </a>

                                <br>

                                <a target="_blank" href="{{route('organizations.employee.download.jobDescription',$emp->id)}}" class="menu_box">
                                    <center style="padding-right: 25px;">
                                        <i class="fa fa-4x fa-download mt-4"></i>
                                        <h5 class="m-portlet__head-text mt-4"> تحميل [Job Description]</h5>
                                    </center>
                                </a>



                                <a target="_blank" href="{{route('organizations.employee.upload.contract',$emp->id)}}" class="menu_box">
                                    <center style="padding-right: 25px;">
                                        <i class="fa fa-4x fa-upload mt-4"></i>
                                        <h5 class="m-portlet__head-text mt-4">  رفع العقد</h5>
                                    </center>
                                </a>

                                <a target="_blank" href="{{route('organizations.employee.download.contract',$emp->id)}}" class="menu_box">
                                    <center style="padding-right: 25px;">
                                        <i class="fa fa-4x fa-download mt-4"></i>
                                        <h5 class="m-portlet__head-text mt-4">   تحميل العقد</h5>
                                    </center>
                                </a>



                                <a target="_blank" href="{{route('organizations.employee.upload.job_description',$emp->id)}}" class="menu_box">
                                    <center style="padding-right: 25px;">
                                        <i class="fa fa-4x fa-upload mt-4"></i>
                                        <h5 class="m-portlet__head-text mt-4">    رفع Job Description</h5>
                                    </center>
                                </a>


                                <a target="_blank" href="{{route('organizations.vacationRequest.empVacation',$emp->id)}}" class="menu_box">
                                    <center style="padding-right: 25px;">
                                        <i class="fa fa-4x fa-file-invoice mt-4"></i>
                                        <h5 class="m-portlet__head-text mt-4">   تاريخ اجازات الموظف</h5>
                                    </center>
                                </a>



                                <a target="_blank" href="{{route('organizations.employee.add.salary',$emp->id)}}" class="menu_box">
                                    <center style="padding-right: 25px;">
                                        <i class="fa fa-4x fa-plus-circle mt-4"></i>
                                        <h5 class="m-portlet__head-text mt-4">    اضافة    مرتب الموظف</h5>
                                    </center>
                                </a>




                                <a target="_blank" href="{{route('organizations.employee.add.working.days',$emp->id)}}" class="menu_box">
                                    <center style="padding-right: 25px;">
                                        <i class="fa fa-4x fa-plus-circle mt-4"></i>
                                        <h5 class="m-portlet__head-text mt-4">       اضافة ايام عمل الموظف</h5>
                                    </center>
                                </a>



















                                <a target="_blank" href="{{route('organizations.vacationRequest.create.fromAdmin',$emp->id)}}" class="menu_box">
                                    <center style="padding-right: 25px;">
                                        <i class="fa fa-4x fa-plus-circle mt-4"></i>
                                        <h5 class="m-portlet__head-text mt-4">    اضافة طلب اجازة للموظف</h5>
                                    </center>
                                </a>





                                <a target="_blank" href="{{route('organizations.financialAdvanceRequest.empVacation',$emp->id)}}" class="menu_box">
                                    <center style="padding-right: 25px;">
                                        <i class="fa fa-4x fa-file-invoice mt-4"></i>
                                        <h5 class="m-portlet__head-text mt-4">   تاريخ طلبات السلف</h5>
                                    </center>
                                </a>

                                <a target="_blank" href="{{route('organizations.financialAdvanceRequest.create.fromAdmin',$emp->id)}}" class="menu_box">
                                    <center style="padding-right: 25px;">
                                        <i class="fa fa-4x fa-plus-circle mt-4"></i>
                                        <h5 class="m-portlet__head-text mt-4">      اضافة طلب سلفه للموظف</h5>
                                    </center>
                                </a>





                                <a target="_blank" href="{{route('organizations.employeeBonus.empBonus',$emp->id)}}" class="menu_box">
                                    <center style="padding-right: 25px;">
                                        <i class="fa fa-4x fa-file-invoice mt-4"></i>
                                        <h5 class="m-portlet__head-text mt-4">   تاريخ مكافأة الموظف</h5>
                                    </center>
                                </a>

                                <a target="_blank" href="{{route('organizations.employeeBonus.create.fromAdmin',$emp->id)}}" class="menu_box">
                                    <center style="padding-right: 25px;">
                                        <i class="fa fa-4x fa-plus-circle mt-4"></i>
                                        <h5 class="m-portlet__head-text mt-4">      اضافة  مكافأة للموظف</h5>
                                    </center>
                                </a>







                                <a target="_blank" href="{{route('organizations.employeeDeduction.empDeduction',$emp->id)}}" class="menu_box">
                                    <center style="padding-right: 25px;">
                                        <i class="fa fa-4x fa-file-invoice mt-4"></i>
                                        <h5 class="m-portlet__head-text mt-4">  تاريخ الخصم الموظف</h5>
                                    </center>
                                </a>

                                <a target="_blank" href="{{route('organizations.employeeDeduction.create.fromAdmin',$emp->id)}}" class="menu_box">
                                    <center style="padding-right: 25px;">
                                        <i class="fa fa-4x fa-plus-circle mt-4"></i>
                                        <h5 class="m-portlet__head-text mt-4">      خصم  للموظف</h5>
                                    </center>
                                </a>





                            {{--                                <a href="{{route('accounts.salesOrders.create')}}" class="menu_box">--}}
                            {{--                                    <center>--}}
                            {{--                                        <i class="fa fa-4x fa-plus mt-4"></i>--}}
                            {{--                                        <h5 class="m-portlet__head-text mt-4">{{ __('Account::sales.headers.new_sale') }}</h5>--}}
                            {{--                                    </center>--}}
                            {{--                                </a>--}}


                            {{--                                <a href="{{route('accounts.salesOrders.index')}}" class="menu_box">--}}
                            {{--                                    <center>--}}
                            {{--                                        <i class="fa fa-4x fa-file-invoice-dollar mt-4"></i>--}}
                            {{--                                        <h5 class="m-portlet__head-text mt-4">{{ __('Account::sales.headers.sales_history') }}</h5>--}}
                            {{--                                    </center>--}}
                            {{--                                </a>--}}

                            <!-- <a href="" class="menu_box">
                        <center>
                            <i class="fa fa-4x fa-backward mt-4"></i>
                            <h5 class="m-portlet__head-text mt-4"
                                style="word-wrap: break-word;">{{ __('Account::inventory.vendor_return') }}</h5>
                        </center>
                    </a> -->
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <a target="_blank" href="{{asset('storage'.DS().$emp->attachment)}}" class="menu_box">
                                    <center style="padding-right: 25px;">
                                        <i class="fa fa-eye"></i>
                                        <input type="hidden" name="image" value="{{ $emp->attachment}}">
                                        <h5 class="m-portlet__head-text mt-4"> الرقم القومى</h5>
                                    </center>
                                </a>
                                <a target="_blank" href="{{asset('storage'.DS().$emp->contract_attachments)}}" class="menu_box">
                                    <center style="padding-right: 25px;">
                                        <i class="fa fa-eye"></i>
                                        <input type="hidden" name="image" value="{{ $emp->contract_attachments}}">
                                        <h5 class="m-portlet__head-text mt-4"> العقد</h5>
                                    </center>
                                </a>
                                <a target="_blank" href="{{asset('storage'.DS().$emp->job_description_attachments)}}" class="menu_box">
                                    <center style="padding-right: 25px;">
                                        <i class="fa fa-eye"></i>
                                        <input type="hidden" name="image" value="{{ $emp->job_description_attachments}}">
                                        <h5 class="m-portlet__head-text mt-4"> Job Description</h5>
                                    </center>
                                </a>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>ملفات اخرى</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        @foreach($emp->attachments as $attach)
                                            <td>

                                                <a target="_blank" href="{{asset('storage'.DS().$attach->attachment)}}" class="menu_box">
                                                    <center style="padding-right: 25px;">
                                                        <i class="fa fa-eye"></i>
                                                        <input type="hidden" name="image" value="{{ $attach->attachment}}">
                                                    </center>
                                                </a>
                                            </td>

                                        @endforeach
                                    </tr>
                                    </tbody>
                                </table>


                            </div>

                        </div>
                        </div>

                </section>
            </div>
        </div>
    </div>
    <!-- End page content -->
    <x-slot name="scripts">
        <script>

        </script>
    </x-slot>
</x-organization::layout>
