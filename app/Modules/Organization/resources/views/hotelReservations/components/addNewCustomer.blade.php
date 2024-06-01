<div class="modal fade" id="add-new-customer-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">أضف عميل جديد</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                                <input
                                    id="address"
                                    type="text"
                                    value="{{old('address')}}"
                                    name="address"
                                    required=""
                                    class="form-control m-input"
                                    placeholder="ادخل العنوان..." />
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
                    <input type="hidden" name="hotel" value="yes">
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
