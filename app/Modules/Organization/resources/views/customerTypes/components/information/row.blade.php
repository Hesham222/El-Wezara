<tr>
    <td>
        <input
            type="text"
            name="title[]"
            required=""
            class="form-control m-input"
            placeholder="العنوان..." />
        @error('title')
        <span class="invalid-feedback" role="alert">
                   <strong>{{ $message }}</strong>
            </span>
        @enderror
    </td>
    <td>
        <select id="document_type[]" name="document_type[]" required="" class="form-control m-input m-input--square" >

            <option value="مرفق">مرفق
            </option>

            <option value="نص"> نص
            </option>

        </select>
    </td>
    <td>
        <label>مطلوب أم لا</label>
        <input type="checkbox" name="status[]" value="1" class="form-control m-input">

        <input type="hidden" value="0" name="status[]">
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
