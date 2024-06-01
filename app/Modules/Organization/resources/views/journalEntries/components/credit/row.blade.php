<tr>
    <td>
        <select name="account[]" id="account" required=""
                class="form-control m-input m-input--square"
                id="exampleSelect1">
            <option value="">--اختر الحساب الرئيسي--</option>
        @foreach($accounts as $account)
                <option
                    @if(count($account->SubAccounts) > 0)
                    disabled
                    @endif
                    @if(old('account')== $account->id) selected @endif
                value="1-{{ $account->id }}">{{ $account->name }}
                </option>
                @foreach($account->SubAccounts as $subAccount)
                    <option @if(old('account_id')== $subAccount->id) selected @endif
                    value="2-{{ $subAccount->id }}">&nbsp;&nbsp;&raquo;&nbsp;&raquo;&nbsp;{{ $subAccount->name }}
                    </option>
                @endforeach
            @endforeach
        </select>
    </td>
{{--    <td>--}}
{{--        <div class="appendSubAccountsCredit" >--}}
{{--            @include('Organization::journalEntries.components.credit.append_sub_accounts')--}}
{{--        </div>--}}
{{--    </td>--}}
    <td>
        @if(isset($ids))
        @if($type == 'creditor')

            <input type="number" value="{{$invoicePrice}}" step="0.01" name="amount_credit[]" required="" class="form-control m-input">
 @else
 <input type="number" step="0.01" name="amount_credit[]" required="" class="form-control m-input">
            @endif
        @else

        <input type="number" step="0.01" name="amount_credit[]" required="" class="form-control m-input">
        @endif
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

