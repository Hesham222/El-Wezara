
            <tr>
                <td>
                    <select name="guest_id[]" id="guest_id[]" required=""
                            class="form-control m-input m-input--square"
                            id="exampleSelect1">
                        @foreach($guestTypes as $guestType)
                            <option @if(old('guest_id')== $guestType->id) selected @endif
                            value="{{ $guestType->id }}">{{ $guestType->name }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="room_id[]" id="room_id[]" required=""
                            class="form-control m-input m-input--square"
                            id="exampleSelect1">
                        @foreach($roomTypes as $roomType)
                            <option @if(old('room_id')== $roomType->id) selected @endif
                            value="{{ $roomType->id }}">{{ $roomType->name }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" step="0.01" name="dayPrice[]" required="" class="form-control m-input">
                </td>
                <td>
                    <a
                        title="Remove the row"
                        class="btn btn-sm btn-danger"
                        onclick="DeleteVendorRowTable(this)">
                        <i class="fa fa-times" style="color: #fff"></i>
                    </a>
                </td>
            </tr>

