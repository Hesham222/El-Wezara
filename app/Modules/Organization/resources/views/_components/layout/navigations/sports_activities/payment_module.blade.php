<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>المدفوعات </h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Payments Module -->

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Payment-Add'))
                <a href="{{ route('organizations.payment.create') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-plus mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            اضف جديد
                        </h5>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Payment-View'))
                <a href="{{ route('organizations.payment.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            عرض
                        </h5>
                    </center>
                </a>
            @endif

        </div>
    </div>
</div>
