<div class="form-group m-form__group row">
    <div class="col-lg-12">
        <label class="">المكونات:</label><br>
        <table  width="100%" class="table table-striped- table-bordered table-hover table-checkable" id="ingredients-table">
            <col style="width:50%">
            <col style="width:30%">
            <col style="width:10%">
            <thead>
                <tr>
{{--                    <th style="font-weight: bold;">UOM</th>--}}
                    <th style="font-weight: bold;">الكمية</th>
                    <th style="font-weight: bold;">اسم المكون </th>
                    <th style="font-weight: bold;">يمكن ان يزال</th>
                    <th class="show-variant" style="font-weight: bold;display: none">متنوع منه</th>
                    <th style="font-weight: bold;">اجراءات</th>
                </tr>
            </thead>
            <tbody>
                @include('Organization::items.components.ingredients.row')
            </tbody>
        </table>
        <div class="row">
            <div class="col-lg-12">
                <button type="button" class="btn btn-default " id="new_row"><i class="fa fa-plus"></i></button>
            </div>
        </div>
    </div>
</div>


