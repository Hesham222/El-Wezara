<x-organization::layout>
 <x-slot name="pageTitle">مدربين لحسابهم الخاص | اضف</x-slot name="pageTitle">
 @section('freelance-trainers-active', 'm-menu__item--active m-menu__item--open')
 @section('freelance-trainers-create-active', 'm-menu__item--active')
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
                مدربين لحسابهم الخاص
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
                  <form method="POST" action="{{route('organizations.freelanceTrainer.store')}}" enctype="multipart/form-data"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-4">
                                  <label>اسم المدرب :</label>
                                  <input
                                    type="text"
                                    value="{{old('name')}}"
                                    name="name"
                                    required=""
                                    class="form-control m-input"
                                    placeholder="ادخل المدرب..." />
                                  @error('name')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4">
                                  <label>رقم التليفون :</label>
                                  <input
                                      type="number"
                                      value="{{old('phone')}}"
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
                              <div class="col-lg-4">
                                  <label>رياضه النادي:</label>
                                  <select name="club_sport_id" required=""
                                          class="form-control m-input m-input--square"
                                          id="exampleSelect1">
                                      @foreach($clubSports as $clubSport)
                                          <option @if(old('club_sport_id')== $clubSport->id) selected @endif
                                          value="{{ $clubSport->id }}">{{ $clubSport->name }}
                                          </option>
                                      @endforeach
                                  </select>
                                  @error('club_sport_id')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>العموله :</label>
                                  <input
                                      type="number"
                                      step="0.01"
                                      value="{{old('commission')}}"
                                      name="commission"
                                      required=""
                                      class="form-control m-input"
                                       />
                                  @error('commission')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6">
                                  <label for="description">التفاصيل:</label>
                                  <textarea id="note" name="note" rows="4" cols="50">{{ old('description') }}</textarea>
                                  @error('note')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label for="files" class="from-label mt-4">ارفق الملف للرقم القومي:</label>
                                  <input name="attachment" id="attachment" type="file">
                              </div>
                              <div class="col-lg-6">
                                  <label>الرقم القومي :</label>
                                  <input
                                      type="number"
                                      value="{{old('national_id')}}"
                                      name="national_id"
                                      required=""
                                      class="form-control m-input"
                                      />
                                  @error('national_id')
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
