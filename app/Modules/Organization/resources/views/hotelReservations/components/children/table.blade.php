@if(!is_null($record->num_of_children) || $record->num_of_children > 0)
<div class="form-group m-form__group row">
    <div class="col-lg-12">
        <label class="">الاطفال :</label><br>
        <table  width="100%" class="table table-striped- table-bordered table-hover table-checkable" id="ingredients-table">
            <col style="width:40%">
            <col style="width:40%">
            <col style="width:20%">
            <thead>
            <tr>
                <th style="font-weight: bold;"> الاسم</th>
                <th style="font-weight: bold;"> العمر </th>
                {{--<th style="font-weight: bold;">مسح</th>--}}
            </tr>
            </thead>
            <tbody>

            @include('Organization::hotelReservations.components.children.row')
            </tbody>
        </table>
        {{--<div class="row">
            <div class="col-lg-12">
                <button type="button" class="btn btn-default " id="new_row"><i class="fa fa-plus"></i></button>
            </div>
        </div>--}}
    </div>
</div>
@endif
