<x-organization::layout>
    <x-slot name="pageTitle">تقرير الاشغال السنوي | عرض</x-slot name="pageTitle">
    @section('balanceSheets-active', 'm-menu__item--active')
    <x-slot name="style">
        <!-- Some styles -->
    </x-slot>
    <!-- Start page content -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    تقرير الاشغال السنوي
                </h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{request()->input('view')=='trash' ? 'سله المهملات' :  'عرض'}}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">

                <div>


                    <form  method="GET"  action="{{route('organizations.hotelWork.OccupancyAnnualReport')}}" >
                        <input type="hidden" name="view" value="{{ request()->input('view',0)}}">
                        <div style="display: flex;justify-content: flex-end;align-items:flex-end;margin-bottom: 20px">
                            <div class="input-group" style="width: 50%">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">اليوم</span>
                                    <input type="date" name="year" id="startDateCol" class="form-control">
                                </div>
                                @if($errors->has('date'))
                                    <span class="invalid-feedback" style="display:block;" role="alert">
                            <strong>{{ $errors->first('start_date') }}</strong>
                          </span>
                                @endif



                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">الفندق</span>
                                <select name="hotel_id">
                                <option value="0">-- select hotel --</option>
                                @foreach ($hotels as $hotel )
                                    <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                @endforeach
                                </select>
                                   </div>
                                @if($errors->has('date'))
                                    <span class="invalid-feedback" style="display:block;" role="alert">
                            <strong>{{ $errors->first('start_date') }}</strong>
                          </span>
                                @endif


                            </div>

                                <div class="input-group-append">
                                    <button

                                        class="btn btn-primary"

                                        title="بحث"
                                        type="submit"
                                    >
                                        <i class="fa fa-search"></i>
                                    </button>

                                </div>

                                {{-- <div class="input-group-append">
                                    <a

                                        class="btn btn-primary"

                                        title="تحميل"
                                       href="{{ route('organizations.hotelWork.export',['date' => request()->input('date',0)]) }}"
                                    >
                                        <i class="fa fa-file"></i>
                                    </a>

                                </div> --}}

                            </div>
                        </div>
                    </form>

                </div>


                <div class="table-responsive">
                    <section class="content table-responsive">
                        <h5> تقرير الاشغال السنوى </h5>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="data-table" class="table table-striped- table-bordered table-hover table-checkable" >
                                    <thead>

                                    <tr>

                                        <th>يناير</th>
                                        <th>فبراير</th>
                                        <th>مارس</th>
                                        <th>ابريل</th>
                                        <th>مايو</th>
                                        <th>يونيو</th>
                                        <th>يوليو</th>
                                        <th>اغسطتس</th>
                                        <th>سبتمبر</th>
                                        <th>اكتوبر</th>
                                        <th>نوفمبر</th>
                                        <th>ديسمبر</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                            <tr>

                                                <td>

                                                    1 : {{ getDayOccoupcety($year,1,1,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    2: {{ getDayOccoupcety($year,1,2,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    3: {{ getDayOccoupcety($year,1,3,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    4: {{ getDayOccoupcety($year,1,4,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    5: {{ getDayOccoupcety($year,1,5,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    6: {{ getDayOccoupcety($year,1,6,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    7: {{ getDayOccoupcety($year,1,7,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    8: {{ getDayOccoupcety($year,1,8,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    9: {{ getDayOccoupcety($year,1,9,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    10: {{ getDayOccoupcety($year,1,10,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    11: {{ getDayOccoupcety($year,1,11,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    12: {{ getDayOccoupcety($year,1,12,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    13: {{ getDayOccoupcety($year,1,13,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    14: {{ getDayOccoupcety($year,1,14,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    15: {{ getDayOccoupcety($year,1,15,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    16: {{ getDayOccoupcety($year,1,16,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    17: {{ getDayOccoupcety($year,1,17,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    18: {{ getDayOccoupcety($year,1,18,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    19: {{ getDayOccoupcety($year,1,19,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    20: {{ getDayOccoupcety($year,1,20,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    21: {{ getDayOccoupcety($year,1,21,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    22: {{ getDayOccoupcety($year,1,22,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    23: {{ getDayOccoupcety($year,1,23,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    24: {{ getDayOccoupcety($year,1,24,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    25: {{ getDayOccoupcety($year,1,25,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    26: {{ getDayOccoupcety($year,1,26,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    27: {{ getDayOccoupcety($year,1,27,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    28: {{ getDayOccoupcety($year,1,28,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    29: {{ getDayOccoupcety($year,1,29,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    30: {{ getDayOccoupcety($year,1,30,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    31: {{ getDayOccoupcety($year,1,31,$hotel_id)['roomNumber'] }},


                                                </td>

                                                <td>

                                                  1 : {{ getDayOccoupcety($year,2,1,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    2: {{ getDayOccoupcety($year,2,2,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    3: {{ getDayOccoupcety($year,2,3,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    4: {{ getDayOccoupcety($year,2,4,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    5: {{ getDayOccoupcety($year,2,5,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    6: {{ getDayOccoupcety($year,2,6,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    7: {{ getDayOccoupcety($year,2,7,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    8: {{ getDayOccoupcety($year,2,8,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    9: {{ getDayOccoupcety($year,2,9,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    10: {{ getDayOccoupcety($year,2,10,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    11: {{ getDayOccoupcety($year,2,11,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    12: {{ getDayOccoupcety($year,2,12,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    13: {{ getDayOccoupcety($year,2,13,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    14: {{ getDayOccoupcety($year,2,14,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    15: {{ getDayOccoupcety($year,2,15,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    16: {{ getDayOccoupcety($year,2,16,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    17: {{ getDayOccoupcety($year,2,17,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    18: {{ getDayOccoupcety($year,2,18,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    19: {{ getDayOccoupcety($year,2,19,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    20: {{ getDayOccoupcety($year,2,20,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    21: {{ getDayOccoupcety($year,2,21,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    22: {{ getDayOccoupcety($year,2,22,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    23: {{ getDayOccoupcety($year,2,23,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    24: {{ getDayOccoupcety($year,2,24,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    25: {{ getDayOccoupcety($year,2,25,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    26: {{ getDayOccoupcety($year,2,26,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    27: {{ getDayOccoupcety($year,2,27,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    28: {{ getDayOccoupcety($year,2,28,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    29: {{ getDayOccoupcety($year,2,29,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    30: {{ getDayOccoupcety($year,2,30,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    31: {{ getDayOccoupcety($year,2,31,$hotel_id)['roomNumber'] }},

                                                </td>

                                                <td>

                                                    1 : {{ getDayOccoupcety($year,3,1,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    2: {{ getDayOccoupcety($year,3,2,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    3: {{ getDayOccoupcety($year,3,3,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    4: {{ getDayOccoupcety($year,3,4,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    5: {{ getDayOccoupcety($year,3,5,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    6: {{ getDayOccoupcety($year,3,6,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    7: {{ getDayOccoupcety($year,3,7,$hotel_id)['roomNumber'] }}
                                                    8: {{ getDayOccoupcety($year,3,8,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    9: {{ getDayOccoupcety($year,3,9,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    10: {{ getDayOccoupcety($year,3,10,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    11: {{ getDayOccoupcety($year,3,11,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    12: {{ getDayOccoupcety($year,3,12,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    13: {{ getDayOccoupcety($year,3,13,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    14: {{ getDayOccoupcety($year,3,14,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    15: {{ getDayOccoupcety($year,3,15,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    16: {{ getDayOccoupcety($year,3,16,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    17: {{ getDayOccoupcety($year,3,17,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    18: {{ getDayOccoupcety($year,3,18,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    19: {{ getDayOccoupcety($year,3,19,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    20: {{ getDayOccoupcety($year,3,20,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    21: {{ getDayOccoupcety($year,3,21,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    22: {{ getDayOccoupcety($year,3,22,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    23: {{ getDayOccoupcety($year,3,23,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    24: {{ getDayOccoupcety($year,3,24,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    25: {{ getDayOccoupcety($year,3,25,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    26: {{ getDayOccoupcety($year,3,26,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    27: {{ getDayOccoupcety($year,3,27,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    28: {{ getDayOccoupcety($year,3,28,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    29: {{ getDayOccoupcety($year,3,29,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    30: {{ getDayOccoupcety($year,3,30,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    31: {{ getDayOccoupcety($year,3,31,$hotel_id)['roomNumber'] }},3

                                                </td>


                                                <td>

                                                    1 : {{ getDayOccoupcety($year,4,1,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    2: {{ getDayOccoupcety($year,4,2,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    3: {{ getDayOccoupcety($year,4,3,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    4: {{ getDayOccoupcety($year,4,4,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    5: {{ getDayOccoupcety($year,4,5,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    6: {{ getDayOccoupcety($year,4,6,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    7: {{ getDayOccoupcety($year,4,7,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    8: {{ getDayOccoupcety($year,4,8,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    9: {{ getDayOccoupcety($year,4,9,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    10: {{ getDayOccoupcety($year,4,10,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    11: {{ getDayOccoupcety($year,4,11,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    12: {{ getDayOccoupcety($year,4,12,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    13: {{ getDayOccoupcety($year,4,13,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    14: {{ getDayOccoupcety($year,4,14,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    15: {{ getDayOccoupcety($year,4,15,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    16: {{ getDayOccoupcety($year,4,16,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    17: {{ getDayOccoupcety($year,4,17,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    18: {{ getDayOccoupcety($year,4,18,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    19: {{ getDayOccoupcety($year,4,19,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    20: {{ getDayOccoupcety($year,4,20,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    21: {{ getDayOccoupcety($year,4,21,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    22: {{ getDayOccoupcety($year,4,22,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    23: {{ getDayOccoupcety($year,4,23,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    24: {{ getDayOccoupcety($year,4,24,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    25: {{ getDayOccoupcety($year,4,25,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    26: {{ getDayOccoupcety($year,4,26,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    27: {{ getDayOccoupcety($year,4,27,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    28: {{ getDayOccoupcety($year,4,28,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    29: {{ getDayOccoupcety($year,4,29,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    30: {{ getDayOccoupcety($year,4,30,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    31: {{ getDayOccoupcety($year,4,31,$hotel_id)['roomNumber'] }},z/4

                                                </td>

                                                <td>

                                                   1 : {{ getDayOccoupcety($year,5,1,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    2: {{ getDayOccoupcety($year,5,2,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    3: {{ getDayOccoupcety($year,5,3,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    4: {{ getDayOccoupcety($year,5,4,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    5: {{ getDayOccoupcety($year,5,5,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    6: {{ getDayOccoupcety($year,5,6,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    7: {{ getDayOccoupcety($year,5,7,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    8: {{ getDayOccoupcety($year,5,8,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    9: {{ getDayOccoupcety($year,5,9,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    10: {{ getDayOccoupcety($year,5,10,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    11: {{ getDayOccoupcety($year,5,11,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    12: {{ getDayOccoupcety($year,5,12,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    13: {{ getDayOccoupcety($year,5,13,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    14: {{ getDayOccoupcety($year,5,14,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    15: {{ getDayOccoupcety($year,5,15,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    16: {{ getDayOccoupcety($year,5,16,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    17: {{ getDayOccoupcety($year,5,17,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    18: {{ getDayOccoupcety($year,5,18,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    19: {{ getDayOccoupcety($year,5,19,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    20: {{ getDayOccoupcety($year,5,20,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    21: {{ getDayOccoupcety($year,5,21,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    22: {{ getDayOccoupcety($year,5,22,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    23: {{ getDayOccoupcety($year,5,23,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    24: {{ getDayOccoupcety($year,5,24,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    25: {{ getDayOccoupcety($year,5,25,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    26: {{ getDayOccoupcety($year,5,26,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    27: {{ getDayOccoupcety($year,5,27,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    28: {{ getDayOccoupcety($year,5,28,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    29: {{ getDayOccoupcety($year,5,29,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    30: {{ getDayOccoupcety($year,5,30,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    31: {{ getDayOccoupcety($year,5,31,$hotel_id)['roomNumber'] }},5

                                                </td>


                                                    <td>

                                                    1 : {{ getDayOccoupcety($year,6,1,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    2: {{ getDayOccoupcety($year,6,2,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    3: {{ getDayOccoupcety($year,6,3,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    4: {{ getDayOccoupcety($year,6,4,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    5: {{ getDayOccoupcety($year,6,5,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    6: {{ getDayOccoupcety($year,6,6,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    7: {{ getDayOccoupcety($year,6,7,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    8: {{ getDayOccoupcety($year,6,8,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    9: {{ getDayOccoupcety($year,6,9,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    10: {{ getDayOccoupcety($year,6,10,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    11: {{ getDayOccoupcety($year,6,11,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    12: {{ getDayOccoupcety($year,6,12,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    13: {{ getDayOccoupcety($year,6,13,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    14: {{ getDayOccoupcety($year,6,14,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    15: {{ getDayOccoupcety($year,6,15,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    16: {{ getDayOccoupcety($year,6,16,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    17: {{ getDayOccoupcety($year,6,17,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    18: {{ getDayOccoupcety($year,6,18,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    19: {{ getDayOccoupcety($year,6,19,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    20: {{ getDayOccoupcety($year,6,20,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    21: {{ getDayOccoupcety($year,6,21,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    22: {{ getDayOccoupcety($year,6,22,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    23: {{ getDayOccoupcety($year,6,23,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    24: {{ getDayOccoupcety($year,6,24,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    25: {{ getDayOccoupcety($year,6,25,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    26: {{ getDayOccoupcety($year,6,26,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    27: {{ getDayOccoupcety($year,6,27,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    28: {{ getDayOccoupcety($year,6,28,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    29: {{ getDayOccoupcety($year,6,29,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    30: {{ getDayOccoupcety($year,6,30,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    31: {{ getDayOccoupcety($year,6,31,$hotel_id)['roomNumber'] }},

                                                    </td>

                                                    <td>

                                                       1 : {{ getDayOccoupcety($year,7,1,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    2: {{ getDayOccoupcety($year,7,2,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    3: {{ getDayOccoupcety($year,7,3,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    4: {{ getDayOccoupcety($year,7,4,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    5: {{ getDayOccoupcety($year,7,5,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    6: {{ getDayOccoupcety($year,7,6,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    7: {{ getDayOccoupcety($year,7,7,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    8: {{ getDayOccoupcety($year,7,8,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    9: {{ getDayOccoupcety($year,7,9,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    10: {{ getDayOccoupcety($year,7,10,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    11: {{ getDayOccoupcety($year,7,11,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    12: {{ getDayOccoupcety($year,7,12,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    13: {{ getDayOccoupcety($year,7,13,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    14: {{ getDayOccoupcety($year,7,14,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    15: {{ getDayOccoupcety($year,7,15,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    16: {{ getDayOccoupcety($year,7,16,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    17: {{ getDayOccoupcety($year,7,17,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    18: {{ getDayOccoupcety($year,7,18,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    19: {{ getDayOccoupcety($year,7,19,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    20: {{ getDayOccoupcety($year,7,20,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    21: {{ getDayOccoupcety($year,7,21,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    22: {{ getDayOccoupcety($year,7,22,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    23: {{ getDayOccoupcety($year,7,23,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    24: {{ getDayOccoupcety($year,7,24,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    25: {{ getDayOccoupcety($year,7,25,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    26: {{ getDayOccoupcety($year,7,26,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    27: {{ getDayOccoupcety($year,7,27,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    28: {{ getDayOccoupcety($year,7,28,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    29: {{ getDayOccoupcety($year,7,29,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    30: {{ getDayOccoupcety($year,7,30,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    31: {{ getDayOccoupcety($year,7,31,$hotel_id)['roomNumber'] }},7

                                                    </td>

                                                     <td>

                                                    1 : {{ getDayOccoupcety($year,8,1,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    2: {{ getDayOccoupcety($year,8,2,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    3: {{ getDayOccoupcety($year,8,3,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    4: {{ getDayOccoupcety($year,8,4,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    5: {{ getDayOccoupcety($year,8,5,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    6: {{ getDayOccoupcety($year,8,6,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    7: {{ getDayOccoupcety($year,8,7,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    8: {{ getDayOccoupcety($year,8,8,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    9: {{ getDayOccoupcety($year,8,9,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    10: {{ getDayOccoupcety($year,8,10,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    11: {{ getDayOccoupcety($year,8,11,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    12: {{ getDayOccoupcety($year,8,12,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    13: {{ getDayOccoupcety($year,8,13,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    14: {{ getDayOccoupcety($year,8,14,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    15: {{ getDayOccoupcety($year,8,15,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    16: {{ getDayOccoupcety($year,8,16,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    17: {{ getDayOccoupcety($year,8,17,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    18: {{ getDayOccoupcety($year,8,18,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    19: {{ getDayOccoupcety($year,8,19,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    20: {{ getDayOccoupcety($year,8,20,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    21: {{ getDayOccoupcety($year,8,21,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    22: {{ getDayOccoupcety($year,8,22,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    23: {{ getDayOccoupcety($year,8,23,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    24: {{ getDayOccoupcety($year,8,24,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    25: {{ getDayOccoupcety($year,8,25,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    26: {{ getDayOccoupcety($year,8,26,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    27: {{ getDayOccoupcety($year,8,27,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    28: {{ getDayOccoupcety($year,8,28,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    29: {{ getDayOccoupcety($year,8,29,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    30: {{ getDayOccoupcety($year,8,30,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    31: {{ getDayOccoupcety($year,8,31,$hotel_id)['roomNumber'] }},

                                                </td>

                                                <td>

                                               1 : {{ getDayOccoupcety($year,9,1,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    2: {{ getDayOccoupcety($year,9,2,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    3: {{ getDayOccoupcety($year,9,3,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    4: {{ getDayOccoupcety($year,9,4,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    5: {{ getDayOccoupcety($year,9,5,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    6: {{ getDayOccoupcety($year,9,6,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    7: {{ getDayOccoupcety($year,9,7,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    8: {{ getDayOccoupcety($year,9,8,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    9: {{ getDayOccoupcety($year,9,9,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    10: {{ getDayOccoupcety($year,9,10,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    11: {{ getDayOccoupcety($year,9,11,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    12: {{ getDayOccoupcety($year,9,12,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    13: {{ getDayOccoupcety($year,9,13,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    14: {{ getDayOccoupcety($year,9,14,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    15: {{ getDayOccoupcety($year,9,15,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    16: {{ getDayOccoupcety($year,9,16,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    17: {{ getDayOccoupcety($year,9,17,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    18: {{ getDayOccoupcety($year,9,18,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    19: {{ getDayOccoupcety($year,9,19,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    20: {{ getDayOccoupcety($year,9,20,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    21: {{ getDayOccoupcety($year,9,21,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    22: {{ getDayOccoupcety($year,9,22,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    23: {{ getDayOccoupcety($year,9,23,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    24: {{ getDayOccoupcety($year,9,24,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    25: {{ getDayOccoupcety($year,9,25,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    26: {{ getDayOccoupcety($year,9,26,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    27: {{ getDayOccoupcety($year,9,27,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    28: {{ getDayOccoupcety($year,9,28,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    29: {{ getDayOccoupcety($year,9,29,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    30: {{ getDayOccoupcety($year,9,30,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    31: {{ getDayOccoupcety($year,9,31,$hotel_id)['roomNumber'] }},

                                                </td>


                                                <td>

                                                  1 : {{ getDayOccoupcety($year,10,1,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    2: {{ getDayOccoupcety($year,10,2,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    3: {{ getDayOccoupcety($year,10,3,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    4: {{ getDayOccoupcety($year,10,4,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    5: {{ getDayOccoupcety($year,10,5,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    6: {{ getDayOccoupcety($year,10,6,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    7: {{ getDayOccoupcety($year,10,7,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    8: {{ getDayOccoupcety($year,10,8,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    9: {{ getDayOccoupcety($year,10,9,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    10: {{ getDayOccoupcety($year,10,10,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    11: {{ getDayOccoupcety($year,10,11,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    12: {{ getDayOccoupcety($year,10,12,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    13: {{ getDayOccoupcety($year,10,13,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    14: {{ getDayOccoupcety($year,10,14,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    15: {{ getDayOccoupcety($year,10,15,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    16: {{ getDayOccoupcety($year,10,16,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    17: {{ getDayOccoupcety($year,10,17,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    18: {{ getDayOccoupcety($year,10,18,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    19: {{ getDayOccoupcety($year,10,19,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    20: {{ getDayOccoupcety($year,10,20,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    21: {{ getDayOccoupcety($year,10,21,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    22: {{ getDayOccoupcety($year,10,22,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    23: {{ getDayOccoupcety($year,10,23,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    24: {{ getDayOccoupcety($year,10,24,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    25: {{ getDayOccoupcety($year,10,25,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    26: {{ getDayOccoupcety($year,10,26,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    27: {{ getDayOccoupcety($year,10,27,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    28: {{ getDayOccoupcety($year,10,28,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    29: {{ getDayOccoupcety($year,10,29,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    30: {{ getDayOccoupcety($year,10,30,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    31: {{ getDayOccoupcety($year,10,31,$hotel_id)['roomNumber'] }},0

                                                </td>



                                                <td>

                                                    1 : {{ getDayOccoupcety($year,11,1,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    2: {{ getDayOccoupcety($year,11,2,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    3: {{ getDayOccoupcety($year,11,3,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    4: {{ getDayOccoupcety($year,11,4,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    5: {{ getDayOccoupcety($year,11,5,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    6: {{ getDayOccoupcety($year,11,6,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    7: {{ getDayOccoupcety($year,11,7,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    8: {{ getDayOccoupcety($year,11,8,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    9: {{ getDayOccoupcety($year,1,9,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    10: {{ getDayOccoupcety($year,11,10,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    11: {{ getDayOccoupcety($year,11,11,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    12: {{ getDayOccoupcety($year,11,12,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    13: {{ getDayOccoupcety($year,11,13,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    14: {{ getDayOccoupcety($year,11,14,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    15: {{ getDayOccoupcety($year,11,15,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    16: {{ getDayOccoupcety($year,11,16,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    17: {{ getDayOccoupcety($year,11,17,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    18: {{ getDayOccoupcety($year,11,18,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    19: {{ getDayOccoupcety($year,11,19,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    20: {{ getDayOccoupcety($year,11,20,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    21: {{ getDayOccoupcety($year,11,21,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    22: {{ getDayOccoupcety($year,11,22,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    23: {{ getDayOccoupcety($year,11,23,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    24: {{ getDayOccoupcety($year,11,24,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    25: {{ getDayOccoupcety($year,11,25,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    26: {{ getDayOccoupcety($year,11,26,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    27: {{ getDayOccoupcety($year,11,27,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    28: {{ getDayOccoupcety($year,11,28,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    29: {{ getDayOccoupcety($year,11,29,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    30: {{ getDayOccoupcety($year,11,30,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    31: {{ getDayOccoupcety($year,11,31,$hotel_id)['roomNumber'] }},1

                                                </td>


                                                <td>

                                                   1 : {{ getDayOccoupcety($year,12,1,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    2: {{ getDayOccoupcety($year,12,2,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    3: {{ getDayOccoupcety($year,12,3,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    4: {{ getDayOccoupcety($year,12,4,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    5: {{ getDayOccoupcety($year,12,5,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    6: {{ getDayOccoupcety($year,12,6,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    7: {{ getDayOccoupcety($year,12,7,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    8: {{ getDayOccoupcety($year,12,8,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    9: {{ getDayOccoupcety($year,12,9,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    10: {{ getDayOccoupcety($year,12,10,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    11: {{ getDayOccoupcety($year,12,11,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    12: {{ getDayOccoupcety($year,12,12,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    13: {{ getDayOccoupcety($year,12,13,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    14: {{ getDayOccoupcety($year,12,14,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    15: {{ getDayOccoupcety($year,12,15,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    16: {{ getDayOccoupcety($year,12,16,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    17: {{ getDayOccoupcety($year,12,17,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    18: {{ getDayOccoupcety($year,12,18,$hotel_id)['roomNumber'] }} ,
                                                    <br>
                                                    19: {{ getDayOccoupcety($year,12,19,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    20: {{ getDayOccoupcety($year,12,20,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    21: {{ getDayOccoupcety($year,12,21,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    22: {{ getDayOccoupcety($year,12,22,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    23: {{ getDayOccoupcety($year,12,23,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    24: {{ getDayOccoupcety($year,12,24,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    25: {{ getDayOccoupcety($year,12,25,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    26: {{ getDayOccoupcety($year,12,26,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    27: {{ getDayOccoupcety($year,12,27,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    28: {{ getDayOccoupcety($year,12,28,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    29: {{ getDayOccoupcety($year,12,29,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    30: {{ getDayOccoupcety($year,12,30,$hotel_id)['roomNumber'] }},
                                                    <br>
                                                    31: {{ getDayOccoupcety($year,12,31,$hotel_id)['roomNumber'] }},2

                                                </td>



                                            </tr>

                                    </tbody>
                                    <tbody id="data-table-body"></tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="scripts">
    </x-slot>
</x-organization::layout>
