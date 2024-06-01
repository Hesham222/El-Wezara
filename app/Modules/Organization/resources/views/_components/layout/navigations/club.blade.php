{{-- @yield('components-active', 'm-menu__item--active') --}}
@section('nav-club-active', 'm-menu__item--active m-menu__item--open')

<x-organization::layout>
    <x-slot name="pageTitle">Navigation
        | Club</x-slot name="pageTitle">
    @section('components-active', 'm-menu__item--active m-menu__item--open')

    <x-slot name="style">
        <style type="text/css">
            .mt-4 {
                margin-top: 1.5rem !important;
            }

            .flex-wrap {
                flex-wrap: wrap !important;
            }

            .mb-3,
            .my-3 {
                margin-bottom: 1rem !important;
            }

            .flex-row {
                -webkit-box-orient: horizontal !important;
                -webkit-box-direction: normal !important;
                flex-direction: row !important;
            }

            .menu_box {
                background-color: #f7f7f7;
                border-radius: 5px;
                border: 1px solid #ececec;
                padding: 3px;
                height: 150px;
                width: 150px;
                margin-right: 15px;
                margin-top: 15px;
                text-decoration: none;
                color: #1f282d;
                transition: all 0.3s ease;
                position: relative;
            }

            .menu_box:hover {
                text-decoration: none;
                color: #F7F7F7;
                background-color: #1F282D;
                transition: all 0.3s ease;
                border: 1px solid #1F282D;
            }

            h5 {
                margin-bottom: .5rem;
                font-family: inherit;
                font-weight: 500;
                line-height: 1.2;
                color: inherit;
            }

            h5,
            .h5 {
                font-size: 1.25rem;
            }

            .fa-4x {
                font-size: 4em !important;
            }

            ::before,
            ::after {
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
            }

            .notification-icon {
                position: absolute;
                top: -0.1px;
                right: -0.1px;
            }
        </style>
    </x-slot>

    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-content">
            <!--Begin::Section Products-->

            <h3>خدمات النادي</h3> <a target="_blank" href="{{route('organizations.navigations.inventoryVideo')}}" class="btn btn-primary" title="اعرف المزيد عن خدمات المخازن">?</a>
            <a target="_blank" href="{{route('organizations.navigations.posVideo')}}" class="btn btn-primary" title="اعرف المزيد عن POS">?</a>
            <br>
            <hr>



            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Unit-Module'))
                @include('Organization::_components.layout.navigations.club.unit')
            @endif
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'IngredientCategory-Module'))
            @include('Organization::_components.layout.navigations.club.ingredient_categories')
            @endif
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Ingredient-Module'))
                @include('Organization::_components.layout.navigations.club.ingredient')
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Item-Module'))
                @include('Organization::_components.layout.navigations.club.item')
            @endif


            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'MenuCategory-Module'))
                @include('Organization::_components.layout.navigations.club.menu_category')
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'PreparationArea-Module'))
                @include('Organization::_components.layout.navigations.club.preparation_area')
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'PreparationAreaOrder-Module'))
                @include('Organization::_components.layout.navigations.club.preparation_area_order')
            @endif


            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'PreparationAreaInventory-Module'))
                @include('Organization::_components.layout.navigations.club.preparation_area_inventory')
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'PointOfSale-Module'))
                @include('Organization::_components.layout.navigations.club.point_of_sale')
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'PointOfSaleOrder-Module'))
                @include('Organization::_components.layout.navigations.club.point_of_sale_order')
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'PointOfSaleInventory-Module'))
                @include('Organization::_components.layout.navigations.club.point_of_sale_inventory')
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'AssetCategory-Module'))
                @include('Organization::_components.layout.navigations.club.asset_category')
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'AssetProduct-Module'))
                @include('Organization::_components.layout.navigations.club.asset_product')
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'SubAssetProduct-Module'))
                @include('Organization::_components.layout.navigations.club.subasset_product')
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'QrMenu-Module'))
                @include('Organization::_components.layout.navigations.club.qr_menu')
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'EmployeeFinancialReport-Module'))
                @include('Organization::_components.layout.navigations.club.employee_financial_report')
            @endif
        </div>
    </div>


    <x-slot name="scripts"></x-slot>
</x-organization::layout>
