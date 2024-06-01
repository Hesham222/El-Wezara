<x-organization::layout>
    @if(request()->input('view')=='trash')
        <x-slot name="pageTitle">المغاسل  | سله المهملات</x-slot name="pageTitle">
        @section('laundries-trash-active', 'm-menu__item--active')
    @else
        <x-slot name="pageTitle">المكونات | المكونات المصنعه</x-slot name="pageTitle">
            @section('ingredient-active', 'm-menu__item--active m-menu__item--open')
    @endif
        @section('ingredient-active', 'm-menu__item--active m-menu__item--open')
    @include('Organization::_modals.confirm_password')
    <x-slot name="style">
        <!-- Some styles -->
    </x-slot>
    <!-- Start page content -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    المكونات المصنعة من
                    {{$record->name}}
                </h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{request()->input('view')=='trash' ? 'سله المهملات' :  'عرض'}}
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{route('organizations.ingredient.add.manufactured',$record->id)}}" class="btn btn-primary">  اضافة مكون تصنيع </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">
                <section class="content">
                    <div class="table-responsive">
                        <section class="content table-responsive">
                            <table id="data-table" class="table table-striped- table-bordered table-hover table-checkable" >
                                <thead>
                                <tr>
                                    <th>التعريف</th>
                                    @if(request()->query('view')=='trash')
                                        <th>@lang('Organization::organization.deletedBy')</th>
                                        <th>@lang('Organization::organization.deletedAt')</th>
                                    @endif

                                    <th>@lang('Organization::organization.arabicName')</th>
                                    <th>@lang('Organization::organization.englishName')</th>
                                    <th>@lang('Organization::organization.englishDescription')</th>
                                    <th>@lang('Organization::organization.arabicDescription')</th>
                                    {{--                                    <th> إعادة كمية الطلب</th>--}}
                                    <th>فى المخزن</th>
                                    <th> الكمية ف المخزن مع تاريخ الصلاحية</th>
                                    <th>@lang('Organization::organization.quantity')</th>
                                    <th>@lang('Organization::organization.unit')</th>
                                    <th>@lang('Organization::organization.cost')</th>
                                    <th>التكلفة النهائية</th>
                                    <th>@lang('Organization::organization.final_price')</th>
                                    <th>@lang('Organization::organization.createdAt')</th>
{{--                                    <th>@lang('Organization::organization.actions')</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($record->manufactured))
                                    @foreach($record->manufactured as $manufactured)
                                        <tr>
                                            <td>{{$manufactured->id}}</td>
                                            @if(request()->query('view')=='trash')
                                                <td>{{$manufactured->deletedBy ? $manufactured->deletedBy->name : "NONE"}}</td>
                                                <td>{{ date('M d, Y', strtotime($manufactured->deleted_at)) .'-'.date('h:i a', strtotime($manufactured->deleted_at)) }}</td>
                                            @endif
                                            <td>{{$manufactured->getTranslation('name', 'ar')}}</td>
                                            <td>{{$manufactured->getTranslation('name', 'en')}}</td>

                                            <td>{{$manufactured->getTranslation('description', 'en')}}</td>
                                            <td>{{$manufactured->getTranslation('description', 'ar')}}</td>
                                            {{--            <td>{{$record->re_order_quantity}}</td>--}}
                                            <td>{{$manufactured->stock}}</td>
                                            <td>
                                                @if($manufactured->ingredient_quantities)

                                                    @foreach($manufactured->ingredient_quantities as $ingredient_quantity)
                                                        qty : {{$ingredient_quantity->quantity}} , exp date : {{$ingredient_quantity->expiration_date}}
                                                        <br>
                                                    @endforeach

                                                @else
                                                    --
                                                @endif

                                            </td>
                                            <td>{{$manufactured->quantity}}</td>
                                            <td>{{$manufactured->unit_of_measurement->name}}</td>
                                            <td>{{$manufactured->cost}}</td>
                                            <td>{{$manufactured->final_cost}}</td>
                                            <td>{{$manufactured->price}}</td>
                                            <td>{{ date('M d, Y', strtotime($manufactured->created_at)) .'-'.date('h:i a', strtotime($manufactured->created_at)) }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            <div id="paginationLinksContainer" style="display: flex;justify-content: center;align-items: center;margin-top: 10px"></div>
                            <div class="row">
                                <div class="col-lg-6">
                                </div>
                                <div class="col-lg-6 m--align-right">
                                    <a href="{{route('organizations.ingredient.index')}}" class="btn btn-sm btn-primary">
                                        العوده للمكونات الرئيسية
                                    </a>
                                </div>
                            </div>
                        </section>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- End page content -->
    <x-slot name="scripts">
    </x-slot>
</x-organization::layout>

