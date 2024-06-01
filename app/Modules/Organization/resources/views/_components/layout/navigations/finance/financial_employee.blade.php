<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            الموظفين
        </h4>

        <hr>

        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start emps Module -->

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialEmployee-View-Nomination'))
                <a href="{{ route('organizations.financial/employee.nomination') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            المعينين </h5>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialEmployee-View-TheInsured'))
                <a href="{{ route('organizations.financial/employee.TheInsured') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            المؤمن عليهم </h5>
                    </center>
                </a>
            @endif
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialEmployee-View-Temporary'))
                <a href="{{ route('organizations.financial/employee.temporary') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            المؤقتين</h5>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialEmployee-View-Officer'))
                <a href="{{ route('organizations.financial/employee.officer') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            الظباط</h5>
                    </center>
                </a>
            @endif


            <!--  End emps Module -->
        </div>
    </div>
</div>
