<x-organization::layout>
 <x-slot name="pageTitle">المغاسل  | تعديل</x-slot name="pageTitle">
 @section('pointOfSaleOrders-active', 'm-menu__item--active m-menu__item--open')
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
                المغاسل
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
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>الاسم كامل:</label>
                                  <input
                                      type="text"
                                      value="{{$record->customer_name}}"
                                      name="name"
                                      readonly
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
                                      value="{{$record->customer_mobile}}"
                                      name="mobile"
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
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>تاريخ الطلب:</label>
                                  <input
                                      class="form-control date"
                                      type="date" name="date"
                                      id="date"
                                      readonly
                                      value="{{$record->date}}"
                                      required>
                              </div>
                              <div class="col-lg-6">
                                  <label>الوقت:</label>
                                  <input
                                      class="form-control date"
                                      type="time" name="time"
                                      id="time"
                                      readonly
                                      value="{{$record->time}}"
                                      required>
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label class="">الدفع:</label>
                                  <input
                                      type="phone" maxlength="15"
                                      value="{{$record->payment_method}}"
                                      name="payment_method"
                                      readonly
                                      class="form-control m-input"
                                      placeholder="الدفع..."
                                      id="payment_method"
                                  />
                                  @error('phone')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>

                              <div class="col-lg-6">
                                  <label>تاريخ استحقاق الطلب:</label>
                                  <input
                                      class="form-control date"
                                      type="date" name="max_due_date"
                                      id="max_due_date"
                                      readonly
                                      value="{{$record->max_due_date}}"
                                      required>
                              </div>
                          </div>
{{--                          <div class="form-group m-form__group row">--}}
{{--                              <div class="col-lg-12">--}}
{{--                                  <label class="">خدمه اضافيه:</label><br>--}}
{{--                                  <table  width="100%" class="table table-striped- table-bordered table-hover table-checkable" id="categories-table">--}}
{{--                                      <col style="width:20%">--}}
{{--                                      <col style="width:20%">--}}
{{--                                      <col style="width:20%">--}}
{{--                                      <col style="width:30%">--}}
{{--                                      <col style="width:20%">--}}
{{--                                      <thead>--}}
{{--                                      <tr>--}}
{{--                                          <th style="font-weight: bold;">التصنيف</th>--}}
{{--                                          <th style="font-weight: bold;">التصنيف الفرعي</th>--}}
{{--                                          <th style="font-weight: bold;">الخدمه</th>--}}
{{--                                          <th style="font-weight: bold;">الكميه</th>--}}
{{--                                          <th style="font-weight: bold;">السعر</th>--}}
{{--                                      </tr>--}}
{{--                                      </thead>--}}
{{--                                      <tbody>--}}
{{--                                      @foreach ($record->laundaryOrderSubCategories as $value)--}}
{{--                                          <tr class="nearest-service">--}}
{{--                                              <td>--}}
{{--                                                  <input--}}
{{--                                                      class="form-control date"--}}
{{--                                                      type="text"--}}
{{--                                                      id="category"--}}
{{--                                                      readonly--}}
{{--                                                      value="{{$value->laundrySubCategory->parent->name}}"--}}
{{--                                                      required>--}}
{{--                                              </td>--}}
{{--                                              <td>--}}
{{--                                                  <input--}}
{{--                                                      class="form-control date"--}}
{{--                                                      type="text"--}}
{{--                                                      id="subCategory"--}}
{{--                                                      readonly--}}
{{--                                                      value="{{$value->laundrySubCategory->name}}"--}}
{{--                                                      required>--}}
{{--                                              </td>--}}
{{--                                              <td>--}}
{{--                                                  <input--}}
{{--                                                      class="form-control date"--}}
{{--                                                      type="text"--}}
{{--                                                      id="service"--}}
{{--                                                      readonly--}}
{{--                                                      value="{{$record->laundrySubCategory->laundryOrderServices->laundryService}}"--}}
{{--                                                      required>--}}
{{--                                              </td>--}}
{{--                                              <td>--}}
{{--                                                  <input--}}
{{--                                                      class="form-control date"--}}
{{--                                                      type="date" name="date"--}}
{{--                                                      id="date"--}}
{{--                                                      readonly--}}
{{--                                                      value="{{$record->date}}"--}}
{{--                                                      required>--}}
{{--                                              </td>--}}
{{--                                              <td>--}}
{{--                                                  <input--}}
{{--                                                      class="form-control date"--}}
{{--                                                      type="date" name="date"--}}
{{--                                                      id="date"--}}
{{--                                                      readonly--}}
{{--                                                      value="{{$record->date}}"--}}
{{--                                                      required>--}}
{{--                                              </td>--}}
{{--                                          </tr>--}}
{{--                                      @endforeach--}}
{{--                                      </tbody>--}}
{{--                                  </table>--}}
{{--                              </div>--}}
{{--                          </div>--}}
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
                                      <a href="{{route('organizations.PointOfSaleOrder.index')}}" class="btn btn-sm btn-primary">
                                          العوده للطلبات
                                      </a>
                                  </div>
                              </div>
                          </div>
                      </div>
                </section>
            </div>
          </div>
        </div>
      </div>
    <!-- end page content -->

    <x-slot name="scripts">


    </x-slot>

</x-organization::layout>

