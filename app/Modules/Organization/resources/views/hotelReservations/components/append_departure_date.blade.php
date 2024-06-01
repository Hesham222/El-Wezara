@if(isset($record['departure_date']))
    <div>
        <label>تاريخ المغادره </label>
        <input  class="form-control" value="{{$record['departure_date']}}" type="text" name="departure_date" id="departure_date" required>
        @error('departure_date')
        <span class="invalid-feedback" role="alert">
       <strong>{{ $message }}</strong>
</span>
        @enderror
    </div>
@elseif(isset($departure_Date))
    <div>
        <label>تاريخ المغادره </label>
        <input  class="form-control" type="date" name="departure_date" id="departure_date" value="{{$departure_Date}}" readonly="readonly" required>
        @error('departure_date')
        <span class="invalid-feedback" role="alert">
       <strong>{{ $message }}</strong>
</span>
        @enderror
    </div>
@else
    <label>تاريخ المغادره</label>
    <input class="form-control" type="date" name="departure_date" id="departure_date" value="{{ old('departure_date') }}" required>
    @error('departure_date')
    <span class="invalid-feedback" role="alert">
       <strong>{{ $message }}</strong>
</span>
    @enderror
@endif


