<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>مخازن نقط البيع

        </h4>

        <hr>

        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Pos Inventory Module -->

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'PointOfSaleInventory-View'))
                <a href="{{ route('organizations.PointOfSaleInventory.index') . '?view=view' }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif

            <!--  End Pos Inventory Module -->
        </div>
    </div>
</div>
