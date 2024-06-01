<x-organization::layout>
 <x-slot name="pageTitle">أسعار التذاكر | اضف</x-slot name="pageTitle">
 @section('ticket-prices-active', 'm-menu__item--active m-menu__item--open')
 @section('ticket-prices-create-active', 'm-menu__item--active')
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
                أسعار التذاكر
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
                  <form method="POST" action="{{route('organizations.ticketPrice.store')}}"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>فئة التذكرة:</label>
                                  <select name="category" required="" class="form-control m-input m-input--square" id="exampleSelect1">
                                      @foreach($categories as $category)
                                          <option @if(old('category') == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                      @endforeach
                                  </select>
                                  @error('category')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              @foreach($subCategories as $subCategory)
                                  <div class="col-lg-3">
                                      <label>سعر {{ $subCategory->name }}:</label>
                                      <input
                                          type="number"
                                          min="0" step="1"
                                          value=""
                                          name="prices[{{ $subCategory->id }}]"
                                          required=""
                                          class="form-control m-input"
                                          placeholder="ادخل سعر فئة التذكرة..." />
                                  </div>
                              @endforeach
                                  @error('prices')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
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
