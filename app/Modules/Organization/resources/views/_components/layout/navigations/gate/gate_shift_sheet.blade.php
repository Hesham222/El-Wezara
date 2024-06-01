<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>تقارير البوابات
        </h4>

        <hr>

        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Gate Shift Sheets Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'GateShiftSheet-View'))
                {{-- <li class="m-menu__item  m-menu__item @yield('gate-shift-sheet-active')" aria-haspopup="true">
                    <a href="{{ route('organizations.gateShiftSheet.index') }}" class="m-menu__link ">

                        </i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text" </span>
                                </span>
                            </span>
                    </a>
                </li> --}}

                <a href="{{ route('organizations.gateShiftSheet.index') . '?view=view' }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>

                <!-- End Gate Shift Sheets Module -->
            @endif
        </div>
    </div>
</div>
