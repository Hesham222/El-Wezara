<x-organization::layout>
 <x-slot name="pageTitle">عقود الايجار | تعديل</x-slot name="pageTitle">
 @section('rent-contracts-active', 'm-menu__item--active m-menu__item--open')
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
                عقود الايجار
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
                  <form method="POST" action="{{route('organizations.rentContract.update', $record->id)}}" enctype="multipart/form-data"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      @method('put')
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-3">
                                  <label>المستأجر:</label>
                                  <select name="tenant" required="" class="form-control m-input m-input--square" id="exampleSelect1">
                                      @foreach($tenants as $tenant)
                                          <option @if($record->vendor_id == $tenant->id) selected @endif value="{{ $tenant->id }}">{{ $tenant->name }}</option>
                                      @endforeach
                                  </select>
                                  @error('tenant')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-3">
                                  <label>المساحة المؤجرة:</label>
                                  <select name="rentSpace" required="" class="form-control m-input m-input--square" id="exampleSelect1">
                                      @foreach($spaces as $space)
                                          <option @if($record->rent_space_id == $space->id) selected @endif value="{{ $space->id }}">{{ $space->name }}</option>
                                      @endforeach
                                  </select>
                                  @error('rentSpace')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4">
                                  <label>ارفق العقد:</label>
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

                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-4">
                                  <label>نوع مدة العقد:</label>
                                  <select name="durationType" required="" class="form-control m-input m-input--square" id="exampleSelect1">
                                      <option @if($record->durationType == "Annually") selected @endif value="Annually">سنوي</option>
                                      <option @if($record->durationType == "Monthly") selected @endif value="Monthly">شهري</option>
                                      <option @if($record->durationType == "Weekly") selected @endif value="Weekly">أسبوعي</option>
                                      <option @if($record->durationType == "Daily") selected @endif value="Daily">يومي</option>
                                  </select>
                                  @error('durationType')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4">
                                  <label>مدة العقد - (سنين او شهور او اسابيع او ايام):</label>
                                  <input
                                      type="text"
                                      value="{{$record->duration}}"
                                      name="duration"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="أدخل عدد (سنين او شهور او اسابيع او ايام)..." />
                                  @error('amount')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4">
                                  <label>نوع الدفع:</label>
                                  <select name="paymentType" required="" class="form-control m-input m-input--square" id="exampleSelect1">
                                      <option @if($record->paymentType == "InAdvance") selected @endif value="InAdvance">مقدما</option>
                                      <option @if($record->paymentType == "Afterward") selected @endif value="Afterward">مؤخرا</option>
                                  </select>
                                  @error('paymentType')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-4">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="">من</span>
                                      <input type="date" name="start_date" id="startDateCol" class="form-control" value="{{ $record->start_date }}">
                                  </div>
                                  @if($errors->has('start_date'))
                                      <span class="invalid-feedback" style="display:block;" role="alert">
                                    <strong>{{ $errors->first('start_date') }}</strong>
                                  </span>
                                  @endif
                              </div>
                              <div class="col-lg-4">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="">الى</span>
                                      <input type="date" name="end_date" id="endDateCol" class="form-control" value="{{ $record->end_date }}" disabled>
                                  </div>
                                  @if($errors->has('end_date'))
                                      <span class="invalid-feedback" style="display:block;" role="alert">
                                    <strong>{{ $errors->first('end_date') }}</strong>
                                  </span>
                                  @endif
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-3">
                                  <label>قيمة الايجار - (سنوي او شهري او اسبوعي او يومي):</label>
                                  <input
                                      type="text"
                                      value="{{$record->amount / $record->duration}}"
                                      name="amount"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="أدخل قيمة الايجار..." />
                                  <label> قيمة اجمالي الايجار{{ $record->amount }}</label>
                                  @error('amount')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-3">
                                  <label>الزيادة السنوية%:</label>
                                  <input
                                      type="text"
                                      value="{{$record->annual_increase}}"
                                      name="annualIncrease"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="ادخل الزيادة السنوية%..." />
                                  @error('annualIncrease')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-3">
                                  <label>حصة الأرباح%:</label>
                                  <input
                                      type="text"
                                      value="{{$record->revenue_share}}"
                                      name="revenueShare"
                                      class="form-control m-input"
                                      placeholder="ادخل حصة الأرباح%..." />
                                  @error('revenueShare')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label for="notes">ملاحظات:</label>
                                  <textarea id="notes" name="notes" rows="4" cols="50">{{$record->notes}}</textarea>
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

