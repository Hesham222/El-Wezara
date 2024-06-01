<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            انواع الموردين
        </h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- start vendors -->

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'VendorType-Add'))
                <a href="{{ route('organizations.vendorType.create') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-plus mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.addNew')
                        </h5>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'VendorType-View'))
                <a href="{{ route('organizations.vendorType.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'VendorType-Delete'))
                <a href="{{ route('organizations.vendorType.index') . '?view=trash' }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-trash mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.trash')
                        </h5>
                        <span class="m-badge m-badge--danger notification-icon">
                            0
                        </span>
                    </center>
                </a>
            @endif

            <!-- end vendors -->
        </div>
    </div>
</div>
