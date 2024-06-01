<x-organization::layout>
 <x-slot name="pageTitle">مدفوعات الحجوزات الخارجيه | اضف</x-slot name="pageTitle">
 @section('external_payments-active', 'm-menu__item--active m-menu__item--open')
 @section('external_payments-create-active', 'm-menu__item--active')
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
                مدفوعات الحجوزات الخارجيه
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
                  <form method="POST" action="{{route('organizations.external_payment.store')}}"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>اسم المشترك :</label>
                                  <select required=""
                                          name="subscriber_id"
                                          class="form-control m-input m-input--square selectpicker"
                                          id="subscriber_id">
                                          <option selected value="{{ $reservation->Subscriber->id }}">{{ $reservation->Subscriber->name.' '.$reservation->Subscriber->phone }} </option>
                                  </select>
                              </div>
                              <div class="col-lg-6">
                                  <label>مساحه النشاط الرياضي :</label>
                                  <select required=""
                                          name="external_reservation_id"
                                          class="form-control m-input m-input--square selectpicker"
                                          id="external_reservation_id">
                                          <option selected value="{{ $reservation->id }}">{{ $reservation->ExternalPricing->ActivityArea->name }} </option>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>اجمالي السعر</label>
                                  <input type="number" name="payment_amount" step="0.01" value="{{ $reservation->total }}" required="" class="form-control m-input"  placeholder="مبلغ الدفع...">
                              </div>
                              <div class="col-lg-6">
                                  <label>النوع:</label>
                                  <select id="payment_method" name="payment_method" required="" class="form-control m-input m-input--square" >

                                      <option value="كاش">كاش
                                      </option>

                                      <option value="فيزا">فيزا
                                      </option>

                                  </select>
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
