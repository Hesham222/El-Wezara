<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>نقطة البيع
        </h4>

        <hr>

        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">

            <!-- Start Pos  Module -->

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'PointOfSale-Add'))
                <a href="{{ route('organizations.pointOfSale.create') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-plus mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.addNew')
                        </h5>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'PointOfSale-View'))
                <a href="{{ route('organizations.pointOfSale.index') . '?view=view' }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'PointOfSale-View-Retrieval-Orders'))
                <a href="{{ route('organizations.pointOfSale.get.retrieval.orders') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">عرض طلبات الارجاع
                        </h5>
                    </center>
                </a>
            @endif


            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'PointOfSale-Delete'))
                <a href="{{ route('organizations.pointOfSale.index') . '?view=trash' }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-trash mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.trash')
                        </h5>
                        <span class="m-badge m-badge--danger notification-icon">
                            {{ $PointOfSaleTrashesCount }}
                        </span>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'PointOfSale-View-ShiftDetails'))
                <a href="{{ route('organizations.pointOfSaleShiftSheet.index') . '?view=view' }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">تفاصيل الشيفتات
                        </h5>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'PointOfSale-View-All-Orders'))
                <a href="{{ route('organizations.pointOfSale.all.orders') . '?view=view' }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4"> كل اوردرات نقاط البيع
                        </h5>
                    </center>
                </a>
            @endif


            <!--  End Pos  Module -->
        </div>
    </div>
</div>
