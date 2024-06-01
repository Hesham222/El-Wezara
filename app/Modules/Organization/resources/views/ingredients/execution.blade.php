<x-organization::layout>
    @if(request()->input('view')=='trash')
        <x-slot name="pageTitle">@lang('Organization::organization.ingredients') | @lang('Organization::organization.trash')</x-slot name="pageTitle">
        @section('ingredient-trash-active', 'm-menu__item--active')
    @else
        <x-slot name="pageTitle">@lang('Organization::organization.ingredients') | @lang('Organization::organization.view')</x-slot name="pageTitle">
        @section('ingredient-view-active', 'm-menu__item--active')
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
                    الكميات الجاهزة للاعدام
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
                                    <th>الكميه</th>
                                    <th>تاريخ الصلاحية</th>
                                    <th>نشأ في</th>
                                    <th> اعدام</th>
                                </tr>
                                </thead>
                                <tbody>
                            
                                    @foreach($ing->ingredient_execution_quantities as $ingredient_quantity)
                                        <tr>
                                            <td>{{$ingredient_quantity->id}}</td>
                                            <td>{{$ingredient_quantity->quantity}}</td>
                                            <td>{{$ingredient_quantity->expiration_date}}</td>
                                            <td>{{$ingredient_quantity->created_at}}</td>
                                            <td>
                                                <a
                                                href="{{route('organizations.ingredient.execIng',$ingredient_quantity->id)}}"
                                                title="execution"
                                                class="btn btn-sm btn-primary">
                                                <i class="fa fa-trash" style="color: #fff"></i>
                                            </a>
                                            </td>
                                        </tr>
                                    @endforeach
                              
                                </tbody>
                            </table>
                           
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

