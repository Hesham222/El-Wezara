<x-organization::layout>
 <x-slot name="pageTitle">مساحات للأنشطة الرياضيه | اضف</x-slot name="pageTitle">
 @section('laundryOrders-active', 'm-menu__item--active m-menu__item--open')
 @section('laundryOrders-create-active', 'm-menu__item--active')
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
                    المدفوعات
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
                            اضف
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="table-responsive">
                    <section class="content">
                        <form method="POST" action="{{route('organizations.laundryOrder.addPayment')}}"
                              class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                            @csrf
                            @method('post')
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label>الاسم كامل:</label>
                                        <input
                                            type="text"
                                            value="{{$record->customer_name}}"
                                            name="name"
                                            required=""
                                            readonly
                                            class="form-control m-input"
                                            placeholder="ادخل الاسم كامل..." />
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="">الرقم:</label>
                                        <input
                                            type="phone" maxlength="15"
                                            value="{{$record->customer_mobile}}"
                                            name="phone"
                                            required=""
                                            readonly
                                            class="form-control m-input"
                                            placeholder="ادخل الموبايل..."
                                            id="phone"
                                        />
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label>تاريخ الدفع:</label>
                                        <input readonly class="form-control date" type="date" name="date" id="date" value="{{ $date }}" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>وقت الدفع:</label>
                                        <input readonly class="form-control date" type="time" name="time" id="time" value="{{ $time }}" required>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label>النوع:</label>
                                        <select id="method" name="method" required="" class="form-control m-input m-input--square" >
                                            <option value="Cash">كاش
                                            </option>
                                            <option value="Visa">فيزا
                                            </option>
                                        </select>
                                        @error('method')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6"></div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label>مبلغ المتبقي قبل الدفع</label>
                                        <input readonly type="number" id="total_remaining_amount" name="total_remaining_amount" step="0.01"  required="" class="form-control m-input" value="{{$record->remaining_amount}}" }}>
                                        @error('total_remaining_amount')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4">
                                        <label>مبلغ الدفع</label>
                                        <input type="number" id="paid_amount" name="paid_amount" step="0.01"  required="" class="form-control m-input"  placeholder="مبلغ الدفع...">
                                        @error('paid_amount')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4">
                                        <label>مبلغ المتبقي بعد الدفع</label>
                                        <input readonly type="number" id="remaining_amount" name="remaining_amount" step="0.01"  required="" class="form-control m-input" value="{{$record->remaining_amount}}"}}>
                                        @error('remaining_amount')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                    </div>
                                    <div class="col-lg-6">
                                        <input id="order_id" name="order_id" value="{{$record->id}}" hidden>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions--solid">
                                    <div class="row">
                                        <div class="col-lg-6"></div>
                                        <div class="col-lg-6 m--align-right">
                                            <button type="submit" class="btn btn-primary">حفظ</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- end page content -->
    <x-slot name="scripts">
        <script>
            $('#paid_amount').on('change',function (){
                var total_remaining = $('#total_remaining_amount').val();
                var paid_amount = $('#paid_amount').val();
                if(parseFloat(total_remaining-paid_amount) < 0){
                    alert('paid amount should be less than total remaining amount')
                }
                else{
                    $('#remaining_amount').val(parseFloat(total_remaining-paid_amount));

                }
            });
        </script>
    </x-slot>
</x-organization::layout>
