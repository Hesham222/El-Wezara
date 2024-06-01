<x-organization::layout>
 <x-slot name="pageTitle">فئات المغاسل  | تعديل</x-slot name="pageTitle">
 @section('laundrySubCategories-active', 'm-menu__item--active m-menu__item--open')
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
                 فئات المغاسل الفرعيه
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
                  <form method="POST" action="{{route('organizations.laundrySubCategory.update', $record->id)}}"enctype="multipart/form-data"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      @method('put')
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>الفئه الرئيسيه</label>
                                  <select name="parent_id" required=""
                                          class="form-control m-input m-input--square selectpicker"
                                          id="exampleSelect1">
                                      <option value="">--اختر الفئه الرئيسيه--</option>
                                      @foreach($categories as $category)
                                          <option @if( old('parent_id') == $category->id || $record->parent_id == $category->id) selected @endif
                                          value="{{ $category->id }}">{{ $category->name }}
                                          </option>
                                      @endforeach
                                  </select>
                                  @error('parent_id')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6">
                                  <label>اسم الفئه الفرعيه:</label>
                                  <input
                                      type="text"
                                      value="{{ $record->name }}"
                                      name="name"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="ادخل الفئه..." />
                                  @error('name')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-12">
                                  <label class="">الخدمات:</label><br>
                                  <table  width="100%" class="table table-striped- table-bordered table-hover table-checkable" id="services-table">
                                      <col style="width:30%">
                                      <col style="width:20%">
                                      <col style="width:20%">
                                      <col style="width:30%">
                                      <col style="width:10%">
                                      <thead>
                                      <tr>
                                          <th style="font-weight: bold;">الخدمه</th>
                                          <th style="font-weight: bold;">السعر</th>
                                          <th style="font-weight: bold;">مسح</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      @foreach($record->laundrySubCategoryServices as $value)
                                          <tr class="nearest">
                                              <td>
                                                  <select name="services[]" id="services" required=""
                                                          class="form-control m-input m-input--square services"
                                                          id="exampleSelect1">
                                                      <option value="" disabled selected>Please select a Service</option>
                                                      @foreach($services as $service)
                                                          <option @if($value->laundry_service_id == $service->id) selected @endif
                                                          value="{{ $service->id }}">{{ $service->name }}
                                                          </option>
                                                      @endforeach
                                                  </select>
                                              </td>
                                              <td>
                                                  <input
                                                      type="number"
                                                      step="0.01"
                                                      value="{{old('service_price[]') ? old('service_price[]'):$value->price}}"
                                                      name="service_price[]"
                                                      required=""
                                                      class="form-control m-input service_price"
                                                      placeholder="ادخل السعر..." />

                                              </td>
                                              <td>
                                                  <a
                                                      title="Remove the row"
                                                      class="btn btn-sm btn-danger"
                                                      onclick="DeleteServiceRowTable(this)">
                                                      <i class="fa fa-times" style="color: #fff"></i>
                                                  </a>
                                              </td>
                                          </tr>
                                      @endforeach
                                      </tbody>
                                  </table>
                                  <div class="row">
                                      <div class="col-lg-12">
                                          <button type="button" class="btn btn-default " id="new_service_row"><i class="fa fa-plus"></i></button>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label for="description">التفاصيل:</label>
                                  <textarea id="description" name="description" rows="4" cols="50">{{ $record->description }}</textarea>
                                  @error('description')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6"></div>
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

