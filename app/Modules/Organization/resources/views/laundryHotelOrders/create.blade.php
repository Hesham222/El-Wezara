<x-organization::layout>
 <x-slot name="pageTitle">طلبات اسكان | اضف</x-slot name="pageTitle">
 @section('laundryHotelOrders-active', 'm-menu__item--active m-menu__item--open')
 @section('laundryHotelOrders-create-active', 'm-menu__item--active')
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
                طلبات اسكان
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
                  <form method="POST" action="{{route('organizations.laundryHotelOrder.store')}}" enctype="multipart/form-data"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>اختر الفندق:</label>
                                  <select name="hotels" id="hotels" required="" class="form-control hotels">
                                      <option value="" disabled selected>Please select an hotel</option>
                                      @foreach($hotels as $hotel)
                                          <option @if(old('hotels')== $hotel->id) selected @endif
                                          value="{{ $hotel->id }}">{{ $hotel->name }}
                                          </option>
                                      @endforeach
                                  </select>
                              </div>
                              <div class="col-lg-6">
                                  <label>اختر الغرفه:</label>
                                  <select name="rooms" id="rooms" required="" class="form-control rooms">
                                      <option value="" disabled selected>Please select an hotel</option>
                                      @foreach($rooms as $room)
                                          <option @if(old('rooms')== $room->id) selected @endif
                                          value="{{ $room->id }}">{{ $room->room_num }}
                                          </option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>اختر المغسله:</label>
                                  <select name="laundry_id" id="laundry_id" required="" class="form-control hotels">
                                      <option value="" disabled selected>Please select an hotel</option>
                                      @foreach($laundries as $laundry)
                                          <option @if(old('laundry_id')== $laundry->id) selected @endif
                                          value="{{ $laundry->id }}">{{ $laundry->name }}
                                          </option>
                                      @endforeach
                                  </select>
                              </div>

                              <div class="col-lg-6"></div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>الاسم كامل:</label>
                                  <input
                                      type="text"
                                      value="{{old('name')}}"
                                      name="name"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="ادخل الاسم كامل..." />
                                  @error('name')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6">
                                  <label class="">رقم الموبايل:</label>
                                  <input
                                      type="phone" maxlength="15"
                                      value="{{old('mobile')}}"
                                      name="mobile"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="ادخل الموبايل..."
                                      id="mobile"
                                  />
                                  @error('phone')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          @include('Organization::laundryHotelOrders.components.service.table')
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>المبلغ الكلي:</label>
                                  <input
                                      type="number"
                                      step="0.01"
                                      name="total_price"
                                      id="total_price"
                                      value="{{old('total_price')}}"
                                      required=""
                                      class="form-control m-input"
                                      readonly
                                      placeholder="ادخل المبلغ الكلي..." />
                                  @error('total_price')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6"></div>

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
        {{--Service Script--}}
        <script>
            function DeleteServiceRowTable(i)
            {
                var p=i.parentNode.parentNode;
                p.parentNode.removeChild(p);
                calcServicesPrice();

            }

            $(document).on('click','#new_service_row',function(){
                $.ajax({
                    url: "{{route('organizations.laundryHotelOrder.get.service.row')}}",
                    success: function (data) {
                        $('#categories-table  tbody:last-child').append(data['data']['responseHTML']);
                        $(".vendor-id").selectpicker();
                    },

                });
            });

        </script>

        {{--Get subcategories Script--}}
        <script>
            $(document).on('change',".form-group .categories",function (){
                var id = $(this).val();
                var parent = $(this).parents(".nearest-service");
                var nearest_subcategory = parent.find('.subCategories');

                $.ajax({
                    url: "{{route('organizations.laundryHotelOrder.get.subCategories')}}",
                    data: {id:id},
                    success: function(data) {
                        $(nearest_subcategory).empty();
                        $(nearest_subcategory).append('<option disabled selected>Please select a sub category</option>');
                        $.each(data['data'], function(key, value) {
                            $(nearest_subcategory).append('<option value="' +
                                key + '">' + value + '</option>');
                        });
                    },
                });
            });
        </script>

        {{--Get subcategories Services Script--}}
        <script>
            $(document).on('change',".form-group .subCategories",function (){
                var id = $(this).val();
                var parent = $(this).parents(".nearest-service");
                var nearest_service = parent.find('.services');
                $.ajax({
                    url: "{{route('organizations.laundryHotelOrder.get.subCategories.services')}}",
                    data: {id:id},
                    success: function(data) {
                        $(nearest_service).empty();
                        $(nearest_service).append('<option disabled selected>Please select a service</option>');
                        $.each(data['data'], function(key,value) {
                            var val = Object.keys(value)['0']
                            var index = Object.values(value)['0']
                            $('select[name="services[]"]').append('<option value="' +
                                index + '">' + val + '</option>');
                        });
                    },
                });
            });
        </script>

        {{--Get subcategory price Script--}}
        <script>
            $(document).on('change',".form-group .services",function (){
                var id = $(this).val();
                var parent = $(this).parents(".nearest-service");
                var nearest_price = parent.find('.category_price');
                $.ajax({
                    url: "{{route('organizations.laundryHotelOrder.get.subCategory.service.price')}}",
                    data: {id:id},
                    success: function(data) {
                        var price = data['data']['price'];
                        var nearest_quantity = parent.find('.category_quantity');
                        $(nearest_quantity).on('change',function (){
                            var q = $(this).val();
                            $(nearest_price).val(q*price);
                            calcServicesPrice();
                        });
                    },

                });
            });
        </script>

        {{--calc service price Script--}}
        <script>
            var services_price = 0
            function calcServicesPrice() {
                var final = 0
                var priceList = $(".form-control.category_price");
                priceList.each(function() {
                    services_price +=parseFloat(($(this).val()))
                    final = services_price
                });
                services_price = 0 ;
                $('#total_price').val(final);
                $('#remaining_amount').val(final);
            }
        </script>
    </x-slot>
</x-organization::layout>
