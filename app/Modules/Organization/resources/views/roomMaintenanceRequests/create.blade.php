<x-organization::layout>
 <x-slot name="pageTitle">صيانة الغرف | اضف</x-slot name="pageTitle">
 @section('maintenance-active', 'm-menu__item--active m-menu__item--open')
 @section('maintenance-create-active', 'm-menu__item--active')
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
                صيانة الغرف
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
                  <form method="POST" action="{{route('organizations.roomMaintenanceRequest.store')}}"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-3">
                                  <label>أختر الفندق:</label>
                                  <select name="hotel" id="hotel-list" required="" class="form-control m-input m-input--square" id="exampleSelect1" >
                                      <option>أختر الفندق</option>
                                      @foreach($hotels as $hotel)
                                          <option @if(old('hotel') == $hotel->id) selected @endif value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                      @endforeach
                                  </select>
                                  @error('hotel')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-3">
                                  <label>أختر الغرفة:</label>
                                  <select id="rooms-list" name="room" class="form-control"></select>
                              </div>
                              <div class="col-lg-3">
                                  <label>تعيين موظف (اختياري):</label>
                                  <select name="employee" class="form-control m-input m-input--square" id="exampleSelect1" >
                                      <option value="">أختر موظف</option>
                                      @foreach($employees as $employee)
                                          <option @if(old('employee') == $employee->id) selected @endif value="{{ $employee->id }}">{{ $employee->name }}</option>
                                      @endforeach
                                  </select>
                                  @error('employee')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label for="notes">ملاحظات:</label>
                                  <textarea id="notes" name="notes" rows="4" cols="50">{{ old('notes') }}</textarea>
                                  @error('notes')
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
      <script>
          $(document).ready(function () {
              $('#hotel-list').on('change', function () {
                  var hotelId = this.value;
                  $("#rooms-list").html('');
                  $.ajax({
                      url: "{{route('organizations.roomMaintenanceRequest.hotel.rooms')}}",
                      type: "POST",
                      data: {
                          hotel_id: hotelId,
                          _token: '{{csrf_token()}}'
                      },
                      dataType: 'json',
                      success: function (result) {
                          $('#rooms-list').html('<option value="">-- أختر الغرفة --</option>');
                          $.each(result, function (key, value) {
                              $("#rooms-list").append('<option value="' + value

                                  .id + '">' + value.room_num + '</option>');
                          });
                      }
                  });
              });
          });
      </script>
  </x-slot>
</x-organization::layout>
