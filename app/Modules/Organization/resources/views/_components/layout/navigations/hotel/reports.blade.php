<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            التقارير
        </h4>

        <hr>

        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- start reports -->

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'HotelReport-Weekly'))
                <a href="{{ route('organizations.hotelWork.weekly') . '?view=view' }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">التقرير الاسبوعى للاشغال
                        </h5>
                    </center>
                </a>
            @endif


            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
            'HotelReport-ArrivalList'))
                <a href="{{ route('organizations.hotelWork.arrivalList') . '?view=view' }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4"> تقرير قائمة الوصول


                        </h5>
                    </center>
                </a>
            @endif



            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'HotelReport-ReservationList'))
                <a href="{{ route('organizations.hotelWork.reservationArrivalList') . '?view=view' }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">قائمة الحجوزات
                        </h5>
                    </center>
                </a>
            @endif


{{--            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),--}}
{{--                'EmployeeFinancialReport-View'))--}}
{{--                <a href="{{ route('organizations.hotelWork.reservationArrivalList') . '?view=view' }}" class="menu_box">--}}
{{--                    <center>--}}
{{--                        <i class="fa fa-4x fa-eye mt-4"></i>--}}
{{--                        <h5 class="m-portlet__head-text mt-4"> قائمة الحجوزات و رقم السيارة--}}
{{--                        </h5>--}}
{{--                    </center>--}}
{{--                </a>--}}
{{--            @endif--}}


{{--            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),--}}
{{--            'EmployeeFinancialReport-View'))--}}
{{--            <a href="{{ route('organizations.hotelWork.weekly') . '?view=view' }}" class="menu_box">--}}
{{--                <center>--}}
{{--                    <i class="fa fa-4x fa-eye mt-4"></i>--}}
{{--                    <h5 class="m-portlet__head-text mt-4"> التقرير الاسبوعى للاشغال--}}

{{--                    </h5>--}}
{{--                </center>--}}
{{--            </a>--}}
{{--        @endif--}}


{{--        @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),--}}
{{--        'EmployeeFinancialReport-View'))--}}
{{--        <a href="{{ route('organizations.hotelWork.arrivalList') . '?view=view' }}" class="menu_box">--}}
{{--            <center>--}}
{{--                <i class="fa fa-4x fa-eye mt-4"></i>--}}
{{--                <h5 class="m-portlet__head-text mt-4"> تقرير قائمة الوصول--}}


{{--                </h5>--}}
{{--            </center>--}}
{{--        </a>--}}
{{--    @endif--}}




    @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
    'HotelReport-ReservationArrivalList'))
    <a href="{{ route('organizations.hotelWork.reservationArrivalList') . '?view=view' }}" class="menu_box">
        <center>
            <i class="fa fa-4x fa-eye mt-4"></i>
            <h5 class="m-portlet__head-text mt-4"> تقرير قائمة الحجوزات و الوصول



            </h5>
        </center>
    </a>
@endif



@if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
'HotelReport-FoundLoss'))
<a href="{{ route('organizations.hotelWork.foundLoss') . '?view=view' }}" class="menu_box">
    <center>
        <i class="fa fa-4x fa-eye mt-4"></i>
        <h5 class="m-portlet__head-text mt-4"> تقرير قائمة ألمفقودات



        </h5>
    </center>
</a>
@endif



@if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
'HotelReport-CompanyStatistics'))
<a href="{{ route('organizations.CompanyStatistic.index') . '?view=view' }}" class="menu_box">
    <center>
        <i class="fa fa-4x fa-eye mt-4"></i>
        <h5 class="m-portlet__head-text mt-4"> تقرير احصائيات الشركات



        </h5>
    </center>
</a>
@endif


            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                        'HotelReport-ReservationYear'))
                <a href="{{ route('organizations.RoomYearReport.index') . '?view=view' }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4"> تقرير السنويه للحجوزات
                        </h5>
                    </center>
                </a>
            @endif


@if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
'HotelReport-ShoppingCode'))
<a href="{{ route('organizations.IndividualReport.index') . '?view=view' }}" class="menu_box">
    <center>
        <i class="fa fa-4x fa-eye mt-4"></i>
        <h5 class="m-portlet__head-text mt-4"> تقرير كود السوق



        </h5>
    </center>
</a>
@endif





@if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
'HotelReport-RoomBalance'))
<a href="{{ route('organizations.RoomBalance.index') . '?view=view' }}" class="menu_box">
    <center>
        <i class="fa fa-4x fa-eye mt-4"></i>
        <h5 class="m-portlet__head-text mt-4"> تقرير أرصدة الغرف



        </h5>
    </center>
</a>
@endif


@if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
'HotelReport-RoomTypeDay'))
<a href="{{ route('organizations.RoomTypeDayReport.index') . '?view=view' }}" class="menu_box">
    <center>
        <i class="fa fa-4x fa-eye mt-4"></i>
        <h5 class="m-portlet__head-text mt-4"> تقرير احصائيات انواع الغرف ليوم محدد
        </h5>
    </center>
</a>
@endif

@if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
'HotelReport-CompanyEmployeeStatistics'))
<a href="{{ route('organizations.CompanyEmployee.index') . '?view=view' }}" class="menu_box">
    <center>
        <i class="fa fa-4x fa-eye mt-4"></i>
        <h5 class="m-portlet__head-text mt-4"> تقرير إحصائيات موظفي الشركة
        </h5>
    </center>
</a>
@endif
@if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
'HotelReport-AllEmployeesStatistics'))
<a href="{{ route('organizations.AllEmployee.index') . '?view=view' }}" class="menu_box">
    <center>
        <i class="fa fa-4x fa-eye mt-4"></i>
        <h5 class="m-portlet__head-text mt-4"> تقرير إحصائيات  جميع الموظفين
        </h5>
    </center>
</a>
@endif
@if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
            'HotelReport-RoomType'))
            <a href="{{ route('organizations.RoomTypeReport.index') . '?view=view' }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4"> تقرير احصائيات انواع الغرف
                        </h5>
                    </center>
            </a>
@endif
@if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
            'HotelReport-AllRoomsBookedTodayStatistics'))
            <a href="{{ route('organizations.RoomTodayReport.index') . '?view=view' }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4"> تقرير احصائيات جميع الغرف المحجوزه اليوم
                        </h5>
                    </center>
            </a>
@endif


@if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
'HotelReport-RoomMaintenance'))
<a href="{{ route('organizations.hotelWork.miantinaceReport') . '?view=view' }}" class="menu_box">
    <center>
        <i class="fa fa-4x fa-eye mt-4"></i>
        <h5 class="m-portlet__head-text mt-4"> تقرير  صيانه الغرف





        </h5>
    </center>
</a>
@endif



@if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
'HotelReport-DepartureList'))
<a href="{{ route('organizations.hotelWork.departureList') . '?view=view' }}" class="menu_box">
    <center>
        <i class="fa fa-4x fa-eye mt-4"></i>
        <h5 class="m-portlet__head-text mt-4"> تقرير  قائمة المغادرة





        </h5>
    </center>
</a>
@endif


@if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
'HotelReport-CancelReservationList'))
<a href="{{ route('organizations.hotelWork.cancelledList') . '?view=view' }}" class="menu_box">
    <center>
        <i class="fa fa-4x fa-eye mt-4"></i>
        <h5 class="m-portlet__head-text mt-4"> تقرير  قائمة الحجوزات الملغية





        </h5>
    </center>
</a>
@endif



@if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
'HotelReport-RoomOccupancyRate'))
<a href="{{ route('organizations.hotelWork.OccupancyRateReport') . '?view=view' }}" class="menu_box">
    <center>
        <i class="fa fa-4x fa-eye mt-4"></i>
        <h5 class="m-portlet__head-text mt-4"> تقرير  نسبة الاشغال للغرف

        </h5>
    </center>
</a>
@endif
@if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
'HotelReport-OccupancyAnnual'))
<a href="{{ route('organizations.hotelWork.OccupancyAnnualReport') . '?view=view' }}" class="menu_box">
    <center>
        <i class="fa fa-4x fa-eye mt-4"></i>
        <h5 class="m-portlet__head-text mt-4"> تقرير الاشغال السنوي

        </h5>
    </center>
</a>
@endif
            <!--  -->
        </div>
    </div>
</div>
