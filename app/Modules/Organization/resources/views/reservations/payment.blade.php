<x-organization::layout>
 <x-slot name="pageTitle">المدفوعات | اضف</x-slot name="pageTitle">
 @section('reservations-active', 'm-menu__item--active m-menu__item--open')
 @section('reservations-create-active', 'm-menu__item--active')
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
                        <form method="POST" action="{{route('organizations.reservation.addPayment')}}"
                              class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                            @csrf
                            @method('post')
                            <div class="m-portlet__body">
                                <div hidden class="form-group m-form__group row">
                                    <div hidden class="col-lg-4">
                                        <label>الاسم كامل:</label>
                                        <input
                                            type="text"
                                            value="{{$record->contact_name}}"
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
                                    <div hidden class="col-lg-4">
                                        <label hidden class="">البريد الالكتروني:</label>
                                        <input
                                            type="email"
                                            value="{{$record->contact_email}}"
                                            name="email"
                                            required=""
                                            readonly
                                            class="form-control m-input"
                                            placeholder="ادخل البريد الالكتروني..." />
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                    <div  hidden class="col-lg-4">
                                        <label class="">الرقم:</label>
                                        <input
                                            type="phone" maxlength="15"
                                            value="{{$record->contact_phone}}"
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
                                <div hidden class="form-group m-form__group row">
                                    <div hidden class="col-lg-4">
                                        <label>اللقب:</label>
                                        <input
                                            type="text" hidden
                                            value="{{$record->contact_title}}"
                                            name="title"
                                            required=""
                                            readonly
                                            class="form-control m-input"
                                            placeholder="اللقب..." />
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                    <div hidden class="col-lg-4">
                                        <label class="">الرقم القومي:</label>
                                        <input
                                            type="phone" maxlength="14"
                                            value="{{$record->contact_national_id}}"
                                            name="national_id"
                                            required=""
                                            readonly
                                            class="form-control m-input"
                                            placeholder="ادخل الرقم القومي..."
                                            id="national_id"
                                        />
                                        @error('national_id')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                    <div hidden class="col-lg-4">
                                        <label class="">العنوان:</label>
                                        <input
                                            type="text"
                                            value="{{$record->contact_address}}"
                                            name="address"
                                            required=""
                                            readonly
                                            class="form-control m-input"
                                            placeholder="ادخل العنوان..." />
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
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
                                        <label>مبلغ المتبقي</label>
                                        <input readonly type="number" id="remaining_amount" name="remaining_amount" step="0.01"  required="" class="form-control m-input" value="{{$record->remaining_amount}}" }}>
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
                                        <input id="reservation_id" name="reservation_id" value="{{$record->id}}" hidden>
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
    </x-slot>
</x-organization::layout>
