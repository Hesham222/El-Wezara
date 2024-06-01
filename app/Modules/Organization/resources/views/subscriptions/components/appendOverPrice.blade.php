@if(isset($record['overpriced']))
    <div>
        <label>السعر زائد 12 %  </label>
        <input type="number" step="0.01" value="{{$record['overpriced']}}" readonly="readonly" required="" class="form-control m-input" name="overpriced" id="overpriced" placeholder="سعر الاشتراك...">
    </div>
@endif
@if(isset($overpriced))
        <label>السعر زائد 12 %  </label>
        <input type="number" step="0.01" value="{{$overpriced}}" readonly="readonly" required="" class="form-control m-input" name="overpriced" id="overpriced" placeholder="سعر الاشتراك...">
@endif
