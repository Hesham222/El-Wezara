@if(isset($record) && ! old('vendors'))
    @foreach($record->vendors as $pivotVendor)
    <tr>



        <td>
            <input
                type="number"
                required
                class="form-control"
                value="{{ $pivotVendor->pivot->discount_amount }}"
                name="amounts[]"
                placeholder="Discount amount(%)..."
            >
        </td>

        <td>
            <select
                name="vendors[]"
                required
                class="vendor-id form-control selectpicker"
                data-live-search="true">
                @foreach($vendors as $vendor)
                    <option
                        value="{{$vendor->id}}"
                        {{ $vendor->id == $pivotVendor->id ? "selected" : "" }}>
                        {{ $vendor->name}} - {{ $vendor->username}}
                    </option>
                @endforeach
            </select>
        </td>
        <td>
            <input
                type="number"
                required
                min="0"
                max="100"
                step="0.01"
                class="form-control"
                value="{{ $pivotVendor->pivot->discount_amount }}"
                name="amounts[]"
                placeholder="Discount amount(%)..."
                >
        </td>
        <td>
            <a
                title="Remove the row"
                class="btn btn-sm btn-danger"
                onclick="DeleteVendorRowTable(this)">
                <i class="fa fa-times" style="color: #fff"></i>
            </a>
        </td>
    </tr>
    @endforeach
@elseif( ( old('vendors') && is_array( old('vendors') ) ) || ( old('vendors') && is_array(old('vendors')) && isset($record) )  )
    @foreach(old('vendors') as $key=>$oldVendor)
    <tr>
        <td>
            <select
                name="vendors[]"
                required
                class="vendor-id form-control selectpicker"
                data-live-search="true">
                @foreach($vendors as $vendor)
                    <option
                        value="{{$vendor->id}}"
                        {{ $vendor->id == $oldVendor ? "selected" : "" }}>
                        {{ $vendor->name}} - {{ $vendor->username}}
                    </option>
                @endforeach
            </select>
        </td>
        <td>
            <input
                type="number"
                required
                step="0.01"
                min="0"
                max="100"
                class="form-control"
                value="{{old('amounts')[$key]}}"
                name="amounts[]"
                placeholder="Discount amount(%)..."
                >
        </td>
        <td>
            <a
                title="Remove the row"
                class="btn btn-sm btn-danger"
                onclick="DeleteVendorRowTable(this)" >
                <i class="fa fa-times" style="color: #fff"></i>
            </a>
        </td>
    </tr>
    @endforeach



@else
<tr>

{{--    <td>--}}
{{--        <input--}}
{{--            type="text"--}}
{{--            required--}}
{{--            class="form-control"--}}
{{--            value="{{$ingredients->first()->unit_of_measurement->name}}"--}}
{{--            readonly--}}

{{--        >--}}
{{--    </td>--}}


    <td>
        <input
            type="number"
            required
            min="0"
            class="form-control quant"
            name="quantities[]"
            placeholder="الكمية..."
        >
    </td>




    <td>
        <select
            name="ingredients[]"
            required

            class=" form-control  ingredient"
            data-live-search="true">
            @foreach($ingredients as $ingredient)
                <option
                    data-type = "ingredient"
                    value="{{$ingredient->id}}">
                    {{ $ingredient->getTranslation('name', 'ar')}} / {{ $ingredient->getTranslation('name', 'en')}} [{{$ingredient->quantity}} . {{$ingredient->unit_of_measurement->name}}]
                </option>
            @endforeach
                @foreach($items as $item)
                    <option
                        data-type = "item"
                        value="{{$item->id}}">
                        {{ $item->getTranslation('name', 'ar')}} / {{ $item->getTranslation('name', 'en')}}
                    </option>
                @endforeach
                @foreach($item_variants as $item_variant)
                    <option
                        data-type = "item_variant"
                        value="{{$item_variant->id}}">
                        {{ $item_variant->getTranslation('name', 'ar')}} / {{ $item_variant->getTranslation('name', 'en')}}
                    </option>
                @endforeach
        </select>
    </td>

    <td>
        <a
            title="Remove the row"
            class="btn btn-sm btn-danger"
            onclick="DeleteVendorRowTable(this)">
            <i class="fa fa-times" style="color: #fff"></i>
        </a>
    </td>
    @if(count($ingredients) > 0)
    <input type="hidden" value="1" name="comType[]" />
    @elseif(count($items) > 0)
        <input type="hidden" value="2" name="comType[]" />
    @elseif(count($item_variants) > 0)
        <input type="hidden" value="3" name="comType[]" />
    @endif
</tr>
    <input type="hidden" value="{{csrf_token()}}" id="token"/>
@endif
