<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            الفنادق
        </h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Hotels Module -->

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Hotel-Add'))
                <a href="{{ route('organizations.hotel.create') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-plus mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.addNew')
                        </h5>
                    </center>
                </a>
            @endif
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Hotel-View'))
                <a href="{{ route('organizations.hotel.index') . '?view=view' }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Hotel-Delete'))
                <a href="{{ route('organizations.hotel.index') . '?view=trash' }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-trash mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.trash')
                        </h5>
                        <span class="m-badge m-badge--danger notification-icon">
                            {{ $hotelTrashesCount }}
                        </span>
                    </center>
                </a>
            @endif

            <!--  End Hotels Module -->
        </div>
    </div>
</div>
