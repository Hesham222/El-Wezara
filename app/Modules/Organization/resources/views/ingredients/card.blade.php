<x-organization::layout>
    @if(request()->input('view')=='trash')
        <x-slot name="pageTitle">المغاسل  | سله المهملات</x-slot name="pageTitle">
        @section('laundries-trash-active', 'm-menu__item--active')
    @else
        <x-slot name="pageTitle">كارت الصنف </x-slot name="pageTitle">
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
                    كارت صنف   
                    {{$ing->name}}
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
                   <a href="{{ route('organizations.ingredient.exportCard',$ing->id) }}" class="btn btn-primary"><i class="fa fa-file"></i></a>
                </div>
            </div>
            <div class="m-portlet__body">
                <section class="content">
                    <div class="table-responsive">
                        <section class="content table-responsive">
                            <table id="data-table" class="table table-striped- table-bordered table-hover table-checkable" >
                                <thead>
                                <tr>
                                   
                                  

                                    <th>اسم الصنف</th>
                                    <th>رقم الصنف</th>
                                    <th>الحد الادنى </th>
                                    <th>الحد الاعلى</th>
                                    <th> الوحده</th>
                                    <th> وارد</th>
                                    <th>      منصرف</th>
                                    <th>رصيد</th>
                                    <th>تاريخ التواجد</th>
                                 
                                </tr>
                                </thead>
                                <tbody>
                              
                                        <tr>
                                
                                            <td>{{$ing->name}}</td>
                                            <td>{{$ing->id}}</td>
                                            <td>{{$ing->re_order_quantity}}</td>
                                            <td>{{$ing->stock}}</td>
                                            <td>{{$ing->unit_of_measurement->name}}</td>
                                            <td>{{$ing->imports()}}</td>
                                            <td>{{$ing->exports()}}</td>
                                            <td>{{$ing->final_cost * $ing->stock }}</td>
                                            <td>{{ date('M d, Y', strtotime($ing->created_at)) .'-'.date('h:i a', strtotime($ing->created_at)) }}</td>
                                        </tr>
                               
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