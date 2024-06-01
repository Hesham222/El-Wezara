
<x-organization::layout>
    @if(request()->input('view')=='trash')
        <x-slot name="pageTitle">@lang('Organization::organization.vendor') | @lang('Organization::organization.trash')</x-slot name="pageTitle">
        @section('vendor-trash-active', 'm-menu__item--active')
    @else
        <x-slot name="pageTitle">@lang('Organization::organization.vendor') | @lang('Organization::organization.view')</x-slot name="pageTitle">
        @section('vendor-view-active', 'm-menu__item--active')
    @endif
    @section('vendor-active', 'm-menu__item--active m-menu__item--open')
    @include('Organization::_modals.confirm_password')
    <x-slot name="style">
        <!-- Some styles -->
    </x-slot>


<div class="col-xl-12">
    <!--begin:: Widgets/Best Sellers-->
    <div class="m-portlet m-portlet--full-height ">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        عرض اذونات الخصم 
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
            </div>
        </div>
        <div class="m-portlet__body">
            <!--begin::Content-->
            <section class="content">
                <table class="table table-striped- table-bordered table-hover table-checkable"
                       id="vendors-pos-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>النوع</th>
                        <th>تاريخ الاذن</th>
                        <th>القائم بعمل الاذن</th>
                        <th>  القيمة المالية</th>
                        <th> اجراء</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($po->po_deductions as $deduction)
                        <tr id="tr-{{$deduction->id}}">
                            <td>{{ $deduction->id }}</td>
                           
                            <td>@if($deduction->type == 'val') Value @else Percentage    @endif</td>
                            <td>{{$deduction->created_at}}</td>
                            <td>{{$deduction->admin->name}}</td>
                            <td>{{$deduction->amount }} EGP</td>
                            <td> <a
                                href="{{route('organizations.vendor.delete.deduction',$deduction->id)}}"
                                title="عمل اذن خصم"
                                class="btn btn-sm btn-danger">
                                <i class="fa fa-trash" style="color: #fff"></i>
                            </a>

                

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </section>
            <!--end::Content-->
        </div>
    </div>
    <!--end:: Widgets/Best Sellers-->
</div>
   <!-- End page content -->
        <x-slot name="scripts">

            <!-- external JS -->
            <script type="text/javascript">
                $(document).ready(function () {
                    //call datatabel
                  //  dataTableInitlize('#vendors-sales-table');
                    dataTableInitlize('#vendors-pos-table');
                    dataTableInitlize('#vendors-payments-table');
                   // dataTableInitlize('#vendors-returns-table');
                });
            </script>
        </x-slot>
</x-organization::layout>
