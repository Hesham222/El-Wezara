<x-organization::layout>
    <x-slot name="pageTitle">عرض امر الشراء</x-slot name="pageTitle">
    @section('inventory-active', 'm-menu__item--active m-menu__item--open')
    <x-slot name="style">
        <!-- Some styles -->
        <style type="text/css">
            .swal2-confirm {
                background: #3085d6 !important;
                border: #3085d6 !important;
            }

            .swal2-cancel {
                background: #f12143 !important;
                color: #fff !important;
            }
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

                                                <input type="text" readonly  value="{{$po->vendor?$po->vendor->name:'-'}}" class="form-control m-input">
                                            </div>

                                            <div class="input-group m-input-group m-input-group--square mt-3">
                                                <div class="input-group-prepend"><span class="input-group-text"
                                                                                       id="basic-addon1"
                                                                                       style="width: 150px">*الرقم المرجعي</span>
                                                </div>


                                                <input type="text" readonly value="{{$po->reference_number}}"
                                                       class="form-control m-input">

                                            </div>




                                            <div class="input-group m-input-group m-input-group--square mt-3">
                                                <div class="input-group-prepend"><span class="input-group-text"
                                                                                       id="basic-addon1"
                                                                                       style="width: 150px">*تاريخ الطلب</span>
                                                </div>



                                                <input type="date" value="{{$po->ordered_date}}" readonly
                                                       class="form-control m-input" placeholder="">

                                            </div>

                                            <div class="input-group m-input-group m-input-group--square mt-3">
                                                <div class="input-group-prepend"><span class="input-group-text"
                                                                                       id="basic-addon1"
                                                                                       style="width: 150px">*متوقع</span>
                                                </div>



                                                <input type="date" value="{{$po->expected}}" readonly class="form-control m-input" placeholder="">

                                            </div>

                                            <div class="mt-3">
                                                <label>ملاحظة الشحن</label>
                                                <textarea rows="6" class="form-control" readonly>{{$po->shipping_note}}</textarea>


                                            </div>

                                            <div class="mt-3">
                                                <label>ملاحظات عامة</label>
                                                <textarea rows="6"  readonly class="form-control">{{$po->general_notes}}</textarea>

                                            </div>

                                            <div class="mt-3">
                                                <label>اضف تعليقك..</label>
                                                <textarea rows="6"  readonly class="form-control">{{$po->check_in_comments}}</textarea>
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


                                                <input type="number" readonly value="{{$po->subtotal}}" class="form-control">


                                            </div>

                                            <div class="input-group m-input-group m-input-group--square mt-3">
                                                <div class="input-group-prepend"><span class="input-group-text"
                                                                                       id="basic-addon1"
                                                                                       style="width: 150px">*خصم(%)</span>
                                                </div>


                                                <input type="number" readonly value="{{$po->discount_amount}}" class="form-control">


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
                                                                                       style="width: 150px">*تكلفة الشحن {!! $setting->shipping_cost ? " <em style='color: green;font-weight: bold;'> (enabled) </em>":"<em style='color: red;font-weight: bold;'> (Disabled) </em>" !!}</span>
                                                </div>


                                                <input type="number" value="{{$po->shipping_cost}}" readonly class="form-control">


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


                                                <input type="number" readonly value="{{$po->vat}}" class="form-control">

                                            </div>

                                            <div class="input-group m-input-group m-input-group--square mt-3">
                                                <div class="input-group-prepend"><span class="input-group-text"
                                                                                       id="basic-addon1"
                                                                                       style="width: 150px">*(بعد ضريبة القيمة المضافة) المجموع
                                        </span>
                                                </div>


                                                <input type="number" readonly value="{{$po->total}}" class="form-control">

                                            </div>


                                            <div class="input-group m-input-group m-input-group--square mt-3">
                                                <div class="input-group-prepend">
        <span class="input-group-text"
              id="basic-addon1"
              style="width: 150px">البونص على الكمية :


        </span>
                                                </div>
                                                <input type="number" name="bounes_quantity" readonly  min="0" value="{{$po->bounes_quantity}}"
                                                       class="form-control">
                                            </div>






                                            <div class="input-group m-input-group m-input-group--square mt-3">
                                                <div class="input-group-prepend">
        <span class="input-group-text"
              id="basic-addon1"
              style="width: 150px">الكمية البونص المراد تزويدها :


        </span>
                                                </div>
                                                <input type="number" name="adding_bounes_quantity" readonly value="{{$po->adding_bounes_quantity}}" min="0" 
                                                       class="form-control">
                                            </div>



                                            <div class="mt-4">
                                                @include('Organization::purchaseOrders.sections.statusHistories')
                                            </div>

                                        </div>

                                    </div>
                                </div>




                            </div>
                        </div>

                        <div class="col-lg-12">
                            @include('Organization::purchaseOrders.sections.showItems')
                        </div>

                        @if($po->add_order)
                        <h3>امر الاضافة</h3>
                        <div class="col-lg-12">
                            @include('Organization::purchaseOrders.sections.showAddOrder')
                        </div>
                        @endif

                        @if($po->status?$po->status->id==4 :0)
                            <div class="col-lg-12">
                                @include('Organization::purchaseOrders.sections.paymentsHistory')
                            </div>
                        @endif
                        <div class="col-lg-6 m--align-right">
                            <a title="return to view purchase order table" href="{{ route('organizations.po.index') }}" class="btn btn-warning">عوده</a>
                            @if(true AND ($po->status?$po->status->id==2 :0))
                                <a
                                    href="{{route('organizations.change.POStatus.toCheckin',$po->id)}}"
                                    title="change status of purchase order to reciveing"
                                    class="changeStatusToCheckIN btn btn-primary">
                                    Check in(Recive) <i style="color: #fff" class="fas fa-clipboard-check"></i>
                                </a>
                            @endif
                            @if($po->status?$po->status->id==4 :0 and ($po->remaining))
                                <a title="Create payment of this PO" href="{{ route('organizations.purchaseOrderPayment.create').'?po='.$po->id }}" class="btn btn-primary">انشاء دفع</a>
                            @endif
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
