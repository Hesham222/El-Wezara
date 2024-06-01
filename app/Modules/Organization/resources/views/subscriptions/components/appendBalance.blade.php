@if(isset($record['payment_balance']))
    <div>
        <label>المبلغ المتبقي </label>
        <input type="text" name="payment_balance" id="payment_balance" value="{{$record['payment_balance']}}" step="0.01"  required="" class="form-control m-input"  readonly="readonly" placeholder="المبلغ المتبقي...">
    </div>
@endif
@if(isset($balance))
        <label>المبلغ المتبقي </label>
        <input type="text" value="{{$balance}}" step="0.01"  required="" class="form-control m-input"  name="payment_balance" id="payment_balance"  readonly="readonly" placeholder="المبلغ المتبقي...">

@endif
@if(isset($balanceOver))
    <label>المبلغ المتبقي </label>
    <input type="text" value="{{$balanceOver}}" step="0.01"  required="" class="form-control m-input"  name="payment_balance" id="payment_balance"  readonly="readonly" placeholder="المبلغ المتبقي...">

@endif
