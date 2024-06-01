<x-organization::layout>
    <x-slot name="pageTitle">@lang('Organization::organization.employeeJob') | @lang('Organization::organization.edit')</x-slot name="pageTitle">
    @section('employeeJob-active', 'm-menu__item--active m-menu__item--open')
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
                    @lang('Organization::organization.employeeJob')
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
                            @lang('Organization::organization.edit')
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="table-responsive">
                    <section class="content">
                        <form method="POST" action="{{route('organizations.employeeJob.update', $record->id)}}"
                              class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                            @csrf
                            @method('put')
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label>@lang('Organization::organization.name'):</label>
                                        <input
                                            type="text"
                                            value="{{old('name')?old('name'):$record->name}}"
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
                                        <textarea id="description"
                                                  name="description"

                                                  class="form-control m-input">
                                       {{$record->description}} </textarea>
                                        @error('desc')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label> @lang('Organization::organization.employee_vacation_balance'):</label>
                                        <input
                                            type="number"
                                            value="{{old('Vacation_balance')?old(''):$record->Vacation_balance}}"
                                            name="Vacation_balance"
                                            required=""
                                            class="form-control m-input"
                                            placeholder="@lang('Organization::organization.employee_vacation_balance')..." />
                                        @error('Vacation_balance')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                </div>

                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions--solid">
                                    <div class="row">
                                        <div class="col-lg-6">
                                        </div>
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
        <script type="text/javascript">
            $('#description').summernote({
                tabsize: 2,
                height: 150
            });
        </script>
    </x-slot>

</x-organization::layout>
