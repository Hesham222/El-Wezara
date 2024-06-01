    <label> رقم الغرفه:</label>
    <select required="required" class="form-control room" name="room_id" id ="room_id"
    >
        @if(isset($record))
            @if (!empty($rooms))
                @foreach ($rooms as $room )
                    <option value="{{ $room['id'] }}"
                            @if (!empty($record['room_id']) && $record['room_id']== $room->id )
                            selected =""
                        @endif
                    >{{ $room['room_num'] }}</option>
                @endforeach
            @endif
        @else
            <option value="">-- اختر رقم الغرفه  --</option>
        @endif

        @if (!empty($parentRooms))
            @foreach ($parentRooms as $parent )
                @foreach($parent->Rooms as $room)
                        <option value="{{ $room['id'] }}"
                                @if (!empty($record['room_id']) && $record['room_id']== $room->id )
                                selected =""
                            @endif
                        >{{ $room['room_num'] }}</option>
                @endforeach
            @endforeach
        @endif
    </select>
    @error('room_id')
    <span class="invalid-feedback" role="alert">
           <strong>{{ $message }}</strong>
    </span>
    @enderror
