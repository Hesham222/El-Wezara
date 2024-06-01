{{-- @yield('components-active', 'm-menu__item--active') --}}
@section('nav-sports-activities-active', 'm-menu__item--active m-menu__item--open')

<x-organization::layout>
    <x-slot name="pageTitle">Navigation
        | Sports Activities</x-slot name="pageTitle">
    @section('nav-sports-activities-active', 'm-menu__item--active m-menu__item--open')

    <x-slot name="style">
        <style type="text/css">
            .mt-4 {
                margin-top: 1.5rem !important;
            }

            .flex-wrap {
                flex-wrap: wrap !important;
            }

            .mb-3,
            .my-3 {
                margin-bottom: 1rem !important;
            }

            .flex-row {
                -webkit-box-orient: horizontal !important;
                -webkit-box-direction: normal !important;
                flex-direction: row !important;
            }

            .menu_box {
                background-color: #f7f7f7;
                border-radius: 5px;
                border: 1px solid #ececec;
                padding: 3px;
                height: 150px;
                width: 150px;
                margin-right: 15px;
                margin-top: 15px;
                text-decoration: none;
                color: #1f282d;
                transition: all 0.3s ease;
                position: relative;
            }

            .menu_box:hover {
                text-decoration: none;
                color: #F7F7F7;
                background-color: #1F282D;
                transition: all 0.3s ease;
                border: 1px solid #1F282D;
            }

            h5 {
                margin-bottom: .5rem;
                font-family: inherit;
                font-weight: 500;
                line-height: 1.2;
                color: inherit;
            }

            h5,
            .h5 {
                font-size: 1.25rem;
            }

            .fa-4x {
                font-size: 4em !important;
            }

            ::before,
            ::after {
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
            }

            .notification-icon {
                position: absolute;
                top: -0.1px;
                right: -0.1px;
            }
        </style>
    </x-slot>

    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-content">
            <!--Begin::Section Products-->

            <h3> الانشطة الرياضية</h3><a target="_blank" href="{{route('organizations.navigations.sportVideo')}}" class="btn btn-primary" title="اعرف المزيد عن الأنشطة الرياضية">?</a>
            <hr>

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'SportArea-Module'))
                @include('Organization::_components.layout.navigations.sports_activities.sport_area_module')
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'ClubSport-Module'))
                @include('Organization::_components.layout.navigations.sports_activities.club_sport_Module')
            @endif


            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FreelanceTrainer-Module'))
                @include('Organization::_components.layout.navigations.sports_activities.freelance_trainer_module')
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Training-Module'))
                @include('Organization::_components.layout.navigations.sports_activities.training_module')
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Subscription-Module'))
                @include('Organization::_components.layout.navigations.sports_activities.subscription_module')
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Payment-Module'))
                @include('Organization::_components.layout.navigations.sports_activities.payment_module')
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'TrainerAttendance-Module'))
                @include('Organization::_components.layout.navigations.sports_activities.trainer_attendance_module')
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'SubscriberAttendance-Module'))
                @include('Organization::_components.layout.navigations.sports_activities.subscriber_attendance_module')
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'ReservationPricing-Module'))
                @include('Organization::_components.layout.navigations.sports_activities.reservation_pricing_module')
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'ExternalReservation-Module'))
                @include('Organization::_components.layout.navigations.sports_activities.external_reservation_module')
            @endif


            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'ExternalReservationPayment-Module'))
                @include('Organization::_components.layout.navigations.sports_activities.external_reservation_payment_module')
            @endif

            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'Report-Module'))
                @include('Organization::_components.layout.navigations.sports_activities.report_module')
            @endif


        </div>
    </div>


    <x-slot name="scripts"></x-slot>
</x-organization::layout>
