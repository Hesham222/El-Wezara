<x-organization::layout>
    <x-slot name="pageTitle">تعديل اوامر الشراء</x-slot name="pageTitle">
    @section('inventory-active', 'm-menu__item--active m-menu__item--open')
    <x-slot name="style">
        <!-- Some styles -->
        <style>
            .invalid-feedback {
                display: block;
            }
        </style>
        <style>
            .invalid-feedback {
                display: block;
            }


            form h4 {
                margin-top: 10px
            }

        </style>

        <style>
            .input-group-text {
                border-radius: 0 !important;
            }

            .form-control {
                border-radius: 0px !important;
            }

            .view_portlet_header {
                padding: 0 1.2rem !important;
                height: 3.1rem !important;
                background-color: #f7f7f7 !important;
            }

            .view_portlet_header_text {
                font-size: 10pt !important;
            }

            .form-group {
                margin-bottom: 0px !important;
            }

            .m-form.m-form--group-seperator-dashed .m-form__group, .m-form.m-form--group-seperator .m-form__group {
                padding: 0px !important;
            }

            .otherImages {
                width: 50px;
                height: 50px;
                border: 1px dashed #ececec;
                border-radius: 5px;
                padding: 2px;
                margin: 2px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            #addNewOtherImages {
                cursor: pointer;

            }
        </style>
    </x-slot>
    <!-- Start page content -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">

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

                </div>
            </div>
            <div class="m-portlet__body">
                <div class="table-responsive">
                    <section class="content">


                        <form method="POST" action="{{route('organizations.po.update',$po->id)}}"
                              class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                            @csrf
                            @method('put')
                            <div class="row mb-0" style="">
                                <div class="p-2 col-lg-6 col-md-6" style="">

                                    <div class="m-portlet m-portlet--full-height">
                                        <div class="m-portlet__head view_portlet_header">
                                            <div class="m-portlet__head-caption">
                                                <div class="m-portlet__head-title">
                                                    <h6 class="m-portlet__head-text view_portlet_header_text">
                                                        عام
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-portlet__body" style="padding: 10px">
                                            <div class="form-group m-form__group">






                                                <div class="input-group m-input-group m-input-group--square mt-3">
                                                    <div class="input-group-prepend"><span class="input-group-text"
                                                                                           id="basic-addon1"
                                                                                           style="width: 150px">*البائع</span>
                                                    </div>

                                                    <select name="vendor" id="vendor" class="form-control select2"  required>
                                                        <option value="">--Select Vendro--</option>
                                                        @foreach($vendors as $vendor)
                                                            <option value="{{ $vendor->id }}" {{ ($po->vendor_id==$vendor->id OR $vendor->id==old('vendor') ) ? 'selected' : '' }}>{{ $vendor->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('vendor')
                                                    <em class="invalid-feedback">
                                                        {{ $message }}
                                                    </em>
                                                    @enderror
                                                </div>

                                                <div class="input-group m-input-group m-input-group--square mt-3">
                                                    <div class="input-group-prepend"><span class="input-group-text"
                                                                                           id="basic-addon1"
                                                                                           style="width: 150px">*الرقم المرجعي</span>
                                                    </div>


                                                    <input type="text" value="{{old('ReferenceNum')?old('ReferenceNum'):$po->reference_number}}" name="ReferenceNum"
                                                           class="form-control m-input" placeholder="">
                                                    @error('ReferenceNum')
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                    @enderror
                                                </div>




                                                <div class="input-group m-input-group m-input-group--square mt-3">
                                                    <div class="input-group-prepend"><span class="input-group-text"
                                                                                           id="basic-addon1"
                                                                                           style="width: 150px">*تاريخ الطلب</span>
                                                    </div>



                                                    <input type="date" value="{{old('orderDate')?old('orderDate'):$po->ordered_date}}" name="orderDate" required=""
                                                           class="form-control m-input" placeholder="">
                                                    @error('orderDate')
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                    @enderror
                                                </div>

                                                <div class="input-group m-input-group m-input-group--square mt-3">
                                                    <div class="input-group-prepend"><span class="input-group-text"
                                                                                           id="basic-addon1"
                                                                                           style="width: 150px">*متوقع</span>
                                                    </div>



                                                    <input type="date" value="{{old('expexted')?old('expexted'):$po->expected}}" name="expexted" class="form-control m-input" placeholder="">
                                                    @error('expexted')
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                    @enderror
                                                </div>

                                                <div class="mt-3">
                                                    <label>ملاحظة الشحن</label>
                                                    <textarea rows="6" class="form-control" name="shippingNote" id="shippingNote" placeholder="Drop shipping notes here....">{{old('shippingNote')?old('shippingNote'):$po->shipping_note}}</textarea>
                                                    @error('shippingNote')
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong></span>
                                                    @enderror

                                                </div>

                                                <div class="mt-3">
                                                    <label>ملاحظات عامة</label>
                                                    <textarea rows="6"  class="form-control" name="generalNotes" id="generalNotes" placeholder="Drop general notes here....">{{old('generalNotes')?old('generalNotes'):$po->general_notes}}</textarea>
                                                    @error('generalNotes')
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>







                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="p-2 col-lg-6 col-md-6" style="">

                                    <div class="m-portlet m-portlet--full-height">
                                        <div class="m-portlet__head view_portlet_header">
                                            <div class="m-portlet__head-caption">
                                                <div class="m-portlet__head-title">
                                                    <h6 class="m-portlet__head-text view_portlet_header_text">
                                                       عام
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-portlet__body" style="padding: 10px">
                                            <div class="form-group m-form__group">






                                                <div class="input-group m-input-group m-input-group--square mt-3">
                                                    <div class="input-group-prepend"><span class="input-group-text"
                                                                                           id="basic-addon1"
                                                                                           style="width: 150px">*المجموع الفرعي</span>
                                                    </div>


                                                    <input type="number" name="subtotal" id="po-subtotal" readonly value="{{$po->subtotal}}" class="form-control">

                                                </div>

                                                <div class="input-group m-input-group m-input-group--square mt-3">
                                                    <div class="input-group-prepend"><span class="input-group-text"
                                                                                           id="basic-addon1"
                                                                                           style="width: 150px">*خصم(%)</span>
                                                    </div>


                                                    <input type="number" step="0" name="shippingDisc" id="shippingDisc" value="{{old('shippingDisc')?old('shippingDisc'):$po->discount_amount}}" min="0" max="100" class="form-control">

                                                </div>

                                                <div class="input-group m-input-group m-input-group--square mt-3">
                                                    <div class="input-group-prepend"><span class="input-group-text"
                                                                                           id="basic-addon1"
                                                                                           style="width: 150px">*المجموع</span>
                                                    </div>

                                                    <input type="number" name="total_disc" id="po-total-disc" readonly value="{{$po->total_disc}}" class="form-control">
                                                </div>




                                                <div class="input-group m-input-group m-input-group--square mt-3">
                                                    <div class="input-group-prepend"><span class="input-group-text"
                                                                                           id="basic-addon1"
                                                                                           style="width: 150px">*تكلفة الشحن {!!$setting->shipping_cost ? " <em style='color: green;font-weight: bold;'> (متاح) </em>":"<em style='color: red;font-weight: bold;'> (غير متاح) </em>" !!}</span>
                                                    </div>


                                                    @if($setting->shipping_cost )
                                                        <input type="number" min="0"  step="0" name="shippingCost" id="shippingCost" value="{{old('shippingCost')?old('shippingCost'):$po->shipping_cost}}" min="0" max="100" class="form-control">
                                                    @else
                                                        <input type="number" min="0" max="100" step="0" name="shippingCost"  value="{{old('shippingCost')?old('shippingCost'):$po->shipping_cost}}" min="0" max="100" class="form-control">

                                                    @endif

                                                </div>

                                                <div class="input-group m-input-group m-input-group--square mt-3">
                                                    <div class="input-group-prepend"><span class="input-group-text"
                                                                                           id="basic-addon1"
                                                                                           style="width: 150px">*المجموع بعد الشحن</span>
                                                    </div>


                                                    <input type="number" min="0" step="0" readonly="" class="form-control" name="totalAfterShipping" id="POtotalAfterShipping" placeholder="المجموع بعد الشحن...." value="{{old('totalAfterShipping')?old('totalAfterShipping'):$po->total_after_shipping}}">
                                                    @error('totalAfterShipping')
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong></span>
                                                    @enderror

                                                </div>

                                                <div class="input-group m-input-group m-input-group--square mt-3">
                                                    <div class="input-group-prepend"><span class="input-group-text"
                                                                                           id="basic-addon1"
                                                                                           style="width: 150px">*ضريبة القيمة المضافة(%)</span>
                                                    </div>


                                                    <input type="number" step="0" name="vat" id="vat" value="{{old('vat')?old('vat'):$po->vat}}" max="100" min="0" class="form-control">

                                                </div>

                                                <div class="input-group m-input-group m-input-group--square mt-3">
                                                    <div class="input-group-prepend"><span class="input-group-text"
                                                                                           id="basic-addon1"
                                                                                           style="width: 150px">*(بعد ضريبة القيمة المضافة) المجموع
                                            </span>
                                                    </div>


                                                    <input type="number" name="total" id="po-total" readonly value="{{$po->total}}" class="form-control">
                                                </div>





                                                <div class="input-group m-input-group m-input-group--square mt-3">
                                                    <div class="input-group-prepend">
            <span class="input-group-text"
                  id="basic-addon1"
                  style="width: 150px">البونص على الكمية :


            </span>
                                                    </div>
                                                    <input type="number" name="bounes_quantity"  min="0" value="{{$po->bounes_quantity}}"
                                                           class="form-control">
                                                </div>






                                                <div class="input-group m-input-group m-input-group--square mt-3">
                                                    <div class="input-group-prepend">
            <span class="input-group-text"
                  id="basic-addon1"
                  style="width: 150px">الكمية البونص المراد تزويدها :


            </span>
                                                    </div>
                                                    <input type="number" name="adding_bounes_quantity" value="{{$po->adding_bounes_quantity}}" min="0"
                                                           class="form-control">
                                                </div>




                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="col-lg-12">
                                @include('Organization::purchaseOrders.sections.editItems')
                            </div>

                            <input type="hidden" name="status" id="status-value" value="1">

                            <a title="return to main page" href="{{ route('organizations.inventory') }}" class="btn btn-warning">الغاء</a>
                            <button title="if you save, po stay open and you can edit data" type="submit" class="btn btn-primary">حفظ</button>
                            <button title="if you save, po stay will be ordered and you can not edit data" type="submit" class="order-po btn btn-success">اطلب</button>

                        </form>


                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- end page content -->
    <x-slot name="scripts">

        <script>
            getItems("{{route('organizations.po.getItems')}}", 'getItemButton');
            $(document).on('click', '.item-search-row', function(event)
            {
                event.preventDefault();
                var item = $(this).data('item');
                url = "{{route('organizations.po.getItemRow')}}"
                $(this).remove();
                $.ajax({
                    url: url,
                    method: "GET",
                    data: {
                        item:item,
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        $('#items-table > tbody:last-child').append(data['result']);
                    },
                    error: function (data) {
                        toastr.error('Failed, Please try again later.');
                    }
                });
            });
        </script>
        <script src="{{asset('admin/js/po.js')}}" type="text/javascript"></script>


    </x-slot>
</x-organization::layout>
