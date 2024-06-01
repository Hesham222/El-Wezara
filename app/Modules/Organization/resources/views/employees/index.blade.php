<x-organization::layout>
@if(!isset($type))
    @if(request()->input('view')=='trash')
  <x-slot name="pageTitle">المشرفين | سلة المهملات</x-slot name="pageTitle">
  @section('employee-trash-active', 'm-menu__item--active')
@else
  <x-slot name="pageTitle">المشرفين | عرض</x-slot name="pageTitle">
  @section('employee-view-active', 'm-menu__item--active')
@endif
@section('employee-active', 'm-menu__item--active m-menu__item--open')
    <input id="type" type="hidden" name="type" value=""/>
    @else
        @if($type == 'emps-nomination')
        <x-slot name="pageTitle">الموظفين |  المعينين</x-slot name="pageTitle">
        @section('emps-active', 'm-menu__item--active m-menu__item--open')
        @section('emps-nomination-active', 'm-menu__item--active')
    <input id="type" type="hidden" name="type" value="{{$type}}"/>
    @elseif($type == 'emps-TheInsured')
        <x-slot name="pageTitle">الموظفين |  المؤمن عليهم</x-slot name="pageTitle">
        @section('emps-active', 'm-menu__item--active m-menu__item--open')
    @section('emps-TheInsured-active', 'm-menu__item--active')
    <input id="type" type="hidden" name="type" value="{{$type}}"/>

    @elseif($type == 'emps-temporary')
        <x-slot name="pageTitle">الموظفين |   المؤقتين</x-slot name="pageTitle">
        @section('emps-active', 'm-menu__item--active m-menu__item--open')
    @section('emps-temporary-active', 'm-menu__item--active')
    <input id="type" type="hidden" name="type" value="{{$type}}"/>

    @elseif($type == 'emps-officer')
        <x-slot name="pageTitle">الموظفين |   الظباط</x-slot name="pageTitle">
        @section('emps-active', 'm-menu__item--active m-menu__item--open')
    @section('emps-officer-active', 'm-menu__item--active')
    <input id="type" type="hidden" name="type" value="{{$type}}"/>

    @elseif($type == 'all')
        <x-slot name="pageTitle">الموظفين |   مرتبات الموظفين</x-slot name="pageTitle">
        @section('empsSalary-active', 'm-menu__item--active m-menu__item--open')
    @section('empsSalary-view-active', 'm-menu__item--active')
    <input id="type" type="hidden" name="type" value="{{$type}}"/>

    @elseif($type == 'nominationSalaries')
        <x-slot name="pageTitle">الموظفين |   مرتبات المعينين</x-slot name="pageTitle">
        @section('empsSalary-active', 'm-menu__item--active m-menu__item--open')
    @section('empsSalary-nomination-active', 'm-menu__item--active')
    <input id="type" type="hidden" name="type" value="{{$type}}"/>

    @elseif($type == 'TheInsuredSalaries')
        <x-slot name="pageTitle">الموظفين |   مرتبات المؤمن عليهم</x-slot name="pageTitle">
        @section('empsSalary-active', 'm-menu__item--active m-menu__item--open')
    @section('empsSalary-TheInsured-active', 'm-menu__item--active')
    <input id="type" type="hidden" name="type" value="{{$type}}"/>

    @elseif($type == 'temporarySalaries')
        <x-slot name="pageTitle">الموظفين |   مرتبات  المؤقتين</x-slot name="pageTitle">
        @section('empsSalary-active', 'm-menu__item--active m-menu__item--open')
    @section('empsSalary-temporary-active', 'm-menu__item--active')
    <input id="type" type="hidden" name="type" value="{{$type}}"/>

    @elseif($type == 'officerSalaries')
        <x-slot name="pageTitle">الموظفين |   مرتبات  المؤقتين</x-slot name="pageTitle">
        @section('empsSalary-active', 'm-menu__item--active m-menu__item--open')
    @section('empsSalary-officer-active', 'm-menu__item--active')
    <input id="type" type="hidden" name="type" value="{{$type}}"/>
    @endif



        @endif
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
                الموظفين
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
            @if(!isset($type))
              <div class="m-portlet__head-tools">
              <ul class="m-portlet__nav">
                  @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module'))
                      @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Employee-Add'))
                      <li class="m-portlet__nav-item">
                          <a href="{{route('organizations.employee.create')}}"
                             class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                    <span>
                        <i class="la la-plus">
                        </i>
                        <span>اضافه موظف جديد</span>
                    </span>
                          </a>
                      </li>
                  @endif
                  @endif
              </ul>
            </div>
                @endif
          </div>
          <div class="m-portlet__body">
             <section class="content">
                @include('Organization::employees.components.filterForm')
                <div class="table-responsive">
                    <section class="content table-responsive">
                      <table id="data-table" class="table table-striped- table-bordered table-hover table-checkable" >
                          <thead>
                         @if(isset($type) && $type == "nominationSalaries")

                             <tr>
                                 <th>التعريف</th>
                                 <th>الاسم</th>
                                 <th>الوظيفة </th>
                                 <th> ايام العمل  </th>
                                 <th>المكافأة  </th>
                                 <th>المكافأة الفعلية </th>
                                 <th> ايام الجزاءات من الراتب   </th>
                                 <th> ايام المكافأت من الراتب </th>
                                 <th> قيمة الجزاءات  </th>
                                 <th>  قيمة المكافأت   </th>
                                 <th>  الدمغة   </th>
                                 <th> ضريبة كسب العمل     </th>
                                 <th> البدلات     </th>
                                 <th> اجمالى المستحق     </th>
                                 <th> المسحوبات     </th>
                                 <th> صافى المستحق     </th>

                             </tr>

                         @elseif(isset($type) && $type == "TheInsuredSalaries")
                             <tr>
                                 <th>التعريف</th>
                                 <th>الاسم</th>
                                 <th>الوظيفة </th>
                                 <th> ايام العمل  </th>
                                 <th>الاجر التأمينى  </th>
                                 <th>الاجر التأمينى الفعلى </th>
                                 <th> مستقطع تأمينات </th>
                                 <th> اجمالى تأمينات </th>
                                 <th>  الدمغة   </th>
                                 <th> ضريبة كسب العمل     </th>
                                 <th>مستقطع ضارئب ودمغات</th>
                                 <th>  اجمالى ضرائب وتأمينات</th>
                                 <th> ايام الجزاءات من الراتب   </th>
                                 <th> ايام المكافأت من الراتب </th>
                                 <th> قيمة الجزاءات  </th>
                                 <th>  قيمة المكافأت   </th>

                                 <th> البدلات     </th>
                                 <th> اجمالى المرتب     </th>
                                 <th> المسحوبات     </th>
                                 <th>  الصافى     </th>

                             </tr>

                         @elseif(isset($type) && $type == "temporarySalaries")
                             <tr>
                                 <th>التعريف</th>
                                 <th>الاسم</th>
                                 <th>الوظيفة </th>
                                 <th> ايام العمل  </th>
                                 <th>الاجر الاساسى  </th>
                                 <th>الاجر الاساسى الفعلى </th>
                                 <th> ايام الجزاءات من الراتب   </th>
                                 <th> ايام المكافأت من الراتب </th>
                                 <th> قيمة الجزاءات  </th>
                                 <th>  قيمة المكافأت   </th>

                                 <th>  الدمغة   </th>
                                 <th> ضريبة كسب العمل     </th>



                                 <th> البدلات     </th>
                                 <th> اجمالى المستحق     </th>
                                 <th> المسحوبات     </th>
                                 <th>  صافى المستحق     </th>

                             </tr>

                         @elseif(isset($type) && $type == "officerSalaries")
                             <tr>
                                 <th>التعريف</th>
                                 <th>الاسم</th>
                                 <th>الوظيفة/ الرتبه </th>
                                 <th> ايام العمل  </th>
                                 <th> قيمة بدل التمثيل  </th>
                                 <th>  قيمة بدل التمثيل الفعلية </th>
                                 <th>  الدمغة   </th>
                                 <th> ضريبة كسب العمل     </th>

                                 <th> البدلات     </th>
                                 <th> اجمالى المستحق     </th>
                                 <th> المسحوبات     </th>
                                 <th>  صافى المستحق     </th>

                             </tr>
                         @else

                          <tr>
                              <th>التعريف</th>
                              @if(request()->query('view')=='trash')
                              <th>مسح بواسطه</th>
                              <th>مسح في</th>
                              @endif
                              <th>الاسم</th>
                              <th>الوظيفة </th>
                              <th>الادارة </th>
                              <th>نوع الوظيفة  </th>
                              <th>رقم الهاتف  </th>
                              <th>تاريخ التوظيف   </th>
                              <th>تاريخ الميلاد </th>
                              <th>الرقم التامينى  </th>
                              <th>الحاله  الاجتمعاية   </th>
                              <th>الحاله  العسكرية   </th>
{{--                              <th>المرتب الاساسى     </th>--}}
                              <th>المرتب الكلى     </th>
                              <th>  هل الموظف في اجازه بدون مرتب     </th>

                              <th>تاريخ الانشاء     </th>
                              <th>أجراءات</th>
                          </tr>
                          @endif
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
          var type = $("#type").val();
            if (type != ""){

                if (type == "officerSalaries"){

                    $(function () {
                        render("{!! route('organizations.financial/employee.officer.salaries.data',['view' => request()->input('view',0)]) !!}");
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
                            render("{!! route('organizations.financial/employee.officer.salaries.data',['view' => request()->input('view',0)]) !!}&column=" + $('#searchColumn').val() + '&value=' + $('#searchField').val()+ '&start_date=' + $('#startDateCol').val()+ '&end_date=' + $('#endDateCol').val());
                        });
                    });

                }
              else  if (type == "temporarySalaries"){

                    $(function () {
                        render("{!! route('organizations.financial/employee.temporary.salaries.data',['view' => request()->input('view',0)]) !!}");
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
                            render("{!! route('organizations.financial/employee.temporary.salaries.data',['view' => request()->input('view',0)]) !!}&column=" + $('#searchColumn').val() + '&value=' + $('#searchField').val()+ '&start_date=' + $('#startDateCol').val()+ '&end_date=' + $('#endDateCol').val());
                        });
                    });

                }
               else if (type == "TheInsuredSalaries"){

                    $(function () {
                        render("{!! route('organizations.financial/employee.TheInsured.salaries.data',['view' => request()->input('view',0)]) !!}");
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
                            render("{!! route('organizations.financial/employee.TheInsured.salaries.data',['view' => request()->input('view',0)]) !!}&column=" + $('#searchColumn').val() + '&value=' + $('#searchField').val()+ '&start_date=' + $('#startDateCol').val()+ '&end_date=' + $('#endDateCol').val());
                        });
                    });

                }

              else  if (type == "nominationSalaries"){

                    $(function () {
                        render("{!! route('organizations.financial/employee.nomination.salaries.data',['view' => request()->input('view',0)]) !!}");
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
                            render("{!! route('organizations.financial/employee.nomination.salaries.data',['view' => request()->input('view',0)]) !!}&column=" + $('#searchColumn').val() + '&value=' + $('#searchField').val()+ '&start_date=' + $('#startDateCol').val()+ '&end_date=' + $('#endDateCol').val());
                        });
                    });

                }

               else if (type == "emps-nomination"){

                    $(function () {
                        render("{!! route('organizations.financial/employee.nomination.data',['view' => request()->input('view',0)]) !!}");
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
                            render("{!! route('organizations.financial/employee.nomination.data',['view' => request()->input('view',0)]) !!}&column=" + $('#searchColumn').val() + '&value=' + $('#searchField').val()+ '&start_date=' + $('#startDateCol').val()+ '&end_date=' + $('#endDateCol').val());
                        });
                    });
                }

                else if (type == "emps-TheInsured"){

                    $(function () {
                        render("{!! route('organizations.financial/employee.TheInsured.data',['view' => request()->input('view',0)]) !!}");
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
                            render("{!! route('organizations.financial/employee.TheInsured.data',['view' => request()->input('view',0)]) !!}&column=" + $('#searchColumn').val() + '&value=' + $('#searchField').val()+ '&start_date=' + $('#startDateCol').val()+ '&end_date=' + $('#endDateCol').val());
                        });
                    });
                }


                else if (type == "emps-temporary"){

                    $(function () {
                        render("{!! route('organizations.financial/employee.temporary.data',['view' => request()->input('view',0)]) !!}");
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
                            render("{!! route('organizations.financial/employee.temporary.data',['view' => request()->input('view',0)]) !!}&column=" + $('#searchColumn').val() + '&value=' + $('#searchField').val()+ '&start_date=' + $('#startDateCol').val()+ '&end_date=' + $('#endDateCol').val());
                        });
                    });
                }


                else if (type == "emps-officer"){

                    $(function () {
                        render("{!! route('organizations.financial/employee.officer.data',['view' => request()->input('view',0)]) !!}");
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
                            render("{!! route('organizations.financial/employee.officer.data',['view' => request()->input('view',0)]) !!}&column=" + $('#searchColumn').val() + '&value=' + $('#searchField').val()+ '&start_date=' + $('#startDateCol').val()+ '&end_date=' + $('#endDateCol').val());
                        });
                    });
                }




            }else {

                $(function () {
                    render("{!! route('organizations.employee.data',['view' => request()->input('view',0)]) !!}");
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
                        render("{!! route('organizations.employee.data',['view' => request()->input('view',0)]) !!}&column=" + $('#searchColumn').val() + '&value=' + $('#searchField').val()+ '&start_date=' + $('#startDateCol').val()+ '&end_date=' + $('#endDateCol').val());
                    });
                });

            }

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
