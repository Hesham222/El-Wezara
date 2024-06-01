<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>القاعات
        </h4>

        <hr>

        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- start hall -->

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Hall-Add'))
                <a href="{{ route('organizations.hall.create') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-plus mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.addNew')
                        </h5>
                    </center>
                </a>
            @endif
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Hall-View'))
                <a href="{{ route('organizations.hall.index') . '?view=view' }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Hall-Delete'))
                <a href="{{ route('organizations.hall.index') . '?view=trash' }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-trash mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.trash')
                        </h5>
                        <span class="m-badge m-badge--danger notification-icon">
                            {{ $hallTrashesCount }}
                        </span>
                    </center>
                </a>
            @endif

            <!-- end hall -->
        </div>
    </div>
</div>
