<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            طلبات </h4>

        <hr>

        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Laundry Order Categories Module -->

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'LaundryOrder-Add'))
                <a href="{{ route('organizations.laundryOrder.create') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-plus mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.addNew')
                        </h5>
                    </center>
                </a>
            @endif
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'LaundryOrder-View'))
                <a href="{{ route('organizations.laundryOrder.index') . '?view=view' }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif
{{--            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),--}}
{{--                'LaundryOrder-Add-ReturnOrder'))--}}
{{--                <a href="{{ route('organizations.returnLaundryOrder.create') }}" class="menu_box">--}}
{{--                    <center>--}}
{{--                        <i class="fa fa-4x fa-plus mt-4"></i>--}}
{{--                        <h5 class="m-portlet__head-text mt-4">--}}
{{--                            اعاده طلب--}}
{{--                        </h5>--}}
{{--                    </center>--}}
{{--                </a>--}}
{{--            @endif--}}
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'LaundryOrder-Add-ReturnOrder'))
                <a href="{{ route('organizations.returnLaundryOrder.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            عرض المرتجعات
                        </h5>
                    </center>
                </a>
            @endif
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'LaundryOrder-Delete'))
                <a href="{{ route('organizations.laundryOrder.index') . '?view=trash' }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-trash mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.trash')
                        </h5>
                        <span class="m-badge m-badge--danger notification-icon">
                            {{ $laundryOrdersTrashesCount }}
                        </span>
                    </center>
                </a>
            @endif


        </div>
    </div>
</div>
