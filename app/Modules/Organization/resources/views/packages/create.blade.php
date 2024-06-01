<x-organization::layout>
 <x-slot name="pageTitle">الحزم | اضف</x-slot name="pageTitle">
 @section('packages-active', 'm-menu__item--active m-menu__item--open')
 @section('packages-create-active', 'm-menu__item--active')
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
                الحزم
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
                  <form method="POST" action="{{route('organizations.package.store')}}"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>اسم الحزمه:</label>
                                  <input
                                    type="text"
                                    value="{{old('name')}}"
                                    name="name"
                                    required=""
                                    class="form-control m-input"
                                    placeholder="اسم الحزمه..." />
                                  @error('name')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6"></div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <select name="hall" id="hall" required=""
                                          class="form-control m-input m-input--square"
                                          id="exampleSelect1">
                                      <option value="" disabled selected>Please select a Hall</option>
                                      @foreach($halls as $hall)
                                          <option @if(old('hall')== $hall->id) selected @endif
                                          value="{{ $hall->id }}">{{ $hall->name }}
                                          </option>
                                      @endforeach
                                          @error('hall')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror
                                  </select>
                                  <span class="badge badge-pill badge-primary" id="min-span"></span>
                                  <span class="badge badge-pill badge-primary" id="max-span"></span>
                              </div>
                              <div class="col-lg-6">
                                  <input
                                      type="number"
                                      step="1"
                                      min="0"
                                      id="capacity"
                                      value="0"
                                      name="capacity"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="ادخل العدد..." />
                                  @error('capacity')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

{{--                          @include('Organization::packages.components.item.table')--}}
                          @include('Organization::packages.components.service.table')
{{--                          @include('Organization::packages.components.product.table')--}}
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>السعر النهائي</label>
                                  <input
                                      type="number"
                                      step="0.01"
                                      name="final_price"
                                      id="final_price"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="ادخل السعر النهائي..." />
                                  @error('final_price')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6">
                                  <input
                                      type="number"
                                      step="0.01"
                                      name="actual_price"
                                      id="actual_price"
                                      required=""
                                      hidden
                                      class="form-control m-input"
                                      placeholder="ادخل الفعلي..."/>
                                  @error('actual_price')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label for="description">الوصف:</label>
                                  <textarea id="description" name="description" rows="4" cols="50">{{ old('description') }}</textarea>
                                  @error('description')
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

        {{--Hall Script--}}
        <script>
            $('#hall').on('change',function (){
                var id = $(this).val();
                $.ajax({
                    url: "{{route('organizations.package.get.hall.capacity')}}",
                    data: {id:id},
                    success: function (data) {
                        var max = data['data']['max'];
                        var min = data['data']['min'];
                        $('#min-span').html('Min Capacity: '+min);
                        $('#max-span').html('Max Capacity: '+max);
                    },

                });

            });
        </script>

        {{--Calc Price Script--}}
        <script>
            var items_price = 0
            function calcItemsPrice() {
                var final
                var priceList = $(".form-control.price");
                priceList.each(function() {
                    items_price +=parseFloat(($(this).val()))
                   final = items_price
                });
                items_price = 0 ;
                return final
            }




            var products_price = 0
            function calcProductsPrice() {
                var final
                var priceList = $(".form-control.product_price");
                priceList.each(function() {
                    products_price +=parseFloat(($(this).val()))
                    final = products_price
                });
                products_price = 0 ;
                return final
            }


            var services_price = 0
            function calcServicesPrice() {
                var final
                var priceList = $(".form-control.service_price");
                priceList.each(function() {
                    services_price +=parseFloat(($(this).val()))
                    final = services_price
                });
                services_price = 0 ;
                return final
            }
        </script>

        {{--Items Script--}}
        <script>
            function DeleteItemRowTable(i)
            {
                if($('#items-table tbody tr').length == 1)
                {
                    toastr.error('You can not delete all the Items.');
                    return;
                }
                var p=i.parentNode.parentNode;
                p.parentNode.removeChild(p);
                var total = 0;

                if (calcItemsPrice()){
                    total+=calcItemsPrice();
                }

                if (calcServicesPrice()){
                    total+=calcServicesPrice();
                }

                if (calcProductsPrice()){
                    total+=calcProductsPrice();
                }

                $('#actual_price').val(total)
                $('#final_price').val(total)
            }


            {{--$(document).on("change", ".form-group .nearest .items" , function() {--}}
            {{--    var id = $(this).val();--}}
            {{--    var parent = $(this).parents(".nearest");--}}
            {{--    var nearest_price = parent.find('.price');--}}
            {{--    $.ajax({--}}
            {{--        url: "{{route('organizations.package.get.item.price')}}",--}}
            {{--        data: {id:id},--}}
            {{--        success: function (data) {--}}
            {{--            var price = data['data']['price'];--}}
            {{--            var nearest_quantity = parent.find('.quantity');--}}
            {{--            $(nearest_quantity).on('change',function (){--}}
            {{--                var q = $(this).val();--}}
            {{--                $(nearest_price).val(q*price);--}}
            {{--                var total = 0;--}}

            {{--                if (calcItemsPrice()){--}}
            {{--                    total+=calcItemsPrice();--}}
            {{--                }--}}

            {{--                if (calcServicesPrice()){--}}
            {{--                    total+=calcServicesPrice();--}}
            {{--                }--}}

            {{--                if (calcProductsPrice()){--}}
            {{--                    total+=calcProductsPrice();--}}
            {{--                }--}}

            {{--                $('#actual_price').val(total)--}}
            {{--                $('#final_price').val(total)--}}
            {{--            });--}}
            {{--        },--}}

            {{--    });--}}
            {{--});--}}


            {{--$(document).on('click','#new_item_row',function(){--}}
            {{--    $.ajax({--}}
            {{--        url: "{{route('organizations.package.get.item.row')}}",--}}
            {{--        // data: {items:items,services:services},--}}
            {{--        success: function (data) {--}}
            {{--            $('#items-table  tbody:last-child').append(data['data']['responseHTML']);--}}
            {{--            $(".vendor-id").selectpicker();--}}
            {{--        },--}}

            {{--    });--}}


            {{--});--}}


            function DeleteProductRowTable(i)
            {
                if($('#products-table tbody tr').length == 1)
                {
                    toastr.error('You can not delete all the Products.');
                    return;
                }
                var p=i.parentNode.parentNode;
                p.parentNode.removeChild(p);
                var total = 0;

                if (calcItemsPrice()){
                    total+=calcItemsPrice();
                }

                if (calcServicesPrice()){
                    total+=calcServicesPrice();
                }

                if (calcProductsPrice()){
                    total+=calcProductsPrice();
                }

                $('#actual_price').val(total)
                $('#final_price').val(total)
            }

            $(document).on("change", ".form-group #capacity" , function() {

                var total = 0;

                if (calcItemsPrice()){
                    total+=calcItemsPrice();
                }

                if (calcServicesPrice()){
                    total+=calcServicesPrice();
                }

                if (calcProductsPrice()){
                    total+=calcProductsPrice();
                }

                $('#actual_price').val(total)
                $('#final_price').val(total)


            });


            $(document).on('click','#new_product_row',function(){
                $.ajax({
                    url: "{{route('organizations.package.get.product.row')}}",
                    // data: {items:items,services:services},
                    success: function (data) {
                        $('#products-table  tbody:last-child').append(data['data']['responseHTML']);
                        $(".vendor-id").selectpicker();
                    },

                });


            });


            $(document).on("change", ".form-group .nearest .products" , function() {

                var id = $(this).val();
                var cap = $("#capacity").val();
                var parent = $(this).parents(".nearest");
                var nearest_price = parent.find('.product_price');

                $.ajax({
                    url: "{{route('organizations.package.get.product.price')}}",
                    data: {id:id,cap:cap},
                    success: function (data) {
                        var price = data['data']['price'];
                        $(nearest_price).val(price);
                        var total = 0;

                        if (calcItemsPrice()){
                            total+=calcItemsPrice();
                        }

                        if (calcServicesPrice()){
                            total+=calcServicesPrice();
                        }

                        if (calcProductsPrice()){
                            total+=calcProductsPrice();
                        }

                                $('#actual_price').val(total)
                                $('#final_price').val(total)



                    },

                });
            });


        </script>

        {{--Service Script--}}
        <script>
            function DeleteServiceRowTable(i)
            {
                if($('#services-table tbody tr').length == 1)
                {
                    toastr.error('You can not delete all the Services.');
                    return;
                }
                var p=i.parentNode.parentNode;
                p.parentNode.removeChild(p);
                var total = 0;

                if (calcItemsPrice()){
                    total+=calcItemsPrice();
                }

                if (calcServicesPrice()){
                    total+=calcServicesPrice();
                }

                if (calcProductsPrice()){
                    total+=calcProductsPrice();
                }

                $('#actual_price').val(total)
                $('#final_price').val(total)
            }


            $(document).on("change", ".form-group .nearest .services" , function() {
                var id = $(this).val();
                var parent = $(this).parents(".nearest");
                var nearest_price = parent.find('.service_price');
                $.ajax({
                    url: "{{route('organizations.package.get.service.price')}}",
                    data: {id:id},
                    success: function (data) {
                        var price = data['data']['price'];
                        var nearest_quantity = parent.find('.service_quantity');
                        $(nearest_quantity).on('change',function (){
                            var q = $(this).val();
                            $(nearest_price).val(q*price);
                            var total = 0;

                            if (calcItemsPrice()){
                                total+=calcItemsPrice();
                            }

                            if (calcServicesPrice()){
                                total+=calcServicesPrice();
                            }

                            if (calcProductsPrice()){
                                total+=calcProductsPrice();
                            }

                            $('#actual_price').val(total)
                            $('#final_price').val(total)
                        });
                    },

                });
            });
            $(document).on('click','#new_service_row',function(){

                $.ajax({
                    url: "{{route('organizations.package.get.service.row')}}",
                    success: function (data) {
                        $('#services-table  tbody:last-child').append(data['data']['responseHTML']);
                        $(".vendor-id").selectpicker();
                    },

                });
            });

        </script>

    </x-slot>
</x-organization::layout>
