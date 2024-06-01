<x-organization::layout>
 <x-slot name="pageTitle">الاشتراكات  | تعديل</x-slot name="pageTitle">
 @section('subscriptions-active', 'm-menu__item--active m-menu__item--open')
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
                الاشتراكات
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
                  تعديل
                </h3>
              </div>
            </div>
          </div>
          <div class="m-portlet__body">
            <div class="table-responsive">
                <section class="content">
                  <form method="POST" action="{{route('organizations.subscription.update', $record->id)}}" enctype="multipart/form-data"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      @method('put')
                      <div class="m-portlet__body">
                            <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>اسم المشترك:</label>
                                  <select name="subscriber_id" required="" id="subscriber_id"
                                          class="form-control m-input m-input--square selectpicker"
                                          id="exampleSelect1">
                                      @foreach($subscribers as $subscriber)
                                          <option @if(old('subscriber_id')== $subscriber->id || $subscriber->id==$record->subscriber_id) selected @endif
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
                          </div>
                            <div class="form-group m-form__group row">
                              <div id="appendTrainings" class="col-lg-6">
                                  @include('Organization::subscriptions.components.append_trainings')
                              </div>
                              <div id="appendPricings" class="col-lg-6">
                                  @include('Organization::subscriptions.components.append_prices')
                              </div>
                            </div>
                            <div class="form-group m-form__group row">
                              <div id="appendDurations">
                                  @include('Organization::subscriptions.components.append_durations')
                              </div>
                            </div>
                          <div class="form-group m-form__group row">
                              <div id="appendPrice" class="col-lg-4">
                                  @include('Organization::subscriptions.components.appendPrice')
                              </div>
                              <div id="appendOverPrice" class="col-lg-4">
                                  @include('Organization::subscriptions.components.appendOverPrice')
                              </div>
                              <div id="appendBalance" class="col-lg-4">
                                  @include('Organization::subscriptions.components.appendBalance')
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>اخر موعد للدفع </label>
                                  <input class="form-control" type="date" name="paid_date" id="paid_date" value="{{ old('paid_date')?old('paid_date'):$record->paid_date }}" required>
                              </div>
                          </div>

                          </div>
                      <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                          <div class="m-form__actions m-form__actions--solid">
                              <div class="row">
                                  <div class="col-lg-6">
                                  </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js" integrity="sha512-Dz4zO7p6MrF+VcOD6PUbA08hK1rv0hDv/wGuxSUjImaUYxRyK2gLC6eQWVqyDN9IM1X/kUA8zkykJS/gEVOd3w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <x-slot name="scripts">
        <script>
            $('#subscriber_id').change(function(){
                var subscriber_id = $(this).val();
                //console.log(subscriber_id)
                var training_id =$(this).data('training');
                console.log(training_id)

                $.ajax({
                    type:'get',
                    url:'{{route('organizations.subscription.append.trainings')}}',
                    data:{
                        "_token": "{{ csrf_token() }}",
                        subscriber_id:subscriber_id,
                        training_id:training_id
                    },
                    success:function(resp){
                        $("#appendTrainings").html(resp);

                    },error:function(){
                        alert('Error');
                    }
                });
            });
        </script>
        <script>
            $('#appendTrainings').change(function(){
                var training_id = $('#training_id').val();
                var subscriber_id = $('#subscriber_id').val();
                var pricing_id = $('#pricing_name').val();
                //console.log(subscriber_id)

                //var price =$(this).data('pricing');

                $.ajax({
                    type:'get',
                    url:'{{route('organizations.subscription.append.pricings')}}',
                    data:{
                        "_token": "{{ csrf_token() }}",
                        training_id:training_id,
                        subscriber_id:subscriber_id,
                        pricing_id:pricing_id,
                    },
                    success:function(resp){
                        $("#appendPricings").html(resp);
                    },error:function(){
                        alert('Error');
                    }
                });
            });
        </script>
        <script>
            $('#appendPricings').change(function(){
                var pricing_id = $('#pricing_name').val();
                var training_id = $('#training_id').val();
                //console.log(training_id)

                $.ajax({
                    type:'get',
                    url:'{{route('organizations.subscription.append.durations')}}',
                    data:{
                        "_token": "{{ csrf_token() }}",
                        pricing_id:pricing_id,
                        training_id:training_id,
                    },
                    success:function(resp){
                        $("#appendDurations").html(resp);
                    },error:function(){
                        alert('Error');
                    }
                });
            });
        </script>
        <script>
            $('#appendDurations').change(function(){
                var start_date = $('#start_date').val();
                var training_id = $('#training_id').val();
                var subscriber_id = $('#subscriber_id').val();


                //console.log(training_id)
                $.ajax({
                    type:'get',
                    url:'{{route('organizations.subscription.append.date.duration')}}',
                    data:{
                        "_token": "{{ csrf_token() }}",
                        start_date:start_date,
                        training_id:training_id,
                        subscriber_id:subscriber_id,
                    },
                    success:function(resp){
                        $("#Duration").html(resp);
                    },error:function(){
                        alert('Error');
                    }
                });
            });
        </script>
        <script>
            $('#appendPricings').change(function(){
                var pricing_name = $('#pricing_name').val();
                var training_id = $('#training_id').val();
                //console.log(pricing_name)
                $.ajax({
                    type:'get',
                    url:'{{route('organizations.subscription.append.balance')}}',
                    data:{
                        "_token": "{{ csrf_token() }}",
                        pricing_name:pricing_name,
                        training_id:training_id,
                    },
                    success:function(resp){
                        $("#appendBalance").html(resp);
                    },error:function(){
                        alert('Error');
                    }
                });
            });
        </script>
        <script>
            $('#appendPricings').change(function(){
                var pricing_name = $('#pricing_name').val();
                var training_id = $('#training_id').val();
                //console.log(pricing_name)
                $.ajax({
                    type:'get',
                    url:'{{route('organizations.subscription.append.price')}}',
                    data:{
                        "_token": "{{ csrf_token() }}",
                        pricing_name:pricing_name,
                        training_id:training_id,
                    },
                    success:function(resp){
                        $("#appendPrice").html(resp);
                    },error:function(){
                        alert('Error');
                    }
                });
            });
        </script>
    </x-slot>
</x-organization::layout>

