<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Organization\Models\Permission;

class OrganizationPermissionEnArSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        //inventory
        Permission::create([
            'name'    => 'InventoryPo-check',
            'name_ar' => 'المخزن - امرشراء جديد - فحص'
        ]);
        Permission::create([
            'name'    => 'InventoryPo-order',
            'name_ar' => 'المخزن - امرشراء جديد - فحص'
        ]);
        Permission::create([
            'name'    => 'InventoryPo-receive',
            'name_ar' => 'المخزن - امرشراء جديد - استلام'
        ]);
        //component

        Permission::create([
            'name'    => 'Employee-Add via excel file',
            'name_ar' => 'اضف موظف عن طريق ملف اكسيل'
        ]);
        Permission::create([
            'name'    => 'Employees financial report',
            'name_ar' => 'التقرير المالي للموظفين'
        ]);
        //hr
        Permission::create([
            'name'    => 'Vendor-Add-Ingredients',
            'name_ar' => 'الموردين - اضف مكون وجبات الي مورد'
        ]);
        Permission::create([
            'name'    => 'Vendor-View-Ingredients',
            'name_ar' => 'الموردين - عرض مكون وجبات المورد'
        ]);
        /**
         * Ingredient Category module
         */
        Permission::create([
            'name'      => 'IngredientCategory-Module',
            'name_ar'   => 'فئات مكونات الوجبات'

        ]);

        Permission::create([
            'name'      => 'IngredientCategory-Add',
            'name_ar'   => 'اضف فئه مكون وجبات'
        ]);
        Permission::create([
            'name' => 'IngredientCategory-Edit',
            'name_ar'   => 'تعديل فئه مكون وجبات'

        ]);

        Permission::create([
            'name' => 'IngredientCategory-View',
            'name_ar'   => 'عرض فئه مكون وجبات'

        ]);

        Permission::create([
            'name' => 'IngredientCategory-Delete',
            'name_ar'   => 'مسح فئه مكون وجبات'
        ]);

        //hotel reports
        Permission::create([
            'name'      => 'Hotel Reports',
            'name_ar'   => 'تقارير الفندق'
        ]);
        Permission::create([
            'name'      => 'HotelReport-Weekly',
            'name_ar'   => 'التقرير الاسبوعى للاشغال'
        ]);
        Permission::create([
            'name'      => 'HotelReport-ArrivalList',
            'name_ar'   => 'قائمه الوصول'
        ]);

        Permission::create([
            'name'      => 'HotelReport-ReservationList',
            'name_ar'   => 'قائمه الحجوزات'
        ]);
        Permission::create([
            'name'      => 'HotelReport-ReservationArrivalList',
            'name_ar'   => 'تقرير قائمة الحجوزات و الوصول'
        ]);
        Permission::create([
            'name'      => 'HotelReport-FoundLoss',
            'name_ar'   => 'تقرير قائمه المفقودات '
        ]);
        Permission::create([
            'name'      => 'HotelReport-CompanyStatistics',
            'name_ar'   => 'تقرير احصائيات الشركات '
        ]);
        Permission::create([
            'name'      => 'HotelReport-ReservationYear',
            'name_ar'   => 'تقرير السنويه للحجوزات '
        ]);
        Permission::create([
            'name'      => 'HotelReport-ShoppingCode',
            'name_ar'   => 'تقرير كود التسوق '
        ]);
        Permission::create([
            'name'      => 'HotelReport-RoomBalance',
            'name_ar'   => 'تقرير ارصده الغرف '
        ]);
        Permission::create([
            'name'      => 'HotelReport-RoomTypeDay',
            'name_ar'   => 'تقرير احصائيات انواع الغرف ليوم محدد '
        ]);
        Permission::create([
            'name'      => 'HotelReport-CompanyEmployeeStatistics',
            'name_ar'   => 'تقرير احصائيات موظفي الشركة '
        ]);
        Permission::create([
            'name'      => 'HotelReport-AllEmployeesStatistics',
            'name_ar'   => 'تقرير إحصائيات جميع الموظفين'
        ]);
        Permission::create([
            'name'      => 'HotelReport-RoomType',
            'name_ar'   => 'تقرير احصائيات انواع الغرف '
        ]);
        Permission::create([
            'name'      => 'HotelReport-AllRoomsBookedTodayStatistics',
            'name_ar'   => 'تقرير إحصائيات جميع الغرف المحجوزه اليوم'
        ]);
        Permission::create([
            'name'      => 'HotelReport-RoomMaintenance',
            'name_ar'   => 'تقرير صيانه الغرف '
        ]);
        Permission::create([
            'name'      => 'HotelReport-DepartureList',
            'name_ar'   => 'تقرير قائمة المغادره '
        ]);
        Permission::create([
            'name'      => 'HotelReport-CancelReservationList',
            'name_ar'   => 'تقرير قائمة الحجوزات الملغيه '
        ]);
        Permission::create([
            'name'      => 'HotelReport-RoomOccupancyRate',
            'name_ar'   => 'تقرير النسبة السنوية للاشغال '
        ]);
        Permission::create([
            'name'      => 'HotelReport-OccupancyAnnual',
            'name_ar'   => 'تقرير الاشغال السنوي '
        ]);
        //financial services
        Permission::create([
            'name'      => 'FinancialInventory',
            'name_ar'   => 'خدمات الماليه- الخزنه'
        ]);
        Permission::create([
            'name'      => 'FinancialInventory-ShiftsReport',
            'name_ar'   => 'خدمات الماليه- تقارير الشيفتات'
        ]);
        Permission::create([
            'name'      => 'FinancialInventory-SafesReceipt',
            'name_ar'   => 'خدمات الماليه- ايصالات الخزنه'
        ]);
        Permission::create([
            'name'      => 'FinancialInventory-SafesBankSupply',
            'name_ar'   => 'خدمات الماليه- ايصالات التوريد للبنك'
        ]);

        Permission::create([
            'name'      => 'FinancialServices-HotelSendPermission',
            'name_ar'   => 'خدمات الماليه- تقارير اذن الصرف الفنادق'
        ]);
        Permission::create([
            'name'      => 'FinancialServices-LaundrySendPermission',
            'name_ar'   => 'خدمات الماليه- تقارير اذن الصرف المغاسل'
        ]);
        Permission::create([
            'name'      => 'FinancialServices-PointOfSaleSendPermission',
            'name_ar'   => 'خدمات الماليه- تقارير اذن الصرف نقاط البيع'
        ]);
        Permission::create([
            'name'      => 'FinancialServices-PreparationAreaSendPermission',
            'name_ar'   => 'خدمات الماليه- تقارير اذن الصرف مناطق التحضير'
        ]);
        Permission::create([
            'name'      => 'FinancialServices-ReceiptCategoryHotels',
            'name_ar'   => 'خدمات الماليه- تقارير استلام بالصنف للفنادق'
        ]);
        Permission::create([
            'name'      => 'FinancialServices-ReceiptCategoryHotels',
            'name_ar'   => 'خدمات الماليه- تقارير استلام بالصنف للفنادق'
        ]);
        Permission::create([
            'name'      => 'FinancialServices-ReceiptCategoryLaundries',
            'name_ar'   => 'خدمات الماليه- تقارير استلام بالصنف للمغاسل'
        ]);
        Permission::create([
            'name'      => 'FinancialServices-ReceiptCategoryPointOfSales',
            'name_ar'   => 'خدمات الماليه- تقارير استلام بالصنف لنقاط البيع'
        ]);
        Permission::create([
            'name'      => 'FinancialServices-ReceiptCategoryPreparationAreas',
            'name_ar'   => 'خدمات الماليه- تقارير استلام بالصنف لمناطق التحضير'
        ]);
        Permission::create([
            'name'      => 'FinancialServices-ReceiptCategoryVendors',
            'name_ar'   => 'خدمات الماليه- تقارير استلام الاصناف بالموردين'
        ]);
        Permission::create([
            'name'      => 'FinancialServices-PriceMaterialsVendors',
            'name_ar'   => 'خدمات الماليه- تقارير اسعار الخامات والموردين'
        ]);
        Permission::create([
            'name'      => 'FinancialServices-GoodsReport',
            'name_ar'   => 'تقارير بضاعه اخر المده اعداد وقيم'
        ]);
        Permission::create([
            'name'      => 'FinancialServices-CategoriesExpirationDate',
            'name_ar'   => 'تقارير تاريخ صلاحية الاصناف'
        ]);
        Permission::create([
            'name'      => 'FinancialServices-PurchaseOrderReports',
            'name_ar'   => 'تقرير أمر الشراء'
        ]);
        Permission::create([
            'name'      => 'FinancialServices-MinMaxIngredients',
            'name_ar'   => 'تقرير حد ادنى وحد اعلى للاصناف'
        ]);
        Permission::create([
            'name'      => 'FinancialServices-InventoryBalancesDetails',
            'name_ar'   => 'تقرير رصيد المخازن بالاصناف تفصيليا'
        ]);
        Permission::create([
            'name'      => 'FinancialServices-PreparationAreaConsumptions',
            'name_ar'   => 'تقرير استهلاك مناطق التحضير'
        ]);
        Permission::create([
            'name'      => 'FinancialServices-PointOfSaleConsumptions',
            'name_ar'   => 'تقرير استهلاك نقط البيع'
        ]);
        Permission::create([
            'name'      => 'FinancialServices-HotelConsumptions',
            'name_ar'   => 'تقرير استهلاك الفندق'
        ]);
        Permission::create([
            'name'      => 'FinancialServices-LaundryConsumptions',
            'name_ar'   => 'تقرير استهلاك المغسله'
        ]);
        Permission::create([
            'name'      => 'FinancialServices-MainInventoryConsumptions',
            'name_ar'   => 'تقرير استهلاك المخزن الرئيسي'
        ]);
        Permission::create([
            'name'      => 'FinancialServices-ItemComponents',
            'name_ar'   => 'تقرير مكونات التجهيزات'
        ]);
        Permission::create([
            'name'      => 'FinancialServices-IngredientComponents',
            'name_ar'   => 'تقرير مكونات التجهيزات تصنيع'
        ]);
        Permission::create([
            'name'      => 'FinancialServices-IngredientTotals',
            'name_ar'   => 'تقرير منصرف صنف معين'
        ]);
        Permission::create([
            'name'      => 'FinancialServices-CategoryTotals',
            'name_ar'   => 'تقرير منصرف من المخازن جروبات'
        ]);
        Permission::create([
            'name'      => 'FinancialServices-ClassAndOutgoings',
            'name_ar'   => 'تقرير الصنف والمنصرف والمتبقى'
        ]);
        Permission::create([
            'name'      => 'FinancialServices-OutgoingOutlets',
            'name_ar'   => 'تقرير المنصرف للمنافذ'
        ]);
        Permission::create([
            'name'      => 'FinancialServices-ReservedIngredientsSuppliers',
            'name_ar'   => 'تقرير استلامات بالاصناف والموردين'
        ]);
        Permission::create([
            'name'      => 'FinancialServices-diffOutgoingInComings',
            'name_ar'   => 'تقرير الصافى بين المنصرف والمرتجع للمخازن'
        ]);
        Permission::create([
            'name'      => 'FinancialServices-AllOutgoings',
            'name_ar'   => 'تقرير مرتجع من المخازن الفرعيه للمخزن الرئيسي'
        ]);
        //ميزان المراجعه
        Permission::create([
            'name'      => 'FinancialServices-AllOutgoings',
            'name_ar'   => 'تقرير مرتجع من المخازن الفرعيه للمخزن الرئيسي'
        ]);

        //stoking
        Permission::create([
            'name'      => 'Ingredient-Inventory Stoking',
            'name_ar'   => ' مكونات الوجبات - الجرد'
        ]);
        Permission::create([
            'name'      => 'PointOfSale-Inventory Stoking',
            'name_ar'   => 'نقاط البيع - الجرد'
        ]);
        Permission::create([
            'name'      => 'PreparationArea-Inventory Stoking',
            'name_ar'   => 'نقاط البيع - الجرد'
        ]);
        Permission::create([
            'name'      => 'PreparationArea-Inventory Stoking',
            'name_ar'   => 'نقاط البيع - الجرد'
        ]);
        Permission::create([
            'name'      => 'Hotel-Inventory Stoking',
            'name_ar'   => 'الفندق - الجرد'
        ]);
        Permission::create([
            'name'      => 'Laundry-Inventory Stoking',
            'name_ar'   => 'المغسله - الجرد'
        ]);
        //notifications
        Permission::create([
            'name'    => 'Component-notifications',
            'name_ar' => 'العناصر - الاشعارات'
        ]);
        Permission::create([
            'name'    => 'ClubServices-notifications',
            'name_ar' => 'خدمات النادي - الاشعارات'
        ]);
        Permission::create([
            'name'    => 'Hotel-notifications',
            'name_ar' => 'الفندق - الاشعارات'
        ]);



    }
}
