@if(isset($record['num_of_nights']))
    <label>عدد الليالي :</label>
    <input
        type="number"
        value="{{old('num_of_nights')?old('num_of_nights'):$record['num_of_nights']}}"
        name="num_of_nights"
        readonly="readonly"
        id="num_of_nights"
        required=""
        class="form-control m-input"
    />
    @error('num_of_nights')
    <span class="invalid-feedback" role="alert">
             <strong>{{ $message }}</strong>
    </span>
    @enderror
@elseif(isset($num_of_nights))
    <label>عدد الليالي :</label>
    <input
        type="number"
        value="{{$num_of_nights}}"
        readonly="readonly"
        name="num_of_nights"
        id="num_of_nights"
        required=""
        class="form-control m-input"
    />
    @error('num_of_nights')
    <span class="invalid-feedback" role="alert">
             <strong>{{ $message }}</strong>
    </span>
    @enderror
@else
    <label>عدد الليالي :</label>
    <input
        type="number"
        value="{{old('num_of_nights')}}"
        name="num_of_nights"
        id="num_of_nights"
        required=""
        class="form-control m-input"
    />
    @error('num_of_nights')
    <span class="invalid-feedback" role="alert">
       <strong>{{ $message }}</strong>
</span>
    @enderror
@endif


