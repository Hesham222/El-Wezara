
<select class="form-control" name="subAccount_id[]"
        id="subAccount_id">
        @if(isset($value->subAccount_id))
            @if (!empty($sub_accounts))
                @foreach ($sub_accounts as $sub_account )
                    <option value="{{ $sub_account['id'] }}"
                            @if (!empty($value['subAccount_id']) && $value['subAccount_id']== $sub_account->id )
                            selected =""
                        @endif
                    >{{ $sub_account['name'] }}</option>
                @endforeach
            @endif
        @else
        @endif
    @if (!empty($subAccounts))
        @foreach ($subAccounts as $subAccount )
            <option value="{{ $subAccount['id'] }}"
                    @if (isset($record['subAccount_id']) && $record['subAccount_id']== $subAccount->id )
                    selected =""
                @endif
            >{{ $subAccount['name'] }}</option>
        @endforeach
    @endif
</select>
@error('subAccount_id')
<span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror
