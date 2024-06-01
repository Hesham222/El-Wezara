<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4> التقارير </h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Club Reports Module -->

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Report-View-DailyVisitors'))
                <a href="{{ route('organizations.clubReport.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            الزوار اليومي
                        </h5>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Report-View-DailyTrainers'))
                <a href="{{ route('organizations.trainerReport.index') . '?view=view' }}"class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            المدربين اليومي
                        </h5>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Report-View-DailyTrainings'))
                <a href="{{ route('organizations.trainingReport.index') . '?view=view' }}"class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            التدريب اليومي
                        </h5>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Report-View-SubscriberBalances'))
                <a href="{{ route('organizations.subscriberBalance.index') . '?view=view' }}"class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            أرصدة المشتركين المتبقية
                        </h5>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Report-View-Payment'))
                <a href="{{ route('organizations.paymentReport.index') . '?view=view' }}"class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            عمليات الدفع
                        </h5>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Report-View-RevenueSport'))
                <a href="{{ route('organizations.revenueSport.index') . '?view=view' }}"class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            الإيرادات لجميع الألعاب الرياضية

                        </h5>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Report-View-Areas'))
                <a href="{{ route('organizations.areaReport.index') . '?view=view' }}"class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            المناطق

                        </h5>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Report-View-TrainerAttend'))
                <a href="{{ route('organizations.trainerAttend.index') . '?view=view' }}"class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            الحضور للمدربين

                        </h5>
                    </center>
                </a>
            @endif

            <!--  End Club Reports Module -->
        </div>
    </div>
</div>
