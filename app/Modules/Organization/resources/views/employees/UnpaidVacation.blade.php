<x-organization::layout>
    <x-slot name="pageTitle">اجازه بدون مرتب | اضف</x-slot name="pageTitle">
    @section('employee-active', 'm-menu__item--active m-menu__item--open')

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
                    اجازه بدون مرتب
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
                            اضف
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="table-responsive">
                    <section class="content">
                        <form method="POST" action="{{route('organizations.employee.store.unpaid')}}" enctype="multipart/form-data"
                              class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                            @csrf
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label> سبب الاجازه:</label>
                                        <textarea
                                            name="leave_reason"
                                            class="form-control m-input"
                                            placeholder="اضف سبب الاجازه..."
                                        ></textarea>
                                        @error('leave_reason')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                    <label> عدد سنين العمل</label>
                                    <input type="number" step="0.01"  required="" class="form-control m-input" name="work_years" placeholder="اضف عدد سنين العمل...">
                                    @error('work_years')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                </div>
                                </div>
                                <div class="form-group m-form__group row">

                                    <div class="col-lg-6">
                                        <label>تاريخ الاجازه</label>
                                        <input class="form-control" type="date"  name="leave_date" id="leave_date" value="{{ old('leave_date') }}" required>
                                        @error('leave_date')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                    <div class="col-lg-6">
                                        <label>تاريخ العوده</label>
                                        <input class="form-control" type="date" name="leave_return" id="leave_return" value="{{ old('leave_return') }}" required>
                                        @error('leave_return')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                    <input hidden value="{{$record->id}}" name="employee_id">
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
        </div>
    </div>
    <!-- end page content -->
    <x-slot name="scripts">

    </x-slot>
</x-organization::layout>
