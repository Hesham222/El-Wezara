<tr class="nearest-ingredient">
    <td>
        <select name="ingredients[]" id="ingredients" required=""
                class="form-control m-input m-input--square ingredients"
                id="exampleSelect1">
            <option value="" disabled selected>اختر مكون لطلبه</option>
        @foreach($ingredients as $ingredient)
                <option @if(old('ingredients')== $ingredient->id) selected @endif
                value="{{ $ingredient->id }}">{{ $ingredient->name }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <input
            type="number"
            step="1"
            value="{{old('ingredient_quantity[]')}}"
            name="ingredient_quantity[]"
            required=""
            class="form-control m-input ingredient_quantity"
            placeholder="ادخل الكميه..." />
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

