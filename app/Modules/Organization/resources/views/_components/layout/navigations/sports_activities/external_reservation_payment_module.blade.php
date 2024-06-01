<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>مدفوعات الحجوزات الخارجيه</h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start External reservation Payment Module -->

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'ExternalReservationPayment-Add'))
                <a href="{{ route('organizations.external_payment.create') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-plus mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            اضف جديد
                        </h5>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'ExternalReservationPayment-View'))
                <a href="{{ route('organizations.external_payment.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            عرض
                        </h5>
                    </center>
                </a>
            @endif

            <!--  End External reservation Payment Module -->
        </div>
    </div>
</div>
