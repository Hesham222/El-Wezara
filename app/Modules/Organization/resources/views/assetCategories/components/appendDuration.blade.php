@if(isset($record['duration']))
    <div>
        <label>الفتره </label>
        <input type="number" step="0.01" value="{{$record['duration']}}" readonly="readonly" required="" class="form-control m-input" name="duration" id="duration" placeholder="الفتره...">
    </div>
@endif
@if(isset($duration))
        <label>الفتره </label>
        <input type="number" step="0.01" value="{{$duration}}" readonly="readonly" required="" class="form-control m-input" name="duration" id="duration" placeholder="الفتره...">
@endif
