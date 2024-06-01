@if(isset($record['exemption_reason']))
    <div>
        <label> سبب الاعفاء:</label>
        <textarea
            name="exemption_reason"
            class="form-control m-input"
            placeholder="اضف سبب الاعفاء..."
        > {{$record['exemption_reason']}}</textarea>
        @error('exemption_reason')
        <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
    </div>
@endif
@if(isset($exemption))
    @if($exemption == 'Exempted')
        <label> سبب الاعفاء:</label>
        <textarea
            name="exemption_reason"
            class="form-control m-input"
            placeholder="اضف سبب الاعفاء..."
        > </textarea>
        @error('exemption_reason')
        <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
    @endif

@endif
