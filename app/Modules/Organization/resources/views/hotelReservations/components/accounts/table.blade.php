@if($record->RoomType->num_of_persons > 1 || !is_null($record->num_of_extra_beds))
<div class="form-group m-form__group row">
    <div class="col-lg-12 prices-wrapper" >
        <label class="">حسابات متصلة:</label><br>
        <div class="row">
        {{--<table class="table table-striped- table-bordered table-hover table-checkable" id="pricing-table">
            <thead>
            <tr>
                <th style="font-weight: bold;">الاسم</th>
                <th style="font-weight: bold;"> الرقم القومي </th>
                <th style="font-weight: bold;">صوره البطاقه</th>
                <th style="font-weight: bold;">صوره عقد الزواج</th>
                <th style="font-weight: bold;"> التفاصيل</th>
                --}}{{--<th style="font-weight: bold;">مسح</th>--}}{{--
            </tr>
            </thead>
            <tbody>--}}
            @include('Organization::hotelReservations.components.accounts.row')
            {{--</tbody>
        </table>--}}
        {{--<div class="row">
            <div class="col-lg-12">
                <button type="button" class="btn btn-default " id="new_pricing_row"><i class="fa fa-plus"></i></button>
            </div>
        </div>--}}
        </div>
    </div>
</div>
@endif
