<x-organization::layout>
 <x-slot name="pageTitle">المغاسل  | تعديل</x-slot name="pageTitle">
 @section('hotelInventories-active', 'm-menu__item--active m-menu__item--open')
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
                  <form method="POST" action="{{route('organizations.hotelInventory.save')}}"enctype="multipart/form-data"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      @method('post')
                      <div class="m-portlet__body">

                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>الكميه قبل الجرد:</label>
                                  <input
                                      type="text"
                                      name="hotel"
                                      id="hotel"
                                      value="{{old('hotel')?old('hotel'):$record->hotel->name}}"
                                      required=""
                                      class="form-control m-input"
                                      readonly
                                      disabled>
                                  @error('hotel')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6">
                                  <label>الكميه قبل الجرد:</label>
                                  <input
                                      type="text"
                                      name="ingredient"
                                      id="ingredient"
                                      value="{{old('ingredient')?old('ingredient'):$record->ingredient->name}}"
                                      required=""
                                      class="form-control m-input"
                                      readonly
                                      disabled>
                                  @error('ingredient')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6">
                                  <input
                                      type="number"
                                      name="inventory"
                                      value="{{$record->id}}"
                                      required=""
                                      class="form-control m-input"
                                      readonly
                                      hidden>
                                  @error('ingredient')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>

                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-4">
                                  <label>الكميه قبل الجرد:</label>
                                  <input
                                      type="number"
                                      step="0.01"
                                      name="old_quantity"
                                      id="old_quantity"
                                      value="{{old('old_quantity')?old('old_quantity'):$record->quantity}}"
                                      required=""
                                      class="form-control m-input"
                                      readonly
                                      disabled
                                  >
                                  @error('old_quantity')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4">
                                  <label>الاستهلاك:</label>
                                  <input
                                      type="number"
                                      step="0.01"
                                      name="used"
                                      id="used"
                                      value=""
                                      required=""
                                      class="form-control m-input">
                                  @error('used')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4">
                                  <label>الكميه بعد الجرد:</label>
                                  <input
                                      type="number"
                                      step="0.01"
                                      name="new_quantity"
                                      id="new_quantity"
                                      value="{{old('new_quantity')}}"
                                      required=""
                                      class="form-control m-input"
                                      readonly>
                                  @error('new_quantity')
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
        <script>
            $('#used').on('change',function (){
                var old = $('#old_quantity').val()
                var used = $(this).val()
                $('#new_quantity').val(parseInt(old - used))
            })
        </script>
    </x-slot>

</x-organization::layout>

