<x-organization::layout>
 <x-slot name="pageTitle">فئات مكونات الوجبات | اضف</x-slot name="pageTitle">
 @section('ingredientCategories-active', 'm-menu__item--active m-menu__item--open')
 @section('ingredientCategories-create-active', 'm-menu__item--active')
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
                فئات مكونات الوجبات
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
                  <form method="POST" action="{{route('organizations.ingredientCategory.store')}}"
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
                                      placeholder="اسم الفئه..." />
                                  @error('name')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6">
                                  <div class="col-lg-6">
                                      <label>أختر في حاله وجود فئه تابع لها:</label>
                                      <select name="parent_id" required="" class="form-control m-input m-input--square" id="exampleSelect1">
                                          <option value="0">لا يوجد</option>
                                          @foreach($categories as $category)
                                              <option @if(old('parent_id')) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                          @endforeach
                                      </select>
                                      @error('parent_id')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror
                                  </div>
                              </div>
                          </div>

                          <div class="form-group m-form__group row">
                              <div class="col-lg-12">
                              <label for="description">التفاصيل:</label>
                              <textarea id="description" name="description" rows="4" cols="50">{{ old('description') }}</textarea>
                              @error('description')
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

    </x-slot>
</x-organization::layout>
