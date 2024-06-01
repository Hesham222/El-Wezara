    <label>مساحه النشاط الرياضي:</label>
    <select required class="form-control" name="external_reservation_id" id ="external_reservation_id"
    >
        <option>-- اخر مساحه النشاط الرياضي --</option>
        @if (!empty($subscriptions))
            @foreach ($subscriptions as $subscription )
                <option value="{{ $subscription['id'] }}"

                >{{ $subscription->ExternalPricing->ActivityArea->name }}</option>
            @endforeach
        @endif
    </select>
    @error('external_reservation_id')
    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
    @enderror
