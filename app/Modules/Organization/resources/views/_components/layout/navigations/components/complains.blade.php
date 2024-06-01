<!-- Start  customer Types Module -->
<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4> الشكاوى</h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">

            <!-- Start  customer complain Module -->

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Complain-Add'))
                <a href="{{ route('organizations.complain.create') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-plus mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            اضف جديد
                        </h5>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Complain-View'))
                <a href="{{ route('organizations.complain.index') . '?view=view' }}"class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            عرض </h5>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Complain-Delete'))
                <a href="{{ route('organizations.complain.index') . '?view=trash' }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-trash mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            سله المهملات
                        </h5>
                        <span class="m-badge m-badge--danger notification-icon">
                            {{ $complainTrashesCount }}
                        </span>
                    </center>
                </a>
            @endif


        </div>
    </div>
</div>
