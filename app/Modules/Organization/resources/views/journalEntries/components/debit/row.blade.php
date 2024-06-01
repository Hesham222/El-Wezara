<tr>
    <td>
        <select name="account_id[]"  id="account_id" required=""
                class="form-control m-input m-input--square"
                id="exampleSelect1">
            <option value="">--اختر الحساب --</option>
        @foreach($accounts as $account)
                    <option
                            @if(count($account->SubAccounts) > 0)
                               disabled
                            @endif
                            @if(old('account_id')== $account->id) selected @endif
                    value="1-{{ $account->id }}">{{ $account->name }}
                    </option>
            @foreach($account->SubAccounts as $subAccount)
                    <option @if(old('subAccount_id')== $subAccount->id) selected @endif
                    value="2-{{ $subAccount->id }}">&nbsp;&nbsp;&raquo;&nbsp;&raquo;&nbsp;{{ $subAccount->name }}
                    </option>
             @endforeach
            @endforeach
        </select>
    </td>
{{--    <td>--}}
{{--        <div id="appendSubAccounts">--}}
{{--            @include('Organization::journalEntries.components.debit.append_sub_accounts')--}}
{{--        </div>--}}
{{--    </td>--}}
    <td>
         @if(isset($ids))

        @if($type == 'debtor')

            <input type="number" value="{{$invoicePrice}}" step="0.01" name="amount[]" required="" class="form-control m-input">
@else 
        <input type="number" step="0.01" name="amount[]" required="" class="form-control m-input">


            @endif
        @else
        <input type="number" step="0.01" name="amount[]" required="" class="form-control m-input">
        @endif
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
