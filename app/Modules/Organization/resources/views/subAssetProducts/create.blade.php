<x-organization::layout>
 <x-slot name="pageTitle">منتجات الأصول | اضف</x-slot name="pageTitle">
 @section('subAssetProducts-active', 'm-menu__item--active m-menu__item--open')
 @section('subAssetProducts-create-active', 'm-menu__item--active')
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
                منتجات الأصول
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
                  <form method="POST" action="{{route('organizations.subAssetProduct.store')}}" enctype="multipart/form-data"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label> الاسم :</label>
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
                                  <label>منتجات الاصول الرئيسيه :</label>
                                  <select required=""
                                          name="assetProduct_id"
                                          id="assetProduct_id"
                                          class="form-control m-input"
                                          id="aspecificUserSelect">
                                      <option value="">-- اختر منتج اصول رئيسي --</option>
                                      @foreach($assetProducts as $assetProduct)
                                          <option value="{{ $assetProduct->id }}">{{ $assetProduct->name}} </option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-4">
                                  <label>قيمه البدايه :</label>
                                  <input
                                      type="number"
                                      step="0.01"
                                      value="{{old('start_value')}}"
                                      name="start_value"
                                      id="start_value"
                                      required=""
                                      class="form-control m-input"
                                  />
                                  @error('start_value')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4">
                                  <label>القيمة الحالية :</label>
                                  <input
                                      type="number"
                                      step="0.01"
                                      value="{{old('current_value')}}"
                                      name="current_value"
                                      id="current_value"
                                      required=""
                                      class="form-control m-input"
                                  />
                                  @error('current_value')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4">
                                  <label>موعد الدخول </label>
                                  <input class="form-control" type="date" name="entry_date" id="entry_date" value="{{ old('entry_date') }}" required>
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

    </x-slot>
</x-organization::layout>
