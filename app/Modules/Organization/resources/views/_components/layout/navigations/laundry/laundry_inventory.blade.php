<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            المخازن
        </h4>

        <hr>

        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Inventory Module -->

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'LaundryInventory-View'))
                <a href="{{ route('organizations.laundryInventory.index') . '?view=view' }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif

            <!--  End Inventory Module -->
        </div>
    </div>
</div>
