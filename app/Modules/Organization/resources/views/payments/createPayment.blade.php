<x-organization::layout>
 <x-slot name="pageTitle">المدفوعات | اضف</x-slot name="pageTitle">
 @section('payments-active', 'm-menu__item--active m-menu__item--open')
 @section('payments-create-active', 'm-menu__item--active')
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
                  <form method="POST" action="{{route('organizations.payment.store')}}"
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
                                          <option selected value="{{ $subscription->Subscriber->id }}">{{ $subscription->Subscriber->name.' '.$subscription->Subscriber->phone }} </option>
                                  </select>
                              </div>
                              <div class="col-lg-6">
                                  <label>اسم الاشتراك:</label>
                                  <select required class="form-control m-input m-input--square selectpicker" name="subscription_id" id ="subscription_id">
                                      <option selected value="{{ $subscription->id }}">{{ $subscription->pricing_name}} </option>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div id="appendBalance" class="col-lg-4">
                                  <label>المبلغ المتبقي </label>
                                  <input type="text" name="payment_balance" value="{{$subscription->payment_balance}}" step="0.01"  required="" class="form-control m-input"  readonly="readonly" placeholder="المبلغ المتبقي...">
                              </div>
                              <div class="col-lg-4">
                                  <label>مبلغ الدفع</label>
                                  <input type="number" name="payment_amount" step="0.01"  required="" class="form-control m-input"  placeholder="مبلغ الدفع...">
                              </div>
                              <div class="col-lg-4">
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
