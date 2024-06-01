<!-- Start  customer Types Module -->
<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>رياضات النادى</h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">



            <!-- Start Club Sports Module -->

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'ClubSport-Add'))
                <a href="{{ route('organizations.clubSport.create') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-plus mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            اضف جديد
                        </h5>
                    </center>
                </a>
            @endif
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'ClubSport-View'))
                <a href="{{ route('organizations.clubSport.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            عرض
                        </h5>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'ClubSport-Delete'))
                <a href="{{ route('organizations.clubSport.index') . '?view=trash' }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-trash mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            سله المهملات
                        </h5>
                        <span class="m-badge m-badge--danger notification-icon">
                            {{ $clubSportTrashesCount }}
                        </span>
                    </center>
                </a>
            @endif

            <!--  End Club Sports Module -->

        </div>
    </div>
</div>
