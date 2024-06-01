<x-organization::layout>
    @if(request()->input('view')=='trash')
        <x-slot name="pageTitle">@lang('Organization::organization.vendor') | @lang('Organization::organization.trash')</x-slot name="pageTitle">
        @section('vendor-trash-active', 'm-menu__item--active')
    @else
        <x-slot name="pageTitle">@lang('Organization::organization.vendor') | @lang('Organization::organization.view')</x-slot name="pageTitle">
        @section('vendor-view-active', 'm-menu__item--active')
    @endif
    @section('vendor-active', 'm-menu__item--active m-menu__item--open')
    @include('Organization::_modals.confirm_password')
    <x-slot name="style">
        <!-- Some styles -->
    </x-slot>


        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <div class="m-content">
                <!--Begin::Section-->
                <div class="row">
{{--                    <div class="col-xl-12">--}}
{{--                        <!--begin:: Widgets/Best Sellers-->--}}
{{--                        <div class="m-portlet m-portlet--full-height ">--}}
{{--                            <div class="m-portlet__head">--}}
{{--                                <div class="m-portlet__head-caption">--}}
{{--                                    <div class="m-portlet__head-title">--}}
{{--                                        <h3 class="m-portlet__head-text">--}}
{{--تفاصيل البائع--}}
{{--                                        </h3>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="m-portlet__head-tools">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="m-portlet__body">--}}
{{--                                <!--begin::Content-->--}}
{{--                                <section class="content">--}}
{{--                                    <form method="POST" action=""--}}
{{--                                          class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">--}}
{{--                                        <div class="m-portlet__body">--}}
{{--                                            <div class="form-group m-form__group row">--}}
{{--                                                <div class="col-lg-4">--}}
{{--                                                    <div class="col-lg-12">--}}
{{--                                                        <div class="row">--}}
{{--                                                            <div class="col-lg-12">--}}
{{--                                                                <img--}}
{{--                                                                    src="{{ $vendor->logo ? asset('storage/250/' . $vendor->logo) : asset('placeholder.jpg') }}"--}}
{{--                                                                    alt="{{ $vendor->name }}">--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-lg-4">--}}
{{--                                                    <div class="col-lg-12">--}}
{{--                                                        <label for="name">{{ __('validation.attributes.name') }}</label>--}}
{{--                                                        <input id="name" type="text" value="{{ $vendor->name }}"--}}
{{--                                                               disabled--}}
{{--                                                               class="form-control m-input">--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3"></div>--}}
{{--                                                    <div class="col-lg-12">--}}
{{--                                                        <label for="account_number">{{ __('validation.attributes.account_number') }}</label>--}}
{{--                                                        <input id="account_number" type="text"--}}
{{--                                                               value="{{ $vendor->account_number }}"--}}
{{--                                                               disabled--}}
{{--                                                               class="form-control m-input">--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3"></div>--}}
{{--                                                    <div class="col-lg-12">--}}
{{--                                                        <label for="phone">{{ __('validation.attributes.phone') }}</label>--}}
{{--                                                        <input id="phone" type="text" value="{{ $vendor->phone }}" disabled--}}
{{--                                                               class="form-control m-input">--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3"></div>--}}
{{--                                                    <div class="col-lg-12">--}}
{{--                                                        <label for="mobile">{{ __('validation.attributes.mobile') }}</label>--}}
{{--                                                        <input id="mobile" type="text" value="{{ $vendor->mobile }}"--}}
{{--                                                               class="form-control m-input" disabled>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3"></div>--}}
{{--                                                    <div class="col-lg-12">--}}
{{--                                                        <label for="email">{{ __('validation.attributes.email') }}</label>--}}
{{--                                                        <input id="email" type="text" value="{{ $vendor->email }}"--}}
{{--                                                               class="form-control m-input" disabled>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3"></div>--}}
{{--                                                    <div class="col-lg-12">--}}
{{--                                                        <label for="email_2">{{ __('validation.attributes.email_2') }}</label>--}}
{{--                                                        <input id="email_2" type="email" value="{{ $vendor->email_2 }}"--}}
{{--                                                               name="email_2"--}}
{{--                                                               class="form-control m-input" disabled>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-lg-4">--}}
{{--                                                    <div class="col-lg-12">--}}
{{--                                                        <label for="address">{{ __('validation.attributes.address') }}</label>--}}
{{--                                                        <input id="address" type="text" value="{{ $vendor->address }}" disabled--}}
{{--                                                               class="form-control m-input">--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3"></div>--}}
{{--                                                    <div class="col-lg-12">--}}
{{--                                                        <label for="country">{{ __('validation.attributes.country') }}</label>--}}
{{--                                                        <input id="country" type="text" value="{{ $vendor->country }}"--}}
{{--                                                               class="form-control m-input" disabled>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3"></div>--}}
{{--                                                    <div class="col-lg-12">--}}
{{--                                                        <label for="city">{{ __('validation.attributes.city') }}</label>--}}
{{--                                                        <input id="city" type="text" value="{{ $vendor->city }}"--}}
{{--                                                               class="form-control m-input" disabled>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3"></div>--}}
{{--                                                    <div class="col-lg-12">--}}
{{--                                                        <label for="area">{{ __('validation.attributes.area') }}</label>--}}
{{--                                                        <input id="area" type="text" value="{{ $vendor->area }}"--}}
{{--                                                               class="form-control m-input" disabled>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3"></div>--}}
{{--                                                    <div class="col-lg-12">--}}
{{--                                                        <label for="postal_code">{{ __('validation.attributes.postal_code') }}</label>--}}
{{--                                                        <input id="postal_code" type="text" value="{{ $vendor->postal_code }}"--}}
{{--                                                               class="form-control m-input" disabled>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3"></div>--}}
{{--                                                    <div class="col-lg-12">--}}
{{--                                                        <label for="website">{{ __('validation.attributes.website') }}</label>--}}
{{--                                                        <input id="website" type="url" value="{{ $vendor->website }}"--}}
{{--                                                               class="form-control m-input" disabled>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group m-form__group row">--}}
{{--                                                <div class="col-lg-4">--}}
{{--                                                    <label for="num_pos"># {{ $POMainTitle }}</label>--}}
{{--                                                    <input id="num_pos" type="text" value="{{ $vendor->purchaseOrders->count() }}"--}}
{{--                                                           disabled--}}
{{--                                                           class="form-control m-input">--}}
{{--                                                </div>--}}
{{--                                                <div class="mb-3"></div>--}}
{{--                                                <div class="col-lg-4">--}}
{{--                                                    <label for="num_payments"># {{ $PaymentsMainTitle }}</label>--}}
{{--                                                    <input id="num_payments" type="text"--}}
{{--                                                           value="{{ $vendor->payments->count() }}"--}}
{{--                                                           disabled--}}
{{--                                                           class="form-control m-input">--}}
{{--                                                </div>--}}
{{--                                                <div class="mb-3"></div>--}}
{{--                                                <div class="col-lg-4">--}}
{{--                                                    <label for="num_returns"># {{ $ReturnsMainTitle }}</label>--}}
{{--                                                    <input id="num_returns" type="text" value="{{ $vendor->returns->count() }}" disabled--}}
{{--                                                           class="form-control m-input">--}}
{{--                                                </div>--}}
{{--                                                <div class="mb-3"></div>--}}
{{--                                                <div class="col-lg-4">--}}
{{--                                                    <label for="total_balance">{{ __('validation.attributes.total_balance') }}</label>--}}
{{--                                                    <input id="total_balance" type="text" value="{{ $vendor->purchaseOrders->where('status_id',4)->sum('total') }} L.E"--}}
{{--                                                           class="form-control m-input" disabled>--}}
{{--                                                </div>--}}
{{--                                                <div class="mb-3"></div>--}}
{{--                                                <div class="col-lg-4">--}}
{{--                                                    <label for="total_payments">{{ __('Account::purchaseOrderPayments.total_payments') }}</label>--}}
{{--                                                    <input id="total_payments" type="text" value="{{ $vendor->payments->sum('amount') }} L.E"--}}
{{--                                                           class="form-control m-input" disabled>--}}
{{--                                                </div>--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </form>--}}
{{--                                </section>--}}
{{--                                <!--end::Content-->--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!--end:: Widgets/Best Sellers-->--}}
{{--                    </div>--}}
                    @include('Organization::vendors.show.pos')
                    @include('Organization::vendors.show.payments')

                </div>
                <!--End::Section-->
            </div>
        </div>






        <!-- End page content -->
        <x-slot name="scripts">

            <!-- external JS -->
            <script type="text/javascript">
                $(document).ready(function () {
                    //call datatabel
                  //  dataTableInitlize('#vendors-sales-table');
                    dataTableInitlize('#vendors-pos-table');
                    dataTableInitlize('#vendors-payments-table');
                   // dataTableInitlize('#vendors-returns-table');
                });
            </script>
        </x-slot>
</x-organization::layout>
