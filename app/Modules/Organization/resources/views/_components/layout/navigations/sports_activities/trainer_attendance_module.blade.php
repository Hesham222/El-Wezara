<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>تأكيد الحضور للمدربين</h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'TrainerAttendance-View-TodayTrainings'))
                <a href="{{ route('organizations.trainerAttendance.create') }}"class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            تدريبات اليوم </h5>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'TrainerAttendance-View'))
                <a href="{{ route('organizations.trainerAttendance.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            عرض
                        </h5>
                    </center>
                </a>
            @endif

            <!--  End Trainer Attendance Module -->
        </div>
    </div>
</div>
