<x-organization::layout>
    <x-slot name="pageTitle"> تقارير اشغال الفنادق | عرض</x-slot name="pageTitle">
    @section('balanceSheets-active', 'm-menu__item--active')
    <x-slot name="style">
        <!-- Some styles -->
    </x-slot>
    <!-- Start page content -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    التقرير الاسبوعى للاشغال
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


                    <form  method="GET"  action="{{route('organizations.hotelWork.weekly')}}" >
                        <input type="hidden" name="view" value="{{ request()->input('view',0)}}">
                        <div style="display: flex;justify-content: flex-end;align-items:flex-end;margin-bottom: 20px">
                            <div class="input-group" style="width: 50%">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">اليوم</span>
                                    <input type="date" name="date" id="startDateCol" class="form-control">
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

                                <div class="input-group-append">
                                    <a
                                      
                                        class="btn btn-primary"
                            
                                        title="تحميل"
                                       href="{{ route('organizations.hotelWork.export',['date' => request()->input('date',0)]) }}"
                                    >
                                        <i class="fa fa-file"></i>
                                    </a>
                                 
                                </div>

                            </div>
                        </div>
                    </form>

                </div>


                <div class="table-responsive">
                    <section class="content table-responsive">
                        <h5> تقرير الاشغال الاسبوعى </h5>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="data-table" class="table table-striped- table-bordered table-hover table-checkable" >
                                    <thead>
                                  
                                    <tr>
                                        @foreach($weekOfdays as $weekOfday)
                                        <th>{{ $weekOfday }}</th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                       
                                            <tr>
                                                @foreach($weekOfdays as $weekOfday)
                                                <td>

                                                    Arrival : {{  \Organization\Models\HotelReservation::where('arrival_date',$weekOfday)->count() }} ,
                                                    Departure : {{  \Organization\Models\HotelReservation::where('departure_date',$weekOfday)->count() }} , 
                                                    Stay Over : {{  \Organization\Models\HotelReservation::where('arrival_date','<=',$weekOfday)->where('departure_date','>=',$weekOfday)->count() }}

                                                </td>
                                                @endforeach
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