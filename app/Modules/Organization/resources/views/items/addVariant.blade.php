<x-organization::layout>
    <x-slot name="pageTitle">@lang('Organization::organization.variant') @lang('Organization::organization.items') | @lang('Organization::organization.create')</x-slot name="pageTitle">
    @section('item-active', 'm-menu__item--active m-menu__item--open')
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
                    @lang('Organization::organization.items')
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
                            @lang('Organization::organization.for') @lang('Organization::organization.variant') @lang('Organization::organization.create') : {{$item->name}}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="table-responsive">
                    <section class="content">
                        <form method="POST" action="{{route('organizations.item.store.variant')}}" id="item-variant-form"
                              class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                            @csrf
                            <div class="m-portlet__body">
                            <input type="hidden" value="{{$item->id}}" name="item_id" />
                                <div class="form-group m-form__group row">


                                    <div class="col-lg-6">
                                        <label> @lang('Organization::organization.arabicName'):</label>
                                        <input
                                            type="text"
                                            value="{{old('name_ar')}}"
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
                                        <label>  @lang('Organization::organization.englishName'):</label>
                                        <input
                                            type="text"
                                            value="{{old('name_en')}}"
                                            name="name_en"

                                            class="form-control m-input"
                                            placeholder=" @lang('Organization::organization.englishName')..." />
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

                                            class="form-control m-input">
                                            {{old('description_en')}}
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

                                            class="form-control m-input">
                                            {{old('description_ar')}}
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
                                        <label>@lang('Organization::organization.type'):</label>
                                        <select name="type"  disabled
                                                class="form-control m-input m-input--square"
                                                id="type">

                                            <option @if($item->type== 'Standard') selected @endif
                                            value="Standard">Standard
                                            </option>

                                            <option @if($item->type== 'Variant') selected @endif
                                            value="Variant">Variant
                                            </option>

                                        </select>
                                        @error('type')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="form-group m-form__group row">
                                    <div class="col-lg-12">
                                        <label class="">components:</label><br>
                                        <table  width="100%" class="table table-striped- table-bordered table-hover table-checkable" id="ingredients-table">
                                            <col style="width:50%">
                                            <col style="width:30%">
                                            <col style="width:10%">
                                            <thead>
                                            <tr>
                                                {{--                    <th style="font-weight: bold;">UOM</th>--}}
                                                <th style="font-weight: bold;">@lang('Organization::organization.quantity')</th>
                                                <th style="font-weight: bold;">omponent Name</th>
                                                <th style="font-weight: bold;">@lang('Organization::organization.removable')</th>
                                                <th class="show-variant" style="font-weight: bold;">@lang('Organization::organization.variant')</th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                         @foreach($item->components as $component)

                                             @if($component->component_type == 'Ingredient')
                                             <tr>

                                                <td>
                                                    <input
                                                        type="number"
                                                        required
                                                        class="form-control quantities @if(\Organization\Models\ItemDetail::where('item_id',$item->id)->where('component_id',$component->component_id)->where('component_type','Ingredient')->first()->variant == 0) notVariant @endif"
                                                        name="quantities[]"
                                                        value="{{\Organization\Models\ItemDetail::where('item_id',$item->id)->where('component_id',$component->component_id)->where('component_type','Ingredient')->first()->quantity}}"
                                                        placeholder="quantity..."
                                                        @if(\Organization\Models\ItemDetail::where('item_id',$item->id)->where('component_id',$component->component_id)->where('component_type','Ingredient')->first()->variant == 0) disabled @endif
                                                    >
                                                </td>




                                                <td>
                                                    <select
                                                        name="ingredients[]"
                                                        required
                                                        disabled
                                                        class=" form-control  ingredient"
                                                        data-live-search="true">
                                                            <option
                                                                value="{{$component->component_id}}" selected>
                                                                {{ $component->ingredent->getTranslation('name', 'ar')}} / {{ $component->ingredent->getTranslation('name', 'en')}}
                                                            </option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input
                                                        type="checkbox"
                                                        class="form-control"
                                                        onclick="return false;"
                                                        name="removable[]"
                                                        value="{{$component->component_id}}"
                                                        @if(\Organization\Models\ItemDetail::where('item_id',$item->id)->where('component_id',$component->component_id)->where('component_type','Ingredient')->first()->removable == 1) checked @endif
                                                    >
                                                </td>
                                                <td class="show-variant">
                                                    <input
                                                        type="checkbox"
                                                        class="form-control"
                                                        onclick="return false;"
                                                        name="variant[]"
                                                        value="{{$component->id}}"
                                                        @if(\Organization\Models\ItemDetail::where('item_id',$item->id)->where('component_id',$component->component_id)->where('component_type','Ingredient')->first()->variant == 1) checked @endif
                                                    >
                                                </td>
                                                 <input type="hidden" value="1" name="comType[]" />

                                            </tr>
                                             @elseif($component->component_type == 'Item Variant')

                                                 <tr>

                                                     <td>
                                                         <input
                                                             type="number"
                                                             required
                                                             class="form-control quantities @if(\Organization\Models\ItemDetail::where('item_id',$item->id)->where('component_id',$component->component_id)->where('component_type','Item Variant')->first()->variant == 0) notVariant @endif"
                                                             name="quantities[]"
                                                             value="{{\Organization\Models\ItemDetail::where('item_id',$item->id)->where('component_id',$component->component_id)->where('component_type','Item Variant')->first()->quantity}}"
                                                             placeholder="quantity..."
                                                             @if(\Organization\Models\ItemDetail::where('item_id',$item->id)->where('component_id',$component->component_id)->where('component_type','Item Variant')->first()->variant == 0) disabled @endif
                                                         >
                                                     </td>




                                                     <td>
                                                         <select
                                                             name="ingredients[]"
                                                             required
                                                             disabled
                                                             class=" form-control  ingredient"
                                                             data-live-search="true">
                                                             <option
                                                                 value="{{$component->component_id}}" selected>
                                                                 {{ $component->item->getTranslation('name', 'ar')}} / {{ $component->item->getTranslation('name', 'en')}}
                                                             </option>
                                                         </select>
                                                     </td>
                                                     <td>
                                                         <input
                                                             type="checkbox"
                                                             class="form-control"
                                                             onclick="return false;"
                                                             name="removable[]"
                                                             value="{{$component->component_id}}"
                                                             @if(\Organization\Models\ItemDetail::where('item_id',$item->id)->where('component_id',$component->component_id)->where('component_type','Item Variant')->first()->removable == 1) checked @endif
                                                         >
                                                     </td>
                                                     <td class="show-variant">
                                                         <input
                                                             type="checkbox"
                                                             class="form-control"
                                                             onclick="return false;"
                                                             name="variant[]"
                                                             value="{{$component->id}}"
                                                             @if(\Organization\Models\ItemDetail::where('item_id',$item->id)->where('component_id',$component->component_id)->where('component_type','Item Variant')->first()->variant == 1) checked @endif
                                                         >
                                                     </td>
                                                     <input type="hidden" value="2" name="comType[]" />

                                                 </tr>
                                             @else




                                                 <tr>

                                                     <td>
                                                         <input
                                                             type="number"
                                                             required
                                                             class="form-control quantities  @if(\Organization\Models\ItemDetail::where('item_id',$item->id)->where('component_id',$component->component_id)->where('component_type','Item')->first()->variant == 0) notVariant @endif"
                                                             name="quantities[]"
                                                             value="{{\Organization\Models\ItemDetail::where('item_id',$item->id)->where('component_id',$component->component_id)->where('component_type','Item')->first()->quantity}}"
                                                             placeholder="quantity..."
                                                             @if(\Organization\Models\ItemDetail::where('item_id',$item->id)->where('component_id',$component->component_id)->where('component_type','Item')->first()->variant == 0) disabled @endif
                                                         >
                                                     </td>




                                                     <td>
                                                         <select
                                                             name="ingredients[]"
                                                             required
                                                             disabled
                                                             class=" form-control  ingredient"
                                                             data-live-search="true">
                                                             <option
                                                                 value="{{$component->component_id}}" selected>
                                                                 {{ $component->item->getTranslation('name', 'ar')}} / {{ $component->item->getTranslation('name', 'en')}}
                                                             </option>
                                                         </select>
                                                     </td>
                                                     <td>
                                                         <input
                                                             type="checkbox"
                                                             class="form-control"
                                                             onclick="return false;"
                                                             name="removable[]"
                                                             value="{{$component->component_id}}"
                                                             @if(\Organization\Models\ItemDetail::where('item_id',$item->id)->where('component_id',$component->component_id)->where('component_type','Item')->first()->removable == 1) checked @endif
                                                         >
                                                     </td>
                                                     <td class="show-variant">
                                                         <input
                                                             type="checkbox"
                                                             class="form-control"
                                                             onclick="return false;"
                                                             name="variant[]"
                                                             value="{{$component->id}}"
                                                             @if(\Organization\Models\ItemDetail::where('item_id',$item->id)->where('component_id',$component->component_id)->where('component_type','Item')->first()->variant == 1) checked @endif
                                                         >
                                                     </td>
                                                     <input type="hidden" value="2" name="comType[]" />

                                                 </tr>



                                             @endif
                                         @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <div class="form-group m-form__group row">

                                    <div class="col-lg-6">
                                        <label>@lang('Organization::organization.cost'):</label>
                                        <input
                                            name="cost"
                                            value="{{$item->cost}}"
                                            type="number"
                                            step="0.01"
                                            id="cost"
                                            readonly

                                            class="form-control m-input"
                                        /> L.E
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
                                        >
                                    </div>

                                </div>


                                <input type="hidden" id="dynamic_percentage" value="{{$setting->dynamic_percentage}}" name="dynamic_percentage"/>

                                <div class="cost_calculations" style="display: none">


                                    <div class="form-group m-form__group row">

                                        <div class="col-lg-3">
                                            <label> @lang('Organization::organization.auxiliary_materials'):</label>
                                            <input
                                                type="number"
                                                step="0.01"
                                                value="{{old('auxiliary_materials')}}"
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
                                                value="{{old('mortal')}}"
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
                                                value="{{old('variable_ratio')}}"
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
                                                value="{{old('final_cost')}}"
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
                                                <option value="0">اختر خيار سعر</option>
                                                <option value="20">+20%</option>
                                                <option value="30">+30%</option>
                                                <option value="1">ادخل السعر النهائى</option>

                                            </select>
                                        </div>

                                        <div class="col-lg-6 show_final_price_calcued">
                                            <label> السعر النهائى</label>
                                            <input
                                                type="number"
                                                step="0.01"
                                                value="{{old('final_price_calcued')}}"
                                                name="final_price_calcued"
                                                readonly
                                                class="form-control m-input final_price_calcued"
                                            />
                                        </div>


                                        <div class="col-lg-6 show_final_price" style="display: none">
                                            <label>  ادخل السعر النهائى</label>
                                            <input
                                                type="number"
                                                step="0.01"
                                                value="{{old('final_price')}}"
                                                name="final_price"
                                                class="form-control m-input final_price"
                                            />
                                        </div>

                                    </div>

                                </div>

                                <input id="token" value="{{csrf_token()}}" type="hidden"/>
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


        <!-- Some JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
        <script>
            $('input').on('focusin', function(){
                $('input[name="quantities[]"]').each(function() {
                    $(this).removeClass( "sleceted" );
                });
                $(this).data('val', $(this).val());
                $(this).addClass( "sleceted" );
            });
        </script>


        <script>

            $("#item-variant-form").on('change','.quantities',function(){


                var prev = $(this).data('val');

                var current = $(this).val();

                if (prev == current){
                    var ratio = 1;
                }else if(prev < current) {
                    var ratio = current / prev ;
                }else if (prev > current){
                    var ratio =  current /prev  ;

                }
                $('input[name="quantities[]"]').each(function() {
                    if ($(this).hasClass("sleceted") || $(this).hasClass("notVariant")){

                    }else {
                        $(this).val(parseInt($(this).val()) * parseFloat(ratio)) ;
                    }
                });

                console.log(prev,current,parseInt(ratio));

                var val1=[];
                $('select[name="ingredients[]"] option:selected').each(function() {
                    val1.push($(this).val());
                });
                var val2 = [];
                $('input[name="quantities[]"]').each(function() {
                    val2.push($(this).val());
                });

                var val3 = [];
                $('input[name="comType[]"]').each(function() {
                    val3.push($(this).val());
                });

                var _token = $("#token").val();
                $.ajax({
                    url: "{{route('organizations.item.get.ingredients.tags')}}",
                    method: "post",
                    data: {
                        val1:val1,val2:val2,val3:val3,_token:_token},
                    success: function (data) {

                        $('#cost').val(data['cost']);
                        setTimeout(get_calcus, 500)
                    },

                });
            });
        </script>

        <script>

            $(document).ready(function() {
                get_calcus();

            });

            $('.quant').on('change', function() {

                setTimeout(get_calcus, 500)
            });

            $(".ingredient").change( function() {
                setTimeout(get_calcus, 1000)
            });

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

            function get_calcus()
            {

                var _token = $("#token").val();
                $.ajax({
                    url: "{{route('organizations.item.get.calcus')}}",
                    method: "post",
                    data: {
                        cost:$("#cost").val(),_token:_token},
                    success: function (data) {
                        $(".auxiliary_materials").val(data.auxiliary_materials);

                        $(".mortal").val(data.mortal);
                        $(".variable_ratio").val(data.variable_ratio);
                        $(".final_cost").val(data.final_cost);
                        get_price();
                    },

                });


            }
        </script>

        @include('Organization::items.components.ingredients._script')
    </x-slot>

</x-organization::layout>
