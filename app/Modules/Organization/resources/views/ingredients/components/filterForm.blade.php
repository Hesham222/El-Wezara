<form  method="GET"  action="{{route('organizations.ingredient.export')}}" id="filterDataForm">
    <div style="display: flex;justify-content: flex-end;align-items:flex-end;margin-bottom: 20px">
        <div class="input-group" style="width: 50%">
            <div class="input-group-prepend">
                <span class="input-group-text" id="">@lang('Admin::admin.from')</span>
                <input type="date" name="start_date" id="startDateCol" class="form-control">
            </div>
            @if($errors->has('start_date'))
                <span class="invalid-feedback" style="display:block;" role="alert">
        <strong>{{ $errors->first('start_date') }}</strong>
      </span>
            @endif
            <div class="input-group-prepend">
                <span class="input-group-text" id="">@lang('Admin::admin.to')</span>
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
                    title="Please select a lunch ...">
                    <option value="_id">ID</option>
                    <option value="name">@lang('Organization::organization.name')</option>
                    <option value="description">Description</option>
                    <option value="quantity">@lang('Organization::organization.quantity')</option>
                    <option value="cost">@lang('Organization::organization.cost')</option>
                    @if(request()->query('view')=='trash')
                        <option value="deletedBy">@lang('Organization::organization.deletedBy')</option>
                    @endif
                </select>
            </div>
            <div class="input-group-append">
                <button
                    id="searchButton"
                    class="btn btn-primary"
                    type="button"
                    title="search data"
                >
                    <i class="fa fa-search"></i>
                </button>
                                <a
                                    id="exportButton"
                                    class="btn btn-primary"

                                    style="margin:0 5px"
                                    title="export data"
                                >
                                    <i class="fa fa-file"></i>
                                </a>

            </div>
        </div>
    </div>
</form>
<script>

</script>
