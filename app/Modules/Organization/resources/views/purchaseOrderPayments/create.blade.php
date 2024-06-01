<x-organization::layout>
    <x-slot name="pageTitle">عرض اوامر الشراء</x-slot name="pageTitle">
    @section('inventory-active', 'm-menu__item--active m-menu__item--open')
    <x-slot name="style">
        <!-- Some styles -->

        <style>
            .invalid-feedback {
                display: block;
            }
        </style>
    </x-slot>

    <div class="m-content">
        <!--Begin::Section-->
        <div class="row">
            <div class="col-xl-12">
                <!--begin:: Widgets/Best Sellers-->
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    إنشاء مدفوعات طلبات الشراء

                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin::Content-->
                        <section class="content">
                            <form method="POST" action="{{route('organizations.purchaseOrderPayment.store')}}"
                                  class="m-form m-form--fit m-form--label-align-right ">
                                @csrf
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-6">
                                            <label><span style="color: red">*</span> طلب الشراء</label>
                                            <select name="purchase_order" required=""
                                                    class="form-control m-input m-input--square">
                                                @foreach($orders as $order)
                                                    <option @if(old('purchase_order')==$order->id OR ($po && $po->id==$order->id )) selected
                                                            @endif value="{{$order->id}}">#{{$order->id}} -
                                                        Remaining on you: {{$order->remaining}} -
                                                        Remaining for you: {{$order->to_return}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('purchase_order')
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <label> <span
                                                    style="color: red">*</span>الكمية
                                            </label>
                                            <input type="number" step="0.01" value="{{old('amount')}}"
                                                   name="amount" required=""
                                                   class="form-control m-input"
                                                   placeholder="الكمية">
                                            @error('amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-6">
                                            <label> <span
                                                    style="color: red">*</span>النوع
                                            </label>
                                            <select name="type" required=""
                                                    class="form-control m-input m-input--square">
                                                <option @if(old('type')=='payment made' ) selected
                                                        @endif value="payment made">تم الدفع
                                                </option>
                                                <option @if(old('type')=='payment received' ) selected
                                                        @endif value="payment received">تم استلام الدفعه
                                                </option>
                                            </select>
                                            @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <label> <span
                                                    style="color: red">*</span>نوع الدفع
                                            </label>
                                            <select name="payment_type" required=""
                                                    class="form-control m-input m-input--square">
                                                <option @if(old('payment_type')=='cash' ) selected
                                                        @endif value="cash">كاش
                                                </option>
                                                <option @if(old('payment_type')=='credit card' ) selected
                                                        @endif value="credit card">بطاقة ائتمان
                                                </option>
                                                <option @if(old('payment_type')=='bank transfer' ) selected
                                                        @endif value="bank transfer">التحويل المصرفى
                                                </option>
                                                <option @if(old('payment_type')=='cheque' ) selected
                                                        @endif value="cheque">شيك
                                                </option>
                                            </select>
                                            @error('payment_type')
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-6">
                                            <label> <span
                                                    style="color: red">*</span>تارثخ الدفع
                                            </label>
                                            <input type="date" value="{{old('date')}}"
                                                   name="date" required=""
                                                   class="form-control m-input"
                                                   placeholder="{{ __('validation.attributes.date') }}">
                                            @error('date')
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <label>الرقم القومى</label>
                                            <input type="number" value="{{old('reference_number')}}"
                                                   name="reference_number"
                                                   class="form-control m-input"
                                                   placeholder="الرقم القومى">
                                            @error('reference_number')
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
                                                <a href="{{ route('organizations.purchaseOrderPayment.index') }}"
                                                   class="btn btn-warning">الغاء</a>
                                                <button type="submit"
                                                        class="btn btn-primary">حفظ</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </section>
                        <!--end::Content-->
                    </div>
                </div>
                <!--end:: Widgets/Best Sellers-->
            </div>
        </div>
        <!--End::Section-->
    </div>



    <!-- end page content -->
    <x-slot name="scripts">
        <script type="text/javascript">

        </script>

    </x-slot>
</x-organization::layout>
