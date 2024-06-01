<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>زوار اليوم
        </h4>

        <hr>

        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'GateReport-View-RentalVisitors'))
                <a href="{{ route('organizations.todayVisitor.rent-index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            زوار الايجارات
                        </h5>
                    </center>
                </a>
            @endif
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'GateReport-View-HotelVisitors'))
                <a href="{{ route('organizations.todayVisitor.hotel-index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            زوار الفندق
                        </h5>
                    </center>
                </a>
            @endif
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'GateReport-View-InventoryVisitors'))
                <a href="{{ route('organizations.todayVisitor.inventory-index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            زوار المخازن
                        </h5>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'GateReport-View-EventsVisitors'))
                <a href="{{ route('organizations.todayVisitor.event-index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            زوار المناسبات
                        </h5>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'GateReport-View-SportVisitors'))
                <a href="{{ route('organizations.todayVisitor.sport-index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">زوار الأنشطة الرياضية
                        </h5>
                    </center>
                </a>
            @endif

        </div>
    </div>
</div>
