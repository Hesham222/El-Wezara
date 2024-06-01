<x-organization::layout>
    <x-slot name="pageTitle">الاوردارات  | اضف</x-slot name="pageTitle">
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
                            اضف
                        </h3>
                        <a href="{{route('organizations.pointOfSale.orders',$point_of_sale->id)}}" style="
    padding: 8px;
    margin-right: 996px;
" class="btn btn-primary">اذهب الى قائمة الاوردرات</a>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="table-responsive">
                    <section class="content">
                        @if(is_null($startShift))
                            <form method="POST" action="{{route('organizations.pointOfSale.start-shift')}}"
                                  class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                                @csrf
                                <h3>{{ $point_of_sale->name }}</h3>
                                <input type="hidden" name="point_of_sale" value="{{ $point_of_sale->id }}">
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-3">
                                            <label>رصيد الخزنة:</label>
                                            <input
                                                type="text"
                                                value="{{old('startBalance')}}"
                                                name="startBalance"
                                                required=""
                                                class="form-control m-input"
                                                placeholder="رصيد الخزنة..." />
                                            @error('startBalance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-3">
                                            <button type="submit" class="btn btn-primary">بداية الشيفت</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @else
                            @if($startShift != "gate")
                                <form method="POST" action="{{route('organizations.pointOfSale.end-shift')}}" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                                    @csrf
                                    <input type="hidden" name="shift" value="{{ $startShift->id }}">
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group row">
                                            <div class="col-lg-3">
                                                <label>رصيد الخزنة:</label>
                                                <input
                                                    type="text"
                                                    value="{{old('endBalance')}}"
                                                    name="endBalance"
                                                    required=""
                                                    class="form-control m-input"
                                                    placeholder="رصيد الخزنة..." />
                                                @error('endBalance')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3">
                                                <button type="submit" class="btn btn-primary">انهاء الشيفت</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endif
                            <form method="POST" action="{{route('organizations.pointOfSale.store.order')}}"
                                  class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="item-form">
                                @csrf

                                <input type="hidden" name="point_of_sale_id" value="{{$point_of_sale->id}}"/>
                                <input type="hidden" name="point_of_sale_order_sheet_id" value="{{$startShift->id}}"/>

                                @include('Organization::pointOfSales.components.ingredients.table')



                                <div class="col-lg-6 show_final_price" style="display: block">
                                    <label>    رقم الطاولة</label>
                                    <input
                                        type="number"
                                        value="{{old('table_number')}}"
                                        name="table_number"
                                        class="form-control m-input"
                                    />
                                </div>

                                <div class="col-lg-6 show_final_price" style="display: block">
                                    <label>   السعر النهائى</label>
                                    <input
                                        type="number"
                                        id="final_price"
                                        step="0.01"
                                        value="{{old('final_price')}}"
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
                        @endif
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
