<x-organization::layout>
 <x-slot name="pageTitle">الحجوزات الخارجيه | اضف</x-slot name="pageTitle">
 @section('externalReservations-active', 'm-menu__item--active m-menu__item--open')
 @section('externalReservations-create-active', 'm-menu__item--active')
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
                الحجوزات الخارجيه
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
                  <form method="POST" action="{{route('organizations.externalReservation.store')}}" enctype="multipart/form-data"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                  <div class="col-lg-6">
                                      <label>اسم المشترك :</label>
                                      <select name="subscriber_id" required="" id="subscriber_id"
                                              class="form-control m-input m-input--square selectpicker"
                                              id="exampleSelect1">
                                          <option value="">--اختر اسم المشترك--</option>
                                          @foreach($subscribers as $subscriber)
                                              <option @if(old('subscriber_id')== $subscriber->id) selected @endif
                                              value="{{ $subscriber->id }}">{{ $subscriber->name }}
                                              </option>
                                          @endforeach
                                      </select>
                                      @error('subscriber_id')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror
                                  </div>
                                  <div class="col-lg-6">
                                      <label>مساحه النشاط الرياضي :</label>
                                      <select name="external_pricing_id" required="" id="external_pricing_id"
                                              class="form-control m-input m-input--square selectpicker"
                                              >
                                          <option value="">--اختر اسم مساحه النشاط الرياضي--</option>
                                          @foreach($externalPricing as $externalPrice)
                                              <option @if(old('external_pricing_id')== $externalPrice->id) selected @endif
                                              value="{{ $externalPrice->id }}">{{ $externalPrice->ActivityArea->name }}
                                              </option>
                                          @endforeach
                                      </select>
                                      @error('external_pricing_id')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror
                                  </div>
                              </div>
                                <div class="form-group m-form__group row">
                                  <div class="col-lg-6">
                                          <label>عدد الساعات </label>
                                          <input type="text" name="num_of_hours" id="num_of_hours" step="0.01"  required="" class="form-control m-input" placeholder="عدد الساعات...">
                                  </div>
                              <div class="col-lg-6">
                                  <label>التاريخ </label>
                                  <input class="form-control" type="date" name="date" id="date" value="{{ old('paid_date') }}" required>
                              </div>
                              </div>
                                <div class="form-group m-form__group row">
                                      <div class="col-lg-6">
                                          <label>بدايه التوقيت</label>
                                          <input class="form-control" type="time" name="start_time" id="start_time" value="{{ old('start_time') }}" required>
                                      </div>
                                      <div id="EndTime" class="col-lg-6">
                                          @include('Organization::externalReservations.components.append_endTime')
                                      </div>
                                </div>
                                <div class="form-group m-form__group row">
                                      <div id="FinalPrice" class="col-lg-6">
                                          @include('Organization::externalReservations.components.append_finalPrice')
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
            $('#start_time').change(function(){
                var start_time = $('#start_time').val();
                var num_of_hours = $('#num_of_hours').val();

                console.log(num_of_hours)
                $.ajax({
                    type:'get',
                    url:'{{route('organizations.externalReservation.append.endTime')}}',
                    data:{
                        "_token": "{{ csrf_token() }}",
                        start_time:start_time,
                        num_of_hours:num_of_hours,
                    },
                    success:function(resp){
                        $("#EndTime").html(resp);
                    },error:function(){
                        alert('Error');
                    }
                });
            });
        </script>
        <script>
            $('#num_of_hours').change(function(){
                var subscriber_id = $('#subscriber_id').val();
                var num_of_hours = $('#num_of_hours').val();
                var external_pricing_id = $('#external_pricing_id').val();
                $.ajax({
                    type:'get',
                    url:'{{route('organizations.externalReservation.append.finalPrice')}}',
                    data:{
                        "_token": "{{ csrf_token() }}",
                        subscriber_id:subscriber_id,
                        num_of_hours:num_of_hours,
                        external_pricing_id:external_pricing_id,
                    },
                    success:function(resp){
                        $("#FinalPrice").html(resp);
                    },error:function(){
                        alert('Error');
                    }
                });
            });
        </script>


    </x-slot>
</x-organization::layout>


