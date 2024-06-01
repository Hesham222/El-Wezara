<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>مناطق التحضير
        </h4>

        <hr>

        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Preparation Areas Module -->

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'PreparationArea-Add'))
                <a href="{{ route('organizations.preparationArea.create') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-plus mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.addNew')
                        </h5>
                    </center>
                </a>
            @endif
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'PreparationArea-View'))
                <a href="{{ route('organizations.preparationArea.index') . '?view=view' }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'PreparationArea-View-Retrieval-Orders'))
                <a href="{{ route('organizations.preparationArea.get.retrieval.orders') . '?view=view' }}"
                    class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">عرض طلبات التحويل الداخلى
                        </h5>
                    </center>
                </a>
            @endif
{{--            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),--}}
{{--                'PreparationArea-Delete'))--}}
{{--                <a href="{{ route('organizations.preparationArea.index') . '?view=trash' }}" class="menu_box">--}}
{{--                    <center>--}}
{{--                        <i class="fa fa-4x fa-trash mt-4"></i>--}}
{{--                        <h5 class="m-portlet__head-text mt-4">--}}
{{--                            @lang('Organization::organization.trash')--}}
{{--                        </h5>--}}
{{--                        <span class="m-badge m-badge--danger notification-icon">--}}
{{--                            {{ $menuCategoryTrashesCount }}--}}
{{--                        </span>--}}
{{--                    </center>--}}
{{--                </a>--}}
{{--            @endif--}}

            <!--  End Preparation Areas Module -->
        </div>
    </div>
</div>
