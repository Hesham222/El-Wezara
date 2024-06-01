<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Organization\Models\Permission;

class OrganizationPermissionSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'All-Modules'
        ]);

        Permission::create([
            'name' => 'Dashboard-Module'
        ]);

        Permission::create([
            'name' => 'Admin-Module'
        ]);

        Permission::create([
            'name' => 'Admin-Add'
        ]);

        Permission::create([
            'name' => 'Admin-Edit'
        ]);

        Permission::create([
            'name' => 'Admin-View'
        ]);

        Permission::create([
            'name' => 'Admin-Delete'
        ]);

        Permission::create([
            'name' => 'Admin-Change-Password'
        ]);
        /**
         * Organization Dashboard module
         */
        Permission::create([
            'name' => 'OrganizationDashboard-View'
        ]);
        /**
         * Organization Event Dashboard module
         */
        Permission::create([
            'name' => 'OrganizationDashboard-View-Event'
        ]);
        /**
         * Organization Housing Dashboard module
         */
        Permission::create([
            'name' => 'OrganizationDashboard-View-Housing'
        ]);
        /**
         * Organization Dashboard Setting module
         */
        Permission::create([
            'name' => 'OrganizationDashboard-View-Setting'
        ]);
        /**
         * Organization Dashboard Inventory module
         */
        Permission::create([
            'name' => 'OrganizationDashboard-View-Inventory'
        ]);
        //Elements Modules
        /**
         * Employee module
         */
        Permission::create([
            'name' => 'Employee-Module'
        ]);

        Permission::create([
            'name' => 'Employee-Add'
        ]);
        Permission::create([
            'name' => 'Employee-Add-Salary'
        ]);
        Permission::create([
            'name' => 'Employee-Add-Working-Days'
        ]);
        Permission::create([
            'name' => 'Employee-Edit'
        ]);

        Permission::create([
            'name' => 'Employee-View'
        ]);
        Permission::create([
            'name' => 'Employee-Approve'
        ]);
        Permission::create([
            'name' => 'Employee-Refuse'
        ]);
        Permission::create([
            'name' => 'Employee-View-Data'
        ]);
        Permission::create([
            'name' => 'Employee-View-EmployeeAttendance'
        ]);
        Permission::create([
            'name' => 'Employee-Delete'
        ]);
        /**
         * Customer Type module
         */
        Permission::create([
            'name' => 'CustomerType-Module'
        ]);

        Permission::create([
            'name' => 'CustomerType-Add'
        ]);

        Permission::create([
            'name' => 'CustomerType-Edit'
        ]);

        Permission::create([
            'name' => 'CustomerType-View'
        ]);

        Permission::create([
            'name' => 'CustomerType-Delete'
        ]);
        /**
         * Customer module
         */
        Permission::create([
            'name' => 'Customer-Module'
        ]);

        Permission::create([
            'name' => 'Customer-Add'
        ]);

        Permission::create([
            'name' => 'Customer-Edit'
        ]);

        Permission::create([
            'name' => 'Customer-View'
        ]);
        Permission::create([
            'name' => 'Customer-Show'
        ]);
        Permission::create([
            'name' => 'Customer-Toggle-TroubleMaker'
        ]);

        Permission::create([
            'name' => 'Customer-Delete'
        ]);
        /**
         * Complain module
         */
        Permission::create([
            'name' => 'Complain-Module'
        ]);

        Permission::create([
            'name' => 'Complain-Add'
        ]);

        Permission::create([
            'name' => 'Complain-Edit'
        ]);

        Permission::create([
            'name' => 'Complain-View'
        ]);

        Permission::create([
            'name' => 'Complain-Delete'
        ]);
        /**
         * Role module
         */
        Permission::create([
            'name' => 'Role-Module'
        ]);

        Permission::create([
            'name' => 'Role-Add'
        ]);

        Permission::create([
            'name' => 'Role-Edit'
        ]);

        Permission::create([
            'name' => 'Role-View'
        ]);
        Permission::create([
            'name' => 'Role-Delete'
        ]);

        //Sport Activity Areas Modules
        /**
         * sport activity module
         */
        Permission::create([
            'name' => 'SportArea-Module'
        ]);

        Permission::create([
            'name' => 'SportArea-Add'
        ]);

        Permission::create([
            'name' => 'SportArea-Edit'
        ]);

        Permission::create([
            'name' => 'SportArea-View'
        ]);

        Permission::create([
            'name' => 'SportArea-Delete'
        ]);

        Permission::create([
            'name' => 'SportArea-Show-Reservation'
        ]);
        Permission::create([
            'name' => 'SportArea-Add-Reservation'
        ]);
        /**
         * club sport module
         */
        Permission::create([
            'name' => 'ClubSport-Module'
        ]);

        Permission::create([
            'name' => 'ClubSport-Add'
        ]);

        Permission::create([
            'name' => 'ClubSport-Edit'
        ]);

        Permission::create([
            'name' => 'ClubSport-View'
        ]);

        Permission::create([
            'name' => 'ClubSport-Delete'
        ]);
        /**
         * freelanceTrainer module
         */
        Permission::create([
            'name' => 'FreelanceTrainer-Module'
        ]);

        Permission::create([
            'name' => 'FreelanceTrainer-Add'
        ]);

        Permission::create([
            'name' => 'FreelanceTrainer-Edit'
        ]);

        Permission::create([
            'name' => 'FreelanceTrainer-View'
        ]);

        Permission::create([
            'name' => 'FreelanceTrainer-Delete'
        ]);
        Permission::create([
            'name' => 'FreelanceTrainer-Show-ProfitRatios'
        ]);
        /**
         * training module
         */
        Permission::create([
            'name' => 'Training-Module'
        ]);

        Permission::create([
            'name' => 'Training-Add'
        ]);

        Permission::create([
            'name' => 'Training-Edit'
        ]);

        Permission::create([
            'name' => 'Training-View'
        ]);

        Permission::create([
            'name' => 'Training-Delete'
        ]);
        /**
         * Subscription module
         */
        Permission::create([
            'name' => 'Subscription-Module'
        ]);

        Permission::create([
            'name' => 'Subscription-Add'
        ]);

        Permission::create([
            'name' => 'Subscription-Edit'
        ]);

        Permission::create([
            'name' => 'Subscription-View'
        ]);
        Permission::create([
            'name' => 'Subscription-View-CancelReservations'
        ]);

        Permission::create([
            'name' => 'Subscription-Delete'
        ]);
        Permission::create([
            'name' => 'Subscription-Add-Payment'
        ]);
        Permission::create([
            'name' => 'Subscription-Cancel-Reservation'
        ]);
        /**
         * payment module
         */
        Permission::create([
            'name' => 'Payment-Module'
        ]);

        Permission::create([
            'name' => 'Payment-Add'
        ]);
        Permission::create([
            'name' => 'Payment-View'
        ]);
        /**
         * Trainer Attendance module
         */
        Permission::create([
            'name' => 'TrainerAttendance-Module'
        ]);

        Permission::create([
            'name' => 'TrainerAttendance-View'
        ]);
        Permission::create([
            'name' => 'TrainerAttendance-View-TodayTrainings'
        ]);
        /**
         * Subscriber Attendance module
         */
        Permission::create([
            'name' => 'SubscriberAttendance-Module'
        ]);

        Permission::create([
            'name' => 'SubscriberAttendance-View'
        ]);
        Permission::create([
            'name' => 'SubscriberAttendance-View-TodayTrainings'
        ]);
        /**
         * External Reservation pricing module
         */
        Permission::create([
            'name' => 'ReservationPricing-Module'
        ]);

        Permission::create([
            'name' => 'ReservationPricing-Add'
        ]);

        Permission::create([
            'name' => 'ReservationPricing-Edit'
        ]);

        Permission::create([
            'name' => 'ReservationPricing-View'
        ]);

        Permission::create([
            'name' => 'ReservationPricing-Delete'
        ]);
        /**
         * External Reservation  module
         */
        Permission::create([
            'name' => 'ExternalReservation-Module'
        ]);

        Permission::create([
            'name' => 'ExternalReservation-Add'
        ]);

        Permission::create([
            'name' => 'ExternalReservation-Edit'
        ]);

        Permission::create([
            'name' => 'ExternalReservation-View'
        ]);

        Permission::create([
            'name' => 'ExternalReservation-Delete'
        ]);
        Permission::create([
            'name' => 'ExternalReservation-Add-Payment'
        ]);
        /**
         * External Reservation Payment module
         */
        Permission::create([
            'name' => 'ExternalReservationPayment-Module'
        ]);

        Permission::create([
            'name' => 'ExternalReservationPayment-Add'
        ]);

        Permission::create([
            'name' => 'ExternalReservationPayment-View'
        ]);


        /**
         * Report module
         */
        Permission::create([
            'name' => 'Report-Module'
        ]);

        Permission::create([
            'name' => 'Report-View-DailyVisitors'
        ]);

        Permission::create([
            'name' => 'Report-View-DailyTrainers'
        ]);

        Permission::create([
            'name' => 'Report-View-DailyTrainings'
        ]);

        Permission::create([
            'name' => 'Report-View-SubscriberBalances'
        ]);
        Permission::create([
            'name' => 'Report-View-Payment'
        ]);
        Permission::create([
            'name' => 'Report-View-RevenueSport'
        ]);
        Permission::create([
            'name' => 'Report-View-Areas'
        ]);
        Permission::create([
            'name' => 'Report-View-TrainerAttend'
        ]);

        //Hr Modules
        /**
         * department module
         */
        Permission::create([
            'name' => 'Department-Module'
        ]);

        Permission::create([
            'name' => 'Department-Add'
        ]);

        Permission::create([
            'name' => 'Department-Edit'
        ]);

        Permission::create([
            'name' => 'Department-View'
        ]);

        Permission::create([
            'name' => 'Department-Delete'
        ]);
        /**
         * Vendor module
         */
        Permission::create([
            'name' => 'Vendor-Module'
        ]);

        Permission::create([
            'name' => 'Vendor-Add'
        ]);

        Permission::create([
            'name' => 'Vendor-Edit'
        ]);

        Permission::create([
            'name' => 'Vendor-View'
        ]);

        Permission::create([
            'name' => 'Vendor-Delete'
        ]);
        Permission::create([
            'name' => 'Vendor-View-Details'
        ]);
        /**
         * Vendor Type module
         */
        Permission::create([
            'name' => 'VendorType-Module'
        ]);

        Permission::create([
            'name' => 'VendorType-Add'
        ]);

        Permission::create([
            'name' => 'VendorType-Edit'
        ]);

        Permission::create([
            'name' => 'VendorType-View'
        ]);

        Permission::create([
            'name' => 'VendorType-Delete'
        ]);
        /**
         * Employee Type module
         */
        Permission::create([
            'name' => 'EmployeeType-Module'
        ]);

        Permission::create([
            'name' => 'EmployeeType-Add'
        ]);

        Permission::create([
            'name' => 'EmployeeType-Edit'
        ]);

        Permission::create([
            'name' => 'EmployeeType-View'
        ]);

        Permission::create([
            'name' => 'EmployeeType-Delete'
        ]);
        /**
         * Employee Job module
         */
        Permission::create([
            'name' => 'EmployeeJob-Module'
        ]);

        Permission::create([
            'name' => 'EmployeeJob-Add'
        ]);

        Permission::create([
            'name' => 'EmployeeJob-Edit'
        ]);

        Permission::create([
            'name' => 'EmployeeJob-View'
        ]);

        Permission::create([
            'name' => 'EmployeeJob-Delete'
        ]);
        /**
         * Employee Vacation Type module
         */
        Permission::create([
            'name' => 'EmployeeVacationType-Module'
        ]);

        Permission::create([
            'name' => 'EmployeeVacationType-Add'
        ]);

        Permission::create([
            'name' => 'EmployeeVacationType-Edit'
        ]);

        Permission::create([
            'name' => 'EmployeeVacationType-View'
        ]);

        Permission::create([
            'name' => 'EmployeeVacationType-Delete'
        ]);
        /**
         * Employee Vacation Request module
         */
        Permission::create([
            'name' => 'VacationRequest-Module'
        ]);

        Permission::create([
            'name' => 'VacationRequest-Add'
        ]);

        Permission::create([
            'name' => 'VacationRequest-View'
        ]);
        /**
         * Employee Financial Request module
         */
        Permission::create([
            'name' => 'FinancialRequest-Module'
        ]);

        Permission::create([
            'name' => 'FinancialRequest-Add'
        ]);

        Permission::create([
            'name' => 'FinancialRequest-View'
        ]);
        /**
         * Employee Bonus module
         */
        Permission::create([
            'name' => 'FinancialBonus-Module'
        ]);

        Permission::create([
            'name' => 'FinancialBonus-View'
        ]);
        /**
         * Employee Deduction module
         */
        Permission::create([
            'name' => 'EmployeeDeduction-Module'
        ]);

        Permission::create([
            'name' => 'EmployeeDeduction-View'
        ]);
        /**
         * Employee Financial Report module
         */
        Permission::create([
            'name' => 'EmployeeFinancialReport-Module'
        ]);

        Permission::create([
            'name' => 'EmployeeFinancialReport-View'
        ]);

        //Club Services Modules
        /**
         * Unit module
         */
        Permission::create([
            'name' => 'Unit-Module'
        ]);

        Permission::create([
            'name' => 'Unit-Add'
        ]);

        Permission::create([
            'name' => 'Unit-Edit'
        ]);

        Permission::create([
            'name' => 'Unit-View'
        ]);

        Permission::create([
            'name' => 'Unit-Delete'
        ]);
        /**
         * Ingredient module
         */
        Permission::create([
            'name' => 'Ingredient-Module'
        ]);

        Permission::create([
            'name' => 'Ingredient-Add'
        ]);
        Permission::create([
            'name' => 'Ingredient-Add-Excel'
        ]);
        Permission::create([
            'name' => 'Ingredient-Edit'
        ]);

        Permission::create([
            'name' => 'Ingredient-View'
        ]);

        Permission::create([
            'name' => 'Ingredient-Delete'
        ]);
        Permission::create([
            'name' => 'Ingredient-View-ExecutionOrder'
        ]);
        Permission::create([
            'name' => 'Ingredient-View-ReOrder'
        ]);
        Permission::create([
            'name' => 'Ingredient-Add-ManufacturingProducts'
        ]);
        /**
         * Item module
         */
        Permission::create([
            'name' => 'Item-Module'
        ]);

        Permission::create([
            'name' => 'Item-Add'
        ]);
        Permission::create([
            'name' => 'Item-Add-Variant'
        ]);
        Permission::create([
            'name' => 'Item-Show-Variant'
        ]);
        Permission::create([
            'name' => 'Item-Edit'
        ]);

        Permission::create([
            'name' => 'Item-View'
        ]);

        Permission::create([
            'name' => 'Item-Delete'
        ]);
        /**
         * Menu Category module
         */
        Permission::create([
            'name' => 'MenuCategory-Module'
        ]);

        Permission::create([
            'name' => 'MenuCategory-Add'
        ]);
        Permission::create([
            'name' => 'MenuCategory-Edit'
        ]);

        Permission::create([
            'name' => 'MenuCategory-View'
        ]);

        Permission::create([
            'name' => 'MenuCategory-Delete'
        ]);
        /**
         * Preparation Area module
         */
        Permission::create([
            'name' => 'PreparationArea-Module'
        ]);

        Permission::create([
            'name' => 'PreparationArea-Add'
        ]);
        Permission::create([
            'name' => 'PreparationArea-Edit'
        ]);

        Permission::create([
            'name' => 'PreparationArea-View'
        ]);

        Permission::create([
            'name' => 'PreparationArea-Delete'
        ]);
        Permission::create([
            'name' => 'PreparationArea-View-Inventories'
        ]);
        Permission::create([
            'name' => 'PreparationArea-View-Stocking'
        ]);
        Permission::create([
            'name' => 'PreparationArea-Order-Items'
        ]);
        Permission::create([
            'name' => 'PreparationArea-Reservation-Items'
        ]);
        Permission::create([
            'name' => 'PreparationArea-Retrieval-Order'
        ]);
        Permission::create([
            'name' => 'PreparationArea-View-Retrieval-Orders'
        ]);

        /**
         * Preparation Area Order module
         */
        Permission::create([
            'name' => 'PreparationAreaOrder-Module'
        ]);
        Permission::create([
            'name' => 'PreparationAreaOrder-View'
        ]);
        Permission::create([
            'name' => 'PreparationAreaOrder-Add'
        ]);
        Permission::create([
            'name' => 'PreparationAreaOrder-Delete'
        ]);
        Permission::create([
            'name' => 'PreparationAreaOrder-Receive-Order'
        ]);

        Permission::create([
            'name' => 'PreparationAreaOrder-Cancel-Order'
        ]);
        /**
         * Preparation Area Inventory module
         */
        Permission::create([
            'name' => 'PreparationAreaInventory-Module'
        ]);
        Permission::create([
            'name' => 'PreparationAreaInventory-View'
        ]);
        Permission::create([
            'name' => 'PreparationAreaInventory-consumption'
        ]);
        /**
         * Point of Sale module
         */
        Permission::create([
            'name' => 'PointOfSale-Module'
        ]);

        Permission::create([
            'name' => 'PointOfSale-Add'
        ]);
        Permission::create([
            'name' => 'PointOfSale-Edit'
        ]);

        Permission::create([
            'name' => 'PointOfSale-View'
        ]);

        Permission::create([
            'name' => 'PointOfSale-Delete'
        ]);
        Permission::create([
            'name' => 'PointOfSale-View-Inventories'
        ]);
        Permission::create([
            'name' => 'PointOfSale-View-Payments'
        ]);
        Permission::create([
            'name' => 'PointOfSale-Add-Order'
        ]);
        Permission::create([
            'name' => 'PointOfSale-View-OrdersInProgress'
        ]);
        Permission::create([
            'name' => 'PointOfSale-View-ShiftDetails'
        ]);
        Permission::create([
            'name' => 'PointOfSale-View-All-Orders'
        ]);
        Permission::create([
            'name' => 'PointOfSale-Retrieval-Order'
        ]);
        Permission::create([
            'name' => 'PointOfSale-View-Retrieval-Orders'
        ]);

        /**
         * Point of Sale Order module
         */
        Permission::create([
            'name' => 'PointOfSaleOrder-Module'
        ]);
        Permission::create([
            'name' => 'PointOfSaleOrder-Add'
        ]);
        Permission::create([
            'name' => 'PointOfSaleOrder-Delete'
        ]);
        Permission::create([
            'name' => 'PointOfSaleOrder-View'
        ]);
        Permission::create([
            'name' => 'PointOfSaleOrder-Receive-Order'
        ]);

        Permission::create([
            'name' => 'PointOfSaleOrder-Cancel-Order'
        ]);
        /**
         * Point of Sale Inventory module
         */
        Permission::create([
            'name' => 'PointOfSaleInventory-Module'
        ]);
        Permission::create([
            'name' => 'PointOfSaleInventory-View'
        ]);
        Permission::create([
            'name' => 'PointOfSaleInventory-consumption'
        ]);
        /**
         * Asset Category module
         */
        Permission::create([
            'name' => 'AssetCategory-Module'
        ]);

        Permission::create([
            'name' => 'AssetCategory-Add'
        ]);
        Permission::create([
            'name' => 'AssetCategory-Edit'
        ]);

        Permission::create([
            'name' => 'AssetCategory-View'
        ]);

        Permission::create([
            'name' => 'AssetCategory-Delete'
        ]);
        /**
         * Asset Product module
         */
        Permission::create([
            'name' => 'AssetProduct-Module'
        ]);

        Permission::create([
            'name' => 'AssetProduct-Add'
        ]);
        Permission::create([
            'name' => 'AssetProduct-Edit'
        ]);

        Permission::create([
            'name' => 'AssetProduct-View'
        ]);

        Permission::create([
            'name' => 'AssetProduct-Delete'
        ]);
        /**
         * Sub Asset Product module
         */
        Permission::create([
            'name' => 'SubAssetProduct-Module'
        ]);

        Permission::create([
            'name' => 'SubAssetProduct-Add'
        ]);
        Permission::create([
            'name' => 'SubAssetProduct-Edit'
        ]);

        Permission::create([
            'name' => 'SubAssetProduct-View'
        ]);

        Permission::create([
            'name' => 'SubAssetProduct-Delete'
        ]);
        /**
         * QrMenu module
         */
        Permission::create([
            'name' => 'QrMenu-Module'
        ]);

        Permission::create([
            'name' => 'QrMenu-Add'
        ]);
        Permission::create([
            'name' => 'QrMenu-Edit'
        ]);

        Permission::create([
            'name' => 'QrMenu-View'
        ]);

        Permission::create([
            'name' => 'QrMenu-Delete'
        ]);

        //Rent Services Modules
        /**
         * Rent Space module
         */
        Permission::create([
            'name' => 'RentSpace-Module'
        ]);

        Permission::create([
            'name' => 'RentSpace-Add'
        ]);

        Permission::create([
            'name' => 'RentSpace-Edit'
        ]);

        Permission::create([
            'name' => 'RentSpace-View'
        ]);

        Permission::create([
            'name' => 'RentSpace-Delete'
        ]);
        /**
         * Tenant module
         */
        Permission::create([
            'name' => 'Tenant-Module'
        ]);

        Permission::create([
            'name' => 'Tenant-Add'
        ]);

        Permission::create([
            'name' => 'Tenant-Edit'
        ]);

        Permission::create([
            'name' => 'Tenant-View'
        ]);

        Permission::create([
            'name' => 'Tenant-Delete'
        ]);
        /**
         * Rent Contract module
         */
        Permission::create([
            'name' => 'RentContract-Module'
        ]);

        Permission::create([
            'name' => 'RentContract-Add'
        ]);

        Permission::create([
            'name' => 'RentContract-Edit'
        ]);

        Permission::create([
            'name' => 'RentContract-View'
        ]);

        Permission::create([
            'name' => 'RentContract-Delete'
        ]);

        //Gate Services Modules
        /**
         * Ticket Category module
         */
        Permission::create([
            'name' => 'TicketCategory-Module'
        ]);

        Permission::create([
            'name' => 'TicketCategory-Add'
        ]);

        Permission::create([
            'name' => 'TicketCategory-Edit'
        ]);

        Permission::create([
            'name' => 'TicketCategory-View'
        ]);

        Permission::create([
            'name' => 'TicketCategory-Delete'
        ]);
        /**
         * Ticket Sub Category module
         */
        Permission::create([
            'name' => 'TicketSubCategory-Module'
        ]);

        Permission::create([
            'name' => 'TicketSubCategory-Add'
        ]);

        Permission::create([
            'name' => 'TicketSubCategory-Edit'
        ]);

        Permission::create([
            'name' => 'TicketSubCategory-View'
        ]);

        Permission::create([
            'name' => 'TicketSubCategory-Delete'
        ]);
        /**
         * Ticket Price module
         */
        Permission::create([
            'name' => 'TicketPrice-Module'
        ]);

        Permission::create([
            'name' => 'TicketPrice-Add'
        ]);

        Permission::create([
            'name' => 'TicketPrice-Edit'
        ]);

        Permission::create([
            'name' => 'TicketPrice-View'
        ]);
        /**
         * Gate module
         */
        Permission::create([
            'name' => 'Gate-Module'
        ]);

        Permission::create([
            'name' => 'Gate-Add'
        ]);

        Permission::create([
            'name' => 'Gate-Edit'
        ]);

        Permission::create([
            'name' => 'Gate-View'
        ]);
        Permission::create([
            'name' => 'Gate-Delete'
        ]);
        /**
         * Gate Shift module
         */
        Permission::create([
            'name' => 'GateShift-Module'
        ]);

        Permission::create([
            'name' => 'GateShift-Add'
        ]);

        Permission::create([
            'name' => 'GateShift-Edit'
        ]);

        Permission::create([
            'name' => 'GateShift-View'
        ]);
        Permission::create([
            'name' => 'GateShift-Delete'
        ]);
        /**
         * Ticket module
         */
        Permission::create([
            'name' => 'Ticket-Module'
        ]);

        Permission::create([
            'name' => 'Ticket-Add'
        ]);

        Permission::create([
            'name' => 'Ticket-Edit'
        ]);

        Permission::create([
            'name' => 'Ticket-View'
        ]);
        Permission::create([
            'name' => 'Ticket-Delete'
        ]);
        /**
         * Gate Shift Sheets module
         */
        Permission::create([
            'name' => 'GateShiftSheet-Module'
        ]);
        Permission::create([
            'name' => 'GateShiftSheet-View'
        ]);
        /**
         * Gate Report module
         */
        Permission::create([
            'name' => 'GateReport-Module'
        ]);

        Permission::create([
            'name' => 'GateReport-View-RentalVisitors'
        ]);

        Permission::create([
            'name' => 'GateReport-View-HotelVisitors'
        ]);

        Permission::create([
            'name' => 'GateReport-View-InventoryVisitors'
        ]);

        Permission::create([
            'name' => 'GateReport-View-EventsVisitors'
        ]);
        Permission::create([
            'name' => 'GateReport-View-SportVisitors'
        ]);

        //Event Services Modules
        /**
         * Hall module
         */
        Permission::create([
            'name' => 'Hall-Module'
        ]);

        Permission::create([
            'name' => 'Hall-Add'
        ]);

        Permission::create([
            'name' => 'Hall-Edit'
        ]);

        Permission::create([
            'name' => 'Hall-View'
        ]);

        Permission::create([
            'name' => 'Hall-Delete'
        ]);
        /**
         * Supplier Service module
         */
        Permission::create([
            'name' => 'SupplierService-Module'
        ]);

        Permission::create([
            'name' => 'SupplierService-Add'
        ]);

        Permission::create([
            'name' => 'SupplierService-Edit'
        ]);

        Permission::create([
            'name' => 'SupplierService-View'
        ]);

        Permission::create([
            'name' => 'SupplierService-Delete'
        ]);
        /**
         * Event Item Type module
         */
        Permission::create([
            'name' => 'EventItemType-Module'
        ]);

        Permission::create([
            'name' => 'EventItemType-Add'
        ]);

        Permission::create([
            'name' => 'EventItemType-Edit'
        ]);

        Permission::create([
            'name' => 'EventItemType-View'
        ]);

        Permission::create([
            'name' => 'EventItemType-Delete'
        ]);
        /**
         * Event Item module
         */
        Permission::create([
            'name' => 'EventItem-Module'
        ]);

        Permission::create([
            'name' => 'EventItem-Add'
        ]);

        Permission::create([
            'name' => 'EventItem-Edit'
        ]);

        Permission::create([
            'name' => 'EventItem-View'
        ]);

        Permission::create([
            'name' => 'EventItem-Delete'
        ]);
        /**
         * Event module
         */
        Permission::create([
            'name' => 'Event-Module'
        ]);

        Permission::create([
            'name' => 'Event-Add'
        ]);

        Permission::create([
            'name' => 'Event-Edit'
        ]);

        Permission::create([
            'name' => 'Event-View'
        ]);

        Permission::create([
            'name' => 'Event-Delete'
        ]);
        /**
         * Package module
         */
        Permission::create([
            'name' => 'Package-Module'
        ]);

        Permission::create([
            'name' => 'Package-Add'
        ]);

        Permission::create([
            'name' => 'Package-Edit'
        ]);

        Permission::create([
            'name' => 'Package-View'
        ]);

        Permission::create([
            'name' => 'Package-Delete'
        ]);
        /**
         * Event Reservation module
         */
        Permission::create([
            'name' => 'EventReservation-Module'
        ]);

        Permission::create([
            'name' => 'EventReservation-Add'
        ]);

        Permission::create([
            'name' => 'EventReservation-Edit'
        ]);

        Permission::create([
            'name' => 'EventReservation-View'
        ]);

        Permission::create([
            'name' => 'EventReservation-Delete'
        ]);
        Permission::create([
            'name' => 'EventReservation-Confirm-Reservation'
        ]);
        Permission::create([
            'name' => 'EventReservation-Cancel-Reservation'
        ]);
        Permission::create([
            'name' => 'EventReservation-Add-Payment'
        ]);
        Permission::create([
            'name' => 'EventReservation-Add-SupplierPayment'
        ]);
        /**
         * Report Reservation module
         */
        Permission::create([
            'name' => 'ReportReservation-Module'
        ]);

        Permission::create([
            'name' => 'ReportReservation-Reservations'
        ]);

        Permission::create([
            'name' => 'ReportReservation-Customers'
        ]);

        Permission::create([
            'name' => 'ReportReservation-Transactions'
        ]);

        Permission::create([
            'name' => 'ReportReservation-Revenue'
        ]);
        Permission::create([
            'name' => 'ReportReservation-Triple'
        ]);
        Permission::create([
            'name' => 'ReportReservation-Expected-Revenue'
        ]);
        Permission::create([
            'name' => 'ReportReservation-Net-Revenue'
        ]);

        //Hotel Services Modules
        /**
         * Hotel module
         */
        Permission::create([
            'name' => 'Hotel-Module'
        ]);

        Permission::create([
            'name' => 'Hotel-Add'
        ]);

        Permission::create([
            'name' => 'Hotel-Edit'
        ]);

        Permission::create([
            'name' => 'Hotel-View'
        ]);
        Permission::create([
            'name' => 'Hotel-View-Invoices'
        ]);
        Permission::create([
            'name' => 'Hotel-View-Inventories'
        ]);
        Permission::create([
            'name' => 'Hotel-Delete'
        ]);
        /**
         * Room Type module
         */
        Permission::create([
            'name' => 'RoomType-Module'
        ]);

        Permission::create([
            'name' => 'RoomType-Add'
        ]);

        Permission::create([
            'name' => 'RoomType-Edit'
        ]);

        Permission::create([
            'name' => 'RoomType-View'
        ]);

        Permission::create([
            'name' => 'RoomType-Delete'
        ]);
        /**
         * Parent Room module
         */
        Permission::create([
            'name' => 'ParentRoom-Module'
        ]);

        Permission::create([
            'name' => 'ParentRoom-Add'
        ]);

        Permission::create([
            'name' => 'ParentRoom-Edit'
        ]);

        Permission::create([
            'name' => 'ParentRoom-View'
        ]);

        Permission::create([
            'name' => 'ParentRoom-Delete'
        ]);
        /**
         * Room module
         */
        Permission::create([
            'name' => 'Room-Module'
        ]);

        Permission::create([
            'name' => 'Room-Edit'
        ]);

        Permission::create([
            'name' => 'Room-View'
        ]);

        Permission::create([
            'name' => 'Room-Delete'
        ]);
        /**
         * Hotel Reservation module
         */
        Permission::create([
            'name' => 'HotelReservation-Module'
        ]);

        Permission::create([
            'name' => 'HotelReservation-Add'
        ]);

        Permission::create([
            'name' => 'HotelReservation-Edit'
        ]);
        Permission::create([
            'name' => 'HotelReservation-Edit-Dates'
        ]);
        Permission::create([
            'name' => 'HotelReservation-View'
        ]);

        Permission::create([
            'name' => 'HotelReservation-Delete'
        ]);
        Permission::create([
            'name' => 'HotelReservation-CheckIn'
        ]);
        Permission::create([
            'name' => 'HotelReservation-View-Invoices'
        ]);
        Permission::create([
            'name' => 'HotelReservation-View-Payments'
        ]);
        Permission::create([
            'name' => 'HotelReservation-Add-Damage'
        ]);
        Permission::create([
            'name' => 'HotelReservation-View-Damages'
        ]);
        /**
         * Room Maintenance module
         */
        Permission::create([
            'name' => 'RoomMaintenance-Module'
        ]);

        Permission::create([
            'name' => 'RoomMaintenance-Add'
        ]);

        Permission::create([
            'name' => 'RoomMaintenance-Edit'
        ]);

        Permission::create([
            'name' => 'RoomMaintenance-View'
        ]);

        Permission::create([
            'name' => 'RoomMaintenance-Delete'
        ]);
        /**
         * Room Loss module
         */
        Permission::create([
            'name' => 'RoomLoss-Module'
        ]);

        Permission::create([
            'name' => 'RoomLoss-Add'
        ]);

        Permission::create([
            'name' => 'RoomLoss-Edit'
        ]);

        Permission::create([
            'name' => 'RoomLoss-View'
        ]);
        Permission::create([
            'name' => 'RoomLoss-Show'
        ]);
        /**
         * House Keeping module
         */
        Permission::create([
            'name' => 'HouseKeeping-Module'
        ]);

        Permission::create([
            'name' => 'HouseKeeping-Edit'
        ]);

        Permission::create([
            'name' => 'HouseKeeping-View'
        ]);
        /**
         * Hotel Order module
         */
        Permission::create([
            'name' => 'HotelOrder-Module'
        ]);

        Permission::create([
            'name' => 'HotelOrder-Add'
        ]);
        Permission::create([
            'name' => 'HotelOrder-Delete'
        ]);
        Permission::create([
            'name' => 'HotelOrder-View'
        ]);
        Permission::create([
            'name' => 'HotelOrder-Receive-Order'
        ]);
        Permission::create([
            'name' => 'HotelOrder-Cancel-Order'
        ]);
        /**
         * Hotel Inventory module
         */
        Permission::create([
            'name' => 'HotelInventory-Module'
        ]);

        Permission::create([
            'name' => 'HotelInventory-Consumption'
        ]);

        Permission::create([
            'name' => 'HotelInventory-View'
        ]);

        //Laundry Services Modules
        /**
         * Laundry module
         */
        Permission::create([
            'name' => 'Laundry-Module'
        ]);

        Permission::create([
            'name' => 'Laundry-Add'
        ]);

        Permission::create([
            'name' => 'Laundry-Edit'
        ]);

        Permission::create([
            'name' => 'Laundry-View'
        ]);
        Permission::create([
            'name' => 'Laundry-View-Inventories'
        ]);
        Permission::create([
            'name' => 'Laundry-Delete'
        ]);
        /**
         * Laundry services module
         */
        Permission::create([
            'name' => 'LaundryService-Module'
        ]);

        Permission::create([
            'name' => 'LaundryService-Add'
        ]);

        Permission::create([
            'name' => 'LaundryService-Edit'
        ]);

        Permission::create([
            'name' => 'LaundryService-View'
        ]);
        Permission::create([
            'name' => 'LaundryService-Delete'
        ]);
        /**
         * Laundry Category module
         */
        Permission::create([
            'name' => 'LaundryCategory-Module'
        ]);

        Permission::create([
            'name' => 'LaundryCategory-Add'
        ]);

        Permission::create([
            'name' => 'LaundryCategory-Edit'
        ]);

        Permission::create([
            'name' => 'LaundryCategory-View'
        ]);
        Permission::create([
            'name' => 'LaundryCategory-Delete'
        ]);
        /**
         * Laundry Sub Category module
         */
        Permission::create([
            'name' => 'LaundrySubCategory-Module'
        ]);

        Permission::create([
            'name' => 'LaundrySubCategory-Add'
        ]);

        Permission::create([
            'name' => 'LaundrySubCategory-Edit'
        ]);

        Permission::create([
            'name' => 'LaundrySubCategory-View'
        ]);
        Permission::create([
            'name' => 'LaundrySubCategory-Delete'
        ]);
        /**
         * Laundry Order module
         */
        Permission::create([
            'name' => 'LaundryOrder-Module'
        ]);

        Permission::create([
            'name' => 'LaundryOrder-Add'
        ]);
        Permission::create([
            'name' => 'LaundryOrder-Add-Payment'
        ]);
        Permission::create([
            'name' => 'LaundryOrder-Add-ReturnOrder'
        ]);
        Permission::create([
            'name' => 'LaundryOrder-Edit'
        ]);

        Permission::create([
            'name' => 'LaundryOrder-View'
        ]);
        Permission::create([
            'name' => 'LaundryOrder-View-Details'
        ]);
        Permission::create([
            'name' => 'LaundryOrder-Delete'
        ]);
        /**
         * Laundry Inventory Order module
         */
        Permission::create([
            'name' => 'LaundryInventoryOrder-Module'
        ]);

        Permission::create([
            'name' => 'LaundryInventoryOrder-Add'
        ]);
        Permission::create([
            'name' => 'LaundryInventoryOrder-Delete'
        ]);
        Permission::create([
            'name' => 'LaundryInventoryOrder-Receive-Order'
        ]);
        Permission::create([
            'name' => 'LaundryInventoryOrder-Cancel-Order'
        ]);
        Permission::create([
            'name' => 'LaundryInventoryOrder-View'
        ]);
        /**
         * Laundry Inventory module
         */
        Permission::create([
            'name' => 'LaundryInventory-Module'
        ]);

        Permission::create([
            'name' => 'LaundryInventory-Add'
        ]);

        Permission::create([
            'name' => 'LaundryInventory-consumption'
        ]);

        Permission::create([
            'name' => 'LaundryInventory-View'
        ]);
        //Financial Services Modules
        /**
         * Financial Employee module
         */
        Permission::create([
            'name' => 'FinancialEmployee-Module'
        ]);

        Permission::create([
            'name' => 'FinancialEmployee-View-Nomination'
        ]);

        Permission::create([
            'name' => 'FinancialEmployee-View-TheInsured'
        ]);

        Permission::create([
            'name' => 'FinancialEmployee-View-Temporary'
        ]);
        Permission::create([
            'name' => 'FinancialEmployee-View-Officer'
        ]);
        /**
         * Financial Employee Salaries module
         */
        Permission::create([
            'name' => 'FinancialEmployeeSalary-Module'
        ]);

        Permission::create([
            'name' => 'FinancialEmployeeSalary-View-Nomination'
        ]);

        Permission::create([
            'name' => 'FinancialEmployeeSalary-View-TheInsured'
        ]);

        Permission::create([
            'name' => 'FinancialEmployeeSalary-View-Temporary'
        ]);
        Permission::create([
            'name' => 'FinancialEmployeeSalary-View-Officer'
        ]);
        /**
         * Financial Account Type module
         */
        Permission::create([
            'name' => 'FinancialAccountType-Module'
        ]);

        Permission::create([
            'name' => 'FinancialAccountType-View'
        ]);
        /**
         * Financial Account module
         */
        Permission::create([
            'name' => 'FinancialAccount-Module'
        ]);

        Permission::create([
            'name' => 'FinancialAccount-Add'
        ]);
        Permission::create([
            'name' => 'FinancialAccount-Edit'
        ]);

        Permission::create([
            'name' => 'FinancialAccount-View'
        ]);
        Permission::create([
            'name' => 'FinancialAccount-View-MasterSheet'
        ]);
        Permission::create([
            'name' => 'FinancialAccount-Delete'
        ]);
        /**
         * Financial Sub Account module
         */
        Permission::create([
            'name' => 'FinancialSubAccount-Module'
        ]);

        Permission::create([
            'name' => 'FinancialSubAccount-Add'
        ]);
        Permission::create([
            'name' => 'FinancialSubAccount-Edit'
        ]);

        Permission::create([
            'name' => 'FinancialSubAccount-View'
        ]);

        Permission::create([
            'name' => 'FinancialSubAccount-Delete'
        ]);
        /**
         * Financial Journal Entry module
         */
        Permission::create([
            'name' => 'FinancialJournalEntry-Module'
        ]);

        Permission::create([
            'name' => 'FinancialJournalEntry-Add'
        ]);
        Permission::create([
            'name' => 'FinancialJournalEntry-Edit'
        ]);

        Permission::create([
            'name' => 'FinancialJournalEntry-View'
        ]);

        Permission::create([
            'name' => 'FinancialJournalEntry-Delete'
        ]);
        /**
         * Financial Daily Account module
         */
        Permission::create([
            'name' => 'FinancialDailyAccount-Module'
        ]);

        Permission::create([
            'name' => 'FinancialDailyAccount-View-NotMigrated'
        ]);
        Permission::create([
            'name' => 'FinancialDailyAccount-View-Migrated'
        ]);
        /**
         * Financial Department Bills module
         */
        Permission::create([
            'name' => 'FinancialDepartmentBills-Module'
        ]);

        Permission::create([
            'name' => 'FinancialDepartmentBills-View-Report-SportActivity'
        ]);

        Permission::create([
            'name' => 'FinancialEmployeeSalary-View-Report-RentBill'
        ]);

        Permission::create([
            'name' => 'FinancialEmployeeSalary-View-Report-HotelReservation'
        ]);
        Permission::create([
            'name' => 'FinancialEmployeeSalary-View-Report-GateTicket'
        ]);
        Permission::create([
            'name' => 'FinancialEmployeeSalary-View-Report-EventBills'
        ]);
        Permission::create([
            'name' => 'FinancialEmployeeSalary-View-Report-LaundryBills'
        ]);
        Permission::create([
            'name' => 'FinancialEmployeeSalary-View-Report-PosBills'
        ]);
        /**
         * Financial Balance Sheet module
         */

        Permission::create([
            'name' => 'FinancialBalanceSheet-View'
        ]);
        /**
         * Financial Daily Center module
         */

        Permission::create([
            'name' => 'FinancialDailyCenter-View'
        ]);
        /**
         * Financial Income Statement module
         */

        Permission::create([
            'name' => 'FinancialIncomeStatement-View'
        ]);
        /**
         * Financial Statement module
         */
        Permission::create([
            'name' => 'FinancialStatement-View'
        ]);
        /**
         * Financial depreciation module
         */
        Permission::create([
            'name' => 'FinancialDepreciation-View'
        ]);
    }
}
