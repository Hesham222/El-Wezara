<?php

namespace Organization\Providers;

use Admin\Models\Organization;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Organization\Models\Account;
use Organization\Models\AssetCategory;
use Organization\Models\AssetProduct;
use Organization\Models\ClubSport;
use Organization\Models\Customer;
use Organization\Models\CustomerComplain;
use Organization\Models\CustomerType;
use Organization\Models\Department;
use Organization\Models\Employee;
use Organization\Models\EmployeeJob;
use Organization\Models\EmployeeType;
use Organization\Models\EmployeeVacationType;
use Organization\Models\EventItem;
use Organization\Models\EventItemType;
use Organization\Models\EventType;
use Organization\Models\ExternalPricing;
use Organization\Models\ExternalReservation;
use Organization\Models\FreelanceTrainer;
use Organization\Models\Gate;
use Organization\Models\GateShift;
use Organization\Models\Hall;
use Organization\Models\Hotel;
use Organization\Models\HotelReservation;
use Organization\Models\Ingredient;
use Organization\Models\IngredientCategory;
use Organization\Models\Item;
use Organization\Models\JournalEntry;
use Organization\Models\laundry;
use Organization\Models\LaundryCategory;
use Organization\Models\LaundryOrder;
use Organization\Models\LaundrySubCategory;
use Organization\Models\LService;
use Organization\Models\MenuCategory;
use Organization\Models\Package;
use Organization\Models\ParentRoom;
use Organization\Models\PointOfSale;
use Organization\Models\PreparationArea;
use Organization\Models\QrMenu;
use Organization\Models\RentContract;
use Organization\Models\RentSpace;
use Organization\Models\Reservation;
use Organization\Models\Role;
use Organization\Models\RoomMaintenanceRequest;
use Organization\Models\Rooms;
use Organization\Models\RoomType;
use Organization\Models\SportActivityAreas;
use Organization\Models\SubAccount;
use Organization\Models\SubAssetProduct;
use Organization\Models\Subscriber;
use Organization\Models\SubscribersType;
use Organization\Models\Subscription;
use Organization\Models\Supplier;
use Organization\Models\SupplierService;
use Organization\Models\Tenant;
use Organization\Models\Ticket;
use Organization\Models\TicketCategory;
use Organization\Models\TicketSubCategory;
use Organization\Models\Training;

class OrganizationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('Organization::_components.layout.navigations.components', function ($view) {
            $view->with([
                'organizationAdminTrashesCount' => Employee::onlyTrashed()->count(),
                'customerTypeTrashesCount' => CustomerType::onlyTrashed()->count(),
                'complainTrashesCount' => CustomerComplain::onlyTrashed()->count(),
                'roleTrashesCount' => Role::onlyTrashed()->count(),
                'customerTrashesCount' => Customer::onlyTrashed()->count(),
            ]);
        });

        view()->composer('Organization::_components.layout.navigations.sports_activities', function ($view) {
            $view->with([
                'freelanceTrainerTrashesCount' => FreelanceTrainer::onlyTrashed()->count(),
                'trainingTrashesCount' => Training::onlyTrashed()->count(),
                'subscriptionTrashesCount' => Subscription::onlyTrashed()->count(),
                'externalPriceTrashesCount' => ExternalPricing::onlyTrashed()->count(),
                'externalReservationTrashesCount' => ExternalReservation::onlyTrashed()->count(),
                'clubSportTrashesCount' => ClubSport::onlyTrashed()->count(),
                'sportAreaTrashesCount' => SportActivityAreas::onlyTrashed()->count(),
            ]);
        });

        view()->composer('Organization::_components.layout.navigations.hr', function ($view) {
            $view->with([
                'deptTrashesCount' => Department::onlyTrashed()->count(),
                'vacationTypeTrashesCount' => EmployeeVacationType::onlyTrashed()->count(),
                'empJobTrashesCount' => EmployeeJob::onlyTrashed()->count(),
                'empTypeTrashesCount' => EmployeeType::onlyTrashed()->count(),
            ]);
        });

        view()->composer('Organization::_components.layout.navigations.club', function ($view) {
            $view->with([
                'ingredientCategoryTrashesCount' => IngredientCategory::onlyTrashed()->count(),
                'menuCategoryTrashesCount' => MenuCategory::onlyTrashed()->count(),
                'PointOfSaleTrashesCount' => PointOfSale::onlyTrashed()->count(),
               // 'PreparetionAreaTrashesCount' => PreparationArea::onlyTrashed()->count(),
                'assetCategoryTrashesCount' => AssetCategory::onlyTrashed()->count(),
                'assetProductTrashesCount' => AssetProduct::onlyTrashed()->count(),
                'subAssetProductTrashesCount' => SubAssetProduct::onlyTrashed()->count(),
                'qrMenuTrashesCount' => QrMenu::onlyTrashed()->count(),
                'itemTrashesCount' => Item::onlyTrashed()->count(),
                'ingredientTrashesCount' => Ingredient::onlyTrashed()->count(),
            ]);
        });

        view()->composer('Organization::_components.layout.navigations.rent', function ($view) {
            $view->with([
                'rentSpaceTrashesCount' => RentSpace::onlyTrashed()->count(),
                'tenantTrashesCount' => Tenant::onlyTrashed()->count(),
                'rentContractTrashesCount' => RentContract::onlyTrashed()->count(),
            ]);
        });

        view()->composer('Organization::_components.layout.navigations.gate', function ($view) {
            $view->with([
                'ticketCategoryTrashesCount' => TicketCategory::onlyTrashed()->count(),
                'ticketSubCategoryTrashesCount' => TicketSubCategory::onlyTrashed()->count(),
                'gatesTrashesCount' => Gate::onlyTrashed()->count(),
                'ticketsTrashesCount' => Ticket::onlyTrashed()->count(),
                'gateShiftTrashesCount' => GateShift::onlyTrashed()->count(),
            ]);
        });

        view()->composer('Organization::_components.layout.navigations.event', function ($view) {
            $view->with([
                'eventItemTypeTrashesCount' => EventItemType::onlyTrashed()->count(),
                'eventItemTrashesCount' => EventItem::onlyTrashed()->count(),
                'eventTypeTrashesCount' => EventType::onlyTrashed()->count(),
                'packagesTrashesCount' => Package::onlyTrashed()->count(),
                'reservationsTrashesCount' => Reservation::onlyTrashed()->count(),
                'hallTrashesCount' => Hall::onlyTrashed()->count(),
                'supplierServiceTrashesCount' => SupplierService::onlyTrashed()->count(),
            ]);
        });

        view()->composer('Organization::_components.layout.navigations.hotel', function ($view) {
            $view->with([
                'hotelTrashesCount' => Hotel::onlyTrashed()->count(),
                'roomTypeTrashesCount' => RoomType::onlyTrashed()->count(),
                'parentRoomTrashesCount' => ParentRoom::onlyTrashed()->count(),
                'roomTrashesCount' => Rooms::onlyTrashed()->count(),
                'hotelReservationTrashesCount' => HotelReservation::onlyTrashed()->count(),
                'maintenanceTrashesCount' => RoomMaintenanceRequest::onlyTrashed()->count(),
                'laundryOrdersTrashesCount' => LaundryOrder::onlyTrashed()->count(),
            ]);
        });

        view()->composer('Organization::_components.layout.navigations.laundry', function ($view) {
            $view->with([
                'laundryOrdersTrashesCount' => LaundryOrder::onlyTrashed()->count(),
                'laundryTrashesCount' => laundry::onlyTrashed()->count(),
                'laundryServiceTrashesCount' => LService::onlyTrashed()->count(),
                'laundryCategoryTrashesCount' => LaundryCategory::onlyTrashed()->count(),
                'laundrySubCategoryTrashesCount' => LaundrySubCategory::onlyTrashed()->count(),

            ]);
        });

        //
        view()->composer('Organization::_components.layout.navigations.finance', function ($view) {
            $view->with([
                'accountTrashesCount' => Account::onlyTrashed()->count(),
                'subAccountTrashesCount' => SubAccount::onlyTrashed()->count(),
                'journalEntryTrashesCount' => JournalEntry::onlyTrashed()->count(),
            ]);
        });

        //render variables with  the sidebar
        view()->composer('Organization::_components.layout.sidebar', function ($view) {
            $organization = Organization::find(auth('organization_admin')->user()->organization_id);
            $active_services = $organization->services->pluck('id')->toArray();
            $view->with([
                'active_services' => $active_services,
                // 'organizationAdminTrashesCount' => Employee::onlyTrashed()->count(),
                //'roleTrashesCount' => Role::onlyTrashed()->count(),
                'supplierTrashesCount' => Supplier::onlyTrashed()->count(),
                // 'customerTypeTrashesCount' => CustomerType::onlyTrashed()->count(),
                //'customerTrashesCount' => Customer::onlyTrashed()->count(),
                'externalPriceTrashesCount' => ExternalPricing::onlyTrashed()->count(),
            ]);
        });

        //render variables with the header
        view()->composer('Organization::_components.layout.header', function ($view) {
            $view->with([
                'organization' => Organization::find(auth('organization_admin')->user()->organization_id),
            ]);
        });

        $moduleName = 'Organization';
        config([
            $moduleName => File::getRequire(loadConfigFile('routePrefix', $moduleName)),
        ]);
        $this->loadRoutesFrom(loadRoute('web', $moduleName));
        $this->loadViewsFrom(loadViews($moduleName), $moduleName);
        $this->loadTranslationsFrom(loadTranslations($moduleName), $moduleName);
        $this->loadMigrationsFrom(loadMigrations($moduleName));
        Blade::componentNamespace('Organization\View\Components', 'organization');
    }
}
