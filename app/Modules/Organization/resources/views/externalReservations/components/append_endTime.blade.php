@if(isset($record['end_time']))
    <div>
        <label>نهايه التوقيت </label>
        <input  class="form-control" value="{{$record['end_time']}}" type="text" name="end_time" id="end_time"  readonly="readonly" required>
    </div>
@endif
@if(isset($end_time))
    <div>
        <label>نهايه التوقيت </label>
        <input  class="form-control" type="text" name="end_time" id="end_time" value="{{$end_time}}" readonly="readonly" required>
    </div>
@endif
