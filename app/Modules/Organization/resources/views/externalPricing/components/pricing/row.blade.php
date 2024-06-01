<tr>
    <td>
        <select name="subscriber_type_id[]" id="subscriber_type_id[]" required=""
                class="form-control m-input m-input--square"
                id="exampleSelect1">
            @foreach($subscriberTypes as $subscriberType)
                <option @if(old('subscriber_type_id')== $subscriberType->id) selected @endif
                value="{{ $subscriberType->id }}">{{ $subscriberType->name }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <input type="number" step="0.01" name="price_per_hour[]" required="" class="form-control m-input">
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
