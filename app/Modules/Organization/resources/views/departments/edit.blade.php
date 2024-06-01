<x-organization::layout>
    <x-slot name="pageTitle">@lang('Organization::organization.department') | @lang('Organization::organization.edit')</x-slot name="pageTitle">
    @section('department-active', 'm-menu__item--active m-menu__item--open')
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
                    @lang('Organization::organization.department')
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
                        <form method="POST" action="{{route('organizations.department.update', $record->id)}}"
                              class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                            @csrf
                            @method('put')
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label>@lang('Organization::organization.englishName'):</label>
                                        <input
                                            type="text"
                                            value="{{old('name_en')?old('name_en'):$record->getTranslation('name', 'en')}}"
                                            name="name_en"
                                            required=""
                                            class="form-control m-input"
                                            placeholder="@lang('Organization::organization.englishName')..." />
                                        @error('name_en')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6">
                                        <label>@lang('Organization::organization.arabicName'):</label>
                                        <input
                                            type="text"
                                            value="{{old('name_ar')?old('name_ar'):$record->getTranslation('name', 'ar')}}"
                                            name="name_ar"
                                            required=""
                                            class="form-control m-input"
                                            placeholder="@lang('Organization::organization.arabicName')..." />
                                        @error('name_ar')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label class="">اختر ادارة رئيسية :</label>
                                        <select name="parent_id"  class="form-control m-input m-input--square" id="exampleSelect1">
                                            <option value="">-- select Dept --</option>
                                            @foreach($depts as $dept)
                                               <option @if(old('parent_id') == $dept->id) selected @endif
                                                @if($record->parent_id == $dept->id) selected @endif
                                                value="{{ $dept->id }}">{{ $dept->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('parent_id')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label class="">@lang('Organization::organization.englishDescription'):</label>
                                        <textarea
                                            name="description_en"
                                            class="form-control m-input"
                                        >{{old('description_en')?old('description_en'):$record->getTranslation('description', 'en')}}
                                        </textarea>
                                        @error('description_en')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6">
                                        <label class="">@lang('Organization::organization.arabicDescription'):</label>
                                        <textarea
                                            name="description_ar"
                                            class="form-control m-input"
                                        >{{old('description_ar')?old('description_ar'):$record->getTranslation('description', 'ar')}}
                                        </textarea>
                                        @error('description_ar')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label class="">@lang('Organization::organization.headOfDept'):</label>
                                        <select name="employee" required="" class="form-control m-input m-input--square" id="exampleSelect1">
                                            @foreach($emps as $emp)
                                                <option @if(old('employee') == $emp->id) selected @endif
                                                @if($record->head_of_department_id == $emp->id) selected @endif
                                                value="{{ $emp->id }}">{{ $emp->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('employee')
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
    </x-slot>
    <script type="text/javascript">
        var input = document.getElementById("phone");
        input.onkeypress = function (e)
        {
            e = e || window.event;
            var charCode = (typeof e.which == "number") ? e.which : e.keyCode;
            if (!charCode || charCode == 8 /* Backspace */)
                return;
            var typedChar = String.fromCharCode(charCode);
            if (/\d/.test(typedChar))
                return;
            if (typedChar == "+" && this.value == "")
                return;
            return false;
        };
    </script>
</x-organization::layout>
