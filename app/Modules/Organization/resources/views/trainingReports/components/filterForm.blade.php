<form  method="GET"  action="{{route('organizations.trainingReport.export')}}" id="filterDataForm">
<input type="hidden" name="view" value="{{ request()->input('view',0)}}">
    <div style="display: flex;justify-content: flex-end;align-items:flex-end;margin-bottom: 20px">
        <div class="input-group" style="width: 40%">
        </div>
        <div class="input-group" style="width: 40%">
            <select name="day" id="dayCol" required="" class="form-control m-input m-input--square" >
                <option value="">--اختر يوم--</option>

                <option value="Saturday">Saturday
                </option>
                <option value="Sunday">Sunday
                </option>
                <option value="Monday">Monday
                </option>
                <option value="Tuesday">Tuesday
                </option>
                <option value="Wednesday">Wednesday
                </option>
                <option value="Thursday">Thursday
                </option>
                <option value="Friday">Friday
                </option>
            </select>
        </div>
    </div>
    <div style="display: flex;justify-content: flex-end;align-items:flex-end;margin-bottom: 20px">
    <div class="input-group" style="width: 50%">
      <div class="input-group-prepend">
        <span hidden class="input-group-text" id="">من</span>
        <input hidden type="date" name="start_date" id="startDateCol" class="form-control">
      </div>
      @if($errors->has('start_date'))
      <span hidden class="invalid-feedback" style="display:block;" role="alert">
        <strong hidden>{{ $errors->first('start_date') }}</strong>
      </span>
      @endif
      <div class="input-group-prepend">
        <span hidden class="input-group-text" id="">الى</span>
        <input hidden type="date" name="end_date" id="endDateCol" class="form-control">
      </div>
      @if($errors->has('end_date'))
      <span hidden class="invalid-feedback" style="display:block;" role="alert">
        <strong hidden>{{ $errors->first('end_date') }}</strong>
      </span>
      @endif
    </div>
    <div class="input-group" style="width: 50%">
      <input hidden="hidden" type="text" name="value" id="searchField" class="form-control" aria-label="Text input with dropdown button">
      <div class="input-group-append">
        <select
            hidden
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
