<x-organization::layout>
    <x-slot name="pageTitle">انواع العملاء  | تعديل</x-slot name="pageTitle">
    @section('customerTypes-active', 'm-menu__item--active m-menu__item--open')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
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
                    انواع العملاء
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
                        <form method="POST" action="{{route('organizations.customerType.update', $record->id)}}"
                              class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                            @csrf
                            @method('put')
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label>النوع:</label>
                                        <input
                                            type="text"
                                            value="{{old('name')?old('name'):$record->name}}"
                                            name="name"
                                            required=""
                                            class="form-control m-input"
                                            placeholder="النوع ..." />
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-12 prices-wrapper">
                                        <label class="">التسعير الكلي:</label><br>
                                        <table  width="100%" class="table table-striped- table-bordered table-hover table-checkable" id="pricing-table">
                                            <col style="width:30%">
                                            <col style="width:30%">
                                            <col style="width:30%">
                                            <col style="width:10%">
                                            <thead>
                                            <tr>
                                                <th style="font-weight: bold;">عنوان </th>
                                                <th style="font-weight: bold;"> نوع الوثيقة </th>
                                                <th style="font-weight: bold;">الحاله</th>
                                                <th style="font-weight: bold;">مسح</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($record->information as $key => $value)
                                                <tr>
                                                    <td>
                                                            <input
                                                                type="text"
                                                                value="{{$value->title}}"
                                                                name="title[]"
                                                                required=""
                                                                class="form-control m-input"
                                                                placeholder="العنوان ..." />
                                                            @error('title')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                    </td>
                                                    <td>
                                                            <select  id="document_type" name="document_type[]" required="" class="form-control m-input m-input--square selectpicker" >

                                                                <option @if(old('document_type')== 'مرفق' || $value->document_type=='مرفق') selected @endif
                                                                value="مرفق">مرفق
                                                                </option>
                                                                <option @if(old('document_type')== 'نص' || $value->document_type=='نص') selected @endif
                                                                value="نص">نص
                                                                </option>

                                                            </select>
                                                    </td>
                                                    <td>
                                                        <label>مطلوب أم لا</label>
                                                        <input type="checkbox" name="status[]"
                                                               @if($value->status==1)
                                                                   checked
                                                               @endif
                                                               value="1"
                                                                class="form-control m-input">
                                                        <input type="hidden" value="0" name="status[]">

                                                    </td>
                                                    <td>
                                                        <a
                                                            title="Remove the row"
                                                            class="btn btn-sm btn-danger"
                                                            onclick="DeletePricingRowTable(this)">
                                                            <i class="fa fa-times" style="color: #fff"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <button type="button" class="btn btn-default " id="new_pricing_row"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js" integrity="sha512-Dz4zO7p6MrF+VcOD6PUbA08hK1rv0hDv/wGuxSUjImaUYxRyK2gLC6eQWVqyDN9IM1X/kUA8zkykJS/gEVOd3w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <x-slot name="scripts">
        <script>
            function DeletePricingRowTable(i)
            {
                if($('#pricing-table tbody tr').length == 1)
                {
                    toastr.error('You can not delete all the information.');
                    return;
                }
                var p=i.parentNode.parentNode;
                p.parentNode.removeChild(p);
            }
            $(document).on('click','#new_pricing_row',function(){


                $.ajax({
                    url: "<?php echo e(route('organizations.customerType.get.information.row')); ?>",
                    success: function (data) {
                        $('#pricing-table > tbody:last-child').append(data['data']['responseHTML']);

                        $(".vendor-id").selectpicker();
                    },

                });
            });

        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    </x-slot>
</x-organization::layout>

