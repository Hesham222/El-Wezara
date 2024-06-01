<x-organization::layout>
    <x-slot name="pageTitle">الموظفين | اضف المرتب</x-slot name="pageTitle">
    @section('emps-active', 'm-menu__item--active m-menu__item--open')
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
                    الموظفين
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
                            اضف المرتب
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="table-responsive">
                    <section class="content">
                        <form method="POST" action="{{route('organizations.employee.store.salary')}}"
                              class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" enctype="multipart/form-data">
                            @csrf
                            <div class="m-portlet__body">
                                <input type="hidden" name="id" value="{{$emp->id}}"/>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label class=""> المرتب الاساسى</label>
                                        <input
                                            type="number"
                                            value="{{old('gross_salary')?old('gross_salary'):$emp->gross_salary}}"
                                            name="gross_salary"
                                            required=""
                                            class="form-control m-input"
                                            step="0.01"
                                            min="1"
                                        />
                                        @error('gross_salary')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>



                                    <div class="col-lg-6">
                                        <label class="">نسبة الزيادة السنوية</label>
                                        <input
                                            type="number"
                                            value="{{old('annual_increase_rate')?old('annual_increase_rate'):$emp->annual_increase_rate}}"
                                            name="annual_increase_rate"
                                            required=""
                                            class="form-control m-input"
                                                min="0"
                                        />
                                        @error('annual_increase_rate')
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
        </div>
    </div>
    <!-- end page content -->
    <x-slot name="scripts">
        <!-- Some JS -->
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

            $("#isSystemUser").on('change',function (){
                if ($("#isSystemUser").is(":checked")){
                    $(".adminSection").show();
                }else {

                    $(".adminSection").hide();
                }
            });
        </script>
    </x-slot>
</x-organization::layout>
