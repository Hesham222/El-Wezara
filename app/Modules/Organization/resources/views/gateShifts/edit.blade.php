<x-organization::layout>
 <x-slot name="pageTitle">ادارة البوابات | تعديل</x-slot name="pageTitle">
 @section('gate-shifts-active', 'm-menu__item--active m-menu__item--open')
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
                ادارة البوابات
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
                  <form method="POST" action="{{route('organizations.gateShift.update', $record->id)}}"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      @method('put')
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>أختر اليوم:</label>
                                  <select name="day" required="" class="form-control m-input m-input--square" id="exampleSelect1">
                                      @foreach($days as $day)
                                          <option @if($record->week_day_id == $day->id) selected @endif value="{{ $day->id }}">{{ $day->name }}</option>
                                      @endforeach
                                  </select>
                                  @error('day')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6">
                                  <label>أختر البوابة:</label>
                                  <select name="gate" required="" class="form-control m-input m-input--square" id="exampleSelect1">
                                      @foreach($gates as $gate)
                                          <option @if($record->gate_id == $gate->id) selected @endif value="{{ $gate->id }}">{{ $gate->name }}</option>
                                      @endforeach
                                  </select>
                                  @error('gate')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>أختر الموظفين:</label>
                                  <select name="admins[]" required="" class="form-control m-input m-input--square" id="exampleSelect1" multiple>
                                      @foreach($admins as $admin)
                                          <option @if(!is_null($record->gateShiftAdmins->where('organization_admin_id',$admin->id)->first())) selected @endif value="{{ $admin->id }}">{{ $admin->name }} - {{ $admin->phone }}</option>
                                      @endforeach
                                  </select>
                                  @error('admins')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              {{--<div class="col-lg-6">
                                  <label for="description">التفاصيل:</label>
                                  <textarea id="description" name="description" rows="4" cols="50">{{ $record->description }}</textarea>
                                  @error('description')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>--}}
                          </div>
                      </div>
                      <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                          <div class="m-form__actions m-form__actions--solid">
                              <div class="row">
                                  <div class="col-lg-6">
                                  </div>
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
  </x-slot>
</x-organization::layout>

