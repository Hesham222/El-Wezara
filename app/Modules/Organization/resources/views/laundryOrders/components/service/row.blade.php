<tr class="nearest-service">
    <td>
        <select name="categories[]" id="categories" required=""
                class="form-control m-input m-input--square categories"
                id="exampleSelect1">
            <option value="" disabled selected>Please select a category</option>
            @foreach($categories as $category)
                <option
                value="{{ $category->id }}">{{ $category->name }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <select name="subCategories[]" id="subCategories" required=""
                class="form-control m-input m-input--square subCategories"
                id="exampleSelect1">
            <option value="" disabled selected>Please select a sub category</option>

        </select>
    </td>
    <td>
        <select name="services[]" id="services" required=""
                class="form-control m-input m-input--square services"
                id="exampleSelect1">
            <option value="" disabled selected>Please select a service</option>

        </select>
    </td>
    <td>
        <input
            type="number"
            step="1"
            value="{{old('category_quantity[]')}}"
            name="category_quantity[]"
            required=""
            class="form-control m-input category_quantity"
            placeholder="ادخل الكميه..." />
    </td>
    <td>
        <input
            type="number"
            step="0.01"
            value="{{old('category_price[]')}}"
            name="category_price[]"
            required=""
            class="form-control m-input category_price"
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

