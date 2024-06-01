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
                          اضف اذن خصم للمورد {{ $po->vendor->name }}
                          على امر الشراء ذو الرقم التعريفي {{ $po->id }}
                          اجمالى المبلغ المستحق لهذا الطلب {{ $po->total }}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="table-responsive">
                    <section class="content">
                        <form method="POST" action="{{route('organizations.vendor.make.deduction')}}"
                              class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="po_id" value="{{ $po->id }}"/>
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label>نوع الخصم:</label>
                                        <select name="type" required=""
                                                class="form-control m-input m-input--square"
                                                id="type">
                                            <option value="1">نسبة مئوية</option>
                                            <option value="2"> قيمة مادية</option>
                                        </select>
                                        @error('type')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6">
                                        <label> القيمة :</label>
                                        <input
                                            type="number"
                                            value="{{old('value')}}"
                                            name="value"
                                            required=""
                                            class="form-control m-input"
                                            />
                                        @error('value')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label> السبب :</label>
                                        <textarea
                                            name="reason"
                                            required=""
                                            class="form-control m-input"
                                            ></textarea>
                                        @error('reason')
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
