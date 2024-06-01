@if(isset($total))
        <label>اجمالي السداد </label>
        <input type="text" name="payment_amount" id="payment_amount" value="{{$total}}" step="0.01"  required="" class="form-control m-input"  readonly="readonly" placeholder="اجمالي السداد...">

@endif

@if(isset($overpriced))
    <label>اجمالي السداد </label>
    <input type="text" name="payment_amount" id="payment_amount" value="{{$overpriced}}" step="0.01"  required="" class="form-control m-input"  readonly="readonly" placeholder="اجمالي السداد...">

@endif
