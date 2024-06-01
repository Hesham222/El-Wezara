<x-organization::layout>
    <x-slot name="pageTitle"> فاتورة غرفة | تعديل</x-slot name="pageTitle">
    @section('hotelReservations-view-active', 'm-menu__item--active')
    @section('hotelReservations-active', 'm-menu__item--active m-menu__item--open')
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
                    تعديل فاتورة غرفة
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
            @if(is_null($record->hotelInvoiceExtra))
                <div class="m-portlet__body">
                    <div class="table-responsive">
                        <section class="content">
                            <form method="POST" action="{{route('organizations.hotelReservation.update.invoice',$record->id)}}" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                                @csrf
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-6">
                                            <label>شخص اضافي :</label>
                                            <h6>السعر: {{ $extraPersonPrice }}</h6>
                                            <input
                                                type="number"
                                                min="1"
                                                value="{{old('extraPerson')}}"
                                                name="extraPerson"
                                                class="form-control m-input"
                                            />
                                            @error('extraPerson')
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <label>طفل اضافي :</label>
                                            <h6>السعر: {{ $extraKidPrice }}</h6>
                                            <input
                                                type="number"
                                                min="1"
                                                value="{{old('extraKid')}}"
                                                name="extraKid"
                                                class="form-control m-input"
                                            />
                                            @error('extraKid')
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
            @else
                <div class="m-portlet__body">
                    <div class="table-responsive">
                        <section class="content">
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-6">
                                            <label>شخص اضافي :</label>
                                            <h6>السعر: {{ $extraPersonPrice }}</h6>
                                            <h4>العدد: {{ $record->hotelInvoiceExtra->extraPerson }}</h4>
                                            <h4>الاجمالي: {{ $record->hotelInvoiceExtra->extraPersonPrice }}</h4>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>طفل اضافي :</label>
                                            <h6>السعر: {{ $extraKidPrice }}</h6>
                                            <h4>العدد: {{ $record->hotelInvoiceExtra->extraChild }}</h4>
                                            <h4>الاجمالي: {{ $record->hotelInvoiceExtra->extraChildPrice }}</h4>
                                        </div>
                                    </div>
                                </div>
                        </section>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- end page content -->
    <x-slot name="scripts">

    </x-slot>
</x-organization::layout>
