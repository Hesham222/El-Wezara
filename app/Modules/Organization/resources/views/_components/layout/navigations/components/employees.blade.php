  <div class="row">
      <div class="col-xl-12">
          <h4>الموظفين</h4>
          <hr>
          <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
              {{-- okay all the above --}}
              <!-- Start Admin Module -->
              @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                  'Admin-Module') ||
                  checkOrganizationAdminPermission(
                      auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                      'Admin-Add'))
                  @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                      'Admin-Module') ||
                      checkOrganizationAdminPermission(
                          auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                          'Employee-Add'))
                      <a href="{{ route('organizations.employee.create') }}" class="menu_box">
                          <center>
                              <i class="fa fa-4x fa-plus mt-4"></i>
                              <h5 class="m-portlet__head-text mt-4">
                                  اضف جديد </h5>
                          </center>
                      </a>
                  @endif
              @endif

              @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                  'Admin-Module') ||
                  checkOrganizationAdminPermission(
                      auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                      'Admin-Add'))
                  @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                      'Admin-Module') ||
                      checkOrganizationAdminPermission(
                          auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                          'Employee-Add via excel file'))
                      <a href="{{ route('organizations.employee.import') }}" class="menu_box">
                          <center>
                              <i class="fa fa-4x fa-plus mt-4"></i>
                              <h5 class="m-portlet__head-text mt-4">
                                  اضافة عن طريق ملف اكسيل

                              </h5>
                          </center>
                      </a>
                  @endif
              @endif

              @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                  'Admin-Module') ||
                  checkOrganizationAdminPermission(
                      auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                      'Admin-Edit') ||
                  checkOrganizationAdminPermission(
                      auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                      'Admin-View') ||
                  checkOrganizationAdminPermission(
                      auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                      'Admin-Delete') ||
                  checkOrganizationAdminPermission(
                      auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                      'Admin-Change-Password'))
                  @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                      'Admin-Module') ||
                      checkOrganizationAdminPermission(
                          auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                          'Employee-View'))
                      <a href="{{ route('organizations.employee.index') . '?view=view' }}" class="menu_box">
                          <center>
                              <i class="fa fa-4x fa-eye mt-4"></i>
                              <h5 class="m-portlet__head-text mt-4">
                                  عرض

                              </h5>
                          </center>
                      </a>
                  @endif
              @endif
              @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                  'Admin-Module') ||
                  checkOrganizationAdminPermission(
                      auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                      'Employee-View-EmployeeAttendance'))
                  <a href="{{ route('organizations.employeeAttendance.show') . '?view=view' }}" class="menu_box">
                      <center>
                          <i class="fa fa-4x fa-eye mt-4"></i>
                          <h5 class="m-portlet__head-text mt-4">
                              الحضور والانصراف

                          </h5>
                      </center>
                  </a>
              @endif
              @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                  'Admin-Module') ||
                  checkOrganizationAdminPermission(
                      auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                      'Admin-Delete'))
                  @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                      'Admin-Module') ||
                      checkOrganizationAdminPermission(
                          auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                          'Employee-Delete'))
                      <a href="{{ route('organizations.employee.index') . '?view=trash' }}" class="menu_box">
                          <center>
                              <i class="fa fa-4x fa-trash mt-4"></i>
                              <h5 class="m-portlet__head-text mt-4">
                                  سله المهملات
                              </h5>
                              <span class="m-badge m-badge--danger notification-icon">
                                  {{ $organizationAdminTrashesCount }}
                              </span>
                          </center>
                      </a>
                  @endif
              @endif


                  @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                  'Admin-Module') ||
                  checkOrganizationAdminPermission(
                      auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                      'Admin-Add'))
                      @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                          'Admin-Module') ||
                          checkOrganizationAdminPermission(
                              auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                              'Employees financial report'))
                          <a href="{{ route('organizations.employeeFinancialReport.index') }}" class="menu_box">
                              <center>
                                  <i class="fa fa-4x fa-eye mt-4"></i>
                                  <h5 class="m-portlet__head-text mt-4">
                                       التقرير المالى للموظفين </h5>
                              </center>
                          </a>
                  @endif
              @endif

              <!-- End Admin Module -->
          </div>
      </div>
  </div>
  <br>
