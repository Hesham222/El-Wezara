<x-admin::layout>
 <x-slot name="pageTitle">المنظمات | اضف</x-slot name="pageTitle">
 @section('organizations-active', 'm-menu__item--active m-menu__item--open')
 @section('organizations-create-active', 'm-menu__item--active')
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
                المنظمات
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
                  <form method="POST" action="{{route('admins.organization.store')}}"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>الاسم:</label>
                                  <input
                                    type="text"
                                    value="{{old('name')}}"
                                    name="name"
                                    required=""
                                    class="form-control m-input"
                                    placeholder="ادخل الاسم..." />
                                  @error('name')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6">
                                  <label class="">العنوان:</label>
                                  <input
                                    type="text"
                                    value="{{old('address')}}"
                                    name="address"
                                    required=""
                                    class="form-control m-input"
                                    placeholder="ادخل العنوان..." />
                                  @error('address')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-12">
                                  <label>الخدمات:</label>
                                  <select
                                    name="services[]"
                                    required
                                    multiple
                                    class="services-id form-control selectpicker"
                                    data-live-search="true">
                                    @foreach($services as $service)
                                        <option
                                            value="{{$service->id}}"
                                              >
                                            {{ $service->name}}
                                        </option>
                                    @endforeach
                                </select>
                              </div>

                          </div>
                      </div>
                      <hr>
                      <h5>المشرف الرئيسي للمنظمة : </h5>
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-4">
                                  <label>الاسم كامل:</label>
                                  <input
                                    type="text"
                                    value="{{old('adminName')}}"
                                    name="adminName"
                                    required=""
                                    class="form-control m-input"
                                    placeholder="ادخل الاسم كامل..." />
                                  @error('adminName')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4">
                                  <label class="">البريد الالكتروني:</label>
                                  <input
                                    type="email"
                                    value="{{old('adminEmail')}}"
                                    name="adminEmail"
                                    required=""
                                    class="form-control m-input"
                                    placeholder="ادخل البريد الالكتروني..." />
                                  @error('adminEmail')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4">
                                  <label class="">الرقم:</label>
                                  <input
                                    type="phone" maxlength="15"
                                    value="{{old('adminPhone')}}"
                                    name="adminPhone"
                                    required=""
                                    class="form-control m-input"
                                    placeholder="ادخل الرقم..."
                                    id="phone"
                                    />
                                  @error('adminPhone')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>الباسورد:</label>
                                  <div class="m-input-icon m-input-icon--right">
                                      <input
                                        type="password"
                                        name="adminPassword"
                                        required=""
                                        class="form-control m-input"
                                        placeholder="ادخل الباسورد..."
                                        maxlength="191"
                                        />

                                  </div>
                                  @error('adminPassword')
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
  </x-slot>

  </x-admin::layout>
