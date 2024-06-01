@if(isset($record['end_date']))
    <div>
        <label>تاريخ الانتهاء </label>
        <input  class="form-control" value="{{$record['end_date']}}" type="text" name="end_date" id="end_date"  readonly="readonly" required>
    </div>
@endif
@if(isset($end_date))
    <div>
        <label>تاريخ الانتهاء </label>
        <input  class="form-control" type="text" name="end_date" id="end_date" value="{{$end_date}}" readonly="readonly" required>
    </div>
@endif
