<x-organization::layout>
    <x-slot name="pageTitle">الاوردارات  | تعديل</x-slot name="pageTitle">
    @section('pointOfSales-active', 'm-menu__item--active m-menu__item--open')
    @section('pointOfSales-view-active', 'm-menu__item--active')
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
                    الاوردارات
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
                            تعيدل الاوردر رقم :   {{$order->id}}#
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="table-responsive">
                    <section class="content">
                            <form method="POST" action="{{route('organizations.pointOfSale.update.order')}}"
                                  class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="item-form">
                                @csrf

                                <input type="hidden" name="order_id" value="{{$order->id}}"/>

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
                                                <th style="font-weight: bold;">الكمية</th>
                                                <th style="font-weight: bold;">اسم المكون</th>
                                                <th>اجراء</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($order->order_items as $component)

                                                @if($component->component_type == 'Ingredient')
                                                    <tr>

                                                        <td>
                                                            <input
                                                                type="number"
                                                                required
                                                                class="form-control quant"
                                                                name="qo[]"
                                                                value="{{\Organization\Models\OrderItem::where('order_id',$order->id)->where('component_id',$component->component_id)->where('component_type','Ingredient')->first()->quantity}}"
                                                                placeholder="quantity..."
                                                                readonly
                                                            >
                                                        </td>




                                                        <td>
                                                            <select
                                                                name="ing[]"
                                                                required
                                                                disabled="true"
                                                                class=" form-control  ingredient"
                                                                data-live-search="true">
                                                                @foreach($ingredients as $ing)
                                                                    <option
                                                                        data-type = "ingredient"
                                                                        value="{{$ing->id}}" @if($ing->id == $component->component_id &&$component->component_type == 'Ingredient' ) selected @endif>
                                                                        {{ $ing->getTranslation('name', 'ar')}} / {{ $ing->getTranslation('name', 'en')}} [{{$ing->unit_of_measurement->name}}]
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
                                                          --
                                                        </td>
                                                        <input type="hidden" value="1" name="comTyp[]" />
                                                    </tr>

                                                @elseif($component->component_type == 'Item Variant')
                                                    <tr>

                                                        <td>
                                                            <input
                                                                type="number"
                                                                required
                                                                class="form-control quant"
                                                                name="qo[]"
                                                                value="{{\Organization\Models\OrderItem::where('order_id',$order->id)->where('component_id',$component->component_id)->where('component_type','Item Variant')->first()->quantity}}"
                                                                placeholder="quantity..."
                                                                readonly
                                                            >
                                                        </td>




                                                        <td>
                                                            <select
                                                                name="ing[]"
                                                                required
                                                                disabled="true"
                                                                class=" form-control  ingredient"
                                                                data-live-search="true">
                                                                @foreach($ingredients as $ing)
                                                                    <option
                                                                        data-type = "ingredient"
                                                                        value="{{$ing->id}}" @if($ing->id == $component->component_id &&$component->component_type == 'Ingredient' ) selected @endif>
                                                                        {{ $ing->getTranslation('name', 'ar')}} / {{ $ing->getTranslation('name', 'en')}}  [{{$ing->unit_of_measurement->name}}]
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
                                                         --
                                                        </td>
                                                        <input type="hidden" value="3" name="comTyp[]" />
                                                    </tr>

                                                @else




                                                    <tr>

                                                        <td>
                                                            <input
                                                                type="number"
                                                                required
                                                                class="form-control quant"
                                                                name="qo[]"
                                                                value="{{\Organization\Models\OrderItem::where('order_id',$order->id)->where('component_id',$component->component_id)->where('component_type','Item')->first()->quantity}}"
                                                                placeholder="quantity..."
                                                                readonly
                                                            >
                                                        </td>




                                                        <td>
                                                            <select
                                                                name="ing[]"
                                                                required
                                                                disabled="true"

                                                                class=" form-control  ingredient"
                                                                data-live-search="true">
                                                                @foreach($ingredients as $ing)
                                                                    <option
                                                                        data-type = "ingredient"
                                                                        value="{{$ing->id}}" @if($ing->id == $component->component_id &&$component->component_type == 'Ingredient' ) selected @endif>
                                                                        {{ $ing->getTranslation('name', 'ar')}} / {{ $ing->getTranslation('name', 'en')}}  [{{$ing->unit_of_measurement->name}}]
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
                                                           --
                                                        </td>
                                                        <input type="hidden" value="2" name="comTyp[]" />
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



                                <div class="col-lg-6 show_final_price" style="display: block">
                                    <label>    رقم الطاولة</label>
                                    <input
                                        type="number"
                                        value="{{$order->table_number}}"
                                        name="table_number"
                                        class="form-control m-input"
                                        readonly
                                    />
                                </div>

                                <div class="col-lg-6 show_final_price" style="display: block">
                                    <label>   السعر النهائى</label>
                                    <input
                                        type="number"
                                        id="final_price"
                                        step="0.01"
                                        value="{{$order->total_amount}}"
                                        name="final_price"
                                        readonly
                                        class="form-control m-input final_price"
                                    />
                                </div>

                                <br>
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
                                <br>
                            </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- end page content -->
    <x-slot name="scripts">
        @include('Organization::pointOfSales.components.ingredients._script')
    </x-slot>
</x-organization::layout>
