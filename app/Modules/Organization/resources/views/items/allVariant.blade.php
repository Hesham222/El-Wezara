<x-organization::layout>
    <x-slot name="pageTitle">@lang('Organization::organization.variant') @lang('Organization::organization.items') | @lang('Organization::organization.view')</x-slot name="pageTitle">
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
                            @lang('Organization::organization.for') @lang('Organization::organization.variant')  : {{$item->name}}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="table-responsive">
                    <div class="m-content">
                        <!--Begin::Section-->
                        <div class="row">
                            <div class="col-xl-12">
                                <!--begin:: Widgets/Best Sellers-->
                                <div class="m-portlet m-portlet--full-height ">
                                    <div class="m-portlet__head">

                                    </div>
                                    <div class="m-portlet__body">
                                        <!--begin::Content-->
                                        <section class="content table-responsive">
                                            <table class="table table-striped- table-bordered table-hover table-checkable"
                                                   id="cities-table">
                                                <thead>
                                                <tr>
                                                    <th>@lang('Organization::organization.arabicName')</th>
                                                    <th>@lang('Organization::organization.englishName')</th>

                                                    <th>@lang('Organization::organization.englishDescription')</th>
                                                    <th>@lang('Organization::organization.arabicDescription')</th>
                                                                                                   <th>Cost</th>
                                                    <th>@lang('Organization::organization.price')</th>
                                                    <th>@lang('Organization::organization.createdAt')</th>
                                                    <th>@lang('Organization::organization.actions')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach( $item->variants as $variant)
                                                    <tr id="tr-{{$variant->id}}">
                                                        <td><a title="Show Details" href="{{route('organizations.item.showVariantDetail',$variant->id)}}">{{$variant->getTranslation('name', 'ar')}}</a></td>

                                                        <td><a title="Show Details" href="{{route('organizations.item.showVariantDetail',$variant->id)}}">{{$variant->getTranslation('name', 'en')}}</a></td>
                                                        <td>{{$variant->getTranslation('description', 'en')}}</td>
                                                        <td>{{$variant->getTranslation('description', 'ar')}}</td>

                                                        <td>{{$variant->cost}}</td>
                                                        <td>{{$variant->price}}</td>
                                                        <td>{{$variant->created_at}}</td>
                                                        <td>
                                                            <a href="{{route('organizations.item.delete.variant',$variant->id)}}" title="Delete"
                                                               class="btn btn-sm btn-danger"><i class="fa fa-trash"
                                                                                                 style="color: #fff"></i></a>
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
                        </div>
                        <!--End::Section-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end page content -->
    <x-slot name="scripts">
        <!-- Some JS -->
        <script type="text/javascript">
            $(document).ready(function () {
                $("#cities-table").dataTable();
            });
        </script>
    </x-slot>

</x-organization::layout>
