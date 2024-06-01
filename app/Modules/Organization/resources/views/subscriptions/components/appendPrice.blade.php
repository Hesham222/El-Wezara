@if(isset($record['price']))
    <div>
        <label>سعر الاشتراك </label>
        <input type="number" step="0.01" value="{{$record['price']}}" readonly="readonly" required="" class="form-control m-input" name="price" id="price" placeholder="سعر الاشتراك...">
    </div>
@endif
@if(isset($price))
        <label>سعر الاشتراك </label>
        <input type="number" step="0.01" value="{{$price}}" readonly="readonly" required="" class="form-control m-input" name="price" id="price" placeholder="سعر الاشتراك...">
@endif
