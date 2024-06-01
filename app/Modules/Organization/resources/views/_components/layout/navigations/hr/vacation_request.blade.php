<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            @lang('Organization::organization.vacationRequest')
        </h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- start vacation_requset -->

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'VacationRequest-Add'))
                <a href="{{ route('organizations.vacationRequest.create') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-plus mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.addNew')
                        </h5>
                    </center>
                </a>
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'VacationRequest-View'))
                <a href="{{ route('organizations.vacationRequest.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif

            @if (auth('organization_admin')->user()->employee->isHeadOfDept())
                <a href="{{ route(
                    'organizations.vacationRequest.indexDepartment',
                    auth('organization_admin')->user()->employee->department->id,
                ) }}"
                    class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.department_vacation_requests')

                        </h5>
                    </center>
                </a>
            @endif

            <!-- end vacation_requset -->
        </div>
    </div>
</div>
