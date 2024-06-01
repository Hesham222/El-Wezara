<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            مرتبات الموظفين
        </h4>

        <hr>

        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start emps salary Module -->

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialEmployeeSalary-View-Nomination'))
                <a href="{{ route('organizations.financial/employee.nomination.salaries') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            المعينين
                        </h5>
                    </center>
                </a>
            @endif
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialEmployeeSalary-View-TheInsured'))
                <a href="{{ route('organizations.financial/employee.TheInsured.salaries') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            المؤمن عليهم
                        </h5>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialEmployeeSalary-View-TheInsured'))
                <a href="{{ route('organizations.financial/employee.temporary.salaries') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            المؤقتين
                        </h5>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialEmployeeSalary-View-Officer'))
                <a href="{{ route('organizations.financial/employee.officer.salaries') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            بدل التمثيل للسادة الظباط </h5>
                    </center>
                </a>
            @endif


            <!--  End emps salary Module -->
        </div>
    </div>
</div>
