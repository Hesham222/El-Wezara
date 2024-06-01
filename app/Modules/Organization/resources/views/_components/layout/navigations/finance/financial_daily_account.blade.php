<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>سجل قيود اليومية

        </h4>

        <hr>

        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Daily Account entries Module -->

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialDailyAccount-View-NotMigrated'))
                <a href="{{ route('organizations.dailyAccount.create') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            سجل قيود اليوم - لم يتم ترحيلها
                        </h5>
                    </center>
                </a>
            @endif
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialDailyAccount-View-Migrated'))
                <a href="{{ route('organizations.dailyAccount.index') . '?view=view' }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">سجل قيود - المرحله
                        </h5>
                    </center>
                </a>
            @endif

            <!--  End Daily Account entries Module -->
        </div>
    </div>
</div>
