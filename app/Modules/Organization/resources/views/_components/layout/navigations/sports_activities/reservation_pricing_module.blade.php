<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>تسعير الحجز الخارجي</h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start External reservation pricing Module -->

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'ReservationPricing-Add'))
                <a href="{{ route('organizations.externalPrice.create') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-plus mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            اضف جديد
                        </h5>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'ReservationPricing-View'))
                <a href="{{ route('organizations.externalPrice.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            عرض
                        </h5>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'ReservationPricing-Delete'))
                <a href="{{ route('organizations.externalPrice.index') . '?view=trash' }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-trash mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            سله المهملات
                        </h5>
                        <span class="m-badge m-badge--danger notification-icon">
                            {{ $externalPriceTrashesCount }}
                        </span>
                    </center>
                </a>
            @endif

            <!--  End External reservation pricing Module -->
        </div>
    </div>
</div>
