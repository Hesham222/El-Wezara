<x-organization::layout>
 <x-slot name="pageTitle">الحجوزات | تعديل</x-slot name="pageTitle">
 @section('reservations-active', 'm-menu__item--active m-menu__item--open')
  <x-slot name="style">
  <!-- Some styles -->
  <style>
        .invalid-feedback {
            display: block;
        }
        .from-label {
            font-weight: bold;
        }
    </style>
  </x-slot>
    <!-- Start page content -->
      <div class="m-subheader ">
        <div class="d-flex align-items-center">
          <div class="mr-auto">
            <h3 class="m-subheader__title ">
                حجز
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
                        <form method="POST" action="{{route('organizations.reservation.update', $record->id)}}"
                              class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                            @csrf
                            @method('put')
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label>تاريخ الحجز:</label>
                                        <input
                                            class="form-control date"
                                            type="date"
                                            name="booking_date"
                                            id="booking_date"
                                            value="{{old('booking_date')?old('booking_date'):$record->booking_date}}"
                                            required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>تاريخ الاستحقاق:</label>
                                        <input
                                            class="form-control date"
                                            type="date" name="due_date"
                                            id="due_date"
                                            value="{{old('due_date')?old('due_date'):$record->payment_due_date}}"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label>من:</label>
                                        <input
                                            class="form-control date"
                                            type="time"
                                            name="from"
                                            id="from"
                                            value="{{old('from')?old('from'):$record->from}}"
                                            required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>الي</label>
                                        <input
                                            class="form-control date"
                                            type="time"
                                            name="to"
                                            id="to"
                                            value="{{old('to')?old('to'):$record->to}}"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <select name="hall" id="hall" required=""
                                                class="form-control m-input m-input--square"
                                                id="exampleSelect1">
                                            <option value="" disabled selected>اختار قاعه</option>
                                            @foreach($halls as $hall)
                                                <option {{ $ReservationHall->hall->id == $hall->id ? 'selected' : ''}}
                                                value="{{ $hall->id }}">{{ $hall->name }}
                                                </option>
                                            @endforeach
                                            @error('hall')
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                            @enderror
                                        </select>
                                    </div>
                                    <div id="appendPackages" class="col-lg-4 nearest">
                                        @include('Organization::reservations.components.append_packages')
                                    </div>
                                    @if (isset($record['actual_price']))
                                        <input name="package-price" hidden id="package-price" value="{{$record->actual_price}}">
                                    @else
                                        <input name="package-price" hidden id="package-price" value="{{old('package-price')}}">
                                    @endif
                                    @if (isset($total))
                                        <input name="package-remaining" hidden id="package-remaining" value="{{$total}}">
                                    @else
                                        <input name="package-remaining" hidden id="package-remaining" value="{{old('package-remaining')}}">
                                    @endif
                                    @if (isset($record['supplier_remaining_amount']))
                                        <input name="services-remaining" hidden id="services-remaining" value="{{$record->supplier_remaining_amount}}">
                                    @else
                                        <input name="services-remaining" hidden id="services-remaining" value="{{old('supplier_remaining_amount')}}">
                                    @endif
                                    <div id="appendEvents" class="col-lg-4">
                                        @include('Organization::reservations.components.append_events')
                                    </div>
                                </div>

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
                                                <th style="font-weight: bold;">مسح</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($record->reservationExtraServices as $value)
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
                                                        <textarea id="description_service" name="description_service[]" rows="4" cols="50">{{$value->description }}</textarea>
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
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-12">
                                        <label class="">المنتجات:</label><br>
                                        <table  width="100%" class="table table-striped- table-bordered table-hover table-checkable" id="products-table">
                                            <col style="width:30%">
                                            <col style="width:20%">
                                            <col style="width:20%">
                                            <col style="width:30%">
                                            <col style="width:10%">
                                            <thead>
                                            <tr>
                                                <th style="font-weight: bold;">المنتج</th>
                                                <th style="font-weight: bold;">الكميه</th>
                                                <th style="font-weight: bold;">السعر</th>
                                                <th style="font-weight: bold;">تفاصيل</th>
                                                <th style="font-weight: bold;">مسح</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($record->reservation_products as $packeage_product)
                                                <tr class="nearest">
                                                    <td>
                                                        <select name="products[]" id="products" required=""
                                                                class="form-control m-input m-input--square products">
                                                            @foreach($products as $item)
                                                                <option @if(old('items')== $item->id) selected @endif
                                                                @if($packeage_product->component_type == "Item" && $packeage_product->component_id == $item->id) selected @endif
                                                                        value="{{ $item->id }},Item">{{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                            @foreach($item_variants as $item)
                                                                <option @if(old('items')== $item->id) selected @endif
                                                                @if($packeage_product->component_type == "Item Variant" && $packeage_product->component_id == $item->id) selected @endif
                                                                        value="{{ $item->id }},Item Variant">{{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input
                                                            type="number"
                                                            step="1"
                                                            value="{{old('product_quantity[]')?old('product_quantity[]') : $packeage_product->quantity}}"
                                                            name="product_quantity[]"
                                                            required=""
                                                            class="form-control m-input product_quantity"
                                                            placeholder="ادخل الكميه..." />
                                                    </td>
                                                    <td>
                                                        <input
                                                            type="number"
                                                            step="0.01"
                                                            value="{{old('product_price[]')?old('product_price[]'):$packeage_product->price}}"
                                                            name="product_price[]"
                                                            required=""
                                                            readonly
                                                            class="form-control m-input product_price"
                                                        />

                                                    </td>
                                                    <td class="col-lg-6">
                                                        <textarea id="description_product" name="description_product[]" rows="4" cols="50">{{$packeage_product->description }}</textarea>
                                                        @error('description_product')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <a
                                                            title="Remove the row"
                                                            class="btn btn-sm btn-danger"
                                                            onclick="DeleteProductRowTable(this)">
                                                            <i class="fa fa-times" style="color: #fff"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <button type="button" class="btn btn-default " id="new_product_row"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label> تابع ل مورد او شركة :</label>
                                        <input class="form-control" id="isVendor" @if($value->vendor_id != null) checked @endif type="checkbox" name="isVendor">

                                    </div>


                                    <div class="col-lg-6" @if($value->vendor_id == null) style="display: none" @endif id="vendors">
                                        <label> موردين:</label>
                                        <select name="vendor"
                                                class="selectpicker" data-live-search="true">
                                            @foreach($vendors as $vendor)
                                                <option @if(old( 'vendor')== $vendor->id) selected
                                                        @endif
                                                        @if($vendor->id == $value->vendor_id) selected @endif
                                                        value="{{$vendor->id}}">{{$vendor->name}}
                                            @endforeach
                                        </select>
                                        @error('vendor')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label>نوع العميل:</label>
                                        <select name="customerType_id" required=""
                                                class="form-control m-input m-input--square"
                                                id="exampleSelect1">
                                            @foreach($customerTypes as $customerType)
                                                <option @if(old('customerType_id')== $customerType->id || $customerType->id==$record->customerType_id) selected @endif
                                                value="{{ $customerType->id }}">{{ $customerType->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('customerType_id')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                    <div id="appendInformation" class="col-lg-6">
                                        @include('Organization::reservations.components.append_information')
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
{{--                                <div class="col-lg-6">--}}
{{--                                    <label> العميل:</label>--}}
{{--                                    <select name="customer"--}}
{{--                                            class="selectpicker" data-live-search="true">--}}
{{--                                        @foreach($customers as $customer)--}}
{{--                                            <option @if(old( 'customer')== $customer->id) selected--}}
{{--                                                    @endif--}}
{{--                                                    @if($record->customer_id == $customer->id) selected @endif--}}
{{--                                                    value="{{$customer->id}}">{{$customer->name}}--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                    @error('customer')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                          <strong>{{ $message }}</strong>--}}
{{--                                      </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
                                </div>



{{--                                <div class="form-group m-form__group row">--}}
{{--                                    <div class="col-lg-6">--}}
{{--                                        <label> نوع التذاكر:</label>--}}
{{--                                        <select name="ticket_price_id"--}}
{{--                                                class="selectpicker" data-live-search="true"--}}
{{--                                                id="ticket_price"--}}
{{--                                        >--}}
{{--                                            <option value="">-- اختر نوع التذاكر --</option>--}}
{{--                                            @foreach($ticket_prices as $ticket_price)--}}
{{--                                                <option @if(old( 'ticket_price_id')== $ticket_price->id) selected--}}
{{--                                                        @endif--}}
{{--                                                        @if($ticket_price->id == $record->ticket_price_id ) selected @endif--}}
{{--                                                        value="{{$ticket_price->id}}">{{$ticket_price->category->name}} - {{$ticket_price->subCategory->name}} [{{$ticket_price->price}}]--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                        @error('ticket_price_id')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                          <strong>{{ $message }}</strong>--}}
{{--                                      </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}

{{--                                    <div class="col-lg-6">--}}
{{--                                        <label>عدد التذاكر المدفوعه:</label>--}}
{{--                                        <input class="form-control" type="number"  min="0" name="number_of_tickets" id="ticket_number"  value="{{ old('number_of_tickets')?old('number_of_tickets'):$record->number_of_tickets }}">--}}
{{--                                        @error('number_of_tickets')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                              <strong>{{ $message }}</strong>--}}
{{--                                          </span>--}}
{{--                                        @enderror--}}

{{--                                    </div>--}}

{{--                                </div>--}}
                                @if($record->discount == 1)
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-6">
                                            <label> الخصم:</label>
                                            <select name="discount_type" disabled
                                                    class="selectpicker" data-live-search="true"
                                                    id="discount_type"
                                            >
                                                <option value="">-- اختر نوع الخصم --</option>
                                                <option  @if(old('discount_type')== 'percentage' || $record->discount_type=='percentage') selected @endif value="percentage">مئوي</option>
                                                <option  @if(old('discount_type')== 'numeric' || $record->discount_type=='numeric') selected @endif value="numeric">رقمي</option>
                                            </select>
                                            @error('discount_type')
                                            <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                            @enderror
                                        </div>

                                        <div class="col-lg-6">
                                            <label>ادخل الخصم:</label>
                                            <input class="form-control" readonly step="0.01" type="number" min="0" name="discount_number" id="discount_number"  value="{{ old('discount_number')?old('discount_number') :$record-> discount_number }}">
                                            @error('discount')
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                            @enderror

                                        </div>

                                    </div>

                                @else
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-6">
                                            <label> الخصم:</label>
                                            <select name="discount_type"
                                                    class="selectpicker" data-live-search="true"
                                                    id="discount_type"
                                            >
                                                <option value="">-- اختر نوع الخصم --</option>
                                                <option @if(old('discount_type')== 'percentage' || $record->discount_type=='percentage') selected @endif value="percentage">مئوي</option>
                                                <option @if(old('discount_type')== 'numeric' || $record->discount_type=='numeric') selected @endif value="numeric">رقمي</option>
                                            </select>
                                            @error('discount_type')
                                            <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                            @enderror
                                        </div>

                                        <div class="col-lg-6">
                                            <label>ادخل الخصم:</label>
                                            <input class="form-control" step="0.01" type="number" min="0" name="discount_number" id="discount_number"  value="{{ old('discount_number')?old('discount_number') :$record-> discount_number }}">
                                            @error('discount')
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                            @enderror

                                        </div>

                                    </div>

                                @endif


{{--                                <div class="form-group m-form__group row">--}}
{{--                                    <div class="col-lg-4">--}}
{{--                                        <label>الاسم كامل:</label>--}}
{{--                                        <input--}}
{{--                                            type="text"--}}
{{--                                            value="{{old('name')?old('name'):$record->contact_name}}"--}}
{{--                                            name="name"--}}
{{--                                            required=""--}}
{{--                                            class="form-control m-input"--}}
{{--                                            placeholder="ادخل الاسم كامل..." />--}}
{{--                                        @error('name')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                          <strong>{{ $message }}</strong>--}}
{{--                                      </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                    <div class="col-lg-4">--}}
{{--                                        <label class="">البريد الالكتروني:</label>--}}
{{--                                        <input--}}
{{--                                            type="email"--}}
{{--                                            value="{{old('email')?old('email'):$record->contact_email}}"--}}
{{--                                            name="email"--}}
{{--                                            required=""--}}
{{--                                            class="form-control m-input"--}}
{{--                                            placeholder="ادخل البريد الالكتروني..." />--}}
{{--                                        @error('email')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                          <strong>{{ $message }}</strong>--}}
{{--                                      </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                    <div class="col-lg-4">--}}
{{--                                        <label class="">الرقم:</label>--}}
{{--                                        <input--}}
{{--                                            type="phone" maxlength="15"--}}
{{--                                            value="{{old('phone')?old('phone'):$record->contact_phone}}"--}}
{{--                                            name="phone"--}}
{{--                                            required=""--}}
{{--                                            class="form-control m-input"--}}
{{--                                            placeholder="ادخل الموبايل..."--}}
{{--                                            id="phone"--}}
{{--                                        />--}}
{{--                                        @error('phone')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                          <strong>{{ $message }}</strong>--}}
{{--                                      </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="form-group m-form__group row">--}}
{{--                                    <div class="col-lg-4">--}}
{{--                                        <label>اللقب:</label>--}}
{{--                                        <input--}}
{{--                                            type="text"--}}
{{--                                            value="{{old('title')?old('title'):$record->contact_title}}"--}}
{{--                                            name="title"--}}
{{--                                            required=""--}}
{{--                                            class="form-control m-input"--}}
{{--                                            placeholder="اللقب..." />--}}
{{--                                        @error('title')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                          <strong>{{ $message }}</strong>--}}
{{--                                      </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                    <div class="col-lg-4">--}}
{{--                                        <label class="">الرقم القومي:</label>--}}
{{--                                        <input--}}
{{--                                            type="phone" maxlength="14"--}}
{{--                                            value="{{old('national_id')?old('national_id'):$record->contact_national_id}}"--}}
{{--                                            name="national_id"--}}
{{--                                            required=""--}}
{{--                                            class="form-control m-input"--}}
{{--                                            placeholder="ادخل الرقم القومي..."--}}
{{--                                            id="national_id"--}}
{{--                                        />--}}
{{--                                        @error('national_id')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                          <strong>{{ $message }}</strong>--}}
{{--                                      </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                    <div class="col-lg-4">--}}
{{--                                        <label class="">العنوان:</label>--}}
{{--                                        <input--}}
{{--                                            type="text"--}}
{{--                                            value="{{old('address')?old('address'):$record->contact_address}}"--}}
{{--                                            name="address"--}}
{{--                                            required=""--}}
{{--                                            class="form-control m-input"--}}
{{--                                            placeholder="ادخل العنوان..." />--}}
{{--                                        @error('address')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                          <strong>{{ $message }}</strong>--}}
{{--                                      </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label>المبلغ المدفوع:</label>
                                        <input
                                            type="number"
                                            step="0.01"
                                            name="paid_amount"
                                            id="paid_amount"
                                            value="{{old('paid_amount')?old('paid_amount'):$record->paid_amount}}"
                                            required=""
                                            readonly
                                            class="form-control m-input"
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
                                            readonly
                                            class="form-control m-input"
                                            placeholder="ادخل المبلغ المتبقي..." />
                                        @error('remaining_amount')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4">
                                        <label>المبلغ المتبقي للمورد</label>
                                        <input
                                            type="number"
                                            step="0.01"
                                            name="supplier_remaining_amount"
                                            id="supplier_remaining_amount"
                                            value="{{old('supplier_remaining_amount')?old('supplier_remaining_amount'):$record->supplier_remaining_amount}}"
                                            required=""
                                            readonly
                                            class="form-control m-input"
                                            placeholder="المبلغ المتبقي للمورد..." />
                                        @error('supplier_remaining_amount')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <input
                                            type="number"
                                            step="0.01"
                                            name="actual_price"
                                            id="actual_price"
                                            value="{{old('actual_price')?old('actual_price'):$record->actual_price}}"
                                            required=""
                                            hidden
                                            readonly
                                            class="form-control m-input"
                                            placeholder="ادخل المبلغ الفعلي..." />
                                        @error('actual_price')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                    </div>
                                </div>
                                </div>
                            <input type="hidden" value="0" name="ticket_amonut" id="ticket_amount" />

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
            $('#customerType_id').change(function(){
                var customerType_id = $(this).val();
                console.log(customerType_id);

                $.ajax({
                    type:'get',
                    url:"{{route('organizations.reservation.append.information')}}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        customerType_id: customerType_id,
                    },
                    success:function(resp){
                        $("#appendInformation").html(resp).hide().fadeIn('slow');
                    },error:function(){
                        alert('Error');
                    }
                });
            });
        </script>
        <script>

            $("#isVendor").on('change',function (){


                if($(this).is(':checked'))
                {
                    // checked
                    $("#vendors").css('display','block');
                }else
                {
                    // unchecked
                    $("#vendors").css('display','none');
                }

            });


        </script>

        {{--Hall Events Script--}}
        <script>
            $('#hall').on('change',function (){
                var id = $(this).val();
                $.ajax({
                    url: "{{route('organizations.reservation.get.hall.events')}}",
                    data: {id:id},
                    success: function (data) {
                        $("#appendEvents").html(data);
                    }
                    ,error:function(){
                    }
                });
            });
        </script>

        {{--Hall Packages Script--}}
        <script>
            $('#hall').on('change',function (){
                var id = $(this).val();
                $.ajax({
                    url: "{{route('organizations.reservation.get.hall.packages')}}",
                    data: {id:id},
                    success: function (data) {
                        $("#appendPackages").html(data);
                    }
                });
            });
        </script>

        {{--Get Package Price Script--}}
        <script>
            $(document).on('change',".form-group .nearest .form-control",function (){
                var id = $(this).val();
                $.ajax({
                    url: "{{route('organizations.reservation.get.package.price')}}",
                    data: {id:id},
                    success: function (data) {
                        $('#package-price').val(data['data']['price'])
                        $('#package-remaining').val(data['data']['remaining'])
                        calcTotalPrice()
                        calcTotalRemaining()
                    }
                });
            });
        </script>



        {{--Get ticket Price Script--}}
        <script>
            $(document).on('change',"#ticket_price",function (){
                var id = $(this).val();
                var number =  $("#ticket_number").val();
                if (number){

                    $.ajax({
                        url: "{{route('organizations.reservation.get.ticket.price')}}",
                        data: {id:id,number:number},
                        success: function (data) {
                            $('#ticket_amount').val(data['data']['price'])
                            calcTotalPrice()
                            calcTotalRemaining()
                        }
                    });
                }

            });
        </script>

        <script>
            $(document).on('change',"#ticket_number",function (){
                var id = $("#ticket_price").val();
                var number =  $(this).val();
                if (number){

                    $.ajax({
                        url: "{{route('organizations.reservation.get.ticket.price')}}",
                        data: {id:id,number:number},
                        success: function (data) {
                            $('#ticket_amount').val(data['data']['price'])
                            calcTotalPrice()
                            calcTotalRemaining()
                        }
                    });
                }

            });
        </script>

        {{--calc package price Script--}}
        <script>
            function calcPackagePrice() {
                var package_price = $('#package-price').val()
                return package_price
            }
        </script>

        {{--calc package remaining Script--}}
        <script>
            function calcPackageRemainingAmount() {
                var package_remaining = $('#package-remaining').val()
                return package_remaining
            }
        </script>

        {{--calc service price Script--}}
        <script>
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
        <script>
            var product_price = 0
            function calcProductPrice() {
                var final
                var priceList = $(".form-control.product_price");
                priceList.each(function() {
                    product_price +=parseFloat(($(this).val()))
                    final = product_price
                });
                product_price = 0 ;
                return final
            }
        </script>
        {{--calc Total price Script--}}
        <script>
            function calcTotalPrice(){
                if(calcServicesPrice() && calcPackagePrice() && calcProductPrice){
                    $('#actual_price').val(parseFloat(calcServicesPrice()) + parseFloat(calcPackagePrice())+ parseFloat(calcProductPrice()) + parseFloat($("#ticket_amount").val()))
                    $('#remaining_amount').val(parseFloat(calcServicesPrice()) + parseFloat(calcPackagePrice())+ parseFloat(calcProductPrice()) +  parseFloat($("#ticket_amount").val()))
                }
                else if(calcProductPrice() && calcServicesPrice()){
                    $('#actual_price').val(parseFloat(calcProductPrice())+  parseFloat(calcServicesPrice()) +  parseFloat($("#ticket_amount").val()))
                    $('#remaining_amount').val(parseFloat(calcProductPrice())+  parseFloat(calcServicesPrice()) +  parseFloat($("#ticket_amount").val()))
                }
                else if(calcPackagePrice() && calcServicesPrice()){
                    $('#actual_price').val(parseFloat(calcServicesPrice())+  parseFloat(calcPackagePrice()) +  parseFloat($("#ticket_amount").val()))
                    $('#remaining_amount').val(parseFloat(calcServicesPrice())+  parseFloat(calcPackagePrice()) +  parseFloat($("#ticket_amount").val()))
                }
                else if(calcPackagePrice() && calcProductPrice()  ){
                    $('#actual_price').val(parseFloat(calcProductPrice())+  parseFloat(calcPackagePrice()) +  parseFloat($("#ticket_amount").val()))
                    $('#remaining_amount').val(parseFloat(calcProductPrice())+  parseFloat(calcPackagePrice()) +  parseFloat($("#ticket_amount").val()))
                }
                else if(calcProductPrice()){
                    $('#actual_price').val(parseFloat(calcProductPrice()) +  parseFloat($("#ticket_amount").val()))
                    $('#remaining_amount').val(parseFloat(calcProductPrice()) +  parseFloat($("#ticket_amount").val()))
                }
                else if(calcPackagePrice()){
                    $('#actual_price').val(parseFloat(calcPackagePrice()) +  parseFloat($("#ticket_amount").val()))
                    $('#remaining_amount').val(parseFloat(calcPackagePrice()) +  parseFloat($("#ticket_amount").val()))
                }
                else if(calcServicesPrice()){
                    $('#actual_price').val(parseFloat(calcServicesPrice()) +  parseFloat($("#ticket_amount").val()))
                    $('#remaining_amount').val(parseFloat(calcServicesPrice()) +  parseFloat($("#ticket_amount").val()))
                }
            }
        </script>

        {{--Contact Script--}}
        <script>
            function DeleteContactRowTable(i)
            {
                if($('#contacts-table tbody tr').length == 1)
                {
                    toastr.error('You can not delete all the Contacts.');
                    return;
                }
                var p=i.parentNode.parentNode;
                p.parentNode.removeChild(p);
            }
            $(document).on('click','#new_contact_row',function(){

                $.ajax({
                    url: "{{route('organizations.reservation.get.contact.row')}}",
                    success: function (data) {
                        $('#contacts-table  tbody:last-child').append(data['data']['responseHTML']);
                        $(".vendor-id").selectpicker();
                    },

                });
            });

        </script>

        {{--Service Script--}}
        <script>
            function DeleteServiceRowTable(i)
            {
                var p=i.parentNode.parentNode;
                p.parentNode.removeChild(p);
                calcSupplierRemainingAmount();
                calcTotalPrice();
                calcTotalRemaining();
            }

            $(document).on("change", ".form-group .nearest-service .services" , function() {
                var id = $(this).val();
                var parent = $(this).parents(".nearest-service");
                var nearest_price = parent.find('.service_price');
                $.ajax({
                    url: "{{route('organizations.reservation.get.service.price')}}",
                    data: {id:id},
                    success: function (data) {
                        calcSupplierRemainingAmount()
                        calcTotalRemaining()
                        var price = data['data']['price'];
                        var nearest_quantity = parent.find('.service_quantity');
                        $(nearest_quantity).on('change',function (){
                            var q = $(this).val();
                            $(nearest_price).val(q*price);
                            calcTotalPrice()
                        });
                    },

                });
            });
            $(document).on("change", ".form-group .nearest .products" , function() {
                var id = $(this).val();
                var parent = $(this).parents(".nearest");
                var nearest_price = parent.find('.product_price');

                //console.log(package_id)
                $.ajax({
                    url: "{{route('organizations.reservation.get.product.price')}}",
                    data: {id:id},
                    success: function (data) {
                        var price = data['data']['price'];
                        var nearest_quantity = parent.find('.product_quantity');
                        $(nearest_quantity).on('change',function (){
                            var q = $(this).val();
                            $(nearest_price).val(q*price);
                            calcTotalPrice()
                        });


                    },

                });
            });

            $(document).on('click','#new_service_row',function(){

                $.ajax({
                    url: "{{route('organizations.reservation.get.service.row')}}",
                    success: function (data) {
                        $('#services-table  tbody:last-child').append(data['data']['responseHTML']);
                        $(".vendor-id").selectpicker();
                    },

                });
            });

        </script>

        {{--calc service supplier remaining Script--}}
        <script>
            function calcSupplierRemainingAmount() {
                var remaining= [];
                var priceList = $(".form-control.services");
                priceList.each(function() {
                    remaining.push( $(this).val() );
                });
                $.ajax({
                    url: "{{route('organizations.reservation.get.supplier.remaining.amount')}}",
                    data:{remaining:remaining},
                    success: function (data) {
                        $('#services-remaining').val(data['data'])
                        calcTotalRemaining()
                    },

                });
            }

            function calcServicesRemaining() {
                return $('#services-remaining').val()
            }

        </script>

        {{--calc service Total remaining Script--}}
        <script>
            function calcTotalRemaining()
            {
                if(calcServicesRemaining() && calcPackageRemainingAmount()){
                    $('#supplier_remaining_amount').val(parseFloat(calcPackageRemainingAmount()) + parseFloat(calcServicesRemaining()))
                }
                else if(calcPackageRemainingAmount()){
                    $('#supplier_remaining_amount').val(parseFloat(calcPackageRemainingAmount()))
                }
                else{
                    $('#supplier_remaining_amount').val(parseFloat(calcServicesRemaining()))
                }
            }
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
                    url: "{{route('organizations.reservation.get.product.row')}}",
                    // data: {items:items,services:services},
                    success: function (data) {
                        $('#products-table  tbody:last-child').append(data['data']['responseHTML']);
                        $(".vendor-id").selectpicker();
                    },

                });


            });





        </script>

    </x-slot>
</x-organization::layout>

