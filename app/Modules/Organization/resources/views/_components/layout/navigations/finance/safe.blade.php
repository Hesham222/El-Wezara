<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            الخزنة
        </h4>

        <hr>

        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start emps Module -->

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialInventory-ShiftsReport'))
                <a href="{{ route('organizations.safe.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            تقارير الشيفتات</h5>
                    </center>
                </a>
            @endif


            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialInventory-SafesReceipt'))
                <a href="{{ route('organizations.safe.receiptsIndex') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            ايصالات الخزنة</h5>
                    </center>
                </a>
            @endif


            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialInventory-SafesBankSupply'))
                <a href="{{ route('organizations.safe.bankSupply') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            ايصالات التوريد للبنك</h5>
                    </center>
                </a>
            @endif


            <!--  End emps Module -->
        </div>
    </div>
</div>
