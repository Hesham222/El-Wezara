    <label>التدريب:</label>
    <select required class="form-control" name="training_id" id ="training_id"
    >
        @if(isset($record))
            @if (!empty($trainings))
                @foreach ($trainings as $training )
                    <option value="{{ $training['id'] }}"
                            @if (!empty($record['training_id']) && $record['training_id']== $training->id )
                            selected =""
                        @endif
                    >{{ $training['name'] }}</option>
                @endforeach
            @endif
        @else
            <option value="0">-- اختر اسم التدريب --</option>
        @endif

        @if (!empty($trainingsAll))
            @foreach ($trainingsAll as $trainingAll )
                <option value="{{ $trainingAll['id'] }}"
                        @if (!empty($record['training_id']) && $record['training_id']== $training->id )
                        selected =""
                    @endif
                >{{ $trainingAll['name'] }}</option>
            @endforeach
        @endif
    </select>
    @error('training_id')
    <span class="invalid-feedback" role="alert">
           <strong>{{ $message }}</strong>
    </span>
    @enderror
