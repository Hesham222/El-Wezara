<x-organization::layout>
    <x-slot name="pageTitle">@lang('Organization::organization.ingredients') | @lang('Organization::organization.import')</x-slot name="pageTitle">
    @section('ingredient-active', 'm-menu__item--active m-menu__item--open')
    @section('ingredient-import-active', 'm-menu__item--active')
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
                    @lang('Organization::organization.ingredients')
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
                        <form method="POST" action="{{route('organizations.ingredient.storeImport')}}"
                              class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" enctype="multipart/form-data">
                            @csrf
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">


                                    <div class="col-lg-6">
                                        <label>اختر ملف:</label>
                                        <input
                                            type="file"
                                            value="{{old('file')}}"
                                            name="file"
                                            required=""
                                            class="form-control m-input"
                                            placeholder="اختر ملف" />
                                        @error('file')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>

                                 

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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

        <script>


            $("#can_sold").change( function() {
        if ($('#can_sold').is(':checked')){
            $(".cost_calculations").show();
        }else {
            $(".cost_calculations").hide();
        }

            });

            $("#cost").change( function() {
                // your code
                var auxiliary_materials = $("#cost").val() * (10/100);
                var mortal = $("#cost").val() * (5/100);
                var variable_ratio = $("#cost").val() * ($("#dynamic_percentage").val()/100);
                var final_cost = parseInt($("#cost").val())  +  parseInt(auxiliary_materials) + parseInt(mortal) + parseInt(variable_ratio) ;

                $(".auxiliary_materials").val(auxiliary_materials);

                $(".mortal").val(mortal);
                $(".variable_ratio").val(variable_ratio);
                $(".final_cost").val(final_cost);

                get_price();
            });

            $("#price_options").change( function() {

                get_price();
            });


            function get_price()
            {
                var price_option = $("#price_options").val();

                if (price_option == 20){
                    $(".show_final_price_calcued").show();
                    $(".show_final_price").hide();

                    var final_price = $(".final_cost").val() * (1 + (20/100)) ;
                    $(".final_price_calcued").val(final_price);
                }else if(price_option == 30){
                    $(".show_final_price_calcued").show();
                    $(".show_final_price").hide();

                    var final_price = $(".final_cost").val() * (1 + (30/100)) ;
                    $(".final_price_calcued").val(final_price);
                }else {
                    $(".show_final_price_calcued").hide();
                    $(".show_final_price").show();
                }

            }
        </script>

    </x-slot>

</x-organization::layout>
