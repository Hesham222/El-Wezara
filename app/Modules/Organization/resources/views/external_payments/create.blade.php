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
                                          id="subscriber_id"
                                          class="form-control m-input m-input--square selectpicker"
                                          data-live-search="true"
                                          id="aspecificUserSelect">
                                      <option value="">--اختر مشترك--</option>
                                      @foreach($subscribers as $subscriber)
                                          <option value="{{ $subscriber->id }}">{{ $subscriber->name.' '.$subscriber->phone }} </option>
                                      @endforeach
                                  </select>
                              </div>
                              <div id="appendSubscriptions" class="col-lg-6">
                                      @include('Organization::external_payments.components.append_subscriptions')
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div id="appendBalance" class="col-lg-4">
                                  @include('Organization::external_payments.components.appendBalance')
                              </div>
                              <div class="col-lg-4">
                                  <label>سعر الاشتراك زائد 12%</label>
                                  <input type="checkbox" name="status" id="status" value="1" class="form-control m-input">
                                  <input type="hidden" value="0" id="status" name="status">
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
        <script>
            $("#status").on('change',function (){
                if ($("#status").is(":checked")){

                    var status = $('#status').val();
                    var payment_amount = $('#payment_amount').val();
                   // console.log(payment_amount)
                    $.ajax({
                        type:'get',
                        url:'{{route('organizations.external_payment.append.overprice')}}',
                        data:{
                            "_token": "{{ csrf_token() }}",
                            payment_amount:payment_amount,
                            status:status,
                        },
                        success:function(resp){
                            $("#appendBalance").html(resp);
                        },error:function(){
                            alert('Error');
                        }
                    });
                }else {
                    var external_reservation_id = $('#external_reservation_id').val();
                    var subscriber_id = $('#subscriber_id').val();
                    $.ajax({
                        type:'get',
                        url:'{{route('organizations.external_payment.append.overprice')}}',
                        data:{
                            "_token": "{{ csrf_token() }}",
                            external_reservation_id:external_reservation_id,
                            subscriber_id:subscriber_id,
                        },
                        success:function(resp){
                            $("#appendBalance").html(resp);
                        },error:function(){
                            alert('Error');
                        }
                    });
                }
            });
        </script>
        <script>
            $('#subscriber_id').change(function(){
                var subscriber_id = $(this).val();

                $.ajax({
                    type:'get',
                    url:'{{route('organizations.external_payment.append.subscriptions')}}',
                    data:{
                        "_token": "{{ csrf_token() }}",
                        subscriber_id:subscriber_id,
                    },
                    success:function(resp){
                        $("#appendSubscriptions").html(resp);

                    },error:function(){
                        alert('Error');
                    }
                });
            });
        </script>
        <script>
            $('#appendSubscriptions').change(function(){
                var external_reservation_id = $('#external_reservation_id').val();
                var subscriber_id = $('#subscriber_id').val();
                // console.log(external_reservation_id)
                // console.log(subscriber_id)
                $.ajax({
                    type:'get',
                    url:'{{route('organizations.external_payment.append.balance')}}',
                    data:{
                        "_token": "{{ csrf_token() }}",
                        external_reservation_id:external_reservation_id,
                        subscriber_id:subscriber_id,

                    },
                    success:function(resp){
                        $("#appendBalance").html(resp).hide().fadeIn('slow');
                    },error:function(){
                        alert('Error');
                    }
                });
            });
        </script>

    </x-slot>
</x-organization::layout>
