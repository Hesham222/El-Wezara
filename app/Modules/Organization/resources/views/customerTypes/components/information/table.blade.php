<div class="form-group m-form__group row">
    <div class="col-lg-12 prices-wrapper" >
        <label class="">معلومات:</label><br>
        <table  width="100%" class="table table-striped- table-bordered table-hover table-checkable" id="pricing-table">
            <col style="width:30%">
            <col style="width:30%">
            <col style="width:30%">
            <col style="width:10%">
            <thead>
            <tr>
                <th style="font-weight: bold;">عنوان </th>
                <th style="font-weight: bold;"> نوع الوثيقة </th>
                <th style="font-weight: bold;">الحاله</th>
                <th style="font-weight: bold;">مسح</th>
            </tr>
            </thead>
            <tbody>

            @include('Organization::customerTypes.components.information.row')
            </tbody>
        </table>
        <div class="row">
            <div class="col-lg-12">
                <button type="button" class="btn btn-default " id="new_pricing_row"><i class="fa fa-plus"></i></button>
            </div>
        </div>
    </div>
</div>
