<div class="form-group m-form__group row">
    <div class="col-lg-12">
        <label class="">خدمه اضافيه:</label><br>
        <table  width="100%" class="table table-striped- table-bordered table-hover table-checkable" id="ingredients-table">
            <col style="width:30%">
            <col style="width:20%">
            <col style="width:20%">
            <col style="width:30%">
            <col style="width:10%">
            <thead>
            <tr>
                <th style="font-weight: bold;">الخدمه</th>
                <th style="font-weight: bold;">الكميه</th>
                <th style="font-weight: bold;">مسح</th>
            </tr>
            </thead>
            <tbody>
            @include('Organization::inventoryOrders.components.ingredient.row')
            </tbody>
        </table>
        <div class="row">
            <div class="col-lg-12">
                <button type="button" class="btn btn-default " id="new_service_row"><i class="fa fa-plus"></i></button>
            </div>
        </div>
    </div>
</div>
