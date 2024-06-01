<x-organization::layout>
    <x-slot name="pageTitle">@lang('Organization::organization.vacationRequest') | @lang('Organization::organization.create')</x-slot name="pageTitle">
    @section('vacationRequest-active', 'm-menu__item--active m-menu__item--open')
    @section('vacationRequest-create-active', 'm-menu__item--active')
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
                    @lang('Organization::organization.vacationRequest')
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
                            @lang('Organization::organization.create')
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="table-responsive">
                    <section class="content">
                        <form method="POST" action="{{route('organizations.vacationRequest.store')}}"
                              class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                            @csrf

                            @if($empId != null)
                                <input type="hidden" name="empId" value="{{$empId}}">
                                @endif

                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label> @lang('Organization::organization.employeeVacationType')</label>
                                        <select name="employee_vacation_type" required="" class="form-control m-input m-input--square" id="exampleSelect1">
                                                    @foreach($vacation_types as $vacation_type)
                                            <option @if(old('employee_vacation_type') == $vacation_type->id) selected @endif value="{{$vacation_type->id}}">{{$vacation_type->type}}</option>
                                                @endforeach
                                        </select>
                                        @error('employee_vacation_type')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6">
                                        <label class="">@lang('Organization::organization.note'):</label>
                                        <textarea
                                            name="note"

                                            class="form-control m-input">
                                        </textarea>
                                        @error('note')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="form-group m-form__group row">

                                    <div class="col-lg-6">
                                        <label class=""> تاريخ بدا الاجازة</label>
                                        <input
                                            type="date"
                                            value="{{old('start_date')}}"
                                            name="start_date"
                                            required=""
                                            class="form-control m-input"
                                            id="start_date"
                                        />
                                        @error('start_date')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>


                                    <div class="col-lg-6">
                                        <label class=""> تاريخ انتهاء الاجازة</label>
                                        <input
                                            type="date"
                                            value="{{old('end_date')}}"
                                            name="end_date"
                                            required=""
                                            class="form-control m-input"
                                            id="end_date"
                                        />
                                        @error('end_date')
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
                                            <button type="submit" class="btn btn-primary">@lang('Organization::organization.save')</button>
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
        <!-- Some JS -->

    </x-slot>

</x-organization::layout>
