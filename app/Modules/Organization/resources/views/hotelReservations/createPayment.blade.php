<x-organization::layout>
    @if(request()->input('view')=='trash')
        <x-slot name="pageTitle">المدفوعات دفع | سله المهملات</x-slot name="pageTitle">
        @section('hotelReservations-trash-active', 'm-menu__item--active')
    @else
        <x-slot name="pageTitle">المدفوعات دفع | عرض</x-slot name="pageTitle">
        @section('hotelReservations-view-active', 'm-menu__item--active')
    @endif
    @section('hotelReservations-active', 'm-menu__item--active m-menu__item--open')
    @include('Organization::_modals.confirm_password')
    <x-slot name="style">
        <!-- Some styles -->
    </x-slot>
    <!-- Start page content -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    المدفوعات دفع
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
                           {{$record->Customer->name}} مدفوعات غرفة رقم {{ $record->Room->room_num }}
                            المتبقي {{ $record->remainingAmount }} جنية
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="table-responsive">
                    <section class="content">
                        <form method="POST" action="{{route('organizations.hotelReservation.store.payment')}}"enctype="multipart/form-data"
                              class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                            @csrf
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label>طريقة الدفع:</label>
                                        <select name="method" required="" class="form-control m-input m-input--square" id="exampleSelect1">
                                            <option @if(old('method') == "Cash") selected @endif value="Cash">Cash</option>
                                            <option @if(old('method') == "Visa") selected @endif value="Visa">Visa</option>
                                        </select>
                                        @error('method')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <label>قيمة المبلغ:</label>
                                        <input
                                            type="text"
                                            value="{{old('amount')}}"
                                            name="amount"
                                            required=""
                                            class="form-control m-input"
                                            placeholder="أدخل قيمة المبلغ..." />
                                        @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="reservation" value="{{$id}}">
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

    </x-slot>
</x-organization::layout>
