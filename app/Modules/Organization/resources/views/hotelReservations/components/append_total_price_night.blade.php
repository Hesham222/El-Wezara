@if(isset($record['total_price_for_duration']))
    <div>
        <label>السعر الإجمالي للمدة </label>
        <input type="number" step="0.01" value="{{$record['total_price_for_duration']}}" readonly="readonly" required="" class="form-control m-input" name="total_price_for_duration" placeholder="السعر الإجمالي للمدة...">
        @error('total_price_for_duration')
        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
        @enderror
    </div>
@endif
@if(isset($total))
    <label> السعر الإجمالي للمدة</label>
    <input type="number" step="0.01" value="{{$total}}" readonly="readonly" required="" class="form-control m-input" name="total_price_for_duration" placeholder="السعر الإجمالي للمدة...">
    @error('total_price_for_duration')
    <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
    @enderror
@endif
