<x-organization::layout>
 <x-slot name="pageTitle">الحزم | تعديل</x-slot name="pageTitle">
 @section('packages-active', 'm-menu__item--active m-menu__item--open')
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
                حزمه
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
                  <form method="POST" action="{{route('organizations.package.update', $record->id)}}"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      @method('put')
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>اسم الحزمه:</label>
                                  <input
                                      type="text"
                                      value="{{old('name')?old('name'):$record->name}}"
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
                                          <option @if($record->hall_id == $hall->id) selected @endif
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
                                      value="{{old('capacity')?old('capacity'):$record->capacity}}"
                                      name="capacity"
                                      id="capacity"
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
{{--                          <div class="form-group m-form__group row">--}}
{{--                                  <div class="col-lg-12">--}}
{{--                                      <label class="">المعدات:</label><br>--}}
{{--                                      <table  width="100%" class="table table-striped- table-bordered table-hover table-checkable" id="items-table">--}}
{{--                                          <col style="width:30%">--}}
{{--                                          <col style="width:20%">--}}
{{--                                          <col style="width:20%">--}}
{{--                                          <col style="width:30%">--}}
{{--                                          <col style="width:10%">--}}
{{--                                          <thead>--}}
{{--                                          <tr>--}}
{{--                                              <th style="font-weight: bold;">العنصر</th>--}}
{{--                                              <th style="font-weight: bold;">الكميه</th>--}}
{{--                                              <th style="font-weight: bold;">السعر</th>--}}
{{--                                              <th style="font-weight: bold;">تفاصيل</th>--}}
{{--                                              <th style="font-weight: bold;">مسح</th>--}}
{{--                                          </tr>--}}
{{--                                          </thead>--}}
{{--                                          <tbody>--}}
{{--                                          @foreach($record->packageItems as $value)--}}
{{--                                              <tr class="nearest">--}}
{{--                                                  <td>--}}
{{--                                                      <select name="items[]" id="items" required=""--}}
{{--                                                              class="form-control m-input m-input--square items"--}}
{{--                                                              id="exampleSelect1">--}}
{{--                                                          <option value="" disabled selected>Please select an Item</option>--}}
{{--                                                          @foreach($items as $item)--}}
{{--                                                              <option @if( $value->item_id == $item->id) selected @endif--}}
{{--                                                              value="{{ $item->id }}">{{ $item->name }}--}}
{{--                                                              </option>--}}
{{--                                                          @endforeach--}}
{{--                                                      </select>--}}
{{--                                                  </td>--}}
{{--                                                  <td>--}}
{{--                                                      <input--}}
{{--                                                          type="number"--}}
{{--                                                          step="1"--}}
{{--                                                          value="{{old('quantity[]') ? old('quantity[]'):$value->quantity}}"--}}
{{--                                                          name="quantity[]"--}}
{{--                                                          required=""--}}
{{--                                                          class="form-control m-input quantity"--}}
{{--                                                          placeholder="ادخل الكميه..." />--}}
{{--                                                  </td>--}}
{{--                                                  <td>--}}
{{--                                                      <input--}}
{{--                                                          type="number"--}}
{{--                                                          step="0.01"--}}
{{--                                                          value="{{old('price[]') ? old('price[]'):$value->price}}"--}}
{{--                                                          name="price[]"--}}
{{--                                                          required=""--}}
{{--                                                          class="form-control m-input price"--}}
{{--                                                          placeholder="ادخل السعر..." />--}}

{{--                                                  </td>--}}
{{--                                                  <td class="col-lg-6">--}}
{{--                                                      <textarea id="description" name="description_item[]" rows="4" cols="50">{{ $value->description }}</textarea>--}}
{{--                                                      @error('description_item')--}}
{{--                                                      <span class="invalid-feedback" role="alert">--}}
{{--                                                            <strong>{{ $message }}</strong>--}}
{{--                                                    </span>--}}
{{--                                                      @enderror--}}
{{--                                                  </td>--}}
{{--                                                  <td>--}}
{{--                                                      <a--}}
{{--                                                          title="Remove the row"--}}
{{--                                                          class="btn btn-sm btn-danger"--}}
{{--                                                          onclick="DeleteItemRowTable(this)">--}}
{{--                                                          <i class="fa fa-times" style="color: #fff"></i>--}}
{{--                                                      </a>--}}
{{--                                                  </td>--}}
{{--                                              </tr>--}}
{{--                                          @endforeach--}}
{{--                                          </tbody>--}}
{{--                                      </table>--}}
{{--                                      <div class="row">--}}
{{--                                          <div class="col-lg-12">--}}
{{--                                              <button type="button" class="btn btn-default " id="new_item_row"><i class="fa fa-plus"></i></button>--}}
{{--                                          </div>--}}
{{--                                      </div>--}}
{{--                                  </div>--}}
{{--                              </div>--}}
                          <div class="form-group m-form__group row">
                                  <div class="col-lg-12">
                                      <label class="">الخدمات:</label><br>
                                      <table  width="100%" class="table table-striped- table-bordered table-hover table-checkable" id="services-table">
                                          <col style="width:30%">
                                          <col style="width:20%">
                                          <col style="width:20%">
                                          <col style="width:30%">
                                          <col style="width:10%">
                                          <thead>
                                          <tr>
                                              <th style="font-weight: bold;">الخدمه</th>
                                              <th style="font-weight: bold;">الكميه</th>
                                              <th style="font-weight: bold;">السعر</th>
                                              <th style="font-weight: bold;">تفاصيل</th>
                                              <th style="font-weight: bold;">مسح</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                          @foreach($record->packageSupplierServices as $value)
                                              <tr class="nearest">
                                                  <td>
                                                      <select name="services[]" id="services" required=""
                                                              class="form-control m-input m-input--square services"
                                                              id="exampleSelect1">
                                                          <option value="" disabled selected>Please select a Service</option>
                                                          @foreach($services as $service)
                                                              <option @if($value->supplier_service_id== $service->id) selected @endif
                                                              value="{{ $service->id }}">{{ $service->name }}
                                                              </option>
                                                          @endforeach
                                                      </select>
                                                  </td>
                                                  <td>
                                                      <input
                                                          type="number"
                                                          step="1"
                                                          value="{{old('service_quantity[]') ? old('service_quantity[]'):$value->quantity}}"
                                                          name="service_quantity[]"
                                                          required=""
                                                          class="form-control m-input service_quantity"
                                                          placeholder="ادخل الكميه..." />
                                                  </td>
                                                  <td>
                                                      <input
                                                          type="number"
                                                          step="0.01"
                                                          value="{{old('service_price[]') ? old('service_price[]'):$value->price}}"
                                                          name="service_price[]"
                                                          required=""
                                                          class="form-control m-input service_price"
                                                          placeholder="ادخل السعر..." />

                                                  </td>
                                                  <td class="col-lg-6">
                                                      <textarea id="description" name="description_service[]" rows="4" cols="50">{{ $value->description }}</textarea>
                                                      @error('description_service')
                                                      <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                    </span>
                                                      @enderror
                                                  </td>

                                                  <td>
                                                      <a
                                                          title="Remove the row"
                                                          class="btn btn-sm btn-danger"
                                                          onclick="DeleteServiceRowTable(this)">
                                                          <i class="fa fa-times" style="color: #fff"></i>
                                                      </a>
                                                  </td>
                                              </tr>
                                          @endforeach
                                          </tbody>
                                      </table>
                                      <div class="row">
                                          <div class="col-lg-12">
                                              <button type="button" class="btn btn-default " id="new_service_row"><i class="fa fa-plus"></i></button>
                                          </div>
                                      </div>
                                  </div>
                              </div>




{{--                          <div class="form-group m-form__group row">--}}
{{--                              <div class="col-lg-12">--}}
{{--                                  <label class="">المنتجات:</label><br>--}}
{{--                                  <table  width="100%" class="table table-striped- table-bordered table-hover table-checkable" id="products-table">--}}
{{--                                      <col style="width:30%">--}}
{{--                                      <col style="width:20%">--}}
{{--                                      <col style="width:20%">--}}
{{--                                      <col style="width:30%">--}}
{{--                                      <col style="width:10%">--}}
{{--                                      <thead>--}}
{{--                                      <tr>--}}
{{--                                          <th style="font-weight: bold;">المنتج</th>--}}
{{--                                          <th style="font-weight: bold;">السعر</th>--}}
{{--                                          <th style="font-weight: bold;">مسح</th>--}}
{{--                                      </tr>--}}
{{--                                      </thead>--}}
{{--                                      <tbody>--}}
{{--                                      @foreach($record->packeage_products as $packeage_product)--}}
{{--                                          <tr class="nearest">--}}
{{--                                              <td>--}}
{{--                                                  <select name="products[]" id="products" required=""--}}
{{--                                                          class="form-control m-input m-input--square products">--}}
{{--                                                      @foreach($products as $item)--}}
{{--                                                          <option @if(old('items')== $item->id) selected @endif--}}
{{--                                                              @if($packeage_product->component_type == "Item" && $packeage_product->component_id == $item->id) selected @endif--}}
{{--                                                          value="{{ $item->id }},Item">{{ $item->name }}--}}
{{--                                                          </option>--}}
{{--                                                      @endforeach--}}
{{--                                                      @foreach($item_variants as $item)--}}
{{--                                                          <option @if(old('items')== $item->id) selected @endif--}}
{{--                                                          @if($packeage_product->component_type == "Item Variant" && $packeage_product->component_id == $item->id) selected @endif--}}
{{--                                                          value="{{ $item->id }},Item Variant">{{ $item->name }}--}}
{{--                                                          </option>--}}
{{--                                                      @endforeach--}}
{{--                                                  </select>--}}
{{--                                              </td>--}}
{{--                                              <td>--}}
{{--                                                  <input--}}
{{--                                                      type="number"--}}
{{--                                                      step="0.01"--}}
{{--                                                      value="{{old('product_price[]')?old('product_price[]'):$packeage_product->price}}"--}}
{{--                                                      name="product_price[]"--}}
{{--                                                      required=""--}}
{{--                                                      readonly--}}
{{--                                                      class="form-control m-input product_price"--}}
{{--                                                  />--}}

{{--                                              </td>--}}
{{--                                              <td>--}}
{{--                                                  <a--}}
{{--                                                      title="Remove the row"--}}
{{--                                                      class="btn btn-sm btn-danger"--}}
{{--                                                      onclick="DeleteProductRowTable(this)">--}}
{{--                                                      <i class="fa fa-times" style="color: #fff"></i>--}}
{{--                                                  </a>--}}
{{--                                              </td>--}}
{{--                                          </tr>--}}
{{--                                      @endforeach--}}
{{--                                      </tbody>--}}
{{--                                  </table>--}}
{{--                                  <div class="row">--}}
{{--                                      <div class="col-lg-12">--}}
{{--                                          <button type="button" class="btn btn-default " id="new_product_row"><i class="fa fa-plus"></i></button>--}}
{{--                                      </div>--}}
{{--                                  </div>--}}
{{--                              </div>--}}
{{--                          </div>--}}

                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>السعر الفعلي</label>
                                  <input
                                      type="number"
                                      step="0.01"
                                      value="{{old('actual_price')?old('actual_price'):$record->actual_price}}"
                                      name="actual_price"
                                      id="actual_price"
                                      required=""
                                      readonly
                                      class="form-control m-input"
                                      placeholder="ادخل الفعلي..." />
                                  @error('actual_price')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6">
                                  <label>السعر النهائي</label>
                                  <input
                                      type="number"
                                      step="0.01"
                                      value="{{old('final_price')?old('final_price'):$record->final_price}}"
                                      name="final_price"
                                      id="final_price"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="ادخل النهائي..." />
                                  @error('final_price')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label for="description">الوصف:</label>
                                  <textarea id="description" name="description" rows="4" cols="50">{{old('description')?old('description'):$record->description}}</textarea>
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


            $(document).on("change", ".form-group .nearest .items" , function() {
                var id = $(this).val();
                var parent = $(this).parents(".nearest");
                var nearest_price = parent.find('.price');
                $.ajax({
                    url: "{{route('organizations.package.get.item.price')}}",
                    data: {id:id},
                    success: function (data) {
                        var price = data['data']['price'];
                        var nearest_quantity = parent.find('.quantity');
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


            $(document).on('click','#new_item_row',function(){
                $.ajax({
                    url: "{{route('organizations.package.get.item.row')}}",
                    // data: {items:items,services:services},
                    success: function (data) {
                        $('#items-table  tbody:last-child').append(data['data']['responseHTML']);
                        $(".vendor-id").selectpicker();
                    },

                });


            });


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
                    url: "{{route('organizations.package.get.item.price')}}",
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

