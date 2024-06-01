<form  method="GET"  action="{{route('organizations.subscription.export')}}" id="filterDataForm">
<input type="hidden" name="view" value="{{ request()->input('view',0)}}">
    <div style="display: flex;justify-content: flex-end;align-items:flex-end;margin-bottom: 20px">
        <div class="input-group" style="width: 40%">
            <select
                name="subscriber"
                id="subscriberColumn"
                class="form-control"
                data-live-search="true"
                title="Please select city ...">
                <option value="">المشتركين</option>
                @foreach($subscribers as $subscriber)
                    <option value="{{$subscriber->id}}">{{$subscriber->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="input-group" style="width: 40%">
            <select
                name="training"
                id="trainingColumn"
                class="form-control"
                data-live-search="true"
                title="Please select city ...">
                <option value="">التدريبات</option>
                @foreach($trainings as $training)
                    <option value="{{$training->id}}">{{$training->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="input-group" style="width: 40%">
            <select
                name="price_name"
                id="price_nameColumn"
                class="form-control"
                data-live-search="true"
                title="Please select city ...">
                <option value="">الاشتراكات</option>
                @foreach($pricing as $price_name)
                    <option value="{{$price_name->pricing_name}}">{{$price_name->pricing_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div style="display: flex;justify-content: flex-end;align-items:flex-end;margin-bottom: 20px">
    <div class="input-group" style="width: 50%">
      <div class="input-group-prepend">
        <span class="input-group-text" id="">من</span>
        <input type="date" name="start_date" id="startDateCol" class="form-control">
      </div>
      @if($errors->has('start_date'))
      <span class="invalid-feedback" style="display:block;" role="alert">
        <strong>{{ $errors->first('start_date') }}</strong>
      </span>
      @endif
      <div class="input-group-prepend">
        <span class="input-group-text" id="">الى</span>
        <input type="date" name="end_date" id="endDateCol" class="form-control">
      </div>
      @if($errors->has('end_date'))
      <span class="invalid-feedback" style="display:block;" role="alert">
        <strong>{{ $errors->first('end_date') }}</strong>
      </span>
      @endif
    </div>
    <div class="input-group" style="width: 50%">
      <input type="text" name="value" id="searchField" class="form-control" aria-label="Text input with dropdown button">
      <div class="input-group-append">
        <select
                name="column"
                id="searchColumn"
                class="form-control"
                data-live-search="true"
                title="أضغط هنا ...">
          <option value="_id">التعريف</option>
          @if(request()->query('view')=='trash')
            <option value="deletedBy">مسح بواسطه</option>
          @endif
        </select>
      </div>
      <div class="input-group-append">
        <button
                id="searchButton"
                class="btn btn-primary"
                type="button"
                title="بحث"
                >
          <i class="fa fa-search"></i>
        </button>
        <button
                id="exportButton"
                class="btn btn-primary"
                type="submit"
                style="margin:0 5px"
                title="تحميل"
                >
          <i class="fa fa-file"></i>
        </button>
      </div>
    </div>
  </div>
</form>
