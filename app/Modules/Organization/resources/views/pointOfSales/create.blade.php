<x-organization::layout>
 <x-slot name="pageTitle">نقط البيع  | اضف</x-slot name="pageTitle">
 @section('pointOfSales-active', 'm-menu__item--active m-menu__item--open')
 @section('pointOfSales-create-active', 'm-menu__item--active')
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
                نقاط البيع
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
                  <form method="POST" action="{{route('organizations.pointOfSale.store')}}" enctype="multipart/form-data"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>اسم المنطقه :</label>
                                  <input
                                    type="text"
                                    value="{{old('name')}}"
                                    name="name"
                                    required=""
                                    class="form-control m-input"
                                    placeholder="ادخل الخدمه..." />
                                  @error('name')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6">
                                  <label>مدير المنطقه</label>
                                  <select name="manager_id" required=""
                                          class="form-control m-input m-input--square selectpicker"
                                          id="exampleSelect1">
                                      <option value="">--اختر مدير المنطقه--</option>
                                      @foreach($employees as $employee)
                                          <option @if(old('manager_id')== $employee->id) selected @endif
                                          value="{{ $employee->id }}">{{ $employee->name }}
                                          </option>
                                      @endforeach
                                  </select>
                                  @error('manager_id')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label> الفئه</label>
                                  <select name="items[]" required="" class="form-control m-input m-input--square" id="exampleSelect1" multiple>
                                      @foreach($items as $item)
                                          <option @if(old('item_id')== $item->id) selected @endif
                                          value="{{ $item->id }}">{{ $item->name }}
                                          </option>
                                      @endforeach
                                  </select>
                                  @error('items')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6">
                                  <label>الموظفين</label>
                                  <select name="employees[]" required="" class="form-control m-input m-input--square" id="exampleSelect1" multiple>
                                      @foreach($employees as $employee)
                                          <option @if(old('employee_id')== $employee->id) selected @endif
                                          value="{{ $employee->id }}">{{ $employee->name }}
                                          </option>
                                      @endforeach
                                  </select>
                                  @error('employees')
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

    </x-slot>
</x-organization::layout>
