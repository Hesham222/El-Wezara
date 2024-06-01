<x-organization::layout>
    <x-slot name="pageTitle">كشف الإهلاك عن فترة | عرض</x-slot name="pageTitle">
    @section('depreciation-active', 'm-menu__item--active m-menu__item--open')
    <x-slot name="style">
        <!-- Some styles -->
    </x-slot>
    <!-- Start page content -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    كشف الإهلاك عن فترة
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
            </div>
            <div class="m-portlet__body">
                <div class="table-responsive">
                    <section class="content table-responsive">
                        <h5>كشف الإهلاك عن فترة</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="data-table" class="table table-striped- table-bordered table-hover table-checkable" >
                                    <thead>
                                    <tr>
                                        <th style="font-weight: bold"></th>
                                        <th style="font-weight: bold">قيمة الأصول</th>
                                        <th style="font-weight: bold">الاضافات</th>
                                        <th style="font-weight: bold">إجمالي الأصول</th>
                                        <th style="font-weight: bold">اهلاك الاصل</th>
                                        <th style="font-weight: bold">إهلاك الاضافات</th>
                                        <th style="font-weight: bold">إجمالي الاهلاك</th>
                                        <th style="font-weight: bold">مجمع الاهلاك</th>
                                        <th style="font-weight: bold">إجمالي مجمع الاهلاك</th>
                                        <th style="font-weight: bold">صافى الاصول الثابتة</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($assetCategories as $assetCategory)
                                        <tr>
                                            <td>{{ $assetCategory->name }}</td>
                                            <td>{{$assetCategory->currentValueAmount->where('created_at','<',\Carbon\Carbon::today())->sum('current_value')}}</td>
                                            <td>{{$assetCategory->currentValueAmount->where('created_at',\Carbon\Carbon::today())->sum('current_value')}}</td>
                                            <td>{{ $assetCategory->currentValueAmount->where('created_at','<',\Carbon\Carbon::today())->sum('current_value') + $assetCategory->currentValueAmount->where('created_at',\Carbon\Carbon::today())->sum('current_value') }}</td>
                                            <td>{{ $assetCategory->currentValueAmount->where('created_at','<',\Carbon\Carbon::today())->sum('current_value') * ($assetCategory->percentage / 100)}}</td>
                                            <td>{{ $assetCategory->currentValueAmount->where('created_at',\Carbon\Carbon::today())->sum('current_value') * ($assetCategory->percentage/100) }}</td>
                                            <td>{{ $assetCategory->currentValueAmount->where('created_at','<',\Carbon\Carbon::today())->sum('current_value') * ($assetCategory->percentage/100) +  $assetCategory->currentValueAmount->where('created_at',\Carbon\Carbon::today())->sum('current_value') * ($assetCategory->percentage/100)}}</td>
                                            <td>--</td>
                                            <td>--</td>
                                            <td>--</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tbody id="data-table-body"></tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="scripts">
    </x-slot>
</x-organization::layout>

