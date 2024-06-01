<x-organization::layout>
    @if(request()->input('view')=='trash')
        <x-slot name="pageTitle">المخزن| @lang('Organization::organization.trash')</x-slot name="pageTitle">
        @section('ingredient-trash-active', 'm-menu__item--active')
    @else
        <x-slot name="pageTitle">المخزن | @lang('Organization::organization.view')</x-slot name="pageTitle">
        @section('inventory-active', 'm-menu__item--active m-menu__item--open')
    @endif
    @section('inventory-active', 'm-menu__item--active m-menu__item--open')
    @include('Organization::_modals.confirm_password')
    <x-slot name="style">
        <style type="text/css">
            .mt-4 {
                margin-top: 1.5rem !important;
            }

            .flex-wrap {
                flex-wrap: wrap !important;
            }

            .mb-3,
            .my-3 {
                margin-bottom: 1rem !important;
            }

            .flex-row {
                -webkit-box-orient: horizontal !important;
                -webkit-box-direction: normal !important;
                flex-direction: row !important;
            }

            .menu_box {
                background-color: #f7f7f7;
                border-radius: 5px;
                border: 1px solid #ececec;
                padding: 3px;
                height: 150px;
                width: 150px;
                margin-right: 15px;
                margin-top: 15px;
                text-decoration: none;
                color: #1f282d;
                transition: all 0.3s ease;
                position: relative;
            }

            .menu_box:hover {
                text-decoration: none;
                color: #F7F7F7;
                background-color: #1F282D;
                transition: all 0.3s ease;
                border: 1px solid #1F282D;
            }

            h5 {
                margin-bottom: .5rem;
                font-family: inherit;
                font-weight: 500;
                line-height: 1.2;
                color: inherit;
            }

            h5,
            .h5 {
                font-size: 1.25rem;
            }

            .fa-4x {
                font-size: 4em !important;
            }

            ::before,
            ::after {
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
            }

            .notification-icon {
                position: absolute;
                top: -0.1px;
                right: -0.1px;
            }
        </style>
    </x-slot>
    <!-- Start page content -->
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <!-- BEGIN: Subheader -->
            <div class="m-content">
                <!--Begin::Section Products-->

                <h3>المخزن

                </h3>
                <a target="_blank" href="{{route('organizations.navigations.inventoryVideo')}}" class="btn btn-primary" title="اعرف المزيد عن خدمات المخازن">?</a>
                <hr>
                <div class="row">
                    <div class="col-xl-12">
                        <h4>الطلبات و الشحن
                        </h4>

                        <hr>
                        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
                            <!-- Start Tickets Category Module -->

                            <a href="{{route('organizations.po.create')}}" class="menu_box">
                                <center>
                                    <i class="fa fa-4x fa-plus mt-4"></i>
                                    <h5 class="m-portlet__head-text mt-4">
                                        امر شراء جديد
                                    </h5>
                                </center>
                            </a>

                            <a href="{{route('organizations.po.index')}}" class="menu_box">
                                <center style="padding-right: 25px;">
                                    <i class="fa fa-4x fa-file-invoice mt-4"></i>
                                    <h5 class="m-portlet__head-text mt-4">طلبات الشراء</h5>
                                </center>
                            </a>

                            <a href="{{route('organizations.po.inventoriesIndex')}}" class="menu_box">
                                <center style="padding-right: 25px;">
                                    <i class="fa fa-4x fa-files-o mt-4"></i>
                                    <h5 class="m-portlet__head-text mt-4">طلبات المخازن</h5>
                                </center>
                            </a>

                            <a href="{{route('organizations.setting.index')}}" class="menu_box">
                                <center style="padding-right: 25px;">
                                    <i class="fa fa-4x fa-cogs mt-4"></i>
                                    <h5 class="m-portlet__head-text mt-4"> اعداد تكلفة الشحن </h5>
                                </center>
                            </a>



                            <a href="{{route('organizations.po.show.orders.ingredients')}}" class="menu_box">
                                <center style="padding-right: 25px;">
                                    <i class="fa fa-4x fa-calculator mt-4"></i>
                                    <h5 class="m-portlet__head-text mt-4">طلبات المخازن لكل منتج</h5>
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

                            <!-- End Tickets Category Module -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- End page content -->
    <x-slot name="scripts">
        <script>

        </script>
    </x-slot>
</x-organization::layout>
