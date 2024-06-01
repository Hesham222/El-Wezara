<x-organization::layout>
    <x-slot name="pageTitle">@lang('Organization::organization.employeeBonus') | @lang('Organization::organization.create')</x-slot name="pageTitle">
    @section('employeeBonus-active', 'm-menu__item--active m-menu__item--open')
    @section('employeeBonus-create-active', 'm-menu__item--active')
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
                    @lang('Organization::organization.employeeBonus')
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
                        <form method="POST" action="{{route('organizations.employeeBonus.store')}}"
                              class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" enctype="multipart/form-data">
                            @csrf

                            @if($empId != null)
                                <input type="hidden" name="empId" value="{{$empId}}">
                                @endif

                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">

                                    <div class="col-lg-4">
                                        <label class="">  المبلغ  </label>
                                        <input
                                            type="number"
                                            value="{{old('amount')}}"
                                            name="amount"
                                            required=""
                                            step="0.5"
                                            class="form-control m-input"
                                            id="amount"
                                        />
                                        @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-4">
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



                                    <div class="col-lg-4">
                                        <label class="">  ارفق ملف </label>
                                        <input
                                            multiple
                                            type="file"
                                            value="{{old('attachment')}}"
                                            name="attachment"
                                            class="form-control m-input"
                                            id="attachment"
                                        />
                                        @error('attachment')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>


                                </div>



                                <div class="form-group m-form__group row" >
                                    <div class="col-lg-4">
                                        <label>نوع المكافاءة:</label>
                                        <select name="status" required="" class="form-control m-input m-input--square" id="exampleSelect1">

                                            <option @if(old('status') == 'OnSalary') selected @endif value="OnSalary">على الراتب</option>
                                            <option @if(old('status') == 'OnBonus') selected @endif value="OnBonus">على البونص</option>

                                        </select>
                                        @error('status')
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
