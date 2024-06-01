<x-organization::layout>
    <x-slot name="pageTitle">@lang('Organization::organization.vendor') | @lang('Organization::organization.create')</x-slot name="pageTitle">
    @section('vendor-active', 'm-menu__item--active m-menu__item--open')
    @section('vendor-create-active', 'm-menu__item--active')
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
                    @lang('Organization::organization.vendor')
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
                            @lang('Organization::organization.create')
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="table-responsive">
                    <section class="content">
                        <form method="POST" action="{{route('organizations.vendor.store')}}"
                              class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" enctype="multipart/form-data">
                            @csrf
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label> @lang('Organization::organization.name'):</label>
                                        <input
                                            type="text"
                                            value="{{old('name')}}"
                                            name="name"
                                            required=""
                                            class="form-control m-input"
                                            placeholder="@lang('Organization::organization.name')..." />
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6">
                                        <label> @lang('Organization::organization.company_name'):</label>
                                        <input
                                            type="text"
                                            value="{{old('company_name')}}"
                                            name="company_name"
                                            required=""
                                            class="form-control m-input"
                                            placeholder="@lang('Organization::organization.company_name')..." />
                                        @error('company_name')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>

                                </div>


                                <div class="form-group m-form__group row">

                                    <div class="col-lg-6">
                                        <label>نوع المورد:</label>
                                        <select name="vendorType_id" required=""
                                                class="form-control m-input m-input--square"
                                                id="vendorType_id">
                                            <option value="">--اختر نوع--</option>
                                            @foreach($vendorTypes as $vendorType)
                                                <option @if(old('vendorType_id')== $vendorType->id) selected @endif
                                                value="{{ $vendorType->id }}">{{ $vendorType->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('vendorType_id')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>

                                </div>


                                <div class="form-group m-form__group row">
                                    <div id="appendInformation" class="col-lg-12">
                                        @include('Organization::vendors.components.append_information')
                                    </div>
                                </div>




                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label> البطاقة الضريبية :</label>
                                        <input
                                            type="text"
                                            value="{{old('tax_card')}}"
                                            name="tax_card"
                                            required=""
                                            class="form-control m-input"
                                            placeholder="" />
                                        @error('tax_card')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6">
                                        <label> السجل التجارى:</label>
                                        <input
                                            type="text"
                                            value="{{old('commercial_record')}}"
                                            name="commercial_record"
                                            required=""
                                            class="form-control m-input"
                                            placeholder="" />
                                        @error('commercial_record')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>

                                </div>




                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label> البطاقة الضريبية [ملف] :</label>
                                        <input
                                            type="file"
                                            name="tax_card_attachment"
                                            required=""
                                            class="form-control m-input"
                                            placeholder="" />
                                        @error('tax_card_attachment')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6">
                                        <label> السجل التجارى [ملف]:</label>
                                        <input
                                            type="file"
                                            name="commercial_record_attachment"
                                            required=""
                                            class="form-control m-input"
                                            placeholder="" />
                                        @error('commercial_record_attachment')
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
                                            <button type="submit" class="btn btn-primary">@lang('Organization::organization.save')</button>
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
        <script>
            $('#vendorType_id').change(function(){
                var vendorType_id = $(this).val();
                console.log(vendorType_id);

                $.ajax({
                    type:'get',
                    url:"{{route('organizations.vendor.append.information')}}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        vendorType_id: vendorType_id,
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
