
@if(isset($record))
    @foreach($vendorData as $data)
        @if($data)
            @if(pathinfo($data->attachment, PATHINFO_EXTENSION) == 'pdf')
                <a target="_blank" href="{{asset('storage'.DS().$data->attachment)}}">View pdf</a>
                <input type="hidden" name="pdf" value="{{ $data->attachment}}">
            @else
                @if(filter_var($data->attachment, FILTER_VALIDATE_URL))
                    <img src="{{ $data->attachment }}" alt="image-not-uploaded" width="100"></td>
                @else
                    <img src="{{asset('storage'.DS().$data->attachment)}}" alt="image-not-uploaded" width="100"></td>
                @endif
            @endif
            <td>
                <input
                    type="text"
                    name="text[]"
                    disabled
                    value="{{$data->text}}"
                    class="form-control m-input"
                    placeholder="ادخل النص..." />
                @error('text')
                <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                @enderror
            </td>
        @endif
    @endforeach
@endif
<table>

    @if(isset($record))
        @foreach ($record->VendorType->information as $info)
            <thead>
            <th>{{$info->title}}</th>
            </thead>
            <tbody>
            <tr>
                @if($info -> document_type == 'مرفق')

                    <td>
                        <input
                            type="file"
                            name="attachment[]"
                            class="form-control m-input"
                        />

                    </td>

                @else
                    <td>
                        <input
                            type="text"
                            name="text[]"
                            class="form-control m-input"
                            placeholder="ادخل النص..." />
                        @error('text')
                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                        @enderror
                    </td>

                @endif

            </tr>
            </tbody>
        @endforeach

    @endif
</table>

<table>
    @if(isset($vendor_information))
        @foreach ($vendor_information as $information)
    <thead>
        <th>{{$information->title}}</th>
    </thead>
    <tbody>
        <tr>
            @if($information -> document_type == 'مرفق')

            <td>
                <input @if($information->status=="1")
                       required=""
                       @endif
                       name="attachment[]" id="attachment[]" type="file">
            </td>
            @else
                <td>
                    <input
                        type="text"
                        name="text[]"
                        @if($information->status=="1")
                        required=""
                        @endif
                        class="form-control m-input"
                        placeholder="ادخل النص..." />
                    @error('text')
                    <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                    @enderror
                </td>

            @endif

        </tr>
    </tbody>
    @endforeach

    @endif
</table>

