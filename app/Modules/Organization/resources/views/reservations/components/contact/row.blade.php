<tr class="nearest-contact">
    <td>
        <input
            type="text"
            value="{{old('name[]')}}"
            name="name[]"
            required=""
            class="form-control m-input"
            placeholder="ادخل الاسم كامل..." />
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </td>
    <td>
        <input
            type="email"
            value="{{old('email[]')}}"
            name="email[]"
            required=""
            class="form-control m-input"
            placeholder="ادخل البريد الالكتروني..." />
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </td>
    <td>
        <input
            type="phone" maxlength="15"
            value="{{old('phone[]')}}"
            name="phone[]"
            required=""
            class="form-control m-input"
            placeholder="ادخل الموبايل..."
            id="phone"
        />
        @error('phone')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </td>
    <td>
        <input
            type="text"
            value="{{old('title[]')}}"
            name="title[]"
            required=""
            class="form-control m-input"
            placeholder="اللقب..." />
        @error('title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </td>
    <td>
        <input
            type="phone" maxlength="14"
            value="{{old('national_id[]')}}"
            name="national_id[]"
            required=""
            class="form-control m-input"
            placeholder="ادخل الرقم القومي..."
            id="national_id"
        />
        @error('national_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </td>
    <td>
        <input
            type="text"
            value="{{old('address[]')}}"
            name="address[]"
            required=""
            class="form-control m-input"
            placeholder="ادخل العنوان..." />
        @error('address')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </td>
    <td>
        <a
            title="Remove the row"
            class="btn btn-sm btn-danger"
            onclick="DeleteContactRowTable(this)">
            <i class="fa fa-times" style="color: #fff"></i>
        </a>
    </td>
</tr>

