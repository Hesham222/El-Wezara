<x-organization::layout>
 <x-slot name="pageTitle">المشتركين  | تعديل</x-slot name="pageTitle">
 @section('subscribers-active', 'm-menu__item--active m-menu__item--open')
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
                المشتركين
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
                  <form method="POST" action="{{route('organizations.subscriber.update', $record->id)}}"enctype="multipart/form-data"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      @method('put')
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>اسم المشترك:</label>
                                  <input
                                      type="text"
                                      value="{{old('name')?old('name'):$record->name}}"
                                      name="name"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="اسم المشترك..." />
                                  @error('name')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6">
                                  <label>نوع المشترك:</label>

                                  <select name="subscriber_type_id" required=""
                                          class="form-control m-input m-input--square"
                                          id="exampleSelect1">
                                      @foreach($subscriberTypes as $subscriberType)
                                          <option @if(old('subscriber_type_id')== $subscriberType->id || $subscriberType->id==$record->subscriber_type_id) selected @endif
                                          value="{{ $subscriberType->id }}">{{ $subscriberType->type }}
                                          </option>
                                      @endforeach
                                  </select>
                                  @error('subscriber_type_id')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>

                          </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>الرقم:</label>
                                  <input
                                      type="number"
                                      value="{{old('phone')?old('phone'):$record->phone}}"
                                      name="phone"
                                      required=""
                                      class="form-control m-input"
                                     />
                                  @error('phone')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6">
                                  <label>الرقم الثاني :</label>
                                  <input
                                      type="number"
                                      value="{{old('second_phone')?old('second_phone'):$record->second_phone}}"
                                      name="second_phone"
                                      class="form-control m-input"
                                  />
                                  @error('second_phone')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>ارفق الملف للرقم القومي:</label>
                                  <input
                                      type="file"
                                      name="attachment"
                                      class="form-control m-input"
                                  />
                                  @if($record->attachment)
                                      @if(pathinfo($record->attachment, PATHINFO_EXTENSION) == 'pdf')
                                          <a target="_blank" href="{{asset('storage'.DS().$record->attachment)}}">View pdf</a>
                                          <input type="hidden" name="pdf" value="{{ $record->attachment}}">
                                      @else
                                          @if(filter_var($record->attachment, FILTER_VALIDATE_URL))
                                              <img src="{{ $record->attachment }}" alt="image-not-uploaded" width="100"></td>
                                          @else
                                              <img src="{{asset('storage'.DS().$record->attachment)}}" alt="image-not-uploaded" width="100"></td>
                                          @endif
                                      @endif

                                  @endif
                                  @error('attachment')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6">
                                  <label>الرقم القومي:</label>
                                  <input
                                      type="number"
                                      value="{{old('national_id')?old('national_id'):$record->national_id}}"
                                      name="national_id"
                                      required=""
                                      class="form-control m-input"
                                      />
                                  @error('commission')
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

