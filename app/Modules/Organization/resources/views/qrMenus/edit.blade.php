<x-organization::layout>
 <x-slot name="pageTitle">Qr Menus | تعديل</x-slot name="pageTitle">
 @section('qrMenus-active', 'm-menu__item--active m-menu__item--open')
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
                Qr Menus
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
                  <form method="POST" action="{{route('organizations.qrMenu.update', $record->id)}}" enctype="multipart/form-data"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      @method('put')
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>أسم المنيو:</label>
                                  <input
                                      type="text"
                                      value="{{$record->name}}"
                                      name="name"
                                      required=""
                                      class="form-control m-input"
                                      id="contract_input_val"
                                      placeholder="أدخل أسم المنيو..." />
                                  @error('name')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6">
                                  <label>ارفق المنيو:</label>
                                  <input
                                      type="file"
                                      name="menu"
                                      class="form-control m-input"
                                  />
                                  @if($record->menu)
                                      @if(pathinfo($record->menu, PATHINFO_EXTENSION) == 'pdf')
                                          <a target="_blank" href="{{asset('storage'.DS().$record->menu)}}">View pdf</a>
                                          <input type="hidden" name="pdf" value="{{ $record->menu}}">
                                      @else
                                          @if(filter_var($record->menu, FILTER_VALIDATE_URL))
                                              <img src="{{ $record->menu }}" alt="image-not-uploaded" width="100"></td>
                                          @else
                                              <img src="{{asset('storage'.DS().$record->menu)}}" alt="image-not-uploaded" width="100"></td>
                                          @endif
                                      @endif
                                  @endif
                                  @error('menu')
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
    <!-- Some JS -->
  </x-slot>
</x-organization::layout>

