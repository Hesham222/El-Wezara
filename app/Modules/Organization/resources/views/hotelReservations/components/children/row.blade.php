@if(count($record->LinkedChildren) == 0)
    @for($i = 1; $i <= $record->num_of_children; $i++)
        <tr>
            <td>
                <input
                    type="text"
                    name="children_name[]"
                    required=""
                    class="form-control m-input"
                    placeholder="الاسم..." />
                @error('children_name')
                <span class="invalid-feedback" role="alert">
                   <strong>{{ $message }}</strong>
            </span>
                @enderror
            </td>
            <td>
                <input
                    type="number"
                    name="age[]"
                    required=""
                    class="form-control m-input"
                />
                @error('age')
                <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                @enderror

            </td>
            {{--<td>
                <a
                    title="Remove the row"
                    class="btn btn-sm btn-danger"
                    onclick="DeletePricingRowTable(this)">
                    <i class="fa fa-times" style="color: #fff"></i>
                </a>
            </td>--}}
        </tr>
    @endfor
@else
    @foreach($record->LinkedChildren as $children)
        <tr>
            <td>
                <input
                    type="text"
                    name="children_name[]"
                    required=""
                    class="form-control m-input"
                    placeholder="الاسم..."
                value="{{$children->name}}"/>
                @error('children_name')
                <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                </span>
                @enderror
            </td>
            <td>
                <input
                    type="number"
                    name="age[]"
                    required=""
                    class="form-control m-input"
                value="{{$children->age}}"/>
                @error('age')
                <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                @enderror

            </td>
            {{--<td>
                <a
                    title="Remove the row"
                    class="btn btn-sm btn-danger"
                    onclick="DeletePricingRowTable(this)">
                    <i class="fa fa-times" style="color: #fff"></i>
                </a>
            </td>--}}
        </tr>
    @endforeach
@endif


