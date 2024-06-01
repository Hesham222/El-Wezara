<x-organization::layout>
    <x-slot name="pageTitle">الغرف الرئيسيه  | تعديل</x-slot name="pageTitle">
    @section('parentRooms-active', 'm-menu__item--active m-menu__item--open')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
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
                    الغرف الرئيسيه
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
                        <form method="POST" action="{{route('organizations.parentRoom.update', $record->id)}}"
                              class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                            @csrf
                            @method('put')
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-3">
                                        <label>أختر الفندق :</label>
                                        <select name="hotel" required="" class="form-control m-input m-input--square" id="exampleSelect1">
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
                                        <label>عدد الغرف :</label>
                                        <input
                                            type="number"
                                            value="{{old('quantity')?old('quantity'):$record->quantity}}"
                                            name="quantity"
                                            required=""
                                            class="form-control m-input"
                                            disabled
                                        />
                                        @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-3">
                                        <label>بدايه الغرف من رقم :</label>
                                        <input
                                            type="number"
                                            value="{{old('start_room_num')?old('start_room_num'):$record->start_room_num}}"
                                            name="start_room_num"
                                            required=""
                                            class="form-control m-input"
                                            disabled
                                        />
                                        @error('start_room_num')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-12 prices-wrapper">
                                        <label class="">التسعير الكلي:</label><br>
                                        <table  width="100%" class="table table-striped- table-bordered table-hover table-checkable" id="pricing-table">
                                            <col style="width:30%">
                                            <col style="width:30%">
                                            <col style="width:30%">
                                            <col style="width:10%">
                                            <thead>
                                            <tr>
                                                <th style="font-weight: bold;">نوع الضيف</th>
                                                <th style="font-weight: bold;"> نوع الغرفه </th>
                                                <th style="font-weight: bold;">السعر</th>
                                                <th style="font-weight: bold;">مسح</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($record->Pricings as $key => $value)
                                                <tr>
                                                    <td>
                                                        <select name="guestType_id[]" id="guestType_id[]" required=""
                                                                class="form-control m-input m-input--square"
                                                                id="exampleSelect1">
                                                            @foreach($guestTypes as $guestType)
                                                                <option @if(old('guestType_id')== $guestType->id || $guestType->id==$value->customerType_id) selected @endif
                                                                value="{{ $guestType->id }}">{{ $guestType->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="roomType_id[]" id="roomType_id[]" required=""
                                                                class="form-control m-input m-input--square"
                                                                id="exampleSelect1">
                                                            @foreach($roomTypes as $roomType)
                                                                <option @if(old('roomType_id')== $roomType->id || $roomType->id==$value->roomType_id) selected @endif
                                                                value="{{ $roomType->id }}">{{ $roomType->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" value="{{$value->price}}" step="0.01" name="price[]" required="" class="form-control m-input">
                                                    </td>
                                                    <td>
                                                        <a
                                                            title="Remove the row"
                                                            class="btn btn-sm btn-danger"
                                                            onclick="DeletePricingRowTable(this)">
                                                            <i class="fa fa-times" style="color: #fff"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <button type="button" class="btn btn-default " id="new_pricing_row"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-12">
                                        <label class="">التسعير اليومي:</label><br>
                                        <table  width="100%" class="table table-striped- table-bordered table-hover table-checkable" id="ingredients-table">
                                            <col style="width:30%">
                                            <col style="width:30%">
                                            <col style="width:30%">
                                            <col style="width:10%">
                                            <thead>
                                            <tr>
                                                <th style="font-weight: bold;">نوع الضيف</th>
                                                <th style="font-weight: bold;"> نوع الغرفه </th>
                                                <th style="font-weight: bold;">السعر</th>
                                                <th style="font-weight: bold;">مسح</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($record->DayPricings as $value)
                                                <tr>

                                                    <td>
                                                        <select name="guest_id[]" id="guest_id[]" required=""
                                                                class="form-control m-input m-input--square"
                                                                id="exampleSelect1">
                                                            @foreach($guestTypes as $guestType)
                                                                <option @if(old('guest_id')== $guestType->id || $guestType->id==$value->customerType_id ) selected @endif
                                                                value="{{ $guestType->id }}">{{ $guestType->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="room_id[]" id="room_id[]" required=""
                                                                class="form-control m-input m-input--square"
                                                                id="exampleSelect1">
                                                            @foreach($roomTypes as $roomType)
                                                                <option @if(old('room_id')== $roomType->id || $roomType->id==$value->roomType_id) selected @endif
                                                                value="{{ $roomType->id }}">{{ $roomType->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" value="{{$value->price}}" step="0.01" name="dayPrice[]" required="" class="form-control m-input">
                                                    </td>
                                                    <td>
                                                        <a
                                                            title="Remove the row"
                                                            class="btn btn-sm btn-danger"
                                                            onclick="DeleteVendorRowTable(this)">
                                                            <i class="fa fa-times" style="color: #fff"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <button type="button" class="btn btn-default " id="new_row"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label>سعر الطفل :</label>
                                        <input
                                            type="number"
                                            step="0.01"
                                            value="{{$record->child_price}}"
                                            name="child_price"
                                            required=""
                                            class="form-control m-input"
                                        />
                                        @error('child_price')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <label>سعر السرير الإضافي :</label>
                                        <input
                                            type="number"
                                            step="0.01"
                                            value="{{$record->extra_price}}"
                                            name="extra_price"
                                            required=""
                                            class="form-control m-input"
                                        />
                                        @error('extra_price')
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js" integrity="sha512-Dz4zO7p6MrF+VcOD6PUbA08hK1rv0hDv/wGuxSUjImaUYxRyK2gLC6eQWVqyDN9IM1X/kUA8zkykJS/gEVOd3w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <x-slot name="scripts">
        <script>
            function DeleteVendorRowTable(i)
            {
                if($('#ingredients-table tbody tr').length == 1)
                {
                    toastr.error('You can not delete all the day pricings.');
                    return;
                }
                var p=i.parentNode.parentNode;
                p.parentNode.removeChild(p);
            }
            $(document).on('click','#new_row',function(){

                $.ajax({
                    url: "<?php echo e(route('organizations.parentRoom.get.dayPricing.row')); ?>",
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
                    toastr.error('You can not delete all the pricings.');
                    return;
                }
                var p=i.parentNode.parentNode;
                p.parentNode.removeChild(p);
            }
            $(document).on('click','#new_pricing_row',function(){


                $.ajax({
                    url: "<?php echo e(route('organizations.parentRoom.get.pricing.row')); ?>",
                    success: function (data) {
                        $('#pricing-table > tbody:last-child').append(data['data']['responseHTML']);

                        $(".vendor-id").selectpicker();
                    },

                });
            });

        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    </x-slot>
</x-organization::layout>

