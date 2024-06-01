<x-organization::layout>
 <x-slot name="pageTitle">طلبات الفنادق  | تعديل</x-slot name="pageTitle">
 @section('hotelOrders-active', 'm-menu__item--active m-menu__item--open')
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
                طلبات الفنادق
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
                  <form method="POST" action="{{route('organizations.hotelOrder.update', $record->id)}}"enctype="multipart/form-data"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      @method('put')
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <input
                                      type="text"
                                      value="{{old('laundry_id')?old('laundry_id'):$record->laundry_id}}"
                                      name="laundry_id"
                                      hidden
                                      class="form-control m-input"
                                  />
                              </div>
                              <div class="col-lg-6"></div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>الاسم كامل:</label>
                                  <input
                                      type="text"
                                      value="{{old('name')?old('name'):$record->customer_name}}"
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
                                  <label class="">الرقم:</label>
                                  <input
                                      type="phone" maxlength="15"
                                      value="{{old('mobile')?old('mobile'):$record->customer_mobile}}"
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
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>تاريخ الطلب:</label>
                                  <input
                                      class="form-control date"
                                      type="date" name="date"
                                      id="date"
                                      value="{{old('date')?old('date'):$record->date}}"
                                      required>
                              </div>
                              <div class="col-lg-6">
                                  <label>الوقت:</label>
                                  <input
                                      class="form-control date"
                                      type="time" name="time"
                                      id="time"
                                      value="{{old('time')?old('time'):$record->time}}"
                                      required>
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>نوع الدفع:</label><select id="payment_method" name="payment_method" required="" class="form-control m-input m-input--square" >
                                      <option value="cash" @if($record->payment_method == 'cash') selected @endif>كاش</option>
                                      <option value="visa" @if($record->payment_method == 'visa') selected @endif>فيزا</option>
                                  </select>
                              </div>
                              <div class="col-lg-6">
                                  <label>تاريخ استحقاق الطلب:</label>
                                  <input
                                      class="form-control date"
                                      type="date" name="max_due_date"
                                      id="max_due_date"
                                      value="{{old('max_due_date')?old('max_due_date'):$record->max_due_date}}"
                                      required>
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
                                      <tbody>
                                      @foreach($record->laundaryOrderSubCategories as $value)
                                          <tr class="nearest-service">
                                              <td>
                                                  <select name="categories[]" id="categories" required=""
                                                          class="form-control m-input m-input--square categories"
                                                          id="exampleSelect1">
                                                      <option value="" disabled selected>Please select a category</option>
                                                      @foreach($categories as $category)
                                                          <option @if($value->laundrySubCategory->parent->id === $category->id) selected @endif
                                                          value="{{ $category->id }}">{{ $category->name }}
                                                          </option>
                                                      @endforeach
                                                  </select>
                                              </td>
                                              <td>

                                                  <select name="subCategories[]" id="subCategories" required=""
                                                          class="form-control m-input m-input--square subCategories"
                                                          id="exampleSelect1">
                                                      <option value="" disabled selected>Please select a sub category</option>
                                                      @foreach($value->laundrySubCategory->parent->childs as $subCategory)
                                                          <option @if($value->laundrySubCategory->id === $subCategory->id) selected @endif
                                                          value="{{ $subCategory->id }}">{{ $subCategory->name }}
                                                          </option>
                                                      @endforeach
                                                  </select>
                                              </td>
                                              <td>
                                                  <select name="services[]" id="services" required=""
                                                          class="form-control m-input m-input--square services"
                                                          id="exampleSelect1">
                                                      <option value="" disabled selected>Please select a service</option>
                                                      @foreach($value->laundrySubCategory->laundrySubCategoryServices as $subCategoryService)
                                                          <option value="{{$subCategoryService->laundryService->id}}" @if($value->isServiceSelected($value->laundrySubCategory->id,$subCategoryService->laundryService->id,$record->id)) selected @endif>{{$subCategoryService->laundryService->name}}</option>
                                                      @endforeach
                                                  </select>
                                              </td>
                                              <td>
                                                  <input
                                                      type="number"
                                                      step="1"
                                                      value="{{old('category_quantity[]') ? old('category_quantity[]'):$value->quantity}}"
                                                      name="category_quantity[]"
                                                      required=""
                                                      class="form-control m-input category_quantity"
                                                      placeholder="ادخل الكميه..." />
                                              </td>
                                              <td>
                                                  <input
                                                      type="number"
                                                      step="0.01"
                                                      value="{{old('category_price[]') ? old('category_price[]'):$value->price}}"
                                                      name="category_price[]"
                                                      required=""
                                                      class="form-control m-input category_price"
                                                      placeholder="ادخل السعر..." />

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
                          <div class="form-group m-form__group row">
                              <div class="col-lg-4">
                                  <label>المبلغ الكلي:</label>
                                  <input
                                      type="number"
                                      step="0.01"
                                      name="total_price"
                                      id="total_price"
                                      value="{{old('total_price')?old('total_price'):$record->total_price}}"
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
                              <div class="col-lg-4">
                                  <label>المبلغ المدفوع:</label>
                                  <input
                                      type="number"
                                      step="0.01"
                                      name="paid_amount"
                                      id="paid_amount"
                                      value="{{old('paid_amount')?old('paid_amount'):$record->paid_amount}}"
                                      required=""
                                      class="form-control m-input"
                                      readonly
                                      placeholder="ادخل المبلغ المدفوع..." />
                                  @error('paid_amount')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4">
                                  <label>المبلغ المتبقي:</label>
                                  <input
                                      type="number"
                                      step="0.01"
                                      name="remaining_amount"
                                      id="remaining_amount"
                                      value="{{old('remaining_amount')?old('remaining_amount'):$record->remaining_amount}}"
                                      required=""
                                      class="form-control m-input"
                                      readonly
                                      placeholder="ادخل المبلغ المتبقي..." />
                                  @error('remaining_amount')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
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
                    url: "{{route('organizations.laundryOrder.get.service.row')}}",
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
                    url: "{{route('organizations.laundryOrder.get.subCategories')}}",
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
                    url: "{{route('organizations.laundryOrder.get.subCategories.services')}}",
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
                    url: "{{route('organizations.laundryOrder.get.subCategory.service.price')}}",
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

