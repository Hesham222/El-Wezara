<tr class="nearest">
    <td>
        <select name="products[]" id="products" required=""
                class="form-control m-input m-input--square products">
            <option value="" disabled selected>Please select an product</option>
        @foreach($products as $item)
                <option @if(old('items')== $item->id) selected @endif
                value="{{ $item->id }},Item">{{ $item->name }}
                </option>
            @endforeach
            @foreach($item_variants as $item)
                <option @if(old('items')== $item->id) selected @endif
                value="{{ $item->id }},Item Variant">{{ $item->name }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <input
            type="number"
            step="1"
            value="{{old('product_quantity[]')}}"
            name="product_quantity[]"
            required=""
            class="form-control m-input product_quantity"
            placeholder="ادخل الكميه..." />
    </td>
    <td>
        <input
            type="number"
            step="0.01"
            value="{{old('product_price[]')}}"
            name="product_price[]"
            required=""
            readonly
            class="form-control m-input product_price"
           />

    </td>
    <td class="col-lg-6">
        <textarea id="description_product" name="description_product[]" rows="4" cols="50"></textarea>
        @error('description_product')
        <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
        </span>
        @enderror
    </td>
    <td>
        <a
            title="Remove the row"
            class="btn btn-sm btn-danger"
            onclick="DeleteProductRowTable(this)">
            <i class="fa fa-times" style="color: #fff"></i>
        </a>
    </td>
</tr>

