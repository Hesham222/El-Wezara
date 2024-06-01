<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            اذن صرف الفنادق
        </h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialServices-HotelSendPermission'))
                <a href="{{ route('organizations.spend_permission.hotel.spend_permission.index') }}"class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            عرض</h5>
                    </center>
                </a>
            @endif

        </div>
    </div>
</div>


<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            اذن صرف المغاسل
        </h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialServices-LaundrySendPermission'))
                <a href="{{ route('organizations.spend_permission.laundry.spend_permission.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            عرض</h5>
                    </center>
                </a>
            @endif
        </div>
    </div>
</div>



<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            اذن صرف نقاط البيع
        </h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialServices-PointOfSaleSendPermission'))
                <a href="{{ route('organizations.spend_permission.po.spend_permission.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            عرض</h5>
                    </center>
                </a>
            @endif

        </div>
    </div>
</div>


<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            اذن صرف مناطق التحضير </h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialServices-PreparationAreaSendPermission'))
                <a href="{{ route('organizations.spend_permission.prep.spend_permission.index') }}"class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif

        </div>
    </div>
</div>


<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            استلام بالصنف للفنادق</h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialServices-ReceiptCategoryHotels'))
                <a href="{{ route('organizations.spend_permission.hotel.spend.index') }}"class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif

        </div>
    </div>
</div>



<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            استلام بالصنف للمغاسل</h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialServices-ReceiptCategoryLaundries'))
                <a href="{{ route('organizations.spend_permission.laundry.spend.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif

        </div>
    </div>
</div>


<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            استلام بالصنف لنقاط البيع</h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialServices-ReceiptCategoryPointOfSales'))
                <a href="{{ route('organizations.spend_permission.po.spend.index') }}"class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif
        </div>
    </div>
</div>


<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            استلام بالصنف لمناطق التحضير </h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialServices-ReceiptCategoryPreparationAreas'))
                <a href="{{ route('organizations.spend_permission.prep.spend.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif
        </div>
    </div>
</div>


<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            استلام الاصناف بالموردين </h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialServices-ReceiptCategoryVendors'))
                <a href="{{ route('organizations.spend_permission.purchase.spend.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif
        </div>
    </div>
</div>

<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            اسعار الخامات والموردين </h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialServices-PriceMaterialsVendors'))
                <a href="{{ route('organizations.priceReport.vendor.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif
        </div>
    </div>
</div>


<!--Begin::Section -->

<div class="row">
    <div class="col-xl-12">
        <h4>
            بضاعه اخر المده اعداد وقيم </h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialServices-GoodsReport'))
                <a href="{{ route('organizations.goodsReport.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif
        </div>
    </div>
</div>

<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            تاريخ صلاحية الاصناف </h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialServices-CategoriesExpirationDate'))
                <a href="{{ route('organizations.expirationDate.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif
        </div>
    </div>
</div>


<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            تقرير الهالك </h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->

                @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                    'FinancialServices-PurchaseOrderReports'))
                    <a href="{{ route('organizations.damageReport.index') }}" class="menu_box">
                        <center>
                            <i class="fa fa-4x fa-eye mt-4"></i>
                            <h5 class="m-portlet__head-text mt-4">
                                @lang('Organization::organization.view')
                            </h5>
                        </center>
                    </a>
            @endif
        </div>
    </div>
</div>





<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            تقرير امر الشراء </h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
                @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                    'FinancialServices-PurchaseOrderReports'))
                    <a href="{{ route('organizations.purchaseOrderReport.index') }}" class="menu_box">
                        <center>
                            <i class="fa fa-4x fa-eye mt-4"></i>
                            <h5 class="m-portlet__head-text mt-4">
                                @lang('Organization::organization.view')
                            </h5>
                        </center>
                    </a>
                @endif

        </div>
    </div>
</div>


<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            حد ادنى وحد اعلى للاصناف </h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialServices-MinMaxIngredients'))
                <a href="{{ route('organizations.minMaxIngredient.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif
        </div>
    </div>
</div>

<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            رصيد المخازن اجماليات</h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialServices-InventoryBalancesDetails'))
                <a href="{{ route('organizations.stockBalance.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif
        </div>
    </div>
</div>

<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            رصيد المخازن بالاصناف تفصيليا</h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialServices-InventoryBalancesDetails'))
                <a href="{{ route('organizations.inventoryBalance.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif
        </div>
    </div>
</div>



<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            استهلاك مناطق التحضير</h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialServices-PreparationAreaConsumptions'))
                <a href="{{ route('organizations.AreaConsumption.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif
        </div>
    </div>
</div>


<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            استهلاك نقط البيع</h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialServices-PointOfSaleConsumptions'))
                <a href="{{ route('organizations.PoConsumption.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif
        </div>
    </div>
</div>

<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            استهلاك الفندق</h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialServices-HotelConsumptions'))
                <a href="{{ route('organizations.HotelConsumption.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif
        </div>
    </div>
</div>

<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            استهلاك المغسله</h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialServices-LaundryConsumptions'))
                <a href="{{ route('organizations.LaundryConsumption.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif
        </div>
    </div>
</div>

<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            استهلاك المخزن الرئيسي</h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialServices-MainInventoryConsumptions'))
                <a href="{{ route('organizations.IngredientConsumption.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif
        </div>
    </div>
</div>


<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            تقرير مكونات التجهيزات</h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialServices-ItemComponents'))
                <a href="{{ route('organizations.ItemComponent.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif
        </div>
    </div>
</div>

<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            تقرير مكونات التجهيزات تصنيع </h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialServices-IngredientComponents'))
                <a href="{{ route('organizations.IngredientComponent.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif
        </div>
    </div>
</div>

<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            منصرف صنف معين </h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialServices-IngredientTotals'))
                <a href="{{ route('organizations.IngredientTotal.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif
        </div>
    </div>
</div>




<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            منصرف من المخازن جروبات</h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialServices-CategoryTotals'))
                <a href="{{ route('organizations.CategoryTotal.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif
        </div>
    </div>
</div>

<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            الصنف والمنصرف والمتبقى </h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialServices-ClassAndOutgoings'))
                <a href="{{ route('organizations.classAndOutgoing.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif
        </div>
    </div>
</div>

<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            المنصرف للمنافذ </h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialServices-OutgoingOutlets'))
                <a href="{{ route('organizations.outgoing.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif
        </div>
    </div>
</div>



<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            استلامات بالاصناف والموردين </h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialServices-ReservedIngredientsSuppliers'))
                <a href="{{ route('organizations.resevedIngredentSupplier.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif
        </div>
    </div>
</div>

<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            الصافى بين المنصرف والمرتجع للمخازن </h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialServices-diffOutgoingInComings'))
                <a href="{{ route('organizations.diffOutgoingInComing.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif
        </div>
    </div>
</div>

<!--Begin::Section -->
<div class="row">
    <div class="col-xl-12">
        <h4>
            مرتجع من المخازن الفرعيه للمخزن الرئيسي </h4>
        <hr>
        <div class="d-flex flex-wrap flex-row bd-highlight mb-3">
            <!-- Start Trainer Attendance Module -->
            @if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),
                'FinancialServices-AllOutgoings'))
                <a href="{{ route('organizations.allOutgoing.index') }}" class="menu_box">
                    <center>
                        <i class="fa fa-4x fa-eye mt-4"></i>
                        <h5 class="m-portlet__head-text mt-4">
                            @lang('Organization::organization.view')
                        </h5>
                    </center>
                </a>
            @endif
        </div>
    </div>
</div>
