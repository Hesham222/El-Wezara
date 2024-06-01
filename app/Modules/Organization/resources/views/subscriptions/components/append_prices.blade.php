<label>اسم الاشتراك:</label>
<select required class="form-control" name="pricing_name" id="pricing_name"
        >
    @if(isset($record['pricing_name']))
                <option value="{{ $record['pricing_name'] }}">{{ $record['pricing_name']}}</option>
    @else
        <option value="">-- اختر اسم الاشتراك --</option>
    @endif
    @if (!empty($pricings))
        @foreach ($pricings as $pricing )
            <option value="{{ $pricing['pricing_name'] }}"
                    @if (isset($record['pricing_name']) && $record['pricing_name']== $pricing->pricing_name )
                    selected =""
                @endif
            >{{ $pricing['pricing_name'] }}</option>
        @endforeach
    @endif
</select>
@error('pricing_name')
<span class="invalid-feedback" role="alert">
             <strong>{{ $message }}</strong>
</span>
@enderror



