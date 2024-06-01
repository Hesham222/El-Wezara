@if(isset($balance))
        <label>المبلغ المتبقي </label>
        <input type="text" name="payment_balance" value="{{$balance}}" step="0.01"  required="" class="form-control m-input"  readonly="readonly" placeholder="المبلغ المتبقي...">

@endif
