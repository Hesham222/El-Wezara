<tr class="nearest">
    <td>
        <select name="items[]" id="items" required=""
                class="form-control m-input m-input--square items"
                id="exampleSelect1">
            <option value="" disabled selected>Please select an Item</option>
        @foreach($items as $item)
                <option @if(old('items')== $item->id) selected @endif
                value="{{ $item->id }}">{{ $item->name }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <input
            type="number"
            step="1"
            value="{{old('quantity[]')}}"
            name="quantity[]"
            required=""
            class="form-control m-input quantity"
            placeholder="ادخل الكميه..." />
    </td>
    <td>
        <input
            type="number"
            step="0.01"
            value="{{old('price[]')}}"
            name="price[]"
            required=""
            class="form-control m-input price"
            placeholder="ادخل السعر..." />

    </td>
    <td class="col-lg-6">
        <textarea id="description" name="description_item[]" rows="4" cols="50">{{ old('description_item') }}</textarea>
        @error('description_item')
        <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
        </span>
        @enderror
    </td>
    <td>
        <a
            title="Remove the row"
            class="btn btn-sm btn-danger"
            onclick="DeleteItemRowTable(this)">
            <i class="fa fa-times" style="color: #fff"></i>
        </a>
    </td>
</tr>

