<div class="form-group m-form__group row">
    <div class="col-lg-12">
        <label class="">الخدمات:</label><br>
        <table  width="100%" class="table table-striped- table-bordered table-hover table-checkable" id="services-table">
            <col style="width:30%">
            <col style="width:20%">
            <col style="width:20%">
            <col style="width:30%">
            <col style="width:10%">
            <thead>
            <tr>
                <th style="font-weight: bold;">الخدمه</th>
                <th style="font-weight: bold;">الكميه</th>
                <th style="font-weight: bold;">السعر</th>
                <th style="font-weight: bold;">تفاصيل</th>
                <th style="font-weight: bold;">مسح</th>
            </tr>
            </thead>
            <tbody>
            @include('Organization::packages.components.service.row')
            </tbody>
        </table>
        <div class="row">
            <div class="col-lg-12">
                <button type="button" class="btn btn-default " id="new_service_row"><i class="fa fa-plus"></i></button>
            </div>
        </div>
    </div>
</div>
