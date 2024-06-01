@if(count($record->LinkedAccounts) == 0)
    @for($i = 2; $i <= $record->RoomType->num_of_persons + $extraBeds; $i++)
            <div class="col-lg-3">
                <input
                    type="text"
                    name="name[]"
                    required=""
                    class="form-control m-input"
                    placeholder="الاسم..." />
                @error('name')
                <span class="invalid-feedback" role="alert">
                   <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>
            <div class="col-lg-3">
                <input
                    type="number"
                    maxlength="14"
                    name="national_id[]"
                    required=""
                    placeholder="الرقم القومي..."
                    class="form-control m-input"
                />
                @error('national_id')
                <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                @enderror

            </div>
            <div class="col-lg-2">
                <input required name="attachment[]" id="attachment" type="file">
            </div>
            <div class="col-lg-2">
                <input name="marriage_contract[]" id="marriage_contract" type="file">
            </div>
            <div class="col-lg-2">
                <textarea id="note" name="note[]" rows="4" cols="50"></textarea>
                @error('note')
                <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
         </span>
                @enderror
            </div>
            {{--<td>
                <a
                    title="Remove the row"
                    class="btn btn-sm btn-danger"
                    onclick="DeletePricingRowTable(this)">
                    <i class="fa fa-times" style="color: #fff"></i>
                </a>
            </td>--}}
    @endfor
@else
    @foreach($record->LinkedAccounts as $account)
            <div class="col-lg-3">
                    <input
                        type="text"
                        name="name[]"
                        required=""
                        class="form-control m-input"
                        placeholder="الاسم..."
                    value="{{$account->name}}"/>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                </span>
                    @enderror
            </div>
            <div class="col-lg-3">
                <input
                    type="number"
                    maxlength="14"
                    name="national_id[]"
                    required=""
                    class="form-control m-input"
                    placeholder="الرقم القومي..."
                    value="{{$account->national_id}}"
                />
                @error('national_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

            </div>
            <div class="col-lg-2">
                <input required name="attachment[]" id="attachment" type="file">
                <br>
                <a href="{{ asset('storage/'.$account->attachment)}}" target="_blank"><img src="{{ asset('storage/'.$account->attachment)}}" width="30%"></a>
            </div>
            <div class="col-lg-2">
                <input required name="marriage_contract[]" id="marriage_contract" type="file">
                <br>
                <a href="{{ asset('storage/'.$account->marriage_contract)}}" target="_blank"><img src="{{ asset('storage/'.$account->marriage_contract)}}" width="30%"></a>
            </div>
            <br>
            <div class="col-lg-2">
                <textarea id="note" name="note[]" rows="4" cols="50">{{$account->note}}</textarea>
                @error('note')
                <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            {{--<td>
                <a
                    title="Remove the row"
                    class="btn btn-sm btn-danger"
                    onclick="DeletePricingRowTable(this)">
                    <i class="fa fa-times" style="color: #fff"></i>
                </a>
            </td>--}}
    @endforeach
@endif
