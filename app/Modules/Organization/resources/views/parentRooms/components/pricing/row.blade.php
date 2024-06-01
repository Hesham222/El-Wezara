<tr>
    <td>
        <select name="guestType_id[]" id="guestType_id[]" required=""
                class="form-control m-input m-input--square"
                id="exampleSelect1">
            @foreach($guestTypes as $guestType)
                <option @if(old('guestType_id')== $guestType->id) selected @endif
                value="{{ $guestType->id }}">{{ $guestType->name }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <select name="roomType_id[]" id="roomType_id[]" required=""
                class="form-control m-input m-input--square"
                id="exampleSelect1">
            @foreach($roomTypes as $roomType)
                <option @if(old('roomType_id')== $roomType->id) selected @endif
                value="{{ $roomType->id }}">{{ $roomType->name }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <input type="number" step="0.01" name="price[]" required="" class="form-control m-input">
    </td>
    <td>
        <a
            title="Remove the row"
            class="btn btn-sm btn-danger"
            onclick="DeletePricingRowTable(this)">
            <i class="fa fa-times" style="color: #fff"></i>
        </a>
    </td>
</tr>
