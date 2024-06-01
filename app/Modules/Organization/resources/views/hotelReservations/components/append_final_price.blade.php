@if(isset($record['final_price']))
    <div>
        <label>السعر النهائى </label>
        <input type="number" step="0.01" value="{{$record['final_price']}}" readonly="readonly" required="" class="form-control m-input" name="final_price" placeholder="السعر النهائى...">
    </div>
@endif
@if(isset($final_price))
    <label> السعر النهائى </label>
    <input type="number" step="0.01" value="{{$final_price}}" readonly="readonly" required="" class="form-control m-input" name="final_price" placeholder="السعر النهائى...">
@endif
