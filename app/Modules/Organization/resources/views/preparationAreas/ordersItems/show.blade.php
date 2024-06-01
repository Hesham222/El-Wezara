<x-organization::layout>
    <x-slot name="pageTitle">Details @lang('Organization::organization.items') | @lang('Organization::organization.view')</x-slot name="pageTitle">

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
                 تفاصيل المنتج
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

                                            <h2>
                                                @if($order_item->component_type == 'Item')
                                                    {{$order_item->item->name}}
                                                @else
                                                    {{$order_item->item_variant->name}}
                                                @endif

                                            </h2>
                                            <table class="table table-striped- table-bordered table-hover table-checkable"
                                                   id="cities-table">
                                                <thead>
                                                <tr>

                                                    <th>
                                                       التفاصيل
                                                    </th>


                                                </tr>
                                                </thead>
                                                <tbody>

                                                <tr>

                                                    @if($order_item->component_type == 'Item')
                                                        <td>
                                                            <h5>Ingredients : </h5>

                                                            @foreach($order_item->item->components as $component)


                                                                <br>
                                                                <ul>
                                                                    @if($component->component_type == 'Ingredient')
                                                                        <li>{{$component->ingredent->getTranslation('name', 'en')}}
                                                                            <br>
                                                                            الكمية المطلوبة  : {{$component->quantity *$component->ingredent->quantity }} [{{$component->ingredent->unit_of_measurement->name}}]
                                                                            <br>

                                                                            </li>
                                                                    @endif

                                                                </ul>
                                                            @endforeach
                                                            <h5>Items : </h5>
                                                            @foreach($order_item->item->components as $component)

                                                                <br>
                                                                <ul>
                                                                    @if($component->component_type == 'Item')
                                                                        <li>{{$component->item->getTranslation('name', 'en')}}
                                                                            <br>
                                                                            الكمية المطلوبة  : {{$component->quantity}}
                                                                            <br>
                                                                        </li>                                                                    @endif
                                                                </ul>
                                                            @endforeach

                                                            <h5>Item Variants : </h5>
                                                            @foreach($order_item->item->components as $component)

                                                                <br>
                                                                <ul>
                                                                    @if($component->component_type == 'Item Variant')
                                                                        <li>{{$component->item_variant->getTranslation('name', 'en')}}
                                                                            <br>
                                                                            الكمية المطلوبة  : {{$component->quantity}}
                                                                            <br>
                                                                        </li>                                                                    @endif
                                                                </ul>
                                                            @endforeach

                                                        </td>
                                                    @elseif($order_item->component_type == 'Item Variant')
                                                    <td>
                                                        <h5>Ingredients : </h5>

                                                        @foreach($order_item->item_variant->components as $component)


                                                            <br>
                                                            <ul>
                                                                @if($component->component_type == 'Ingredient')
                                                                    <li>{{$component->ingredent->getTranslation('name', 'en')}}
                                                                        <br>
                                                                        الكمية المطلوبة  : {{$component->quantity * $component->ingredent->quantity}} [{{$component->ingredent->unit_of_measurement->name}}]
                                                                        <br>
                                                                    </li>                                                                @endif

                                                            </ul>
                                                        @endforeach
                                                        <h5>Items : </h5>
                                                        @foreach($order_item->item_variant->components as $component)

                                                            <br>
                                                            <ul>
                                                                @if($component->component_type == 'Item')
                                                                    <li>{{$component->item->getTranslation('name', 'en')}}
                                                                        <br>
                                                                        الكمية المطلوبة  : {{$component->quantity}}
                                                                        <br>
                                                                    </li>                                                                @endif
                                                            </ul>
                                                        @endforeach

                                                        <h5>Item Variants : </h5>
                                                        @foreach($order_item->item_variant->components as $component)

                                                            <br>
                                                            <ul>
                                                                @if($component->component_type == 'Item Variant')
                                                                    <li>{{$component->item_variant->getTranslation('name', 'en')}}
                                                                        <br>
                                                                        الكمية المطلوبة  : {{$component->quantity}}
                                                                        <br>
                                                                    </li>                                                                @endif
                                                            </ul>
                                                        @endforeach

                                                    </td>
                                                        @endif


                                                </tr>

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
