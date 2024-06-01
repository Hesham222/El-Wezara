<x-organization::layout>
 <x-slot name="pageTitle">الموظفين | اضف</x-slot name="pageTitle">
 @section('employee-active', 'm-menu__item--active m-menu__item--open')
 @section('employee-create-active', 'm-menu__item--active')
  <x-slot name="style">
  <!-- Some styles -->
    <style>
        .invalid-feedback {
            display: block;
        }
    </style>
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
        <div style="display: none;" class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30" role="alert">
          <div class="m-alert__icon">
            <i class="flaticon-exclamation m--font-brand">
            </i>
          </div>
        </div>
        <div class="m-portlet m-portlet--mobile">
          <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
              <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                  اضف
                </h3>
              </div>
            </div>
          </div>
          <div class="m-portlet__body">
            <div class="table-responsive">
                <section class="content">
                  <form method="POST" action="{{route('organizations.employee.store')}}"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" enctype="multipart/form-data">
                      @csrf
                      <div class="m-portlet__body">

                          <div class="form-group m-form__group row">
                              <div class="col-lg-4">
                                  <label class="">الاسم بالكامل</label>
                                  <input
                                      type="text"
                                      value="{{old('name')}}"
                                      name="name"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="ادخل الاسم بالكامل..."
                                  />
                                  @error('name')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>



                              <div class="col-lg-4">
                                  <label>@lang('Organization::organization.department')</label>
                                  <select name="department" required=""  class="form-control m-input m-input--square" id="exampleSelect1">
                                      @foreach($departments as $department)
                                          <option @if(old('department') == $department->id) selected @endif value="{{ $department->id }}">{{ $department->name }}</option>
                                      @endforeach
                                  </select>
                                  @error('department')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>


                              <div class="col-lg-4">
                                  <label>@lang('Organization::organization.employeeType')</label>
                                  <select name="employeeType" required=""  class="form-control m-input m-input--square" id="exampleSelect1">
                                      @foreach($employee_types as $employee_type)
                                          <option @if(old('employeeType') == $employee_type->id) selected @endif value="{{ $employee_type->id }}">{{ $employee_type->name }}</option>
                                      @endforeach
                                  </select>
                                  @error('employeeType')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>


                              <div class="col-lg-4">
                                  <label>@lang('Organization::organization.employeeJob')</label>
                                  <select name="employeeJob" required=""  class="form-control m-input m-input--square" id="exampleSelect1">
                                      @foreach($employee_jobs as $employee_job)
                                          <option @if(old('employeeJob') == $employee_job->id) selected @endif value="{{ $employee_job->id }}">{{ $employee_job->name }}</option>
                                      @endforeach
                                  </select>
                                  @error('employeeJob')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>

                          </div>

                          <div class="form-group m-form__group row">

                              <div class="col-lg-4">
                                  <label class="">
                                        عدد ايام الاجازة المتاحة للموظف فى توقيت ادخال بياناته البرنامج :
                                  </label>
                                  <input
                                      type="number"
                                      value="{{old('vacation_balance')}}"
                                      name="vacation_balance"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="@lang('Organization::organization.employee_vacation_balance')"
                                      id="current_vacations"
                                  />
                                  @error('vacation_balance')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>


                              <div class="col-lg-4">
                                  <label class="">
                                      عدد ايام الاجازة المتاحة للموظف المرحله فى اخر تلات سنوات :
                                  </label>
                                  <input
                                      type="number"
                                      value="{{old('remaining_vacs')}}"
                                      name="remaining_vacs"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="@lang('Organization::organization.employee_vacation_balance')"
                                      id="remaining_vacs"
                                  />
                                  @error('remaining_vacs')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>




                              <div class="col-lg-4">
                                  <label class=""> تاريخ موعد التحديث السنوى لرصيد اجازات الموظف : </label>
                                  <input
                                      type="date"
                                      value="{{old('vacation_renew_date')}}"
                                      name="vacation_renew_date"
                                      required=""
                                      class="form-control m-input"
                                      id="vacation_renew_date"
                                  />
                                  @error('vacation_renew_date')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>


                              <div class="col-lg-4">
                                  <label class="">رقم الهاتف</label>
                                  <input
                                      type="number"
                                      value="{{old('phone')}}"
                                      name="phone"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="رقم الهاتف"
                                      id="phone"
                                  />
                                  @error('phone')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>


                              <div class="col-lg-4">
                                  <label class=""> تاريخ التوظيف</label>
                                  <input
                                      type="date"
                                      value="{{old('date_of_hiring')}}"
                                      name="date_of_hiring"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="تاريخ التوظيف"
                                      id="date_of_hiring"
                                  />
                                  @error('date_of_hiring')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>



                              <div class="col-lg-4">
                                  <label class=""> تاريخ الميلاد</label>
                                  <input
                                      type="date"
                                      value="{{old('birth_date')}}"
                                      name="birth_date"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="تاريخ الميلاد"
                                      id="birth_date"
                                  />
                                  @error('birth_date')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>


                          </div>


                          <div class="form-group m-form__group row">

                              <div class="col-lg-4">
                                  <label class="">رقم التامينى</label>
                                  <input
                                      type="number"
                                      value="{{old('insurance_number')}}"
                                      name="insurance_number"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="رقم التامينى"
                                      id="insurance_number"
                                  />
                                  @error('insurance_number')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>

                              <div class="col-lg-4">
                                  <label>الحالة الاجتماعية:</label>
                                  <select name="social_status"  class="form-control m-input m-input--square" id="exampleSelect1">

                                          <option @if(old('social_status') == 'Single') selected @endif value="Single">اعزب</option>
                                      <option @if(old('social_status') == 'Engaged') selected @endif value="Engaged">مخطوب</option>
                                      <option @if(old('social_status') == 'Married') selected @endif value="Married">متزوج</option>
                                        <option @if(old('social_status') == 'Divorced') selected @endif value="Divorced">مطلق</option>

                                          <option @if(old('social_status') == 'Widowed') selected @endif value="Widowed">ارمل</option>


                                  </select>
                                  @error('social_status')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>

                              <div class="col-lg-4">
                                  <label class=""> العنوان</label>
                                  <input
                                      type="text"
                                      value="{{old('address')}}"
                                      name="address"
                                      required=""
                                      class="form-control m-input"
                                      placeholder=" العنوان"
                                      id="address"
                                  />
                                  @error('address')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>



                          <div class="form-group m-form__group row">

                              <div class="col-lg-4">
                                  <label>الحالة العسكرية:</label>
                                  <select name="military_status"  class="form-control m-input m-input--square" id="military_status">

                                      <option @if(old('military_status') == 'Postponed') selected @endif value="Postponed">مؤجل</option>
                                      <option @if(old('military_status') == 'Exempted') selected @endif value="Exempted">معافى</option>
                                      <option @if(old('military_status') == 'Done') selected @endif value="Done">اتم الخدمة</option>

                                  </select>
                                  @error('military_status')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>

                              <div id="appendDescription" class="col-lg-4">
                                  @include('Organization::employees.components.append_extemption_desc')

                              </div>
{{--                              <div class="col-lg-4">--}}
{{--                                  <label class=""> الراتب الكلى</label>--}}
{{--                                  <input--}}
{{--                                      type="number"--}}
{{--                                      value="{{old('gross_salary')}}"--}}
{{--                                      name="gross_salary"--}}
{{--                                      required=""--}}
{{--                                      class="form-control m-input"--}}
{{--                                      placeholder=" الراتب الكلى"--}}
{{--                                      id="gross_salary"--}}
{{--                                  />--}}
{{--                                  @error('gross_salary')--}}
{{--                                  <span class="invalid-feedback" role="alert">--}}
{{--                                          <strong>{{ $message }}</strong>--}}
{{--                                      </span>--}}
{{--                                  @enderror--}}
{{--                              </div>--}}


                              <div class="col-lg-4">
                                  <label> الحالة:</label>
                                  <select name="status"  class="form-control m-input m-input--square" id="exampleSelect1">

                                      <option @if(old('status') == 'nomination') selected @endif value="nomination">المعين</option>
                                      <option @if(old('status') == 'TheInsured') selected @endif value="TheInsured">المؤمن عليه</option>
                                      <option @if(old('status') == 'temporary') selected @endif value="temporary">المؤقت</option>
                                      <option @if(old('status') == 'officer') selected @endif value="officer">الظابط</option>
                                  </select>
                                  @error('status')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>


                          </div>


<div class="form-group m-form__group row">
  <div class="col-lg-6">
      <label> النوع:</label>
      <select name="gender"  class="form-control m-input m-input--square" id="gender">

          <option @if(old('gender') == 'male') selected @endif value="male">ذكر</option>
          <option @if(old('gender') == 'female') selected @endif value="female">انثى </option>

      </select>
      @error('gender')
      <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
  </div>

</div>



<div class="form-group m-form__group row">
  <div class="col-lg-6">
      <label> عنوان المراسالات:</label>
      <textarea
          name="sending_address"
          class="form-control m-input"
      > </textarea>
      @error('sending_address')
      <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
  </div>


  <div class="col-lg-6">
      <label>  رقم هاتف اخر:</label>
      <input
          type="number"
          value="{{old('secondPhone')}}"
          name="secondPhone"

          class="form-control m-input"
          placeholder=" "
          id="secondPhone"
      />
      @error('secondPhone')
      <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
  </div>


</div>


<div class="form-group m-form__group row">
  <div class="col-lg-6">
      <label> الحالة الصحية  :</label>
      <textarea
          name="medical_condition"
          class="form-control m-input"
      > </textarea>
      @error('medical_condition')
      <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
  </div>


  <div class="col-lg-6">
      <label> الادوية اللازمة فى حاله الطوارئ :</label>
      <textarea
          name="medications_in_emergecies"
          class="form-control m-input"
      > </textarea>
      @error('medications_in_emergecies')
      <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
  </div>


</div>



<div class="form-group m-form__group row">
  <div class="col-lg-6">
      <label> تاريخ التامين على الموظف :</label>
      <input
          type="date"
          value="{{old('insurance_date')}}"
          name="insurance_date"

          class="form-control m-input"
          placeholder=" "
          id="insurance_date"
      />
      @error('insurance_date')
      <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
  </div>


  <div class="col-lg-6">
      <label>تاريخ انتهاء عقد الموظف:</label>
      <input
          type="date"
          value="{{old('contract_end_date')}}"
          name="contract_end_date"

          class="form-control m-input"
          placeholder=" "
          id="contract_end_date"
      />
      @error('contract_end_date')
      <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
  </div>


</div>


<div class="form-group m-form__group row">
  <div class="col-lg-6">
      <label>تاريخ انتهاء الشهاده الصحية :</label>
      <input
          type="date"
          value="{{old('health_certificate_end_date')}}"
          name="health_certificate_end_date"

          class="form-control m-input"
          placeholder=" "
          id="health_certificate_end_date"
      />
      @error('health_certificate_end_date')
      <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
  </div>


  <div class="col-lg-6">
      <label>تاريخ انتهاء بطاقه الرقم القومى:</label>
      <input
          type="date"
          value="{{old('national_id_end_date')}}"
          name="national_id_end_date"

          class="form-control m-input"
          placeholder=" "
          id="national_id_end_date"
      />
      @error('national_id_end_date')
      <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
  </div>


</div>






<div class="form-group m-form__group row">
  <div class="col-lg-6">
      <label> عدد ساعات العمل ف اليوم    :</label>
      <input
          type="number"
          value="{{old('hours_per_days')}}"
          name="hours_per_days"

          class="form-control m-input"
          placeholder=" "
          id="hours_per_days"
      />
      @error('hours_per_days')
      <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
  </div>


  <div class="col-lg-6">
      <label>ساعه بدا العمل   :</label>
      <input
          type="number"
          value="{{old('start_hour')}}"
          name="start_hour"

          class="form-control m-input"
          placeholder=" "
          id="start_hour"
      />
      @error('start_hour')
      <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
  </div>


</div>



<div class="form-group m-form__group row">
  <div class="col-lg-6">
      <label> ساعة انتهاء العمل        :</label>
      <input
          type="number"
          value="{{old('end_hour')}}"
          name="end_hour"

          class="form-control m-input"
          placeholder=" "
          id="end_hour"
      />
      @error('end_hour')
      <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
  </div>


  <div class="col-lg-6">
      <label>ثمن الساعه الاضافية     :</label>
      <input
          type="number"
          value="{{old('extra_hour_price')}}"
          name="extra_hour_price"
            step="0.01"
          class="form-control m-input"
          placeholder=" "
          id="extra_hour_price"
      />
      @error('extra_hour_price')
      <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
  </div>


</div>
<div class="form-group m-form__group row">

  <div class="col-lg-6">
      <label> الدورات التدريبيه الحاصل عليها الموظف:</label>
      <textarea
          name="training_description"
          class="form-control m-input"
      > </textarea>
      @error('training_description')
      <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
  </div>



</div>



{{--                          <div class="form-group m-form__group row">--}}

{{--                              <div class="col-lg-3">--}}
{{--                                  <label>نوع الضرائب:</label>--}}
{{--                                  <select name="taxes_type" required="" class="form-control m-input m-input--square" id="exampleSelect1">--}}

{{--                                      <option @if(old('taxes_type') == 'Percentage') selected @endif value="Percentage">Percentage</option>--}}
{{--                                      <option @if(old('taxes_type') == 'Number') selected @endif value="Number">Number</option>--}}

{{--                                  </select>--}}
{{--                                  @error('taxes_type')--}}
{{--                                  <span class="invalid-feedback" role="alert">--}}
{{--                                          <strong>{{ $message }}</strong>--}}
{{--                                      </span>--}}
{{--                                  @enderror--}}
{{--                              </div>--}}



{{--                              <div class="col-lg-3">--}}
{{--                                  <label class="">قيمة الضرائب</label>--}}
{{--                                  <input--}}
{{--                                      type="number"--}}
{{--                                      value="{{old('taxes_value')}}"--}}
{{--                                      name="taxes_value"--}}
{{--                                      required=""--}}
{{--                                      class="form-control m-input"--}}
{{--                                      placeholder=" قيمة الضرائب"--}}
{{--                                      id="taxes_value"--}}
{{--                                  />--}}
{{--                                  @error('taxes_value')--}}
{{--                                  <span class="invalid-feedback" role="alert">--}}
{{--                                          <strong>{{ $message }}</strong>--}}
{{--                                      </span>--}}
{{--                                  @enderror--}}
{{--                              </div>--}}







{{--                              <div class="col-lg-3">--}}
{{--                                  <label>نوع التامين:</label>--}}
{{--                                  <select name="insurance_type" required="" class="form-control m-input m-input--square" id="exampleSelect1">--}}

{{--                                      <option @if(old('insurance_type') == 'Percentage') selected @endif value="Percentage">Percentage</option>--}}
{{--                                      <option @if(old('insurance_type') == 'Number') selected @endif value="Number">Number</option>--}}

{{--                                  </select>--}}
{{--                                  @error('insurance_type')--}}
{{--                                  <span class="invalid-feedback" role="alert">--}}
{{--                                          <strong>{{ $message }}</strong>--}}
{{--                                      </span>--}}
{{--                                  @enderror--}}
{{--                              </div>--}}



{{--                              <div class="col-lg-3">--}}
{{--                                  <label class="">قيمة التامين</label>--}}
{{--                                  <input--}}
{{--                                      type="number"--}}
{{--                                      value="{{old('insurance_value')}}"--}}
{{--                                      name="insurance_value"--}}
{{--                                      required=""--}}
{{--                                      class="form-control m-input"--}}
{{--                                      placeholder=" قيمة التامين"--}}
{{--                                      id="insurance_value"--}}
{{--                                  />--}}
{{--                                  @error('insurance_value')--}}
{{--                                  <span class="invalid-feedback" role="alert">--}}
{{--                                          <strong>{{ $message }}</strong>--}}
{{--                                      </span>--}}
{{--                                  @enderror--}}
{{--                              </div>--}}




{{--                          </div>--}}

                          <div class="form-group m-form__group row">
                              <div class="col-lg-4">
                                  <label class=""> ارفق الرقم القومى  </label>
                                  <input
                                      type="file"
                                      value="{{old('attachment')}}"
                                      name="attachment"
                                      class="form-control m-input"
                                      id="attachment"
                                  />
                                  @error('attachment')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>


                              <div class="col-lg-4">
                                  <label class="">  ملفات اخرى </label>
                                  <input
                                      multiple
                                      type="file"
                                      value="{{old('ather_attachment')}}"
                                      name="ather_attachment[]"
                                      class="form-control m-input"
                                      id="ather_attachment"
                                  />
                                  @error('ather_attachment')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>

                              <div class="col-lg-4">

                                  <label class="">  هل الموظف ادمن </label>
                                  <input
                                      type="checkbox"

                                      name="isSystemUser"
                                      class="form-control m-input"
                                      id="isSystemUser"
                                  />
                              </div>


                          </div>









                          <div class="form-group m-form__group row adminSection" style="display: none">
                              <div class="col-lg-4">
                                  <label> اسم المستخدم:</label>
                                  <input
                                      type="text"
                                      value="{{old('user_name')}}"
                                      name="user_name"
                                      class="form-control m-input"
                                      placeholder="ادخل اسم المستخم ..." />
                                  @error('user_name')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4">
                                  <label>الباسورد:</label>
                                  <div class="m-input-icon m-input-icon--right">
                                      <input
                                          type="password"
                                          name="password"
                                          class="form-control m-input"
                                          placeholder="ادخل كلمة المرور..."
                                          maxlength="191"
                                      />

                                  </div>
                                  @error('password')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>

                              <div class="col-lg-4">
                                  <label>الادوار:</label>
                                  <select name="role"  class="form-control m-input m-input--square" id="exampleSelect1">
                                      @foreach($roles as $role)
                                          <option @if(old('role') == $role->id) selected @endif value="{{ $role->id }}">{{ $role->name }}</option>
                                      @endforeach
                                  </select>
                                  @error('role')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>


                          <div class="form-group m-form__group row" >

                              <div class="col-lg-4">

                                  <label class="">  هل الموظف منتدب </label>
                                  <input
                                      type="checkbox"

                                      name="isDelegated"
                                      class="form-control m-input"
                                      id="isDelegated"
                                  />
                              </div>

                          </div>







                          <div class="form-group m-form__group row DelegatedSection" style="display: none">
                              <div class="col-lg-4">
                                  <label>  الدرجة الوظيفية:</label>
                                  <input
                                      type="text"
                                      value="{{old('functional_class')}}"
                                      name="functional_class"
                                      class="form-control m-input"
                                      placeholder="الدرجة الوظيفية ..." />
                                  @error('functional_class')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4">
                                  <label>تاريخ الحصول عليها:</label>
                                  <div class="m-input-icon m-input-icon--right">
                                      <input
                                          type="date"
                                          name="functional_class_date"
                                          class="form-control m-input"
                                      />

                                  </div>
                                  @error('functional_class_date')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4">
                                  <label>   نوع الدرجة الوظيفية:</label>
                                  <input
                                      type="text"
                                      value="{{old('functional_class_type')}}"
                                      name="functional_class_type"
                                      class="form-control m-input"
                                      placeholder="نوع الدرجة الوظيفية  ..." />
                                  @error('functional_class_type')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>

                              <div class="col-lg-4">
                                  <label>   جهة الانتداب:</label>
                                  <input
                                      type="text"
                                      value="{{old('delegated_area')}}"
                                      name="delegated_area"
                                      class="form-control m-input"
                                      placeholder=" جهه الانتداب ..." />
                                  @error('delegated_area')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>



                          </div>












                          <div class="form-group m-form__group row" >

                              <div class="col-lg-4">

                                  <label class="">  هل الموظف يعانى من اعاقة  </label>
                                  <input
                                      type="checkbox"

                                      name="is_disabled"
                                      class="form-control m-input"
                                      id="is_disabled"
                                  />
                              </div>

                          </div>







                          <div class="form-group m-form__group row disabledSection" style="display: none">
                              <div class="col-lg-4">
                                  <label>   وصف الاعاقة ووصف الاعمال المسموح القيام بها :</label>
                                  <textarea
                                      name="disabled_desc"
                                      class="form-control m-input"
                                      cols="5"
                                      ></textarea>
                                  @error('disabled_desc')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror

                          </div>
                              </div>









                      </div>
                      <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                          <div class="m-form__actions m-form__actions--solid">
                              <div class="row">
                                  <div class="col-lg-6"></div>
                                  <div class="col-lg-6 m--align-right">
                                      <button type="submit" class="btn btn-primary">حفظ</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </form>
                </section>
            </div>
          </div>
        </div>
      </div>
    <!-- end page content -->
  <x-slot name="scripts">
    <!-- Some JS -->
    <script type="text/javascript">
      var input = document.getElementById("phone");
      input.onkeypress = function (e)
      {
          e = e || window.event;
          var charCode = (typeof e.which == "number") ? e.which : e.keyCode;
          if (!charCode || charCode == 8 /* Backspace */)
              return;
          var typedChar = String.fromCharCode(charCode);
          if (/\d/.test(typedChar))
              return;
          if (typedChar == "+" && this.value == "")
              return;
          return false;
      };

      $("#isSystemUser").on('change',function (){
         if ($("#isSystemUser").is(":checked")){
           $(".adminSection").show();
         }else {

             $(".adminSection").hide();
         }
      });





      $("#isDelegated").on('change',function (){
          if ($("#isDelegated").is(":checked")){
              $(".DelegatedSection").show();
          }else {

              $(".DelegatedSection").hide();
          }
      });





      $("#is_disabled").on('change',function (){
          if ($("#is_disabled").is(":checked")){
              $(".disabledSection").show();
          }else {

              $(".disabledSection").hide();
          }
      });


    </script>
      <script>
          $('#military_status').change(function(){
              var military_status  = $('#military_status').val();
              //console.log(training_id)
              $.ajax({
                  type:'get',
                  url:'{{route('organizations.employee.append.exemption.description')}}',
                  data:{
                      "_token": "{{ csrf_token() }}",
                      military_status:military_status,
                  },
                  success:function(resp){
                      $("#appendDescription").html(resp);
                  },error:function(){
                      alert('Error');
                  }
              });
          });
      </script>
  </x-slot>
</x-organization::layout>
