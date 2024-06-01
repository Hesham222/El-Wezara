<x-organization::layout>
    <x-slot name="pageTitle">الاوردارات  | انهاء</x-slot name="pageTitle">
    @section('pointOfSales-active', 'm-menu__item--active m-menu__item--open')
    @section('pointOfSales-view-active', 'm-menu__item--active')
    <x-slot name="style">
        <!-- Some styles -->
        <style>
            .invalid-feedback {
                display: block;
            }
        </style>
    </x-slot>
    <!-- Start page content -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    الاوردارات
                </h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div style="display: none;" class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30" role="alert">
            <div class="m-alert__icon">
                <i class="flaticon-exclamation m--font-brand">
                </i>
            </div>
        </div>
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            انهاء
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="table-responsive">
                    <section class="content">
                            <form method="POST" action="{{route('organizations.pointOfSale.close.order.payment')}}"
                                  class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="item-form">
                                @csrf

                                <input type="hidden" name="order_id" value="{{$order->id}}"/>
                                <div class="form-group m-form__group row">
                                <div class="col-lg-6">
                                    <label>طريقة الدفع:</label>
                                    <select name="payment_type" required="" class="form-control m-input m-input--square" id="exampleSelect1">

                                        <option @if(old('payment_type') == "cash") selected @endif value="cash">Cash</option>
                                        <option @if(old('payment_type') == "visa") selected @endif value="visa">Visa</option>
                                        <option @if(old('payment_type') == "credit") selected @endif value="credit">Credit</option>
                                        <option @if(old('payment_type') == "hotel") selected @endif value="hotel">Hotel</option>
                                        <option @if(old('payment_type') == "employee") selected @endif value="employee">Employee</option>

                                    </select>
                                    @error('payment_type')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                </div>
                                    <div class="col-lg-6" id="tax">
                                        <label> المبلغ : {{$order->total_amount}}</label>
                                        <br>
                                        <label> المبلغ بعد 12 % ضريبة :{{$order->total_amount + $order->total_amount * .12}}</label>
                                    </div>

                                </div>

                                <div id="hotel" class="col-lg-6 show_final_price" style="display: none">
                                    <label>    فندق </label>
                                    <div class="col-lg-6">
                                        <label> رقم الغرفة :</label>
                                        <input
                                            type="number"
                                            value="{{old('room_num')}}"
                                            name="room_num"
                                            class="form-control m-input"
                                            />
                                        @error('room_num')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6">
                                        <label> الرقم ا لتعريفى للعميل  :</label>
                                        <input
                                            type="number"
                                            value="{{old('customer_id')}}"
                                            name="customer_id"
                                            class="form-control m-input"
                                        />
                                        @error('customer_id')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                </div>

                                <div id="employee" class="col-lg-6 show_final_price" style="display: none">
                                    <label>    موظف </label>
                                    <div class="col-lg-6">
                                        <label> الموظفين:</label>
                                        <select name="employee"
                                                class="selectpicker" data-live-search="true">
                                            @foreach($employees as $employee)
                                                <option @if(old( 'employee')== $employee->id) selected
                                                        @endif value="{{$employee->id}}">{{$employee->name}}
                                            @endforeach
                                        </select>
                                        @error('employee')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>

                                </div>

                                <br>
                                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                    <div class="m-form__actions m-form__actions--solid">
                                        <div class="row">
                                            <div class="col-lg-6"></div>
                                            <div class="col-lg-6 m--align-right">
                                                <button type="submit" class="btn btn-primary">@lang('Organization::organization.save')</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- end page content -->
    <x-slot name="scripts">
        <script>
            $("#exampleSelect1").on('change',function(){
                if ($(this).val() == "employee"){
                    $("#hotel").hide();
                    $("#employee").show();
                    $("#tax").hide();
                }else if ($(this).val() == "hotel"){
                    $("#hotel").show();
                    $("#employee").hide();
                    $("#tax").hide();
                }else {
                    $("#hotel").hide();
                    $("#employee").hide();
                    $("#tax").show();
                }


            });

        </script>
    </x-slot>
</x-organization::layout>
