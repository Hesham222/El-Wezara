<tr class="nearest-service">
    <td>
        <select name="services[]" id="services" required=""
                class="form-control m-input m-input--square services"
                id="exampleSelect1">
            <option value="" disabled selected>Please select a Service</option>
        @foreach($services as $service)
                <option @if(old('services')== $service->id) selected @endif
                value="{{ $service->id }}">{{ $service->name }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <input
            type="number"
            step="0.01"
            value="{{old('service_price[]')}}"
            name="service_price[]"
            required=""
            class="form-control m-input service_price"
            placeholder="ادخل السعر..." />

    </td>
    <td>
        <a
            title="Remove the row"
            class="btn btn-sm btn-danger"
            onclick="DeleteServiceRowTable(this)">
            <i class="fa fa-times" style="color: #fff"></i>
        </a>
    </td>
</tr>

