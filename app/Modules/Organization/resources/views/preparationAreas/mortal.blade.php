<x-organization::layout>
    <x-slot name="pageTitle">مناطق التحضير | تصنيع</x-slot name="pageTitle">
    @section('preparationAreas-active', 'm-menu__item--active m-menu__item--open')

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
                    مناطق التحضير
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
                            تصنيع من
                            [{{$inventory->ingredient->name}}]
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="table-responsive">
                    <section class="content">
                        <form method="POST" action="{{route('organizations.preparationArea.store.manufactured.ings')}}" enctype="multipart/form-data"
                              class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                            @csrf
                            <input type="hidden" name="inventory" id="inventory" value="{{$inventory->id}}"/>
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label>الكمية المصنعة  :</label>
                                        <input
                                            type="number"
                                            value="{{old('manufactured')}}"
                                            name="manufactured"
                                            id="manufacturedNumber"
                                            required=""
                                            min="0"
                                            class="form-control m-input"
                                            placeholder="ادخل الكمية..." />
                                        @error('manufactured')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        {{$inventory->quantity * $inventory->ingredient->quantity}} [{{$inventory->ingredient->unit_of_measurement->name}}]
                            <br>
                                   من
                                        <p id="manufactured"> {{$inventory->quantity * $inventory->ingredient->quantity}}</p> [{{$inventory->ingredient->unit_of_measurement->name}}]


                                  <input type="hidden" name="actualManufacturedQty" id="actualManufacturedQty" value="0"/>

                                        <input type="hidden" name="inventoryQty" id="inventoryQty" value="{{$inventory->quantity}}"/>

                                    </div>
                                </div>


                                @foreach($inventory->ingredient->manufactured as $manufactured)
                                    <tr>
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-2">
                                            <label>{{$manufactured->name}} [{{$manufactured->unit_of_measurement->name}}] :</label>
                                            <input
                                                type="hidden"
                                                value="{{$manufactured->id}}"
                                                name="ingredients[]"
                                                required=""
                                                class="form-control m-input ingredients"
                                            />
                                            @error('ingredients')
                                            <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                            @enderror
                                        </div>

                                        <div class="col-lg-2">
                                            <label>الكمية المصنعة  :</label>
                                            <input
                                                type="number"
                                                value=""
                                                data-id="{{$manufactured->id}}"
                                                name="manufacturedQuantity[]"
                                                required=""
                                                id="manufacturedQuantity-{{$manufactured->id}}"
                                                class="form-control m-input manufacturedQuantity"
                                            />
                                            @error('manufacturedQuantity')
                                            <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                            @enderror
                                        </div>



                                        <div class="col-lg-2">
                                            <label>التكلفة المحسوبة  :</label>
                                            <input
                                                type="number"
                                                value="{{old('calc_cost')}}"
                                                name="calc_cost[]"
                                                required=""
                                                id="calc_cost-{{$manufactured->id}}"
                                                readonly
                                                class="form-control m-input"
                                            />
                                            @error('calc_cost')
                                            <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                            @enderror
                                        </div>






                                        <div class="col-lg-2">
                                            <label>القيمة المالية  :</label>
                                            <input
                                                type="number"
                                                value="{{old('financial_value')}}"
                                                name="financial_value[]"
                                                required=""
                                                step="0.1"
                                                data-id="{{$manufactured->id}}"
                                                class="form-control m-input financial_value"
                                            />
                                            @error('financial_value')
                                            <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                            @enderror
                                        </div>




                                        <div class="col-lg-2">
                                            <label>التكلفة النهائية  :</label>
                                            <input
                                                type="number"
                                                value="{{old('final_cost')}}"
                                                name="final_cost[]"
                                                required=""
                                                readonly
                                                id="final_cost-{{$manufactured->id}}"
                                                class="form-control m-input"
                                            />
                                            @error('final_cost')
                                            <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                            @enderror
                                        </div>




                                    </div>
                                    </tr>
                                @endforeach




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
    <input name="_token" id="token" value="{{csrf_token()}}" type="hidden" />
    <!-- end page content -->
    <x-slot name="scripts">
<script>

    $("#manufacturedNumber").on('change',function (){


        var _token = $("#token").val();
        $.ajax({
            url: "{{route('organizations.preparationArea.calc.manufactured.qty')}}",
            method: "post",
            data: {
                quantity:$(this).val(),_token:_token,inventory:$("#inventory").val()},
            success: function (data) {
                $("#manufactured").html(data);
                $("#actualManufacturedQty").val(data);

            },

        });

    });


    $(".manufacturedQuantity").on('change',function (){

        var ing_id = $(this).data("id");
        var quantity = $(this).val();
        var manifactured_quantity = $("#manufacturedNumber").val();
        var inventoryQty = $("#inventoryQty").val();

        var _token = $("#token").val();
        $.ajax({
            url: "{{route('organizations.preparationArea.calc_cost')}}",
            method: "post",
            data: {
                quantity:quantity,_token:_token,ing_id:ing_id,manifactured_quantity:manifactured_quantity,inventoryQty:inventoryQty},
            success: function (data) {
                $("#calc_cost-"+ing_id).val(data);

            },

        });

    });



    $(".financial_value").on('change',function (){

        var ing_id = $(this).data("id");
        var manifactured_quantity = $("#manufacturedQuantity-"+ing_id).val();
        var financial_value = $(this).val();

        var final_cost = manifactured_quantity * financial_value;
        $("#final_cost-"+ing_id).val(final_cost);

    });


</script>
    </x-slot>
</x-organization::layout>
