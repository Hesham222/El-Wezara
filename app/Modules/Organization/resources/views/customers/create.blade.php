<x-organization::layout>
 <x-slot name="pageTitle">العملاء | اضف</x-slot name="pageTitle">
 @section('customers-active', 'm-menu__item--active m-menu__item--open')
 @section('customers-create-active', 'm-menu__item--active')
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
                العملاء
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
                  <form method="POST" action="{{route('organizations.customer.store')}}" enctype="multipart/form-data"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>الاسم :</label>
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
                                  <label>نوع العميل:</label>
                                  <select name="customerType_id" required=""
                                          class="form-control m-input m-input--square"
                                          id="customerType_id">
                                      <option value="">--اختر نوع--</option>
                                  @foreach($customerTypes as $customerType)
                                          <option @if(old('customerType_id')== $customerType->id) selected @endif
                                          value="{{ $customerType->id }}">{{ $customerType->name }}
                                          </option>
                                      @endforeach
                                  </select>
                                  @error('customerType_id')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div id="appendInformation" class="col-lg-12">
                                  @include('Organization::customers.components.append_information')
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
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
                              <div class="col-lg-6">
                                  <label class="">البريد الالكتروني:</label>
                                  <input
                                      type="email"
                                      value="{{old('email')}}"
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
                                  <select id="gender" name="gender" required="" class="form-control m-input m-input--square" >

                                      <option value="ذكر">ذكر
                                      </option>

                                      <option value="أنثى"> أنثى
                                      </option>

                                  </select>
                              </div>
                              <div class="col-lg-6">
                                  <label for="description">العنوان:</label>
                                  <textarea id="address" name="address" rows="4" cols="50">{{ old('address') }}</textarea>
                                  @error('address')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>تاريخ الميلاد </label>
                                  <input class="form-control" type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" required>
                              </div>
                              <div class="col-lg-6">
                                  <label>الجنسيه :</label>
                                  <input
                                      type="text"
                                      value="{{old('nationality')}}"
                                      name="nationality"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="ادخل الجنسيه..." />
                                  @error('nationality')
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
        <script>
            $('#customerType_id').change(function(){
                var customerType_id = $(this).val();
                console.log(customerType_id);

                $.ajax({
                    type:'get',
                    url:"{{route('organizations.customer.append.information')}}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        customerType_id: customerType_id,
                    },
                    success:function(resp){
                        $("#appendInformation").html(resp).hide().fadeIn('slow');
                    },error:function(){
                        alert('Error');
                    }
                });
            });
        </script>
    </x-slot>
</x-organization::layout>
