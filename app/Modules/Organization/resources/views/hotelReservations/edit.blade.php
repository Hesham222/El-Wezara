<x-organization::layout>
 <x-slot name="pageTitle">حجوزات الفنادق | تعديل</x-slot name="pageTitle">
 @section('hotelReservations-active', 'm-menu__item--active m-menu__item--open')
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
                حجوزات الفنادق
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
                  <form method="POST" action="{{route('organizations.hotelReservation.update', $record->id)}}" enctype="multipart/form-data"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      @method('put')
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-3">
                                  <label>أختر الفندق :</label>
                                  <select name="hotel" required="" class="form-control m-input m-input--square" id="hotelId">
                                      <option value="">أختر فندق</option>
                                      @foreach($hotels as $hotel)
                                          <option @if(old('hotel') == $hotel->id || $hotel->id == $record->hotel_id) selected @endif value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                      @endforeach
                                  </select>
                                  @error('hotel')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-3">
                                  <label> العميل:</label>
                                  <select name="customer_id" required=""
                                          class="form-control m-input m-input--square"
                                          id="exampleSelect1">
                                      @foreach($customers as $customer)
                                          <option @if(old('customer_id')== $customer->id || $customer->id==$record->customer_id) selected @endif
                                          value="{{ $customer->id }}">{{ $customer->name }}
                                          </option>
                                      @endforeach
                                  </select>
                                  @error('customer_id')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-3">
                                  <label> نوع الغرفه:</label>
                                  <select name="roomType_id" required=""
                                          class="form-control m-input m-input--square"
                                          id="exampleSelect1">
                                      @foreach($roomTypes as $roomType)
                                          <option @if(old('roomType_id')== $roomType->id || $roomType->id==$record->roomType_id) selected @endif
                                          value="{{ $roomType->id }}">{{ $roomType->name }}
                                          </option>
                                      @endforeach
                                  </select>
                                  @error('roomType_id')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-3">
                                  <label>الشركة - (اختياري) :</label>
                                  <select name="supplier" class="form-control m-input m-input--square">
                                      <option value="">أختر الشركة</option>
                                      @foreach($suppliers as $supplier)
                                          <option @if($record->supplier_id == $supplier->id) selected @endif value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                      @endforeach
                                  </select>
                                  @error('supplier')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-4">
                                  <label>تاريخ الوصول</label>
                                  <input class="form-control" type="date" name="arrival_date" id="arrival_date" value="{{ old('arrival_date')?old('arrival_date'):$record->arrival_date }}" required>
                              </div>
                              <div id="appendDepartureDate" class="col-lg-4">
                                  @include('Organization::hotelReservations.components.append_departure_date')
                              </div>
                              <div id="appendNumberOfNights" class="col-lg-4">
                                  @include('Organization::hotelReservations.components.append_num_of_nights')
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div id="appendRoom" class="col-lg-4">
                                  @include('Organization::hotelReservations.components.append_room')
                              </div>
                              <div id="appendPriceNight" class="col-lg-4">
                                  @include('Organization::hotelReservations.components.append_price_night')
                              </div>
                              <div id="appendTotalPriceNight" class="col-lg-4">
                                  @include('Organization::hotelReservations.components.append_total_price_night')
                              </div>

                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-4">
                                  <label>عدد الاطفال :</label>
                                  <input
                                      type="number"
                                      value="{{old('num_of_children')?old('num_of_children'):$record->num_of_children}}"
                                      name="num_of_children"
                                      id="num_of_children"
                                      class="form-control m-input"
                                  />
                                  @error('num_of_children')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4">
                                  <label>عدد السراير الاضافيه :</label>
                                  <input
                                      type="number"
                                      value="{{old('num_of_extra_beds')?old('num_of_extra_beds'):$record->num_of_extra_beds}}"
                                      name="num_of_extra_beds"
                                      id="num_of_extra_beds"
                                      class="form-control m-input"
                                  />
                                  @error('num_of_extra_beds')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div id="appendFinalPrice" class="col-lg-4">
                                  @include('Organization::hotelReservations.components.append_final_price')
                              </div>
                          </div>
                          @include('Organization::hotelReservations.components.accounts.table')
                          @include('Organization::hotelReservations.components.children.table')
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

    <x-slot name="scripts">
        <script>
            function DeleteVendorRowTable(i)
            {
                if($('#ingredients-table tbody tr').length == 1)
                {
                    toastr.error('You can not delete all the children.');
                    return;
                }
                var p=i.parentNode.parentNode;
                p.parentNode.removeChild(p);
            }
            $(document).on('click','#new_row',function(){

                $.ajax({
                    url: "<?php echo e(route('organizations.hotelReservation.get.children.row')); ?>",
                    success: function (data) {
                        $('#ingredients-table > tbody:last-child').append(data['data']['responseHTML']);
                        $(".vendor-id").selectpicker();
                    },

                });
            });

        </script>
        <script>
            function DeletePricingRowTable(i)
            {
                if($('#pricing-table tbody tr').length == 1)
                {
                    toastr.error('You can not delete all the accounts.');
                    return;
                }
                var p=i.parentNode.parentNode;
                p.parentNode.removeChild(p);
            }
            $(document).on('click','#new_pricing_row',function(){

                $.ajax({
                    url: "<?php echo e(route('organizations.hotelReservation.get.account.row')); ?>",
                    success: function (data) {
                        $('#pricing-table > tbody:last-child').append(data['data']['responseHTML']);
                        $(".vendor-id").selectpicker();
                    },

                });
            });

        </script>
        <script>
            $('#appendDepartureDate').change(function(){
                var departure_date  = $('#departure_date').val();
                var arrival_date    = $('#arrival_date').val();
                //console.log(training_id)
                $.ajax({
                    type:'get',
                    url:'{{route('organizations.hotelReservation.append.number.nights')}}',
                    data:{
                        "_token": "{{ csrf_token() }}",
                        departure_date:departure_date,
                        arrival_date:arrival_date,
                    },
                    success:function(resp){
                        $("#appendNumberOfNights").html(resp);
                    },error:function(){
                        alert('Error');
                    }
                });
            });
        </script>
        <script>
            $('#appendNumberOfNights').change(function(){
                var arrival_date     = $('#arrival_date').val();
                var num_of_nights    = $('#num_of_nights').val();
                //console.log(training_id)
                $.ajax({
                    type:'get',
                    url:'{{route('organizations.hotelReservation.append.departure.date')}}',
                    data:{
                        "_token": "{{ csrf_token() }}",
                        arrival_date:arrival_date,
                        num_of_nights:num_of_nights,
                    },
                    success:function(resp){
                        $("#appendDepartureDate").html(resp);
                    },error:function(){
                        alert('Error');
                    }
                });
            });
        </script>
        <script>
            $('#CustomerRoom').change(function(){
                var customer_id         = $('#customer_id').val();
                var roomType_id         = $('#roomType_id').val();
                var hotel_id            = $('#hotelId').val();
                $.ajax({
                    type:'get',
                    url:'{{route('organizations.hotelReservation.append.rooms')}}',
                    data:{
                        "_token": "{{ csrf_token() }}",
                        customer_id:customer_id,
                        roomType_id:roomType_id,
                        hotel_id:hotel_id,
                    },
                    success:function(resp){
                        $("#appendRoom").html(resp);
                    },error:function(){
                        alert('Error');
                    }
                });
            });
        </script>
        <script>
            $('#CustomerRoom').change(function(){
                var customer_id         = $('#customer_id').val();
                var roomType_id         = $('#roomType_id').val();
                $.ajax({
                    type:'get',
                    url:'{{route('organizations.hotelReservation.append.price.night')}}',
                    data:{
                        "_token": "{{ csrf_token() }}",
                        customer_id:customer_id,
                        roomType_id:roomType_id,
                    },
                    success:function(resp){
                        $("#appendPriceNight").html(resp);
                    },error:function(){
                        alert('Error');
                    }
                });
            });
        </script>
        <script>
            $('#appendDepartureDate').change(function(){
                var departure_date      = $('#departure_date').val();
                var arrival_date        = $('#arrival_date').val();
                var customer_id         = $('#customer_id').val();
                var roomType_id         = $('#roomType_id').val();

                $.ajax({
                    type:'get',
                    url:'{{route('organizations.hotelReservation.append.total.price.night')}}',
                    data:{
                        "_token": "{{ csrf_token() }}",
                        departure_date:departure_date,
                        arrival_date:arrival_date,
                        customer_id:customer_id,
                        roomType_id:roomType_id,
                    },
                    success:function(resp){
                        $("#appendTotalPriceNight").html(resp);
                    },error:function(){
                        alert('Error');
                    }
                });
            });
        </script>
        <script>
            $('#appendNumberOfNights').change(function(){
                var num_of_nights       = $('#num_of_nights').val();
                var customer_id         = $('#customer_id').val();
                var roomType_id         = $('#roomType_id').val();

                $.ajax({
                    type:'get',
                    url:'{{route('organizations.hotelReservation.append.total.price')}}',
                    data:{
                        "_token": "{{ csrf_token() }}",
                        num_of_nights:num_of_nights,
                        customer_id:customer_id,
                        roomType_id:roomType_id,
                    },
                    success:function(resp){
                        $("#appendTotalPriceNight").html(resp);
                    },error:function(){
                        alert('Error');
                    }
                });
            });
        </script>
        <script>
            $('#num_of_extra_beds').change(function(){
                var num_of_extra_beds           = $('#num_of_extra_beds').val();
                var num_of_children             = $('#num_of_children').val();
                var customer_id                 = $('#customer_id').val();
                var roomType_id                 = $('#roomType_id').val();
                var departure_date              = $('#departure_date').val();
                var arrival_date                = $('#arrival_date').val();

                $.ajax({
                    type:'get',
                    url:'{{route('organizations.hotelReservation.append.final.price')}}',
                    data:{
                        "_token": "{{ csrf_token() }}",
                        num_of_extra_beds:num_of_extra_beds,
                        num_of_children:num_of_children,
                        customer_id:customer_id,
                        roomType_id:roomType_id,
                        departure_date:departure_date,
                        arrival_date:arrival_date,
                    },
                    success:function(resp){
                        $("#appendFinalPrice").html(resp);
                    },error:function(){
                        alert('Error');
                    }
                });
            });
        </script>
        <script>
            $('#appendNumberOfNights').change(function(){
                var num_of_extra_beds           = $('#num_of_extra_beds').val();
                var num_of_children             = $('#num_of_children').val();
                var customer_id                 = $('#customer_id').val();
                var roomType_id                 = $('#roomType_id').val();
                var num_of_nights               = $('#num_of_nights').val();


                $.ajax({
                    type:'get',
                    url:'{{route('organizations.hotelReservation.append.final.price.night')}}',
                    data:{
                        "_token": "{{ csrf_token() }}",
                        num_of_extra_beds:num_of_extra_beds,
                        num_of_children:num_of_children,
                        customer_id:customer_id,
                        roomType_id:roomType_id,
                        num_of_nights:num_of_nights,
                    },
                    success:function(resp){
                        $("#appendFinalPrice").html(resp);
                    },error:function(){
                        alert('Error');
                    }
                });
            });
        </script>
    </x-slot>
</x-organization::layout>

