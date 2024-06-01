@if(count($records))
@foreach($records as $record)



    <tr id="tableRecord-{{$record->id}}">
         <td>{{$record->id}}</td>
    <td>{{$record->name}}</td>
 @foreach($dates as $date)
    <td>

 <form method="POST" action="{{route('organizations.employeeAttendance.storeAttendance')}}"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" enctype="multipart/form-data">
                      @csrf

                      <input type="hidden" name="emp_id" value="{{$record->id}}">

                      <input type="hidden" name="date" value="{{$date}}">

                      <div class="form-group m-form__group row">
                              <div class="col-lg-12">

                                  <label class=""> وقت الوصول</label>
                                  <input
                                      type="time"
                                      value="@if(!$record->checkAttendanceDate($date)){{old('checkIn')}} @else{{$record->checkAttendanceDate($date)->checkIn}}@endif"
                                      name="checkIn"
                                      required=""
                                      class="form-control m-input"

                                  />
                                  @error('checkIn')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group m-form__group row">
                              <div class="col-lg-12">
                                  <label class=""> وقت المغادرة </label>
                                  <input
                                      type="time"
                                      value="@if(!$record->checkAttendanceDate($date)){{old('checkOut')}}@else{{$record->checkAttendanceDate($date)->checkOut}}@endif"
                                      name="checkOut"
                                      required=""
                                      class="form-control m-input"

                                  />
                                  @error('checkOut')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <h3> عدد ساعات العمل : {{$record->checkAttendanceDate($date)?$record->workingHours($date):'--'}}</h3>
                          </div>

                          <div class="form-group m-form__group row">
                              <div class="col-lg-12">
                                  <label class=""> الوقت الاضافى</label>
                                  <input
                                      type="number"
                                      value="@if(!$record->checkAttendanceDate($date)){{old('overTimeDuration')}}@else{{$record->checkAttendanceDate($date)->overTimeDuration}}@endif"
                                      name="overTimeDuration"
                                    step="0.1"
                                      class="form-control m-input"

                                  />
                                  @error('overTimeDuration')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <h3>
                              	@if($record->checDesmissOverTime($date))
                              			تم تجاهل الساعات الاضافية
                              	@else
                              		لم يتم تجاهل الساعات الاضافية

                              	@endif
                              </h3>
                          </div>


<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                          <div class="m-form__actions m-form__actions--solid">


                              <div class="row">
                                  <div class="col-lg-3"></div>
                                  @if(!$record->checkIsVacation($date))

                                  	@if(!$record->checkAproovedHoursDate($date))
                                  <div class="col-lg-3 m--align-right">
                                      <button type="submit" class="btn btn-primary">حفظ</button>
                                  </div>


                                  <div class="col-lg-3 m--align-right">
                                  		<a href="{{route('organizations.employeeAttendance.vacation',[$record->id,$date])}}" class="btn btn-warning">اجازة</a>
	                                  </div>

	                                 @endif

	                                  @else
	                                  هذا اليوم مأخوذ اجازة
	                                  @endif
                              </div>
                              @if(!$record->checkIsVacation($date))
                              <div class="row">

                              			@if(!$record->checkAproovedHoursDate($date))
                              	  <div class="col-lg-3 m--align-right">
                                  		<a href="{{route('organizations.employeeAttendance.dessmissOverTime',[$record->id,$date])}}" class="btn btn-success">تجاهل الساعات الاضافسية</a>
	                                  </div>
	                                  @endif
                              </div>
                              @endif

                              @if($record->checkAttendanceDate($date) && !$record->checkIsVacation($date))
                              @if(!$record->checkAproovedHoursDate($date))
                              <div class="row">
                              	  <div class="col-lg-3 m--align-right">
                                  		<a href="{{route('organizations.employeeAttendance.approveHours',[$record->id,$date])}}" class="btn btn-success">الموافقة على تفاصيل اليوم  </a>
	                                  </div>
                              </div>

                              @else
                              تم اعتماد بيانات اليوم
                              @endif
                                @endif
                          </div>
                      </div>

                  </form>
    </td>
     @endforeach
</tr>


@endforeach


@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
