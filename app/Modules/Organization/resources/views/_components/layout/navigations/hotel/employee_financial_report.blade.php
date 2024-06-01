<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            الاشعارات
        </h4>

        <hr>

        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- start employeeDeduction -->

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Hotel-notifications'))
                <a href="{{ route('organizations.hotel.notification') . '?view=view' }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif

            <!-- end employeeDeduction -->
        </div>
    </div>
</div>
