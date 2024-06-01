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
            step="0.01"
            value="{{old('product_price[]')}}"
            name="product_price[]"
            required=""
            readonly
            class="form-control m-input product_price"
           />

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

