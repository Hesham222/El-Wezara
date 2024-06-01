<x-organization::layout>
 <x-slot name="pageTitle">اعاده طلب | اضف</x-slot name="pageTitle">
 @section('laundryOrders-active', 'm-menu__item--active m-menu__item--open')
 @section('laundryOrders-return-create-active', 'm-menu__item--active')
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
                اعاده طلب
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
                  <form method="POST" action="{{route('organizations.laundryOrder.store')}}" enctype="multipart/form-data"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>اختر طلب:</label>
                                  <select name="orders" id="orders" required=""
                                          class="form-control m-input m-input--square orders"
                                          id="exampleSelect1">
                                      <option value="" disabled selected>Please select an order</option>
                                      @foreach($orders as $order)
                                          <option @if(old('orders')== $order->id) selected @endif
                                          value="{{ $order->id }}">{{ $order->customer_name }}-{{$order->total_price}}
                                          </option>
                                      @endforeach
                                  </select>

                              </div>
                              <div class="col-lg-6">
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-4">
                                  <label>الاسم كامل:</label>
                                  <input
                                      type="text"
                                      value="{{old('name')}}"
                                      name="name"
                                      required=""
                                      readonly
                                      id="name"
                                      class="form-control m-input"
                                      placeholder="ادخل الاسم كامل..." />
                                  @error('name')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4">
                                  <label class="">الرقم:</label>
                                  <input
                                      type="phone" maxlength="15"
                                      value="{{old('mobile')}}"
                                      name="mobile"
                                      required=""
                                      readonly
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
                              <div class="col-lg-4">
                                  <label>الاسم المغسله:</label>
                                  <input
                                      type="text"
                                      value="{{old('laundry_name')}}"
                                      name="laundry_name"
                                      required=""
                                      readonly
                                      id="laundry_name"
                                      class="form-control m-input"
                                      placeholder="ادخل الاسم كامل..." />
                                  @error('laundry_name')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-12">
                                  <label class="">خدمه اضافيه:</label><br>
                                  <table  width="100%" class="table table-striped- table-bordered table-hover table-checkable" id="categories-table">
                                      <col style="width:20%">
                                      <col style="width:20%">
                                      <col style="width:20%">
                                      <col style="width:30%">
                                      <col style="width:10%">
                                      <col style="width:10%">
                                      <thead>
                                      <tr>
                                          <th style="font-weight: bold;">التصنيف</th>
                                          <th style="font-weight: bold;">التصنيف الفرعي</th>
                                          <th style="font-weight: bold;">الخدمه</th>
                                          <th style="font-weight: bold;">الكميه</th>
                                          <th style="font-weight: bold;">السعر</th>
                                          <th style="font-weight: bold;">مسح</th>
                                      </tr>
                                      </thead>
                                      <tbody id="old_table">
                                      </tbody>
                                  </table>
                              </div>
                          </div>

                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>تاريخ الطلب:</label>
                                  <input class="form-control date" type="date" name="date" id="date" value="{{ old('date') }}" required>
                              </div>
                              <div class="col-lg-6">
                                  <label>الوقت:</label>
                                  <input class="form-control date" type="time" name="time" id="time" value="{{ old('time') }}" required>
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

{{--        @foreach($categories as $category)--}}
{{--            <option @if($record->laundryOrderServices->laundrySubCategory->parent->id === $category->id) selected @endif--}}
{{--            value="{{ $category->id }}">{{ $category->name }}--}}
{{--            </option>--}}
{{--        @endforeach--}}

        {{--Order Script--}}
        <script>
            $('#orders').on('change',function (){
                var id = $(this).val();
                $.ajax({
                    url: "{{route('organizations.returnLaundryOrder.get.order.details')}}",
                    data: {id:id},
                    success: function(data) {
                        $('#name').val(data['data']['order']['customer_name'])
                        $('#mobile').val(data['data']['order']['customer_mobile'])
                        $('#laundry_name').val(data['data']['laundry'])
                        $('#total_price').val(data['data']['order']['total_price'])
                        $('#paid_amount').val(data['data']['order']['paid_amount'])
                        $('#remaining_amount').val(data['data']['order']['remaining_amount'])
                        $('#old_table').empty()
                        $.each(data['data']['laundryOrderServices'],function (key,value){
                                $.ajax({
                                    url: "{{route('organizations.returnLaundryOrder.get.service.row')}}",
                                    success: function (d) {
                                        $('#categories-table  tbody:last-child').append(d['data']['responseHTML']);
                                        $(".vendor-id").selectpicker();
                                        var parent = $('.categories').parents(".nearest-category");
                                        var nearest_subcategory = parent.find('.subCategories');
                                        var nearest_category = parent.find('.categories');
                                        var nearest_service = parent.find('.services');
                                        // nearest_category.append('<option value="' +
                                        //     index + '">' + val + '</option>');
                                        //
                                        // nearest_subcategory.append('<option value="' +
                                        //     index + '">' + val + '</option>');
                                        //
                                        // nearest_service.append('<option value="' +
                                        //     index + '">' + val + '</option>');
                                    },

                                });
                        })
                    },
                })
            })

{{--            @foreach($categories as $category)--}}
{{--            <option @if($record->laundryOrderServices->laundrySubCategory->parent->id === $category->id) selected @endif--}}
{{--                value="{{ $category->id }}">{{ $category->name }}--}}
{{--                </option>--}}
{{--            @endforeach--}}
        </script>

        {{--Service Script--}}
        <script>
            function DeleteServiceRowTable(i)
            {
                var p=i.parentNode.parentNode;
                p.parentNode.removeChild(p);
                calcServicesPrice();

            }

        </script>

        {{--Get subcategories Script--}}
{{--        <script>--}}
{{--            $(document).on('change',".form-group .categories",function (){--}}
{{--                var id = $(this).val();--}}
{{--                var parent = $(this).parents(".nearest-category");--}}
{{--                var nearest_subcategory = parent.find('.subCategories');--}}
{{--                $.ajax({--}}
{{--                    url: "{{route('organizations.returnLaundryOrder.get.subCategories')}}",--}}
{{--                    data: {id:id},--}}
{{--                    success: function(data) {--}}
{{--                        $(nearest_subcategory).empty();--}}
{{--                        $(nearest_subcategory).append('<option disabled selected>Please select a sub category</option>');--}}
{{--                        $.each(data['data'], function(key, value) {--}}
{{--                            $(nearest_subcategory).append('<option value="' +--}}
{{--                                key + '" >' + value + '</option>');--}}
{{--                        });--}}
{{--                    },--}}
{{--                });--}}
{{--            });--}}
{{--        </script>--}}

        {{--Get subcategories Services Script--}}
{{--        <script>--}}
{{--            $(document).on('change',".form-group .subCategories",function (){--}}
{{--                var id = $(this).val();--}}
{{--                var parent = $(this).parents(".nearest-category");--}}
{{--                var nearest_service = parent.find('.services');--}}
{{--                $.ajax({--}}
{{--                    url: "{{route('organizations.returnLaundryOrder.get.subCategories.services')}}",--}}
{{--                    data: {id:id},--}}
{{--                    success: function(data) {--}}
{{--                        $(nearest_service).empty();--}}
{{--                        $(nearest_service).append('<option disabled selected>Please select a service</option>');--}}
{{--                        $.each(data['data'], function(key,value) {--}}
{{--                            var val = Object.keys(value)['0']--}}
{{--                            var index = Object.values(value)['0']--}}
{{--                            $(nearest_service).append('<option value="' +--}}
{{--                                    index + '">' + val + '</option>');--}}
{{--                        });--}}
{{--                    },--}}
{{--                });--}}
{{--            });--}}
{{--        </script>--}}

        {{--Get subcategory price Script--}}
{{--        <script>--}}
{{--            $(document).on('change',".form-group .services",function (){--}}
{{--                var id = $(this).val();--}}
{{--                var parent = $(this).parents(".nearest-category");--}}
{{--                var nearest_price = parent.find('.category_price');--}}
{{--                $.ajax({--}}
{{--                    url: "{{route('organizations.returnLaundryOrder.get.subCategory.service.price')}}",--}}
{{--                    data: {id:id},--}}
{{--                    success: function(data) {--}}
{{--                        var price = data['data']['price'];--}}
{{--                        var nearest_quantity = parent.find('.category_quantity');--}}
{{--                        $(nearest_quantity).on('change',function (){--}}
{{--                            var q = $(this).val();--}}
{{--                            $(nearest_price).val(q*price);--}}
{{--                            calcServicesPrice();--}}
{{--                        });--}}
{{--                    },--}}

{{--                });--}}
{{--            });--}}
{{--        </script>--}}

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
