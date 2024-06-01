<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            المستأجرين
        </h4>

        <hr>

        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">

            <!-- Start Tenants Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Tenant-Add'))
                <a href="{{ route('organizations.tenant.create') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-plus mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.addNew')
                        </h5>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Tenant-View'))
                <a href="{{ route('organizations.tenant.index') . '?view=view' }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Tenant-Delete'))
                <a href="{{ route('organizations.tenant.index') . '?view=trash' }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-trash mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.trash')
                        </h5>
                        <span class="m-badge m-badge--danger notification-icon">
                            {{ $tenantTrashesCount }}
                        </span>
                    </center>
                </a>
            @endif

            <!-- End Tenants Module -->
        </div>
    </div>
</div>
