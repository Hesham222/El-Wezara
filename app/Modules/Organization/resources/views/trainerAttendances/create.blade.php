<x-organization::layout>
 <x-slot name="pageTitle">تدريبات اليوم | اضف</x-slot name="pageTitle">
 @section('trainerAttendances-active', 'm-menu__item--active m-menu__item--open')
 @section('trainerAttendances-create-active', 'm-menu__item--active')
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
                تدريبات اليوم
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
                    تأكيد الحضور للمدربين
                </h3>
              </div>
            </div>
          </div>
          <div class="m-portlet__body">
            <div class="table-responsive">
                <section class="content">

                      <table class="table table-condensed">
                          <thead>
                          <tr>
                              <th> التعريف</th>
                              <th>اسم المدرب</th>
                              <th> </th>
                              <th>رقم التليفون</th>
                              <th>اسم التدريب</th>
                              <th> </th>
                              <th> اليوم</th>
                              <th>وقت التدريب</th>
                              <th> حضور</th>
                              <th> غياب</th>
                          </tr>
                          </thead>
                          <tbody>
                          @if(count($trainingsToday))
                              @foreach($trainingsToday as $schedule)
                          <form method="POST" action="{{route('organizations.trainerAttendance.store')}}" enctype="multipart/form-data"
                              class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                          @csrf
                          <tr>
                              <td>{{$schedule->Training->FreelanceTrainer->id?$schedule->Training->FreelanceTrainer->id:"لا يوجد"}}</td>
                              <td>
                                  <input
                                      type="text"
                                      value="{{$schedule->Training->FreelanceTrainer?$schedule->Training->FreelanceTrainer->name:"لا يوجد"}}"
                                      required=""
                                      name="freelance_trainer"
                                      class="form-control m-input"
                                      readonly="readonly"/>
                                  @error('freelance_trainer_id')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </td>
                              <td>
                                  <input
                                      type="text"
                                      value="{{$schedule->Training->FreelanceTrainer?$schedule->Training->FreelanceTrainer->id:"لا يوجد"}}"
                                      required=""
                                      hidden
                                      name="freelance_trainer_id"
                                      class="form-control m-input"
                                      readonly="readonly"/>
                                  @error('freelance_trainer_id')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </td>
                              <td>
                                  <input
                                      type="text"
                                      value="{{$schedule->Training->FreelanceTrainer->phone?$schedule->Training->FreelanceTrainer->phone:"لا يوجد"}}"
                                      required=""
                                      name="phone"
                                      class="form-control m-input"
                                      readonly="readonly"/>
                                  @error('phone')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </td>
                              <td>
                                  <input
                                      type="text"
                                      value="{{$schedule->Training?$schedule->Training->name:"لا يوجد"}}"
                                      required=""
                                      name="training"
                                      class="form-control m-input"
                                      readonly="readonly"/>
                                  @error('training_id')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </td>
                              <td>
                                  <input
                                      type="text"
                                      value="{{$schedule->Training?$schedule->Training->id:"لا يوجد"}}"
                                      required=""
                                      hidden
                                      name="training_id"
                                      class="form-control m-input"
                                      readonly="readonly"/>
                                  @error('training_id')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </td>
                              <td>
                                  <input
                                      type="text"
                                      value="{{$schedule->day?$schedule->day:"لا يوجد"}}"
                                      required=""
                                      name="day"
                                      class="form-control m-input"
                                      readonly="readonly"/>
                                  @error('day')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </td>
                              <td>
                                  <input
                                      type="text"
                                      value="{{$schedule->start_time?$schedule->start_time:"لا يوجد"}}"
                                      required=""
                                      name="train_time"
                                      class="form-control m-input"
                                      readonly="readonly"/>
                                  @error('train_time')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </td>
                              <td>
                                  <button type="submit" name="attendance" value="1" class="btn btn-primary">حضر</button>
                              </td>
                              <td>
                                  <button type="submit" name="attendance" value="0" class="btn btn-danger">غاب</button>

                              </td>
                          </tr>
                          </form>
                          @endforeach
                          @else
                              <tr>
                                  <td colspan="8" style="text-align:center;">
                                      لا توجد سجلات تطابق المدخلات الخاصة بك.
                                  </td>
                              </tr>
                          @endif
                          </tbody>
                      </table>
                </section>
            </div>
          </div>
        </div>
      </div>
    <!-- end page content -->
    <x-slot name="scripts">
        <script>
            form.addEventListener('submit', () => {
                if (document.getElementById("yes").checked) {
                    document.getElementById('no').disabled = true;
                }
            })
        </script>
    </x-slot>
</x-organization::layout>
