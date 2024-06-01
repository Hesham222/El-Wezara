<x-organization::layout>
 <x-slot name="pageTitle">المغاسل  | تعديل</x-slot name="pageTitle">
 @section('laundries-active', 'm-menu__item--active m-menu__item--open')
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
                المغاسل
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
                  <form method="POST" action="{{route('organizations.laundry.update', $record->id)}}"enctype="multipart/form-data"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      @method('put')
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>اسم المغسله:</label>
                                  <input
                                      type="text"
                                      value="{{old('name')?old('name'):$record->name}}"
                                      name="name"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="اسم المغسله..." />
                                  @error('name')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6">
                                  <label>رئيس المغسله :</label>

                                  <select name="head_id" required=""
                                          class="form-control m-input m-input--square"
                                          id="exampleSelect1">
                                      @foreach($employees as $employee)
                                          <option @if(old('head_id')== $employee->id || $employee->id==$record->head_id) selected @endif
                                          value="{{ $employee->id }}">{{ $employee->name }}
                                          </option>
                                      @endforeach
                                  </select>
                                  @error('head_id')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>

                          </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>موظفي المغسله  :</label>

                                  <select name="employee_id[]"  multiple
                                          class="form-control m-input m-input--square"
                                          id="exampleSelect1">
                                  @foreach($employees as $employee)
{{--                                          <option @if(old('employee_id')== $employee->id || $employee->id==$record->employee_id) selected @endif--}}
{{--                                          value="{{ $employee->id }}">{{ $employee->name }}--}}
{{--                                          </option>--}}
{{--                                          <option value="{{$employee->id }}" {{is_array($record->employees) && in_array($employee->id, $record->employees) ? 'selected' : '' }}> {{$employee->name}}</option>--}}
                                          <option @if(!is_null($record->employees->where('employee_id',$employee->id)->first())) selected @endif value="{{ $employee->id }}">{{ $employee->name }}</option>
                                      @endforeach
                                  </select>
                                  @error('employee_id')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6">
                                  <label for="description">التفاصيل:</label>
                                  <textarea id="description" name="description" rows="4" cols="50">{{ $record->description }}</textarea>
                                  @error('description')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>

                          </div>
                          <div class="form-group m-form__group row">

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

