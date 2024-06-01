<x-organization::layout>
    <x-slot name="pageTitle">القيد المحاسبي  | تعديل</x-slot name="pageTitle">
    @section('journalEntries-active', 'm-menu__item--active m-menu__item--open')
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
                    القيد المحاسبي
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
                        <form method="POST" action="{{route('organizations.journalEntry.update', $record->id)}}"
                              class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                            @csrf
                            @method('put')
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label for="description">شرح القيد:</label>
                                        <textarea id="description" name="description" rows="4" cols="50">{{ $record->description}}</textarea>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group m-form__group row">
                                    <div id="debit" class="col-lg-12">
                                        <label class="">قسم المدين:</label><br>
                                        <table  width="100%" class="table table-striped- table-bordered table-hover table-checkable" id="ingredients-table">
                                            <col style="width:30%">
                                            <col style="width:30%">
                                            <col style="width:30%">
                                            <col style="width:10%">
                                            <thead>
                                            <tr>
                                                <th style="font-weight: bold;">الحساب </th>
                                                <th style="font-weight: bold;">السعر</th>
                                                <th style="font-weight: bold;">مسح</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($record->Debits as $value)
                                                <tr>

                                                    <td>
                                                        <select name="account_id[]" id="account_id" required=""
                                                                class="form-control m-input m-input--square"
                                                                id="exampleSelect1">
                                                                @foreach($accounts as $account)
                                                                    <option
                                                                        @if(count($account->SubAccounts) > 0)
                                                                        disabled
                                                                        @endif
                                                                @if(isset($value->account_id))
                                                                    @foreach($accounts as $account)
                                                                       @if(old('account_id')== $account->id || $account->id==$value->account_id) selected @endif
                                                                    @endforeach
                                                                @endif
                                                                        value="1-{{ $account->id }}">{{ $account->name }}
                                                                    </option>
                                                                    @foreach($account->SubAccounts as $subAccount)
                                                                        <option @if(old('subAccount_id')== $subAccount->id) selected @endif
                                                                         @if(old('account_id')== $account->id) selected @endif
                                                                            @if(isset($value->subAccount_id))
                                                                            @if (!empty($sub_accounts))
                                                                                @foreach ($sub_accounts as $sub_account )
                                                                                    @if (!empty($value['subAccount_id']) && $value['subAccount_id']== $sub_account->id )
                                                                                    selected =""
                                                                                    @endif
                                                                                @endforeach
                                                                            @endif
                                                                         @endif
                                                                        value="2-{{ $subAccount->id }}">&nbsp;&nbsp;&raquo;&nbsp;&raquo;&nbsp;{{ $subAccount->name }}
                                                                        </option>
                                                                    @endforeach
                                                                @endforeach

                                                        </select>
                                                    </td>
{{--                                                    <td>--}}
{{--                                                        <div id="appendSubAccounts">--}}
{{--                                                            @include('Organization::journalEntries.components.debit.append_sub_accounts')--}}
{{--                                                        </div>--}}
{{--                                                    </td>--}}
                                                    <td>
                                                        <input type="number" value="{{$value->amount}}" step="0.01" name="amount[]" required="" class="form-control m-input">
                                                    </td>
                                                    <td>
                                                        <a
                                                            title="Remove the row"
                                                            class="btn btn-sm btn-danger"
                                                            onclick="DeleteVendorRowTable(this)">
                                                            <i class="fa fa-times" style="color: #fff"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <button type="button" class="btn btn-default " id="new_row"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div id="credit" class="col-lg-12 prices-wrapper">
                                        <label class="">قسم الدائن:</label><br>
                                        <table  width="100%" class="table table-striped- table-bordered table-hover table-checkable" id="pricing-table">
                                            <col style="width:30%">
                                            <col style="width:30%">
                                            <col style="width:30%">
                                            <col style="width:10%">
                                            <thead>
                                            <tr>
                                                <th style="font-weight: bold;">الحساب </th>
                                                <th style="font-weight: bold;">السعر</th>
                                                <th style="font-weight: bold;">مسح</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($record->Credits as $key => $value)
                                                <tr>
                                                    <td>
                                                        <select name="account[]" id="account" required=""
                                                                class="form-control m-input m-input--square"
                                                                id="exampleSelect1">
                                                            @foreach($accounts as $account)
                                                                <option
                                                                    @if(count($account->SubAccounts) > 0)
                                                                    disabled
                                                                    @endif
                                                                    @if(isset($value->account_id))
                                                                    @foreach($accounts as $account)
                                                                    @if(old('account')== $account->id || $account->id==$value->account_id) selected @endif
                                                                    @endforeach
                                                                    @endif
                                                                    value="1-{{ $account->id }}">{{ $account->name }}
                                                                </option>
                                                                @foreach($account->SubAccounts as $subAccount)
                                                                    <option @if(old('subAccount_id')== $subAccount->id) selected @endif
                                                                    @if(old('account')== $account->id) selected @endif
                                                                            @if(isset($value->subAccount_id))
                                                                            @if (!empty($sub_accounts))
                                                                            @foreach ($sub_accounts as $sub_account )
                                                                            @if (!empty($value['subAccount_id']) && $value['subAccount_id']== $sub_account->id )
                                                                            selected =""
                                                                            @endif
                                                                            @endforeach
                                                                            @endif
                                                                            @endif
                                                                            value="2-{{ $subAccount->id }}">&nbsp;&nbsp;&raquo;&nbsp;&raquo;&nbsp;{{ $subAccount->name }}
                                                                    </option>
                                                                @endforeach
                                                            @endforeach
                                                        </select>
                                                    </td>
{{--                                                    <td>--}}
{{--                                                        <div id="appendSubAccountsCredit">--}}
{{--                                                            @include('Organization::journalEntries.components.credit.append_sub_accounts')--}}
{{--                                                        </div>--}}
{{--                                                    </td>--}}
                                                    <td>
                                                        <input type="number" value="{{$value->amount}}" step="0.01" name="amount_credit[]" required="" class="form-control m-input">
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
            function DeleteVendorRowTable(i)
            {
                if($('#ingredients-table tbody tr').length == 1)
                {
                    toastr.error('You can not delete all the Debit sections.');
                    return;
                }
                var p=i.parentNode.parentNode;
                p.parentNode.removeChild(p);
            }
            $(document).on('click','#new_row',function(){


                $.ajax({
                    url: "<?php echo e(route('organizations.journalEntry.get.debit.row')); ?>",
                    success: function (data) {
                        $('#ingredients-table > tbody:last-child').append(data['data']['responseHTML']);
                        $(".vendor-id").selectpicker();
                    },

                });
            });

        </script>

        <script>
            function DeletePricingRowTable(i)
            {
                if($('#pricing-table tbody tr').length == 1)
                {
                    toastr.error('You can not delete all the credit sections.');
                    return;
                }
                var p=i.parentNode.parentNode;
                p.parentNode.removeChild(p);
            }
            $(document).on('click','#new_pricing_row',function(){


                $.ajax({
                    url: "<?php echo e(route('organizations.journalEntry.get.credit.row')); ?>",
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

