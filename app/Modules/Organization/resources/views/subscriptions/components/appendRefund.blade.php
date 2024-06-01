@if(isset($refund))
    <label>المبلغ المسترجع للمشترك</label>
        <input type="number" name="amount_after_discount" value="{{$refund}}" step="0.01"  required="" class="form-control m-input"  readonly="readonly" placeholder="المبلغ المسترجع...">

@endif
