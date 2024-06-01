@if(isset($record['price_per_night']))
    <div>
        <label>سعر الليلة الواحدة </label>
        <input type="number" step="0.01" value="{{$record['price_per_night']}}" readonly="readonly" required="" class="form-control m-input" name="price_per_night" placeholder="سعر الليلة الواحدة...">
        @error('price_per_night')
        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
        @enderror
    </div>
@endif
@if(isset($price))
    <label> سعر الليلة الواحدة</label>
    <input type="number" step="0.01" value="{{$price}}" readonly="readonly" required="" class="form-control m-input" name="price_per_night" placeholder="سعر الليلة الواحدة...">
    @error('price_per_night')
    <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
    @enderror
@endif
