<x-organization::layout>
    <x-slot name="pageTitle">المدفوعات | عرض</x-slot name="pageTitle">
    @section('payments-view-active', 'm-menu__item--active')
    @section('payments-active', 'm-menu__item--active m-menu__item--open')
    @include('Organization::_modals.confirm_password')
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
                                      @include('Organization::payments.components.append_subscriptions')
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div id="appendBalance" class="col-lg-4">
                                  @include('Organization::payments.components.appendBalance')
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
        <script>
            $('#subscriber_id').change(function(){
                var subscriber_id = $(this).val();

                $.ajax({
                    type:'get',
                    url:'{{route('organizations.payment.append.subscriptions')}}',
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
                var subscription_id = $('#subscription_id').val();
                $.ajax({
                    type:'get',
                    url:'{{route('organizations.payment.append.balance')}}',
                    data:{
                        "_token": "{{ csrf_token() }}",
                        subscription_id:subscription_id,
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
