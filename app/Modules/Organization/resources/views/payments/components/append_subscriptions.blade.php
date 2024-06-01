    <label>اسم الاشتراك:</label>
    <select required class="form-control" name="subscription_id" id ="subscription_id"
    >
        @if(!empty($record['subscription_id']))
            <option  value="{{$record['subscription_id']}}"
                     @if ( isset($record['subscription_id']))
                     selected =""
                @endif
            >اختار التدريب</option>
        @else
            <option value="0"
                    @if ( isset($record['subscription_id']))
                    selected =""
                @endif
            >اختار التدريب</option>
        @endif
        @if (!empty($subscriptions))
            @foreach ($subscriptions as $subscription )
                <option value="{{ $subscription['id'] }}"
                        @if (isset($record['subscription_id']) && $record['subscription_id']== $subscription->id )
                        selected =""
                    @endif
                >{{ $subscription['pricing_name'] }}</option>
            @endforeach
        @endif
    </select>
    @error('subscription_id')
    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
    @enderror
