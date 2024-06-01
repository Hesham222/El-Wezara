<form  method="GET"  action="{{route('organizations.training.export')}}" id="filterDataForm">
<input type="hidden" name="view" value="{{ request()->input('view',0)}}">
    <div style="display: flex;justify-content: flex-end;align-items:flex-end;margin-bottom: 20px">
        <div class="input-group" style="width: 40%">
            <select
                name="clubSport"
                id="clubSportColumn"
                class="form-control"
                data-live-search="true"
                title="Please select city ...">
                <option value="">رياضات النادى</option>
                @foreach($clubSports as $clubSport)
                    <option value="{{$clubSport->id}}">{{$clubSport->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="input-group" style="width: 40%">
            <select
                name="area"
                id="areaColumn"
                class="form-control"
                data-live-search="true"
                title="Please select city ...">
                <option value="">مساحات للانشطه الرياضيه</option>
                @foreach($areas as $area)
                    <option value="{{$area->id}}">{{$area->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="input-group" style="width: 40%">
            <select
                name="trainer"
                id="trainerColumn"
                class="form-control"
                data-live-search="true"
                title="Please select city ...">
                <option value="">المدربين</option>
                @foreach($trainers as $trainer)
                    <option value="{{$trainer->id}}">{{$trainer->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="input-group" style="width: 40%">
            <select name="type" id="typeColumn"  required="" class="form-control m-input m-input--square" >

                <option value=""> اختر نوع التدريب </option>

                <option value="مواعيد ثابتة بالجلسات">مواعيد ثابتة بالجلسات
                </option>

                <option value="بعدد الجلسات">بعدد الجلسات
                </option>

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
          <option value="name">الاسم</option>
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
