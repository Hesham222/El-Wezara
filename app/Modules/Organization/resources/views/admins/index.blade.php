<x-organization::layout>
@if(request()->input('view')=='trash')
  <x-slot name="pageTitle">المشرفين | سلة المهملات</x-slot name="pageTitle">
  @section('admins-trash-active', 'm-menu__item--active')
@else
  <x-slot name="pageTitle">المشرفين | عرض</x-slot name="pageTitle">
  @section('admins-view-active', 'm-menu__item--active')
@endif
@section('admins-active', 'm-menu__item--active m-menu__item--open')
@include('Organization::_modals.confirm_password')
@include('Organization::_modals.reset_admin_password')
  <x-slot name="style">
    <!-- Some styles -->
  </x-slot>
    <!-- Start page content -->
      <div class="m-subheader ">
        <div class="d-flex align-items-center">
          <div class="mr-auto">
            <h3 class="m-subheader__title ">
                المشرفين
            </h3>
          </div>
        </div>
      </div>
      <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
          <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
              <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                  {{request()->input('view')=='trash' ? 'سله المهملات' :  'عرض'}}
                </h3>
              </div>
            </div>
            <div class="m-portlet__head-tools">
              <ul class="m-portlet__nav">
                  @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module'))
                      <li class="m-portlet__nav-item">
                          <a href="{{route('organizations.admin.create')}}"
                             class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                    <span>
                        <i class="la la-plus">
                        </i>
                        <span>اضافه ادمن جديد</span>
                    </span>
                          </a>
                      </li>
                  @endif
              </ul>
            </div>
          </div>
          <div class="m-portlet__body">
             <section class="content">
                @include('Organization::admins.components.filterForm')
                <div class="table-responsive">
                    <section class="content table-responsive">
                      <table id="data-table" class="table table-striped- table-bordered table-hover table-checkable" >
                          <thead>
                          <tr>
                              <th>التعريف</th>
                              @if(request()->query('view')=='trash')
                              <th>مسح بواسطه</th>
                              <th>مسح في</th>
                              @endif
                              <th>الاسم</th>
                              <th>البريد الالكتروني</th>
                              <th>الرقم</th>
                              <th>الدور</th>
                              <th>نشأ بواسطه</th>
                              <th>نشأ في</th>
                              <th>أجراءات</th>
                          </tr>
                          </thead>
                          <tbody id="spinner">
                            <tr>
                                <td style="height: 100px;text-align: center;line-height: 100px;" colspan="8">
                                    <i class="fa fa-spinner fa-spin text-primary" style="font-size: 30px"aria-hidden="true"></i>
                                </td>
                            </tr>
                          </tbody>
                          <tbody id="data-table-body"></tbody>
                      </table>
                      <div id="paginationLinksContainer" style="display: flex;justify-content: center;align-items: center;margin-top: 10px"></div>
                    </section>
                </div>
              </section>
          </div>
        </div>
      </div>
    <!-- End page content -->
    <x-slot name="scripts">
      <script>
        $(function () {
            render("{!! route('organizations.admin.data',['view' => request()->input('view',0)]) !!}");
            /**
             * When Click on the pagination buttons, calling this script.
             *
             * */
            $('#paginationLinksContainer').on('click', 'a.page-link', function (event) {
                event.stopPropagation();
                render($(this).attr('href'));
                return false;
            });
            /**
             * When Click on the search button, calling this script.
             *
             * */
            $('#searchButton').on('click', function (event) {
                event.stopPropagation();
                render("{!! route('organizations.admin.data',['view' => request()->input('view',0)]) !!}&column=" + $('#searchColumn').val() + '&value=' + $('#searchField').val()+ '&start_date=' + $('#startDateCol').val()+ '&end_date=' + $('#endDateCol').val());
            });
        });
      </script>
      <!-- external JS -->
      <script>
          $(document).on('submit', '#reset-admin-password-form', function(event)
          {
              event.preventDefault();
              var url           = $(this).attr('action');
              var record        = document.getElementById('record_resource_id').value;
              var adminPassword = document.getElementById('inputAdminPassword').value;
              var newPassword   = document.getElementById('inputPass').value;
              var newPasswordConfirmation = document.getElementById('inputConfirmPass').value;
              var token    = $('meta[name="csrf-token"]').attr('content');
              $.ajax({
                  url: url,
                  method: "POST",
                  data: {
                      _token:token,
                      resource_id:record,
                      admin_password:adminPassword,
                      password:newPassword,
                      password_confirmation:newPasswordConfirmation,
                  },
                  dataType: 'JSON',
                  success: function (data) {
                      if (data['code']===200)
                      {
                          $('#reset-admin-password-modal').modal('toggle');
                          toastr.success(data['message']);
                      }
                      if (data['code']===500)
                          toastr.error(data['message']);
                      if (data['code']===101)
                          toastr.error(data['message']);
                  },
                  error: function (data) {
                      if (data.responseJSON.errors) {
                          Object.keys(data.responseJSON.errors).forEach(function (key, index) {
                              data.responseJSON.errors[key].forEach(function (err) {
                                  toastr.error(err);
                              })
                          });
                      }
                      else
                          toastr.error('فشل ، يرجى المحاولة مرة أخرى في وقت لاحق.');
                  }
              });
          });
      </script>
    </x-slot>
</x-organization::layout>
