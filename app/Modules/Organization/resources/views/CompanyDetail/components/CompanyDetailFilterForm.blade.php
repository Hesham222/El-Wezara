<form  method="GET"  action="{{route('organizations.CompanyDetail.export',$supplier->id)}}" id="filterDataForm">
    <input type="hidden" name="view" value="{{ request()->input('view',0)}}">
      <div style="display: flex;justify-content: flex-end;align-items:flex-end;margin-bottom: 20px">
        <div class="input-group" style="width: 50%">
{{--          <input type="text" name="value" id="searchField" class="form-control" aria-label="Text input with dropdown button">--}}
          <div class="input-group-append">
{{--            <select--}}
{{--                    name="column"--}}
{{--                    id="searchColumn"--}}
{{--                    class="form-control"--}}
{{--                    data-live-search="true"--}}
{{--                    title="أضغط هنا ...">--}}
{{--              <option value="_id">التعريف</option>--}}
{{--              @if(request()->query('view')=='trash')--}}
{{--                <option value="deletedBy">مسح بواسطه</option>--}}
{{--              @endif--}}
{{--            </select>--}}
          </div>
          <div class="input-group-append">
{{--            <button--}}
{{--                    id="searchButton"--}}
{{--                    class="btn btn-primary"--}}
{{--                    type="button"--}}
{{--                    title="بحث"--}}
{{--                    >--}}
{{--              <i class="fa fa-search"></i>--}}
{{--            </button>--}}
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
