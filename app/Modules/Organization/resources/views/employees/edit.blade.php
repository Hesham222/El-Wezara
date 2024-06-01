<x-organization::layout>
 <x-slot name="pageTitle">المشرفين | تعديل</x-slot name="pageTitle">
 @section('admins-active', 'm-menu__item--active m-menu__item--open')
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
                المشرفين
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
                  تعديل
                </h3>
              </div>
            </div>
          </div>
          <div class="m-portlet__body">
            <div class="table-responsive">

                <section class="content">
                    <form method="POST" action="{{route('organizations.employee.update',$record->id)}}"
                          class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="m-portlet__body">

                            <div class="form-group m-form__group row">
                                <div class="col-lg-4">
                                    <label class="">الاسم بالكامل</label>
                                    <input
                                        type="text"
                                        value="{{old('name')?old('name'):$record->name}}"
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
                                            <option @if(old('department') == $department->id) selected @endif  @if($record->department_id == $department->id) selected @endif value="{{ $department->id }}">{{ $department->name }}</option>
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
                                            <option @if(old('employeeType') == $employee_type->id) selected @endif  @if($record->employee_type_id == $employee_type->id) selected @endif value="{{ $employee_type->id }}">{{ $employee_type->name }}</option>
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
                                            <option @if(old('employeeJob') == $employee_job->id) selected @endif   @if($record->employee_job_id== $employee_job->id) selected @endif value="{{ $employee_job->id }}">{{ $employee_job->name }}</option>
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
                                    <label class="">عدد ايام الاجازة المتاحة للموظف فى توقيت ادخال بياناته البرنامج</label>
                                    <input
                                        type="number"
                                        value="{{old('vacation_balance')?old('vacation_balance'):$record->vacation_balance}}"
                                        name="vacation_balance"
                                        required=""
                                        class="form-control m-input"
                                        placeholder="@lang('Organization::organization.employee_vacation_balance')"
                                        id="phone"
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
                                        value="{{old('remaining_vacs')?old('remaining_vacs'):$record->remaining_vacs}}"
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
                                        value="{{old('vacation_renew_date')?old('vacation_renew_date'):$record->vacation_renew_date}}"
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
                                        value="{{old('phone')?old('phone'):$record->phone}}"
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
                                        value="{{old('date_of_hiring')?old('date_of_hiring'):$record->date_of_hiring}}"
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
                                        value="{{old('birth_date')?old('birth_date'):$record->birth_date}}"
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
                                        value="{{old('insurance_number')?old('insurance_number'):$record->insurance_number}}"
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

                                        <option @if(old('social_status') == 'Single') selected @endif
                                        @if($record->social_status == 'Single') selected @endif
                                        value="Single">اعزب</option>
                                        <option @if(old('social_status') == 'Engaged') selected @endif
                                        @if($record->social_status == 'Engaged') selected @endif
                                        value="Engaged">مخطوب</option>
                                        <option @if(old('social_status') == 'Married') selected @endif
                                        @if($record->social_status == 'Married') selected @endif
                                        value="Married">متزوج</option>

                                        <option @if(old('social_status') == 'Divorced') selected @endif
                                        @if($record->social_status == 'Divorced') selected @endif
                                        value="Married">مطلق</option>


                                        <option @if(old('social_status') == 'Widowed') selected @endif
                                        @if($record->social_status == 'Widowed') selected @endif
                                        value="Married">ارمل</option>

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
                                        value="{{old('address')?old('address'):$record->address}}"
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

                                        <option @if(old('military_status') == 'Postponed') selected @endif
                                        @if($record->military_status == 'Postponed') selected @endif
                                                value="Postponed">مؤجل</option>
                                        <option @if(old('military_status') == 'Exempted') selected @endif
                                        @if($record->military_status == 'Exempted') selected @endif
                                                value="Exempted">معافى</option>
                                        <option @if(old('military_status') == 'Done') selected @endif
                                        @if($record->military_status == 'Done') selected @endif
                                                value="Done">اتم الخدمة</option>

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
                                <div class="col-lg-4">
                                    <label> النوع:</label>
                                    <select name="gender"  class="form-control m-input m-input--square" id="gender">

                                        <option @if(old('gender') == 'male') selected @endif
                                        @if($record->gender == 'male') selected @endif
                                                value="male">ذكر</option>
                                        <option @if(old('gender') == 'female') selected @endif
                                        @if($record->gender == 'female') selected @endif
                                                value="female">انثى </option>

                                    </select>
                                    @error('gender')
                                    <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
                                    @enderror
                                </div>
                              </div>

{{--                                <div class="col-lg-6">--}}
{{--                                    <label class=""> الراتب الكلى</label>--}}
{{--                                    <input--}}
{{--                                        type="number"--}}
{{--                                        value="{{old('gross_salary')?old('gross_salary'):$record->gross_salary}}"--}}
{{--                                        name="gross_salary"--}}
{{--                                        required=""--}}
{{--                                        class="form-control m-input"--}}
{{--                                        placeholder=" الراتب الكلى"--}}
{{--                                        id="gross_salary"--}}
{{--                                    />--}}
{{--                                    @error('gross_salary')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                          <strong>{{ $message }}</strong>--}}
{{--                                      </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}


{{--                            </div>--}}



{{--                            <div class="form-group m-form__group row">--}}

{{--                                <div class="col-lg-3">--}}
{{--                                    <label>نوع الضرائب:</label>--}}
{{--                                    <select name="taxes_type" required="" class="form-control m-input m-input--square" id="exampleSelect1">--}}

{{--                                        <option @if(old('taxes_type') == 'Percentage') selected @endif--}}
{{--                                        @if($record->taxes_type == 'Percentage') selected @endif--}}
{{--                                                value="Percentage">Percentage</option>--}}
{{--                                        <option @if(old('taxes_type') == 'Number') selected @endif--}}
{{--                                        @if($record->taxes_type == 'Number') selected @endif--}}
{{--                                        value="Number">Number</option>--}}

{{--                                    </select>--}}
{{--                                    @error('taxes_type')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                          <strong>{{ $message }}</strong>--}}
{{--                                      </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}



{{--                                <div class="col-lg-3">--}}
{{--                                    <label class="">قيمة الضرائب</label>--}}
{{--                                    <input--}}
{{--                                        type="number"--}}
{{--                                        value="{{old('taxes_value')?old('taxes_value'):$record->taxes_value}}"--}}
{{--                                        name="taxes_value"--}}
{{--                                        required=""--}}
{{--                                        class="form-control m-input"--}}
{{--                                        placeholder=" قيمة الضرائب"--}}
{{--                                        id="taxes_value"--}}
{{--                                    />--}}
{{--                                    @error('taxes_value')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                          <strong>{{ $message }}</strong>--}}
{{--                                      </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}







{{--                                <div class="col-lg-3">--}}
{{--                                    <label>نوع التامين:</label>--}}
{{--                                    <select name="insurance_type" required="" class="form-control m-input m-input--square" id="exampleSelect1">--}}

{{--                                        <option @if(old('insurance_type') == 'Percentage') selected @endif--}}
{{--                                        @if($record->insurance_type == 'Percentage') selected @endif--}}
{{--                                        value="Percentage">Percentage</option>--}}
{{--                                        <option @if(old('insurance_type') == 'Number') selected @endif--}}
{{--                                        @if($record->insurance_type == 'Number') selected @endif--}}
{{--                                        value="Number">Number</option>--}}

{{--                                    </select>--}}
{{--                                    @error('insurance_type')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                          <strong>{{ $message }}</strong>--}}
{{--                                      </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}



{{--                                <div class="col-lg-3">--}}
{{--                                    <label class="">قيمة التامين</label>--}}
{{--                                    <input--}}
{{--                                        type="number"--}}
{{--                                        value="{{old('insurance_value')?old('insurance_value'):$record->insurance_value}}"--}}
{{--                                        name="insurance_value"--}}
{{--                                        required=""--}}
{{--                                        class="form-control m-input"--}}
{{--                                        placeholder=" قيمة التامين"--}}
{{--                                        id="insurance_value"--}}
{{--                                    />--}}
{{--                                    @error('insurance_value')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                          <strong>{{ $message }}</strong>--}}
{{--                                      </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}




{{--                            </div>--}}








<div class="form-group m-form__group row">
  <div class="col-lg-6">
      <label> عنوان المراسالات:</label>
      <textarea
          name="sending_address"
          class="form-control m-input"
      > {{ $record->sending_address }} </textarea>
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
          value="{{old('secondPhone')?old('secondPhone'):$record->secondPhone}}"
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
      > {{ $record->medical_condition }} </textarea>
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
      >{{ $record->medications_in_emergecies }} </textarea>
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
          value="{{old('insurance_date')?old('insurance_date'):$record->insurance_date}}"
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
          value="{{old('contract_end_date')?old('contract_end_date'):$record->contract_end_date}}"
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
          value="{{old('health_certificate_end_date')?old('health_certificate_end_date'):$record->health_certificate_end_date}}"
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
          value="{{old('national_id_end_date')?old('national_id_end_date'):$record->national_id_end_date}}"
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
          value="{{old('hours_per_days')?old('hours_per_days'):$record->hours_per_days}}"
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
          value="{{old('start_hour')?old('start_hour'):$record->start_hour}}"
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
          value="{{old('end_hour')?old('end_hour'):$record->end_hour}}"
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
          value="{{old('extra_hour_price')?old('extra_hour_price'):$record->extra_hour_price}}"
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
   >{{old('training_description')?old('training_description'):$record->training_description}} </textarea>
    @error('training_description')
    <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>



                            </div>


                            <div class="form-group m-form__group row">
                                <div class="col-lg-6">
                                    <label class=""> ارفاق ملف </label>
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




                            </div>

                            </div>
</div>



<h3> بيانات الادمن للموظف :  </h3>
@if($record->isSystemUser == 1)
    <input type="hidden" name="isSystemUser" value="1"/>
                            <div class="form-group m-form__group row adminSection">
                                <div class="col-lg-4">
                                    <label> اسم المستخدم:</label>
                                    <input
                                        type="text"
                                        value="{{old('user_name')?old('user_name'):$record->org_admin->name}}"
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
                                            <option @if(old('role') == $role->id) selected @endif
                                            @if($record->org_admin->role_id == $role->id) selected @endif
                                                    value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                </div>
                            </div>
@endif
 <br>
              <hr>






<h3>بيانات الانتداب للموظف ان وجدت : </h3>
              @if($record->delegated == 1)
                  <input type="hidden" name="isdelegated" value="1"/>
                  <div class="form-group m-form__group row adminSection">
                      <div class="col-lg-4">
                          <label>  الدرجة الوظيفية:</label>
                          <input
                              type="text"
                              value="{{old('functional_class')?old('functional_class'):$record->functional_class}}"
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
                                  value="{{old('functional_class_date')?old('functional_class_date'):$record->functional_class_date}}"
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
                              value="{{old('functional_class_type')?old('functional_class_type'):$record->functional_class_type}}"
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
                              value="{{old('delegated_area')?old('delegated_area'):$record->delegated_area}}"
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
              @endif


              <br>
              <hr>

<h3>بيانات الموظف صاحب الاعاقة ان وجدت : </h3>
              @if($record->is_disabled == 1)
                  <input type="hidden" name="is_disabled" value="1"/>
                  <div class="form-group m-form__group row adminSection">
                      <div class="col-lg-4">
                          <label>   وصف الاعاقة ووصف الاعمال المسموح القيام بها :</label>
                          <textarea
                              name="disabled_desc"
                              class="form-control m-input"
                              cols="5"
                          >{{old('disabled_desc')?old('disabled_desc'):$record->disabled_desc}}</textarea>
                          @error('disabled_desc')
                          <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                          @enderror

                      </div>
                  </div>
              @endif






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
    </script>
</x-organization::layout>
