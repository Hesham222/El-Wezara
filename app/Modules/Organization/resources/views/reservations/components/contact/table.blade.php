<div class="form-group m-form__group row">
    <div class="col-lg-12">
        <label class="">التواصل:</label><br>
        <table  width="100%" class="table table-striped- table-bordered table-hover table-checkable" id="contacts-table">
            <col style="width:10%">
            <col style="width:10%">
            <col style="width:10%">
            <col style="width:10%">
            <col style="width:10%">
            <thead>
            <tr>
                <th style="font-weight: bold;">الاسم</th>
                <th style="font-weight: bold;">البريد الالكتروني</th>
                <th style="font-weight: bold;">الرقم</th>
                <th style="font-weight: bold;">اللقب</th>
                <th style="font-weight: bold;">الرقم القومي</th>
                <th style="font-weight: bold;">العنوان</th>
                <th style="font-weight: bold;">مسح</th>
            </tr>
            </thead>
            <tbody>
            @include('Organization::reservations.components.contact.row')
            </tbody>
        </table>
        <div class="row">
            <div class="col-lg-12">
                <button type="button" class="btn btn-default " id="new_contact_row"><i class="fa fa-plus"></i></button>
            </div>
        </div>
    </div>
</div>
