<x-organization::layout>
 <x-slot name="pageTitle">المستأجرين | تعديل</x-slot name="pageTitle">
 @section('tenants-active', 'm-menu__item--active m-menu__item--open')
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
                المستأجرين
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
                  <form method="POST" action="{{route('organizations.tenant.update', $record->id)}}"enctype="multipart/form-data"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      @method('put')
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>اسم المستأجر:</label>
                                  <input
                                      type="text"
                                      value="{{old('name')?old('name'):$record->name}}"
                                      name="name"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="ادخل اسم المستأجر..." />
                                  @error('name')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-3">
                                  <label>اسم الشخص المسئول:</label>
                                  <input
                                      type="text"
                                      value="{{old('primaryName')?old('primaryName'):$record->primary_name}}"
                                      name="primaryName"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="ادخل اسم الشخص المسئول..." />
                                  @error('primaryName')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-3">
                                  <label>تليفون الشخص المسئول:</label>
                                  <input
                                      type="phone" maxlength="15"
                                      value="{{old('primaryPhone')?old('primaryPhone'):$record->primary_phone}}"
                                      name="primaryPhone"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="ادخل تليفون الشخص المسئول..."
                                      id="phone"/>
                                  @error('primaryPhone')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-3">
                                  <label for="files" class="from-label mt-4">ارفق الملفات:</label>
                                  <input
                                      name="attachment[]"
                                      class="form-control m-input"
                                      type="file" multiple="multiple"
                                  />
                                  @error('image')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-3">
                                      @foreach ($record->attachments as $attachment)

                                        @if(pathinfo($attachment->attachment, PATHINFO_EXTENSION) == 'pdf')
                                          <a target="_blank" href="{{asset('storage'.DS().$attachment->attachment)}}">View pdf</a>
                                          <input type="hidden" name="pdf" value="{{ $attachment->attachment}}">
                                          <div style="margin-bottom: 5px">
                                              <a name="attachment" title="Delete image"  href="{{route('organizations.tenant.file.destroy', $attachment->id)}}"  class="confirmDelete"><i class="fas fa-trash"></i>
                                              </a>
                                          </div>
                                        @else
                                          <div style="margin-bottom: 3px">
                                              <img src="{{asset('storage'.DS().$attachment->attachment)}}" alt="file-not-uploaded" width="100"></td>
                                          </div>
                                          <div style="margin-bottom: 5px">
                                              <a name="attachment" title="Delete image"  href="{{route('organizations.tenant.file.destroy', $attachment->id)}}"  class="confirmDelete"><i class="fas fa-trash"></i>
                                              </a>
                                          </div>
                                        @endif

                                      @endforeach
                              </div>
                          </div>

                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label for="notes">ملاحظات:</label>
                                  <textarea id="notes" name="notes" rows="4" cols="50">{{old('notes')?old('notes'):$record->notes}}</textarea>
                                  @error('notes')
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

