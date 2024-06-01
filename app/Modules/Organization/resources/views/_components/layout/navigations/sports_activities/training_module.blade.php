<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>التدريبات </h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">

            <!-- Start  Trainings Module -->

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Training-Add'))
                <a href="{{ route('organizations.training.create') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-plus mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            اضف جديد
                        </h5>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Training-View'))
                <a href="{{ route('organizations.training.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            عرض
                        </h5>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Training-Delete'))
                <a href="{{ route('organizations.training.index') . '?view=trash' }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-trash mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            سله المهملات
                        </h5>
                        <span class="m-badge m-badge--danger notification-icon">
                            {{ $trainingTrashesCount }}
                        </span>
                    </center>
                </a>
            @endif

            <!--  End Trainings Module -->

        </div>
    </div>
</div>
