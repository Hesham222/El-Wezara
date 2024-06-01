<label>مدرب لحسابه الخاص:</label>
<select required class="form-control" name="freelance_trainer_id"
        id="freelance_trainer_id">
    @if(isset($record['freelance_trainer_id']))
        @if (!empty($freelance_trainers))
            @foreach ($freelance_trainers as $freelance_trainer )
                <option value="{{ $freelance_trainer['id'] }}"
                        @if (!empty($record['freelance_trainer_id']) && $record['freelance_trainer_id']== $freelance_trainer->id )
                        selected =""
                    @endif
                >{{ $freelance_trainer['name'] }}</option>
            @endforeach
        @endif
    @else
        <option value="">-- اختر اسم التدريب --</option>
    @endif
    @if (!empty($trainers))
        @foreach ($trainers as $trainer )
            <option value="{{ $trainer['id'] }}"
                    @if (isset($record['freelance_trainer_id']) && $record['freelance_trainer_id']== $trainer->id )
                    selected =""
                @endif
            >{{ $trainer['name'] }}</option>
        @endforeach
    @endif
</select>
@error('freelance_trainer_id')
<span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror
