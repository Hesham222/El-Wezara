<x-organization::layout>
    <x-slot name="pageTitle">انشاء اوامر الشراء</x-slot name="pageTitle">
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


                        <div class="m-grid__item m-grid__item--fluid m-wrapper">
                            <!-- BEGIN: Subheader -->
                            <!-- END: Subheader -->
                            <div class="m-content">
                                <!--Begin::Section-->
                                <form method="POST" action="{{route('organizations.po.store')}}"
                                      class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                                    @csrf
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
                                                            <div class="input-group-prepend">
                    <span class="input-group-text"
                          id="basic-addon1"
                          style="width: 150px">البائع
                    </span>
                                                            </div>
                                                            <select name="vendor" id="vendor" class="form-control select2" required>
                                                                <option value="">--Select Vendro--
                                                                </option>
                                                                @foreach($vendors as $vendor)
                                                                    <option
                                                                        value="{{ $vendor->id }}" {{ $vendor->id==old('vendor') ? 'selected' : '' }}>{{ $vendor->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('vendor')
                                                            <em class="invalid-feedback">
                                                                {{ $message }}
                                                            </em>
                                                            @enderror
                                                        </div>


                                                        <div class="input-group m-input-group m-input-group--square mt-3">
                                                            <div class="input-group-prepend">
                    <span class="input-group-text"
                          id="basic-addon1"
                          style="width: 150px">*الرقم المرجعي

                    </span>
                                                            </div>
                                                            <input type="text" value="{{old('ReferenceNum')}}" name="ReferenceNum"
                                                                   class="form-control m-input" placeholder="">
                                                            @error('ReferenceNum')
                                                            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}
                    </strong>
                  </span>
                                                            @enderror
                                                        </div>
                                                        <div class="input-group m-input-group m-input-group--square mt-3">
                                                            <div class="input-group-prepend">
                    <span class="input-group-text"
                          id="basic-addon1"
                          style="width: 150px">*تاريخ الطلب

                    </span>
                                                            </div>
                                                            <input type="date"
                                                                   value="{{old('orderDate')?old('orderDate'):date('Y-m-d')}}"
                                                                   name="orderDate" required=""
                                                                   class="form-control m-input" placeholder="">
                                                            @error('orderDate')
                                                            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}
                    </strong>
                  </span>
                                                            @enderror
                                                        </div>
                                                        <div class="input-group m-input-group m-input-group--square mt-3">
                                                            <div class="input-group-prepend">
                    <span class="input-group-text"
                          id="basic-addon1"
                          style="width: 150px">*متوقع
                    </span>
                                                            </div>
                                                            <input type="date" value="{{old('expexted')}}" name="expexted"
                                                                   class="form-control m-input" placeholder="">
                                                            @error('expexted')
                                                            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}
                    </strong>
                  </span>
                                                            @enderror
                                                        </div>
                                                        <div class="mt-3">
                                                            <label>ملاحظة الشحن
                                                            </label>
                                                            <textarea rows="6" class="form-control" name="shippingNote"
                                                                      id="shippingNote"
                                                                      placeholder="Drop shipping notes here....">{{old('shippingNote')}}</textarea>
                                                            @error('shippingNote')
                                                            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}
                    </strong>
                  </span>
                                                            @enderror
                                                        </div>
                                                        <div class="mt-3">
                                                            <label>ملاحظات عامة
                                                            </label>
                                                            <textarea rows="6" class="form-control" name="generalNotes"
                                                                      id="generalNotes"
                                                                      placeholder="Drop general notes here....">{{old('generalNotes')}}</textarea>
                                                            @error('generalNotes')
                                                            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}
                    </strong>
                  </span>
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
                                                            <div class="input-group-prepend">
                    <span class="input-group-text"
                          id="basic-addon1"
                          style="width: 150px">*المجموع الفرعي

                    </span>
                                                            </div>
                                                            <input type="number" name="subtotal" id="po-subtotal" readonly value="0"
                                                                   class="form-control">
                                                        </div>
                                                        <div class="input-group m-input-group m-input-group--square mt-3">
                                                            <div class="input-group-prepend">
                    <span class="input-group-text"
                          id="basic-addon1"
                          style="width: 150px">*خصم(%)

                    </span>
                                                            </div>
                                                            <input type="number" step="0" name="shippingDisc" id="shippingDisc"
                                                                   value="{{old('shippingDisc')?old('shippingDisc'):0}}" max="100"
                                                                   min="0" class="form-control">
                                                        </div>
                                                        <div class="input-group m-input-group m-input-group--square mt-3">
                                                            <div class="input-group-prepend">
                    <span class="input-group-text"
                          id="basic-addon1"
                          style="width: 150px">*المجموع

                    </span>
                                                            </div>
                                                            <input type="number" name="total_disc" id="po-total-disc" readonly
                                                                   value="0" class="form-control">
                                                        </div>
                                                        <div class="input-group m-input-group m-input-group--square mt-3">
                                                            <div class="input-group-prepend">
                    <span class="input-group-text"
                          id="basic-addon1"
                          style="width: 150px">*تكلفة الشحن{!! $setting->shipping_cost ? "
                      <em style='color: green;font-weight: bold;'> (متاح)
                      </em>":"
                      <em style='color: red;font-weight: bold;'> (غير متاح)
                      </em>" !!}
                    </span>
                                                            </div>
                                                            @if($setting->shipping_cost )
                                                                <input type="number" min="0" step="0" id="shippingCost"
                                                                       name="shippingCost"
                                                                       value="{{old('shippingCost')?old('shippingCost'):0}}" min="0"
                                                                       max="100" class="form-control">
                                                            @else
                                                                <input type="number" name="shippingCost" min="0" max="100"
                                                                       step="0"
                                                                       value="{{old('shippingCost')?old('shippingCost'):0}}" min="0"
                                                                       max="100" class="form-control">
                                                            @endif
                                                        </div>
                                                        <div class="input-group m-input-group m-input-group--square mt-3">
                                                            <div class="input-group-prepend">
                    <span class="input-group-text"
                          id="basic-addon1"
                          style="width: 150px">*المجموع بعد الشحن

                    </span>
                                                            </div>
                                                            <input type="number" min="0" step="0" readonly="" class="form-control" name="totalAfterShipping" id="POtotalAfterShipping" placeholder="{{ __('validation.attributes.totalAfterShipping') }}...." value="{{old('totalAfterShipping')?old('totalAfterShipping'):0}}">
                                                            @error('totalAfterShipping')
                                                            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}
                    </strong>
                  </span>
                                                            @enderror
                                                        </div>
                                                        <div class="input-group m-input-group m-input-group--square mt-3">
                                                            <div class="input-group-prepend">
                    <span class="input-group-text"
                          id="basic-addon1"
                          style="width: 150px">*ضريبة القيمة المضافة(%)

                    </span>
                                                            </div>
                                                            <input type="number" step="0" name="vat" id="vat" min="0"
                                                                   value="{{old('vat')?old('vat'):0}}" max="100"
                                                                   class="form-control">
                                                        </div>
                                                        <div class="input-group m-input-group m-input-group--square mt-3">
                                                            <div class="input-group-prepend">
                    <span class="input-group-text"
                          id="basic-addon1"
                          style="width: 150px">(بعد ضريبة القيمة المضافة) المجموع


                    </span>
                                                            </div>
                                                            <input type="number" name="total" id="po-total" readonly value="0"
                                                                   class="form-control">
                                                        </div>






                                                        <div class="input-group m-input-group m-input-group--square mt-3">
                                                            <div class="input-group-prepend">
                    <span class="input-group-text"
                          id="basic-addon1"
                          style="width: 150px">البونص على الكمية :


                    </span>
                                                            </div>
                                                            <input type="number" name="bounes_quantity"  min="0"
                                                                   class="form-control">
                                                        </div>






                                                        <div class="input-group m-input-group m-input-group--square mt-3">
                                                            <div class="input-group-prepend">
                    <span class="input-group-text"
                          id="basic-addon1"
                          style="width: 150px">الكمية البونص المراد تزويدها :


                    </span>
                                                            </div>
                                                            <input type="number" name="adding_bounes_quantity"  min="0"
                                                                   class="form-control">
                                                        </div>



                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        @include('Organization::purchaseOrders.sections.createItems')
                                    </div>
                                    <input type="hidden" name="status" id="status-value" value="1">
                                    <a title="return to main page"
                                       href="{{ route('organizations.inventory') }}"
                                       class="btn btn-warning">الغاء
                                    </a>
                                    <button type="submit"
                                            title="if you save, po stay open and you can edit data"
                                            class="btn btn-primary">حفظ
                                    </button>
                                    <button
                                        title="if you save, po stay will be ordered and you can not edit data"
                                        type="submit"
                                        class="order-po btn btn-success">اطلب
                                    </button>
                                </form>
                                <!--End::Section-->
                            </div>
                        </div>



                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- end page content -->
    <x-slot name="scripts">
        <script>

            $( document ).ready(function() {
                calculateItemFinalCostTotal();
            });


            function getItems(url, buttonId)
            {
                $(document).on('click', '#'+buttonId, function(event)
                {
                    event.preventDefault();
                    var searchKey = document.getElementById('itemSearchKey').value;
                    var itemsAdded = $("input[name='items[]']").map(
                        function(){
                            return parseInt($(this).val());
                        }).get();;
                    $.ajax({
                        url: url,
                        method: "GET",
                        data: {
                            searchKey:searchKey,
                            items:itemsAdded,
                        },
                        dataType: 'JSON',
                        success: function (data) {
                            $('#item-list-holder').html(data['result']).hide().fadeIn('slow');
                            var toggles = $('.item-toggle');
                            toggles.bootstrapToggle();
                        },
                        error: function (data) {
                            if (data.responseJSON.errors) {
                                Object.keys(data.responseJSON.errors).forEach(function (key, index) {
                                    data.responseJSON.errors[key].forEach(function (err) {
                                        toastr.error(err);
                                    })
                                });
                            }
                            else
                                toastr.error('Failed, Please try again later.');
                        }
                    });
                });
            }

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
        <script src="{{asset('admin/js/po.js')}}" type="text/javascript">
        </script>

    </x-slot>
</x-organization::layout>
