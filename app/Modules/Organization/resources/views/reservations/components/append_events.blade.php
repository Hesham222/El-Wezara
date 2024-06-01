<select required class="form-control" name="event_id"
        id="event_id">
    @if(isset($record['event_type_id']))
        @if (!empty($allEventTypes))
            @foreach ($allEventTypes as $allEventType )
                <option value="{{ $allEventType['id'] }}"
                        @if (!empty($record['event_type_id']) && $record['event_type_id']== $allEventType->id )
                        selected =""
                    @endif
                >{{ $allEventType['name'] }}</option>
            @endforeach
        @endif
    @else
        <option value="0">-- اختر اسم المناسبه --</option>
    @endif
    @if (!empty($events))
        @foreach ($events as $event )
            <option value="{{ $event['id'] }}"
                    @if(old('event_id')== $event->id) selected @endif
            >{{ $event['name'] }}</option>
        @endforeach
    @endif
</select>
@error('event_id')
<span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror
