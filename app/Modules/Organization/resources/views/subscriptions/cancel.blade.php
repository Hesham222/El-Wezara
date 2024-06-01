<x-organization::layout>
 <x-slot name="pageTitle">الغاء الحجز | اضف</x-slot name="pageTitle">
 @section('subscriptions-active', 'm-menu__item--active m-menu__item--open')
 @section('subscriptions-create-active', 'm-menu__item--active')
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
                الغاء الحجز
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
                  <form method="POST" action="{{route('organizations.subscription.cancelSubscription')}}"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      <div class="m-portlet__body">
                          <input name="record_id" value="{{$record->id}}" hidden>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>اسم المشترك :</label>
                                  <select required=""
                                          name="subscriber_id"
                                          class="form-control m-input m-input--square selectpicker"
                                          disabled
                                          id="subscriber_id">
                                          <option selected value="{{ $record->Subscriber->id }}">{{ $record->Subscriber->name.' '.$record->Subscriber->phone }} </option>
                                  </select>
                              </div>
                              <div class="col-lg-6">
                                  <label for="reason_of_cancelled">سبب الغاء الاشتراك :</label>
                                  <textarea id="reason_of_cancelled" name="reason_of_cancelled" rows="4" cols="50">{{ old('reason_of_cancelled') }}</textarea>
                                  @error('reason_of_cancelled')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                                  <div class="col-lg-4">
                                      <label>سعر الاشتراك</label>
                                      <input type="number" value="{{$record->price}}"   step="0.01"  required="" class="form-control m-input" disabled  placeholder="مبلغ الدفع...">
                                  </div>

                                  <div class="col-lg-4">
                                      <label>المبلغ المدفوع</label>
                                      <input type="number"  value="{{$payment_amount}}" step="0.01"  required="" class="form-control m-input" disabled>
                                  </div>
                                  <div class="col-lg-4">
                                      <label>عدد مرات الحضور </label>
                                      <input type="number" name="attendance" value="{{$num_of_attendance}}" required="" class="form-control m-input"  readonly="readonly">
                                  </div>

                          </div>
                          <div class="form-group m-form__group row">
                              <div id="appendBalance" class="col-lg-4">
                                  <label> سعر الجلسه </label>
                                  <input type="number" value="{{$price_of_session}}" required="" class="form-control m-input" disabled  >
                              </div>
                              <div class="col-lg-4">
                                  <label>سعر الحضور</label>
                                  <input type="number" name="attendance_price" value="{{$attendance_price}}"   step="0.01"  required="" class="form-control m-input"  readonly="readonly" >
                              </div>
                              <div class="col-lg-4">
                                  <label>باقي الدفع</label>
                                  <input type="number" name="rest_of_paid" id="rest_of_paid" value="{{$rest_of_paid}}"   step="0.01"  required="" class="form-control m-input"  readonly="readonly" >
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>نسبه الخصم % :</label>
                                  <input
                                      type="number"
                                      step="0.01"
                                      value="{{old('commission')}}"
                                      name="commission"
                                      id="commission"
                                      required=""
                                      class="form-control m-input"
                                  />
                                  @error('commission')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div id="appendRefund" class="col-lg-4">
                                  @include('Organization::subscriptions.components.appendRefund')
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
            $('#commission').change(function(){
                var rest_of_paid = $('#rest_of_paid').val();
                var commission   = $('#commission').val();
                $.ajax({
                    type:'get',
                    url:'{{route('organizations.subscription.append.refund')}}',
                    data:{
                        "_token": "{{ csrf_token() }}",
                        rest_of_paid:rest_of_paid,
                        commission:commission,
                    },
                    success:function(resp){
                        $("#appendRefund").html(resp).hide().fadeIn('slow');
                    },error:function(){
                        alert('Error');
                    }
                });
            });
        </script>
    </x-slot>
</x-organization::layout>
