<tr>
    <td>
        <select name="subscriber_type_id[]" id="subscriber_type_id" required=""
                class="form-control m-input m-input--square"
                id="exampleSelect1">
            @foreach($subscriberTypes as $subscriberType)
                <option @if(old('subscriber_type_id')== $subscriberType->id) selected @endif
                value="{{ $subscriberType->id }}">{{ $subscriberType->name }}
                </option>
            @endforeach
        </select>
        @error('subscriber_type_id')
        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
        @enderror
    </td>
    <td>
        <input
            type="text"
            name="pricing_name[]"
            required=""
            class="form-control m-input"
            placeholder="ادخل الاسم..." />
        @error('pricing_name')
        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
        @enderror
    </td>
    <td>
        <input type="number" required="" class="form-control m-input" name="num_of_sessions[]" placeholder="ادخل عدد الجلسات...">
        @error('num_of_sessions')
        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
        @enderror
    </td>
    <td>
        <input id="duration_in_days" type="number"  class="form-control m-input" name="duration_in_days[]" placeholder="ادخل المده بالايام...">
        @error('duration_in_days')
        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
        @enderror
    </td>
    <td>
        <input type="number" step="0.01" name="price[]" required="" class="form-control m-input">
        @error('price')
        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
        @enderror
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
