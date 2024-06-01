@if(checkAdminSideBarFinance(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray()))

    <li class="m-menu__item  m-menu__item--submenu @yield('nav-finance-active')" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a href="{{ route('organizations.navigations.finance') }}" class="m-menu__link m-menu__toggle">
        <i class=" m-menu__link-icon fa fa-usd">
            <span> </span>
        </i>
        <span class="m-menu__link-text">خدمات المالية
        </span>
    </a>
</li>


{{-- above will be in the page --}}
@if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
    'FinancialBalanceSheet-View'))
    <!-- Start Balance Sheet Journal Module -->
    <li class="m-menu__item  m-menu__item @yield('balanceSheets-active')" aria-haspopup="true">
        <a href="{{ route('organizations.balanceSheet.index') }}" class="m-menu__link ">
            <i class="m-menu__link-icon fa fa-balance-scale">
            </i>
            <span class="m-menu__link-title">
                <span class="m-menu__link-wrap">
                    <span class="m-menu__link-text"> ميزان المراجعة
                    </span>
                </span>
            </span>
        </a>
    </li>
    <!--  End Balance Sheet Journal Module -->
@endif
@if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
    'FinancialDailyCenter-View'))
    <li class="m-menu__item  m-menu__item @yield('dailyCenters-active')" aria-haspopup="true">
        <a href="{{ route('organizations.dailyCenter.index') }}" class="m-menu__link ">
            <i class="m-menu__link-icon fa fa-table">
            </i>
            <span class="m-menu__link-title">
                <span class="m-menu__link-wrap">
                    <span class="m-menu__link-text">اليومية المركزية
                    </span>
                </span>
            </span>
        </a>
    </li>
@endif
@if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
    'FinancialIncomeStatement-View'))
    <li class="m-menu__item  m-menu__item @yield('incomeStatement-active')" aria-haspopup="true">
        <a href="{{ route('organizations.incomeStatement.index') }}" class="m-menu__link ">
            <i class="m-menu__link-icon fa fa-address-card">
            </i>
            <span class="m-menu__link-title">
                <span class="m-menu__link-wrap">
                    <span class="m-menu__link-text">قوائم الدخل
                    </span>
                </span>
            </span>
        </a>
    </li>
@endif
@if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
    'FinancialStatement-View'))
    <li class="m-menu__item  m-menu__item @yield('financialStatement-active')" aria-haspopup="true">
        <a href="{{ route('organizations.financialStatement.index') }}" class="m-menu__link ">
            <i class="m-menu__link-icon fa fa-list-alt">
            </i>
            <span class="m-menu__link-title">
                <span class="m-menu__link-wrap">
                    <span class="m-menu__link-text">قائمة المركز المالي
                    </span>
                </span>
            </span>
        </a>
    </li>
@endif
@if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
    'FinancialDepreciation-View'))
    <li class="m-menu__item  m-menu__item @yield('depreciation-active')" aria-haspopup="true">
        <a href="{{ route('organizations.depreciation.index') }}" class="m-menu__link ">
            <i class="m-menu__link-icon fa fa-recycle">
            </i>
            <span class="m-menu__link-title">
                <span class="m-menu__link-wrap">
                    <span class="m-menu__link-text">كشف الإهلاك
                    </span>
                </span>
            </span>
        </a>
    </li>
@endif
@endif
