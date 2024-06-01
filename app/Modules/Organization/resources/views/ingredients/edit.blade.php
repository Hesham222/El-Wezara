<x-organization::layout>
    <x-slot name="pageTitle">@lang('Organization::organization.ingredients') | @lang('Organization::organization.edit')</x-slot name="pageTitle">
    @section('ingredient-active', 'm-menu__item--active m-menu__item--open')
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
                            @lang('Organization::organization.edit')
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="table-responsive">
                    <section class="content">
                        <form method="POST" action="{{route('organizations.ingredient.update', $record->id)}}"
                              class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                            @csrf
                            @method('put')
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">


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

                                    <div class="col-lg-6">
                                        <label>@lang('Organization::organization.englishName'):</label>
                                        <input
                                            type="text"
                                            value="{{old('name_en')?old('name_en'):$record->getTranslation('name', 'en')}}"
                                            name="name_en"
                                            class="form-control m-input"
                                            placeholder="@lang('Organization::organization.englishName')..." />
                                        @error('name_en')
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
                                        <label>  إعادة كمية الطلب:</label>
                                        <input
                                            type="number"
                                            value="{{old('re_order_quantity')?old('re_order_quantity'):$record->re_order_quantity}}"
                                            name="re_order_quantity"
                                            min="0"
                                            class="form-control m-input"
                                        />
                                        @error('re_order_quantity')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">


                                    <div class="col-lg-3">
                                        <label> فى المخزن:</label>
                                        <input
                                            type="number"
                                            value="{{old('stock')?old('stock'):$record->stock}}"
                                            name="stock"
                                            class="form-control m-input"
                                        />
                                        @error('stock')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-3">
                                        <label> @lang('Organization::organization.quantity'):</label>
                                        <input
                                            type="number"
                                            value="{{old('quantity')?old('quantity'):$record->quantity}}"
                                            name="quantity"
                                            required=""
                                            class="form-control m-input"
                                        />
                                        @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-3">
                                        <label> @lang('Organization::organization.unit'):</label>
                                        <select name="unit" required=""
                                                class="form-control m-input m-input--square"
                                                id="exampleSelect1">
                                            @foreach($units as $unit)
                                                <option @if(old( 'unit')==$unit->id ) selected
                                                        @endif @if($record->unit_measurement_id == $unit->id) selected @endif value="{{$unit->id}}">{{$unit->getTranslation('name', 'ar')}} / {{$unit->getTranslation('name', 'en')}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('unit')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-3">
                                        <label>نوع :</label>

                                        <select name="type" required="" class="form-control m-input m-input--square" id="exampleSelect1">

                                            <option @if(old('type') == 'laundry') selected @endif @if($record->type == 'laundry') selected @endif value=laundry"" >مغسلة</option>
                                            <option @if(old('type') == 'hotel') selected @endif  @if($record->type == 'hotel') selected @endif value="hotel" >فندق</option>
                                            <option @if(old('type') == 'pointOfSale') selected @endif @if($record->type == 'pointOfSale') selected @endif value="pointOfSale" >نقطه بيع</option>
                                            <option @if(old('type') == 'preprationArea') selected @endif  @if($record->type == 'preprationArea') selected @endif value="preprationArea" >منطقة تحضير</option>
                                            <option @if(old('type') == 'all') selected @endif  @if($record->type == 'all') selected @endif value="all" >الجميع</option>
                                        </select>
                                        @error('type')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>

                                </div>


                                <div class="form-group m-form__group row">



                                    <div class="col-lg-3">
                                        <label> @lang('Organization::organization.cost'):</label>
                                        <input
                                            type="number"
                                            step="0.01"
                                            value="{{old('cost')?old('cost'):$record->cost}}"
                                            name="cost"
                                            required=""
                                            class="form-control m-input"
                                        />
                                        @error('cost')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>


                                    <div class="col-lg-3">
                                        <label> @lang('Organization::organization.can_sold'):</label>
                                        <input
                                            id="can_sold"
                                            type="checkbox"
                                            class="form-control"
                                            name="can_sold"
                                            @if($record->final_cost != null) checked @endif
                                        >
                                    </div>



                                    <div class="col-lg-3">
                                        <label> الفئات:</label>
                                        <select name="category" required=""
                                                class="form-control m-input m-input--square"
                                                id="exampleSelect1">
                                            @foreach($categories as $category)
                                                <option @if(old( 'category')==$category->id ) selected
                                                        @endif @if($record->ingredient_category_id == $category->id) selected @endif value="{{$category->id}}">{{$category->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>


                                </div>




                                <input type="hidden" id="dynamic_percentage" value="{{$setting->dynamic_percentage}}" name="dynamic_percentage"/>

                                <div class="cost_calculations" @if($record->final_cost == null) style="display: none" @endif>


                                    <div class="form-group m-form__group row">

                                        <div class="col-lg-3" style="display: none">
                                            <label> @lang('Organization::organization.auxiliary_materials'):</label>
                                            <input
                                                type="number"
                                                step="0.01"
                                                value="{{$record->auxiliary_materials}}"
                                                name="auxiliary_materials"
                                                readonly
                                                class="form-control m-input auxiliary_materials"
                                            />

                                        </div>


                                        <div class="col-lg-3">
                                            <label> @lang('Organization::organization.mortal'):</label>
                                            <input
                                                type="number"
                                                step="0.01"
                                                value="{{$record->mortal}}"
                                                name="mortal"
                                                readonly
                                                class="form-control m-input mortal"
                                            />

                                        </div>


                                        <div class="col-lg-3">
                                            <label> @lang('Organization::organization.variable_ratio'):</label>
                                            <input
                                                type="number"
                                                step="0.01"
                                                value="{{$record->variable_ratio}}"
                                                name="variable_ratio"
                                                readonly
                                                class="form-control m-input variable_ratio"
                                            />

                                        </div>


                                        <div class="col-lg-3">
                                            <label> @lang('Organization::organization.final_cost'):</label>
                                            <input
                                                type="number"
                                                step="0.01"
                                                value="{{$record->final_cost}}"
                                                name="final_cost"
                                                readonly
                                                class="form-control m-input final_cost"
                                            />

                                        </div>


                                    </div>

                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-6">
                                            <label>خيارات السعر:</label>
                                            <select name="price_options" required=""
                                                    class="form-control m-input m-input--square"
                                                    id="price_options">
                                                <option @if($record->price_options == null) selected @endif value="0">اختر خيار سعر</option>
                                                <option @if($record->price_options == 20) selected @endif value="20">+20%</option>
                                                <option @if($record->price_options == 30) selected @endif value="30">+30%</option>
                                                <option @if($record->price_options == 1) selected @endif value="1">ادخل السعر النهائى</option>

                                            </select>
                                        </div>

                                        <div class="col-lg-6 show_final_price_calcued" @if(  $record->price_options == null || $record->price_options == 1) style="display: none" @endif>
                                            <label> السعر النهائى</label>
                                            <input
                                                type="number"
                                                step="0.01"
                                                value="{{$record->price}}"
                                                name="final_price_calcued"
                                                readonly
                                                class="form-control m-input final_price_calcued"
                                            />
                                        </div>


                                        <div class="col-lg-6 show_final_price" @if(  $record->price_options == 1) style="display: block" @else style="display: none" @endif >
                                            <label>  ادخل السعر النهائى</label>
                                            <input
                                                type="number"
                                                step="0.01"
                                                value="{{$record->price}}"
                                                name="final_price"
                                                class="form-control m-input final_price"
                                            />
                                        </div>

                                    </div>

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
                var auxiliary_materials = 0;//$("#cost").val() * (10/100);
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
