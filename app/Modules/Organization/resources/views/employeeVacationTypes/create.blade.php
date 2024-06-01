<x-organization::layout>
    <x-slot name="pageTitle">@lang('Organization::organization.employeeVacationType') | @lang('Organization::organization.create')</x-slot name="pageTitle">
    @section('employeeVacationType-active', 'm-menu__item--active m-menu__item--open')
    @section('employeeVacationType-create-active', 'm-menu__item--active')
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
                    @lang('Organization::organization.employeeVacationType')
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
                        <form method="POST" action="{{route('organizations.employeeVacationType.store')}}"
                              class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                            @csrf
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label> @lang('Organization::organization.name'):</label>
                                        <input
                                            type="text"
                                            value="{{old('name')}}"
                                            name="name"
                                            required=""
                                            class="form-control m-input"
                                            placeholder="@lang('Organization::organization.name')..." />
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>



                                </div>

                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label class="">@lang('Organization::organization.desc'):</label>
                                        <textarea
                                            name="description"
                                            id="description"
                                            class="form-control m-input">
                                        </textarea>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>



                                </div>

                                <div class="form-group m-form__group row">

                                    <div class="col-lg-6">
                                        <label>نوع الاجازة:</label>
                                        <select name="vacation_type" required="" class="form-control m-input m-input--square" id="exampleSelect1">

                                                <option @if(old('vacation_type') == 'Paid') selected @endif >Paid</option>
                                            <option @if(old('vacation_type') == 'UnPaid') selected @endif >UnPaid</option>
                                        </select>
                                        @error('vacation_type')
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
        <script>
            $('#description').summernote({
                tabsize: 2,
                height: 150
            });
        </script>
    </x-slot>

</x-organization::layout>
