<x-organization::layout>
 <x-slot name="pageTitle">عقود الايجار | اضف</x-slot name="pageTitle">
 @section('rent-contracts-active', 'm-menu__item--active m-menu__item--open')
 @section('rent-contracts-create-active', 'm-menu__item--active')
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
                  اضف
                </h3>
              </div>
            </div>
          </div>
          <div class="m-portlet__body">
            <div class="table-responsive">
                <section class="content">
                  <form method="POST" action="{{route('organizations.rentContract.store')}}"enctype="multipart/form-data"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-3">
                                  <label>المستأجر:</label>
                                  <select name="tenant" required="" class="form-control m-input m-input--square" id="exampleSelect1">
                                      @foreach($tenants as $tenant)
                                          <option @if(old('tenant') == $tenant->id) selected @endif value="{{ $tenant->id }}">{{ $tenant->name }}</option>
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
                                          <option @if(old('rentSpace') == $space->id) selected @endif value="{{ $space->id }}">{{ $space->name }}</option>
                                      @endforeach
                                  </select>
                                  @error('rentSpace')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                              </div>
                              <div class="col-lg-3">
                                  <label for="files" class="from-label mt-4">ارفق الملف:</label>
                                  <input name="attachment" id="attachment" type="file">
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-4">
                                  <label>نوع مدة العقد:</label>
                                  <select name="durationType" required="" class="form-control m-input m-input--square" id="durationSelect">
                                      <option @if(old('durationType') == "Annually") selected @endif value="Annually">سنوي</option>
                                      <option @if(old('durationType') == "Monthly") selected @endif value="Monthly">شهري</option>
                                      <option @if(old('durationType') == "Weekly") selected @endif value="Weekly">أسبوعي</option>
                                      <option @if(old('durationType') == "Daily") selected @endif value="Daily">يومي</option>
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
                                      value="{{old('duration')}}"
                                      name="duration"
                                      required=""
                                      class="form-control m-input"
                                      id="contract_input_val"
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
                                      <option @if(old('paymentType') == "InAdvance") selected @endif value="InAdvance">مقدما</option>
                                      <option @if(old('paymentType') == "Afterward") selected @endif value="Afterward">مؤخرا</option>
                                  </select>
                                  @error('paymentType')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-3">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="">من</span>
                                      <input type="date" name="start_date" id="startDateCol" class="form-control">
                                  </div>
                                  @if($errors->has('start_date'))
                                      <span class="invalid-feedback" style="display:block;" role="alert">
                                    <strong>{{ $errors->first('start_date') }}</strong>
                                  </span>
                                  @endif
                              </div>
                              <div class="col-lg-3">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="">الى</span>
                                      <input type="date" name="end_date" id="endDateCol" class="form-control" value="" disabled>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-3">
                                  <label>قيمة الايجار - (سنوي او شهري او اسبوعي او يومي):</label>
                                  <input
                                      type="text"
                                      value="{{old('amount')}}"
                                      name="amount"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="أدخل قيمة الايجار..." />
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
                                      value="{{old('annualIncrease')}}"
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
                                      value="{{old('revenueShare')}}"
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
                                  <textarea id="notes" name="notes" rows="4" cols="50">{{ old('notes') }}</textarea>
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
    $(document).ready(function (){
        $('#durationSelect, #contract_input_val, #startDateCol').change(function() {
            const durationSelect = $('#durationSelect').val();
            const contract_input_val = $('#contract_input_val').val();
            const startDateCol = $('#startDateCol').val();
            const endDateCol = $('#endDateCol').val();
            
            if(durationSelect === "Annually"){
                var monthCount = +contract_input_val * 12
                var start_date_utc = new Date(startDateCol);
                start_date_utc.setMonth(start_date_utc.getMonth() + +monthCount);
                let date = start_date_utc.toJSON().slice(0, 10).split`-`.join`-`;
                $('#endDateCol').val(date);
            }
            if(durationSelect === "Monthly"){
                var start_date_utc = new Date(startDateCol);
                start_date_utc.setMonth(start_date_utc.getMonth() + +contract_input_val);
                let date = start_date_utc.toJSON().slice(0, 10).split`-`.join`-`;
                $('#endDateCol').val(date);
            }
            if(durationSelect === "Weekly"){
                var daysCount = +contract_input_val * 7
                var start_date_utc = new Date(startDateCol);
                start_date_utc.setDate(start_date_utc.getDate() + +daysCount);
                let date = start_date_utc.toJSON().slice(0, 10).split`-`.join`-`;
                $('#endDateCol').val(date);
            }
            if(durationSelect === "Daily"){
                var start_date_utc = new Date(startDateCol);
                start_date_utc.setDate(start_date_utc.getDate() + +contract_input_val);
                let date = start_date_utc.toJSON().slice(0, 10).split`-`.join`-`;
                $('#endDateCol').val(date);
            }
            
            // alert('The option with value ' + $(this).val() + ' and text ' + $(this).text() + ' was selected.');
        });
    });
    </script>

    </x-slot>
</x-organization::layout>
