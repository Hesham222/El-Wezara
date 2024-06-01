<x-organization::layout>
    <x-slot name="pageTitle">@lang('Organization::organization.items') | @lang('Organization::organization.edit')</x-slot name="pageTitle">
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
                            @lang('Organization::organization.edit')
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="table-responsive">
                    <section class="content">
                        <form method="POST" action="{{route('organizations.item.update',$item->id)}}" id="item-variant-form"
                              class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed"
                        enctype="multipart/form-data"
                        >
                            @csrf
                            @method('PUT')
                            <div class="m-portlet__body">
                                <input type="hidden" value="{{$item->id}}" name="item_id" />

                                <div class="form-group m-form__group row">


                                    <div class="col-lg-6">
                                        <label>@lang('Organization::organization.arabicName'):</label>
                                        <input
                                            type="text"
                                            value="{{old('name_ar')?old('name_ar'):$item->getTranslation('name', 'ar')}}"
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
                                            value="{{old('name_en')?old('name_en'):$item->getTranslation('name', 'en')}}"
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
                                        >{{old('description_en')?old('description_en'):$item->getTranslation('description', 'en')}}
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
                                        >{{old('description_ar')?old('description_ar'):$item->getTranslation('description', 'ar')}}
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
                                        <label> @lang('Organization::organization.image'):</label>
                                        <input
                                            type="file"
                                            value="{{old('image')}}"
                                            name="image"
                                            class="form-control m-input"
                                        />
                                        @error('image')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="form-group m-form__group row">

                                    <div class="col-lg-6">
                                        <label>@lang('Organization::organization.type'):</label>
                                        <select name="type"
                                                class="form-control m-input m-input--square"
                                                id="type">

                                            <option @if($item->type== 'Standard') selected @endif
                                            value="Standard">طبق
                                            </option>

                                            <option @if($item->type== 'Variant') selected @endif
                                            value="Variant">طبق فرعى
                                            </option>

                                        </select>
                                        @error('type')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>


                                    <div class="col-lg-6">
                                        <label>الفئة:</label>
                                        <select name="category" required=""
                                                class="form-control m-input m-input--square"
                                                id="type">
                                            @foreach($menu_categories as $menu_category)
                                                <option @if(old('category')== $menu_category->id) selected @endif
                                                    @if($item->menu_category_id == $menu_category->id) selected @endif
                                                value="{{$menu_category->id}}">{{$menu_category->name}}
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
                                                <th style="font-weight: bold;">component Name</th>
                                                <th style="font-weight: bold;">@lang('Organization::organization.removable')</th>
                                                <th class="show-variant" style="font-weight: bold;@if($item->type != 'Variant') display: none; @endif">@lang('Organization::organization.variant')</th>
                                                <th>@lang('Organization::organization.actions')</th>
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
                                                            class="form-control quant"
                                                            name="quantities[]"
                                                            value="{{\Organization\Models\ItemDetail::where('item_id',$item->id)->where('component_id',$component->component_id)->where('component_type','Ingredient')->first()->quantity}}"
                                                            placeholder="quantity..."
                                                        >
                                                    </td>




                                                    <td>
                                                        <select
                                                            name="ingredients[]"
                                                            required

                                                            class=" form-control  ingredient"
                                                            data-live-search="true">
                                                            @foreach($ingredients as $ing)
                                                                <option
                                                                    data-type = "ingredient"
                                                                    value="{{$ing->id}}" @if($ing->id == $component->component_id &&$component->component_type == 'Ingredient' ) selected @endif>
                                                                    {{ $ing->getTranslation('name', 'ar')}} / {{ $ing->getTranslation('name', 'en')}} [{{$ing->unit_of_measurement?$ing->unit_of_measurement->name:'--'}}]
                                                                </option>
                                                            @endforeach

                                                            @foreach($items as $it)
                                                                <option
                                                                    data-type = "item"
                                                                    value="{{$it->id}}" @if($it->id == $component->component_id && $component->component_type == 'Item' ) selected @endif>
                                                                    {{ $it->getTranslation('name', 'ar')}} / {{ $it->getTranslation('name', 'en')}}
                                                                </option>
                                                            @endforeach

                                                            @foreach($item_variants as $it)
                                                                <option
                                                                    data-type = "item_variant"
                                                                    value="{{$it->id}}" @if($it->id == $component->component_id && $component->component_type == 'Item Variant' ) selected @endif>
                                                                    {{ $it->getTranslation('name', 'ar')}} / {{ $it->getTranslation('name', 'en')}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input
                                                            type="checkbox"
                                                            class="form-control"
                                                            value="{{$component->component_id}},Ingredient"
                                                            name="removable[]"
                                                            @if(\Organization\Models\ItemDetail::where('item_id',$item->id)->where('component_id',$component->component_id)->where('component_type','Ingredient')->first()->removable == 1) checked @endif
                                                        >
                                                    </td>
                                                    <td class="show-variant" @if($item->type != 'Variant') style="display: none;" @endif>
                                                        <input
                                                            type="checkbox"
                                                            value="{{$component->component_id}},Ingredient"
                                                            class="form-control"
                                                            name="variant[]"
                                                            @if(\Organization\Models\ItemDetail::where('item_id',$item->id)->where('component_id',$component->component_id)->where('component_type','Ingredient')->first()->variant == 1) checked @endif
                                                        >
                                                    </td>

                                                    <td>
                                                        <a
                                                            title="Remove the row"
                                                            class="btn btn-sm btn-danger"
                                                            onclick="DeleteVendorRowTable(this)">
                                                            <i class="fa fa-times" style="color: #fff"></i>
                                                        </a>
                                                    </td>
                                                    <input type="hidden" value="1" name="comType[]" />
                                                </tr>

                                                @elseif($component->component_type == 'Item Variant')
                                                    <tr>

                                                        <td>
                                                            <input
                                                                type="number"
                                                                required
                                                                class="form-control quant"
                                                                name="quantities[]"
                                                                value="{{\Organization\Models\ItemDetail::where('item_id',$item->id)->where('component_id',$component->component_id)->where('component_type','Item Variant')->first()->quantity}}"
                                                                placeholder="quantity..."
                                                            >
                                                        </td>




                                                        <td>
                                                            <select
                                                                name="ingredients[]"
                                                                required

                                                                class=" form-control  ingredient"
                                                                data-live-search="true">
                                                                @foreach($ingredients as $ing)
                                                                    <option
                                                                        data-type = "ingredient"
                                                                        value="{{$ing->id}}" @if($ing->id == $component->component_id &&$component->component_type == 'Ingredient' ) selected @endif>
                                                                        {{ $ing->getTranslation('name', 'ar')}} / {{ $ing->getTranslation('name', 'en')}}  [{{$ing->unit_of_measurement?$ing->unit_of_measurement->name:'--'}}]
                                                                    </option>
                                                                @endforeach

                                                                @foreach($items as $it)
                                                                    <option
                                                                        data-type = "item"
                                                                        value="{{$it->id}}" @if($it->id == $component->component_id && $component->component_type == 'Item' ) selected @endif>
                                                                        {{ $it->getTranslation('name', 'ar')}} / {{ $it->getTranslation('name', 'en')}}
                                                                    </option>
                                                                @endforeach

                                                                    @foreach($item_variants as $it)
                                                                        <option
                                                                            data-type = "item_variant"
                                                                            value="{{$it->id}}" @if($it->id == $component->component_id && $component->component_type == 'Item Variant' ) selected @endif>
                                                                            {{ $it->getTranslation('name', 'ar')}} / {{ $it->getTranslation('name', 'en')}}
                                                                        </option>
                                                                    @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input
                                                                type="checkbox"
                                                                class="form-control"
                                                                value="{{$component->component_id}},Item Variant"
                                                                name="removable[]"
                                                                @if(\Organization\Models\ItemDetail::where('item_id',$item->id)->where('component_id',$component->component_id)->where('component_type','Item Variant')->first()->removable == 1) checked @endif
                                                            >
                                                        </td>
                                                        <td class="show-variant" @if($item->type != 'Variant') style="display: none;" @endif>
                                                            <input
                                                                type="checkbox"
                                                                value="{{$component->component_id}},Item Variant"
                                                                class="form-control"
                                                                name="variant[]"
                                                                @if(\Organization\Models\ItemDetail::where('item_id',$item->id)->where('component_id',$component->component_id)->where('component_type','Item Variant')->first()->variant == 1) checked @endif
                                                            >
                                                        </td>

                                                        <td>
                                                            <a
                                                                title="Remove the row"
                                                                class="btn btn-sm btn-danger"
                                                                onclick="DeleteVendorRowTable(this)">
                                                                <i class="fa fa-times" style="color: #fff"></i>
                                                            </a>
                                                        </td>
                                                        <input type="hidden" value="3" name="comType[]" />
                                                    </tr>

                                                @else




                                                    <tr>

                                                        <td>
                                                            <input
                                                                type="number"
                                                                required
                                                                class="form-control quant"
                                                                name="quantities[]"
                                                                value="{{\Organization\Models\ItemDetail::where('item_id',$item->id)->where('component_id',$component->component_id)->where('component_type','Item')->first()->quantity}}"
                                                                placeholder="quantity..."
                                                            >
                                                        </td>




                                                        <td>
                                                            <select
                                                                name="ingredients[]"
                                                                required

                                                                class=" form-control  ingredient"
                                                                data-live-search="true">
                                                                @foreach($ingredients as $ing)
                                                                    <option
                                                                        data-type = "ingredient"
                                                                        value="{{$ing->id}}" @if($ing->id == $component->component_id &&$component->component_type == 'Ingredient' ) selected @endif>
                                                                        {{ $ing->getTranslation('name', 'ar')}} / {{ $ing->getTranslation('name', 'en')}}  [{{$ing->unit_of_measurement?$ing->unit_of_measurement->name:'--'}}]
                                                                    </option>
                                                                @endforeach

                                                                @foreach($items as $it)
                                                                    <option
                                                                        data-type = "item"
                                                                        value="{{$it->id}}" @if($it->id == $component->component_id && $component->component_type == 'Item' ) selected @endif>
                                                                        {{ $it->getTranslation('name', 'ar')}} / {{ $it->getTranslation('name', 'en')}}
                                                                    </option>
                                                                @endforeach
                                                                    @foreach($item_variants as $it)
                                                                        <option
                                                                            data-type = "item_variant"
                                                                            value="{{$it->id}}" @if($it->id == $component->component_id && $component->component_type == 'Item Variant' ) selected @endif>
                                                                            {{ $it->getTranslation('name', 'ar')}} / {{ $it->getTranslation('name', 'en')}}
                                                                        </option>
                                                                    @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input
                                                                type="checkbox"
                                                                class="form-control"
                                                                value="{{$component->component_id}},Item"
                                                                name="removable[]"
                                                                @if(\Organization\Models\ItemDetail::where('item_id',$item->id)->where('component_id',$component->component_id)->where('component_type','Item')->first()->removable == 1) checked @endif
                                                            >
                                                        </td>
                                                        <td class="show-variant" @if($item->type != 'Variant') style="display: none;" @endif>
                                                            <input
                                                                type="checkbox"
                                                                value="{{$component->component_id}},Item"
                                                                class="form-control"
                                                                name="variant[]"
                                                                @if(\Organization\Models\ItemDetail::where('item_id',$item->id)->where('component_id',$component->component_id)->where('component_type','Item')->first()->variant == 1) checked @endif
                                                            >
                                                        </td>

                                                        <td>
                                                            <a
                                                                title="Remove the row"
                                                                class="btn btn-sm btn-danger"
                                                                onclick="DeleteVendorRowTable(this)">
                                                                <i class="fa fa-times" style="color: #fff"></i>
                                                            </a>
                                                        </td>
                                                        <input type="hidden" value="2" name="comType[]" />
                                                    </tr>








                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <button type="button" class="btn btn-default " id="new_row"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="item_id" value="{{$item->id}}"  />

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


                                    <div class="col-lg-6">
                                        <label> @lang('Organization::organization.can_sold'):</label>
                                        <input
                                            id="can_sold"
                                            type="checkbox"
                                            class="form-control"
                                            name="can_sold"
                                            @if($item->final_cost != null) checked @endif
                                        >
                                    </div>

                                </div>


                                <input type="hidden" id="dynamic_percentage" value="{{$setting->dynamic_percentage}}" name="dynamic_percentage"/>

                                <div class="cost_calculations" @if($item->final_cost == null) style="display: none" @endif>


                                    <div class="form-group m-form__group row">

                                        <div class="col-lg-3" style="display: none">
                                            <label> @lang('Organization::organization.auxiliary_materials'):</label>
                                            <input
                                                type="number"
                                                step="0.01"
                                                value="{{$item->auxiliary_materials}}"
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
                                                value="{{$item->mortal}}"
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
                                                value="{{$item->variable_ratio}}"
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
                                                value="{{$item->final_cost}}"
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
                                                <option @if($item->price_options == null) selected @endif value="0">اختر خيار سعر</option>
                                                <option @if($item->price_options == 20) selected @endif value="20">+20%</option>
                                                <option @if($item->price_options == 30) selected @endif value="30">+30%</option>
                                                <option @if($item->price_options == 1) selected @endif value="1">ادخل السعر النهائى</option>

                                            </select>
                                        </div>

                                        <div class="col-lg-6 show_final_price_calcued" @if(  $item->price_options == null || $item->price_options == 1) style="display: none" @endif>
                                            <label> السعر النهائى</label>
                                            <input
                                                type="number"
                                                step="0.01"
                                                value="{{$item->price}}"
                                                name="final_price_calcued"
                                                readonly
                                                class="form-control m-input final_price_calcued"
                                            />
                                        </div>


                                        <div class="col-lg-6 show_final_price" @if(  $item->price_options == 1) style="display: block" @else style="display: none" @endif >
                                            <label>  ادخل السعر النهائى</label>
                                            <input
                                                type="number"
                                                step="0.01"
                                                value="{{$item->price}}"
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

        </script>


        <script>

            $("#item-variant-form").on('change','.ingredient',function(){

                var lastType = jQuery(this).closest('tr').find('[type=hidden]');
                var intVal = $(this).val();
                var check =    jQuery(this).closest('tr').find('[type=checkbox]');

                var commingType = $(this).children(":selected").data('type');

                console.log(commingType);
                if (commingType === 'item'){

                    lastType.val(2);
                    check.val(intVal.toString()+',Item');
                }else if(commingType === 'item_variant'){
                    alert('from item variant');
                    lastType.val(3);
                    check.val(intVal.toString()+',Item Variant');
                }
                else{
                    lastType.val(1);
                    check.val(intVal.toString()+',Ingredient');
                }

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




            $("#item-variant-form").on('change','.quant',function(){

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

                var intVal = $(this).val();
                var check =    jQuery(this).closest('tr').find('[type=checkbox]');
                check.val(intVal.toString());

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



            {{--$("#item-variant-form").on('change','.ingredient',function(){--}}

            {{--    var intVal = $(this).val();--}}


            {{--    var check =    jQuery(this).closest('tr').find('[type=checkbox]');--}}

            {{--    console.log(intVal.toString());--}}
            {{--    console.log('kjnjkn');--}}
            {{--    check.val(intVal.toString());--}}

            {{--    var val1=[];--}}
            {{--    $('select[name="ingredients[]"] option:selected').each(function() {--}}
            {{--        val1.push($(this).val());--}}
            {{--    });--}}
            {{--    var val2 = [];--}}
            {{--    $('input[name="quantities[]"]').each(function() {--}}
            {{--        val2.push($(this).val());--}}
            {{--    });--}}

            {{--    var _token = $("#token").val();--}}
            {{--    $.ajax({--}}
            {{--        url: "{{route('admins.item.get.ingredients.tags')}}",--}}
            {{--        method: "post",--}}
            {{--        data: {--}}
            {{--            val1:val1,val2:val2,_token:_token},--}}
            {{--        success: function (data) {--}}
            {{--            $('#tag_list').html(data['output']);--}}
            {{--            $('#calories').val(data['cal']);--}}
            {{--            $('#cost').val(data['cost']);--}}
            {{--            // $(".vendor-id").selectpicker();--}}
            {{--        },--}}

            {{--    });--}}
            {{--});--}}

            $("#item-variant-form").on('change','#type',function(){

                var intVal = $(this).val();

                if (intVal == 'Variant'){
                    $(".show-variant").css('display','block');
                }else {
                    $(".show-variant").css('display','none');
                }


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
