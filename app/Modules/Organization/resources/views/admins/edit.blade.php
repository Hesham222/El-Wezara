<x-organization::layout>
 <x-slot name="pageTitle">المشرفين | تعديل</x-slot name="pageTitle">
 @section('admins-active', 'm-menu__item--active m-menu__item--open')
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
                المشرفين
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
                  <form method="POST" action="{{route('organizations.admin.update', $record->id)}}"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" enctype="multipart/form-data">
                      @csrf
                      @method('put')
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>الاسم كامل:</label>
                                  <input
                                    type="text"
                                    value="{{old('name')?old('name'):$record->name}}"
                                    name="name"
                                    required=""
                                    class="form-control m-input"
                                    placeholder="ادخل الاسم كامل..." />
                                  @error('name')
                                     <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6">
                                  <label class="">البريد الالكتروني:</label>
                                  <input
                                    type="email"
                                    value="{{old('email')?old('email'):$record->email}}"
                                    name="email"
                                    required=""
                                    class="form-control m-input"
                                    placeholder="ادخل البريد الالكتروني..." />
                                  @error('email')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label class="">الرقم:</label>
                                  <input
                                    type="text"
                                    name="phone"
                                    value="{{old('phone')?old('phone'):$record->phone}}"
                                    required=""
                                    class="form-control m-input"
                                    placeholder="ادخل الرقم..."
                                    maxlength="15" id="phone">
                                  @error('phone')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6">
                                  <label>الادوار:</label>
                                      <select name="role" required="" class="form-control m-input m-input--square" id="exampleSelect1">
                                          @foreach($roles as $role)
                                              <option @if($role->id == $record->role_id) selected @endif value="{{ $role->id }}">{{ $role->name }}</option>
                                          @endforeach
                                      </select>
                                  @error('role')
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
    <script type="text/javascript">
      var input = document.getElementById("phone");
      input.onkeypress = function (e)
      {
          e = e || window.event;
          var charCode = (typeof e.which == "number") ? e.which : e.keyCode;
          if (!charCode || charCode == 8 /* Backspace */)
              return;
          var typedChar = String.fromCharCode(charCode);
          if (/\d/.test(typedChar))
              return;
          if (typedChar == "+" && this.value == "")
              return;
          return false;
      };
    </script>
</x-organization::layout>
