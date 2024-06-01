<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>انواع الحسابات

        </h4>

        <hr>

        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Account Types Module -->

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialAccountType-View'))
                <a href="{{ route('organizations.accountType.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif

            <!--  End Account Types Module -->
        </div>
    </div>
</div>
