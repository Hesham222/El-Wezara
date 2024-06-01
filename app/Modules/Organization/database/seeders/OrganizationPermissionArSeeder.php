<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Organization\Models\Permission;

class OrganizationPermissionArSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Permission::where('id',1)->update([
            'name_ar' => 'كل الاقسام'
        ]);

        Permission::where('id',2)->update([
            'name_ar' => 'داشبورد'
        ]);

        Permission::where('id',3)->update([
            'name_ar' => 'المسؤول'
        ]);

        Permission::where('id',4)->update([
            'name_ar' => 'المسؤول-اضف'
        ]);

        Permission::where('id',5)->update([
            'name_ar' => 'المسؤول-تعديل'
        ]);

        Permission::where('id',6)->update([
            'name_ar' => 'المسؤول-عرض'
        ]);

        Permission::where('id',7)->update([
            'name_ar' => 'المسؤول-مسح'
        ]);

        Permission::where('id',8)->update([
            'name_ar' => 'المسؤول-تغيير-الباسورد'
        ]);
        /**
         * Organization Dashboard module
         */
        Permission::where('id',9)->update([
            'name_ar' => 'لوحه التحكم-اظهار'
        ]);
        /**
         * Organization Event Dashboard module
         */
        Permission::where('id',10)->update([
            'name_ar' => 'اظهار لوحه تحكم الحفلات'
        ]);
        /**
         * Organization Housing Dashboard module
         */
        Permission::where('id',11)->update([
            'name_ar' => 'اظهار لوحه تحكم الاسكان'
        ]);
        /**
         * Organization Dashboard Setting module
         */
        Permission::where('id',12)->update([
            'name_ar' => 'اظهار لوحه تحكم الاعدادات'
        ]);
        /**
         * Organization Dashboard Inventory module
         */
        Permission::where('id',13)->update([
            'name_ar' => 'المخزن - عرض'
        ]);
        //Elements Modules
        /**
         * Employee module
         */
        Permission::where('id',14)->update([
            'name_ar' => 'العناصر'
        ]);

        Permission::where('id',15)->update([
            'name_ar' => 'اضف-موظف'
        ]);
        Permission::where('id',16)->update([
            'name_ar' => 'اضف مرتب للموظف'
        ]);
        Permission::where('id',17)->update([
            'name_ar' => 'اضق ايام العمل للموظف'
        ]);
        Permission::where('id',18)->update([
            'name_ar' => 'تعديل الموظف'
        ]);

        Permission::where('id',19)->update([
            'name_ar' => 'عرض - الموظف'
        ]);
        Permission::where('id',20)->update([
            'name_ar' => 'الموافقه للموظف'
        ]);
        Permission::where('id',21)->update([
            'name_ar' => 'الرفض للموظف'
        ]);
        Permission::where('id',22)->update([
            'name_ar' => 'عرض بيانات الموظف'
        ]);
        Permission::where('id',23)->update([
            'name_ar' => 'الحضور والانصراف للموظف'
        ]);
        Permission::where('id',24)->update([
            'name_ar' => 'مسح الموظف'
        ]);
        /**
         * Customer Type module
         */
        Permission::where('id',25)->update([
            'name_ar' => 'انواع العملاء'
        ]);

        Permission::where('id',26)->update([
            'name_ar' => 'اضف نوع عميل'
        ]);

        Permission::where('id',27)->update([
            'name_ar' => 'تعديل نوع عميل'
        ]);

        Permission::where('id',28)->update([
            'name_ar' => 'اظهار نوع عميل'
        ]);

        Permission::where('id',29)->update([
            'name_ar' => 'مسح نوع عميل'
        ]);
        /**
         * Customer module
         */
        Permission::where('id',30)->update([
            'name_ar' => 'العملاء'
        ]);

        Permission::where('id',31)->update([
            'name_ar' => 'اضف عميل'
        ]);

        Permission::where('id',32)->update([
            'name_ar' => 'تعديل عميل'
        ]);

        Permission::where('id',33)->update([
            'name_ar' => 'عرض العميل'
        ]);
        Permission::where('id',34)->update([
            'name_ar' => 'اظهار بيانات العميل'
        ]);
        Permission::where('id',35)->update([
            'name_ar' => 'تغيير الحاله للعميل'
        ]);

        Permission::where('id',36)->update([
            'name_ar' => 'مسح العميل'
        ]);
        /**
         * Complain module
         */
        Permission::where('id',37)->update([
            'name_ar' => 'الشكاوى'
        ]);

        Permission::where('id',38)->update([
            'name_ar' => 'اضف الشكوى'
        ]);

        Permission::where('id',39)->update([
            'name_ar' => 'تعديل الشكوى'
        ]);

        Permission::where('id',40)->update([
            'name_ar' => 'عرض الشكوى'
        ]);

        Permission::where('id',41)->update([
            'name_ar' => 'مسح الشكوى'
        ]);
        /**
         * Role module
         */
        Permission::where('id',42)->update([
            'name_ar' => 'الادوار'
        ]);

        Permission::where('id',43)->update([
            'name_ar' => 'اضف دور'
        ]);

        Permission::where('id',44)->update([
            'name_ar' => 'تعديل دور'
        ]);

        Permission::where('id',45)->update([
            'name_ar' => 'عرض دور'
        ]);
        Permission::where('id',46)->update([
            'name_ar' => 'مسح دور'
        ]);

        //Sport Activity Areas Modules
        /**
         * sport activity module
         */
        Permission::where('id',47)->update([
            'name_ar' => 'الانشطه الرياضيه'
        ]);

        Permission::where('id',48)->update([
            'name_ar' => 'اضف مساحه للانشطه الرياضيه'
        ]);

        Permission::where('id',49)->update([
            'name_ar' => 'تعديل مساحه للانشطه الرياضيه'
        ]);

        Permission::where('id',50)->update([
            'name_ar' => 'عرض مساحه للانشطه الرياضيه'
        ]);

        Permission::where('id',51)->update([
            'name_ar' => 'مسح مساحه للانشطه الرياضيه'
        ]);

        Permission::where('id',52)->update([
            'name_ar' => 'عرض الحجوزات للانشطه الرياضيه'
        ]);
        Permission::where('id',53)->update([
            'name_ar' => 'اضف حجز خارجيللانشطه الرياضيه'
        ]);
        /**
         * club sport module
         */
        Permission::where('id',54)->update([
            'name_ar' => 'رياضات النادي'
        ]);

        Permission::where('id',55)->update([
            'name_ar' => 'اضف رياضه للنادي'
        ]);

        Permission::where('id',56)->update([
            'name_ar' => 'تعديل رياضه للنادي'
        ]);

        Permission::where('id',57)->update([
            'name_ar' => 'عرض رياضه للنادي'
        ]);

        Permission::where('id',58)->update([
            'name_ar' => 'مسح رياضه للنادي'
        ]);
        /**
         * freelanceTrainer module
         */
        Permission::where('id',59)->update([
            'name_ar' => 'مدربين لحسابهم الخاص'
        ]);

        Permission::where('id',60)->update([
            'name_ar' => 'اضف مدرب لحسابه الخاص'
        ]);

        Permission::where('id',61)->update([
            'name_ar' => 'تعديل مدرب لحسابه الخاص'
        ]);

        Permission::where('id',62)->update([
            'name_ar' => 'عرض مدرب لحسابه الخاص'
        ]);

        Permission::where('id',63)->update([
            'name_ar' => 'مسح مدرب لحسابه الخاص'
        ]);
        Permission::where('id',64)->update([
            'name_ar' => 'عرض نسب الربح للمدربين'
        ]);
        /**
         * training module
         */
        Permission::where('id',65)->update([
            'name_ar' => 'التدريبات'
        ]);

        Permission::where('id',66)->update([
            'name_ar' => 'اضف تدريب'
        ]);

        Permission::where('id',67)->update([
            'name_ar' => 'تعديل تدريب'
        ]);

        Permission::where('id',68)->update([
            'name_ar' => 'عرض تدريب'
        ]);

        Permission::where('id',69)->update([
            'name_ar' => 'مسح تدريب'
        ]);
        /**
         * Subscription module
         */
        Permission::where('id',70)->update([
            'name_ar' => 'الاشتراكات'
        ]);

        Permission::where('id',71)->update([
            'name_ar' => 'اضف اشتراك'
        ]);

        Permission::where('id',72)->update([
            'name_ar' => 'تعديل اشتراك'
        ]);

        Permission::where('id',73)->update([
            'name_ar' => 'عرض اشتراك'
        ]);
        Permission::where('id',74)->update([
            'name_ar' => 'عرض الاشتراكات الملغيه'
        ]);

        Permission::where('id',75)->update([
            'name_ar' => 'مسح اشتراك'
        ]);
        Permission::where('id',76)->update([
            'name_ar' => 'اضف دفع لاشتراك'
        ]);
        Permission::where('id',77)->update([
            'name_ar' => 'الغاء اشتراك'
        ]);
        /**
         * payment module
         */
        Permission::where('id',78)->update([
            'name_ar' => 'المدفوعات'
        ]);

        Permission::where('id',79)->update([
            'name_ar' => 'اضف دفع'
        ]);
        Permission::where('id',80)->update([
            'name_ar' => 'عرض المدفوعات'
        ]);
        /**
         * Trainer Attendance module
         */
        Permission::where('id',81)->update([
            'name_ar' => ' حضور المدربين'
        ]);

        Permission::where('id',82)->update([
            'name_ar' => 'عرض حضور المدربين'
        ]);
        Permission::where('id',83)->update([
            'name_ar' => 'عرض تدريبات اليوم للمدربين'
        ]);
        /**
         * Subscriber Attendance module
         */
        Permission::where('id',84)->update([
            'name_ar' => 'حضور المشتركين'
        ]);

        Permission::where('id',85)->update([
            'name_ar' => 'عرض حضور المشتركين'
        ]);
        Permission::where('id',86)->update([
            'name_ar' => 'عرض تدريبات اليوم للمشتركين'
        ]);
        /**
         * External Reservation pricing module
         */
        Permission::where('id',87)->update([
            'name_ar' => 'تسعير الحجوزات الخارجيه'
        ]);

        Permission::where('id',88)->update([
            'name_ar' => 'اضف تسعير حجز خارجي'
        ]);

        Permission::where('id',89)->update([
            'name_ar' => 'تعديل تسعير حجز خارجي'
        ]);

        Permission::where('id',90)->update([
            'name_ar' => 'عرض تسعيرات حجز خارجي'
        ]);

        Permission::where('id',91)->update([
            'name_ar' => 'مسح تسعيرات حجز خارجي'
        ]);
        /**
         * External Reservation  module
         */
        Permission::where('id',92)->update([
            'name_ar' => 'الحجوزات الخارجيه'
        ]);

        Permission::where('id',93)->update([
            'name_ar' => 'اضف حجز خارجي'
        ]);

        Permission::where('id',94)->update([
            'name_ar' => 'تعديل حجز خارجي'
        ]);

        Permission::where('id',95)->update([
            'name_ar' => 'عرض حجز خارجي'
        ]);

        Permission::where('id',96)->update([
            'name_ar' => 'مسح حجز خارجي'
        ]);
        Permission::where('id',97)->update([
            'name_ar' => 'اضف دفع حجز خارجي'
        ]);
        /**
         * External Reservation Payment module
         */
        Permission::where('id',98)->update([
            'name_ar' => 'مدفوعات الحجوزات الخارجيه'
        ]);

        Permission::where('id',99)->update([
            'name_ar' => 'اضف دفع حجز خارجي'
        ]);

        Permission::where('id',100)->update([
            'name_ar' => 'عرض مدفوعات الحجوزات الخارجيه'
        ]);


        /**
         * Report module
         */
        Permission::where('id',101)->update([
            'name_ar' => 'تقارير الانشطه الرياضيه'
        ]);

        Permission::where('id',102)->update([
            'name_ar' => 'تقرير الزوار اليومي'
        ]);

        Permission::where('id',103)->update([
            'name_ar' => 'تقرير المدربين اليومي'
        ]);

        Permission::where('id',104)->update([
            'name_ar' => 'تقرير التدريب اليومي'
        ]);

        Permission::where('id',105)->update([
            'name_ar' => 'تقرير ارصده المشتركين المتبقيه'
        ]);
        Permission::where('id',106)->update([
            'name_ar' => 'تقرير عمليات الدفع'
        ]);
        Permission::where('id',107)->update([
            'name_ar' => 'تقرير الايرادات لجميع الالعاب الرياضيه'
        ]);
        Permission::where('id',108)->update([
            'name_ar' => 'المناطق'
        ]);
        Permission::where('id',109)->update([
            'name_ar' => 'الحضور للمدربين'
        ]);

        //Hr Modules
        /**
         * department module
         */
        Permission::where('id',110)->update([
            'name_ar' => 'الموارد البشريه'
        ]);

        Permission::where('id',111)->update([
            'name_ar' => 'اضف اداره'
        ]);

        Permission::where('id',112)->update([
            'name_ar' => 'تعديل اداره'
        ]);

        Permission::where('id',113)->update([
            'name_ar' => 'عرض اداره'
        ]);

        Permission::where('id',114)->update([
            'name_ar' => 'مسح اداره'
        ]);
        /**
         * Vendor module
         */
        Permission::where('id',115)->update([
            'name_ar' => 'الموردين'
        ]);

        Permission::where('id',116)->update([
            'name_ar' => 'اضف مورد'
        ]);

        Permission::where('id',117)->update([
            'name_ar' => 'تعديل مورد'
        ]);

        Permission::where('id',118)->update([
            'name_ar' => 'عرض مورد'
        ]);

        Permission::where('id',119)->update([
            'name_ar' => 'مسح مورد'
        ]);
        Permission::where('id',120)->update([
            'name_ar' => 'مشاهده تفاصيل المورد'
        ]);
        /**
         * Vendor Type module
         */
        Permission::where('id',121)->update([
            'name_ar' => 'نوع الموردين'
        ]);

        Permission::where('id',122)->update([
            'name_ar' => 'اضف نوع مورد'
        ]);

        Permission::where('id',123)->update([
            'name_ar' => 'تعديل نوع مورد'
        ]);

        Permission::where('id',124)->update([
            'name_ar' => 'عرض نوع مورد'
        ]);

        Permission::where('id',125)->update([
            'name_ar' => 'مسح نوع مورد'
        ]);
        /**
         * Employee Type module
         */
        Permission::where('id',126)->update([
            'name_ar' => 'نوع الموظف'
        ]);

        Permission::where('id',127)->update([
            'name_ar' => 'اضف نوع موظف'
        ]);

        Permission::where('id',128)->update([
            'name_ar' => 'تعديل نوع موظف'
        ]);

        Permission::where('id',129)->update([
            'name_ar' => 'عرض نوع موظف'
        ]);

        Permission::where('id',130)->update([
            'name_ar' => 'مسح نوع موظف'
        ]);
        /**
         * Employee Job module
         */
        Permission::where('id',131)->update([
            'name_ar' => 'وظيفه الموظف'
        ]);

        Permission::where('id',132)->update([
            'name_ar' => 'اضف زظيفه موظف'
        ]);

        Permission::where('id',133)->update([
            'name_ar' => 'تعديل وظيفه موظف'
        ]);

        Permission::where('id',134)->update([
            'name_ar' => 'عرض وظيفه موظف'
        ]);

        Permission::where('id',135)->update([
            'name_ar' => 'مسح وظيفه موظف'
        ]);
        /**
         * Employee Vacation Type module
         */
        Permission::where('id',136)->update([
            'name_ar' => 'نوع اجازة الموظف'
        ]);

        Permission::where('id',137)->update([
            'name_ar' => 'اضف نوع اجازة الموظف'
        ]);

        Permission::where('id',138)->update([
            'name_ar' => 'تعديل نوع اجازة الموظف'
        ]);

        Permission::where('id',139)->update([
            'name_ar' => 'عرض نوع اجازة الموظف'
        ]);

        Permission::where('id',140)->update([
            'name_ar' => 'مسح نوع اجازة الموظف'
        ]);
        /**
         * Employee Vacation Request module
         */
        Permission::where('id',141)->update([
            'name_ar' => 'طلب اجازه'
        ]);

        Permission::where('id',142)->update([
            'name_ar' => 'اضف طلب اجازه'
        ]);

        Permission::where('id',143)->update([
            'name_ar' => 'عرض طلب اجازه'
        ]);
        /**
         * Employee Financial Request module
         */
        Permission::where('id',144)->update([
            'name_ar' => 'طلب سلفه'
        ]);

        Permission::where('id',145)->update([
            'name_ar' => 'اضف طلب سلفه'
        ]);

        Permission::where('id',146)->update([
            'name_ar' => 'عرض طلب سلفه'
        ]);
        /**
         * Employee Bonus module
         */
        Permission::where('id',147)->update([
            'name_ar' => 'مكافأه للموظف'
        ]);

        Permission::where('id',148)->update([
            'name_ar' => 'عرض مكافأه للموظف'
        ]);
        /**
         * Employee Deduction module
         */
        Permission::where('id',149)->update([
            'name_ar' => 'خصم للموظف'
        ]);

        Permission::where('id',150)->update([
            'name_ar' => 'عرض خصم للموظف'
        ]);
        /**
         * Employee Financial Report module
         */
        Permission::where('id',151)->update([
            'name_ar' => 'التقرير المالي للموظف'
        ]);

        Permission::where('id',152)->update([
            'name_ar' => 'عرض التقرير المالي للموظف'
        ]);

        //Club Services Modules
        /**
         * Unit module
         */
        Permission::where('id',153)->update([
            'name_ar' => 'خدمات النادي'
        ]);

        Permission::where('id',154)->update([
            'name_ar' => 'اضف وحده قياس'
        ]);

        Permission::where('id',155)->update([
            'name_ar' => 'تعديل وحده قياس'
        ]);

        Permission::where('id',156)->update([
            'name_ar' => 'عرض وحده قياس'
        ]);

        Permission::where('id',157)->update([
            'name_ar' => 'مسح وحده قياس'
        ]);
        /**
         * Ingredient module
         */
        Permission::where('id',158)->update([
            'name_ar' => 'مكونات الوجبات'
        ]);

        Permission::where('id',159)->update([
            'name_ar' => 'اضف مكونات الوجبات'
        ]);
        Permission::where('id',160)->update([
            'name_ar' => 'اضف بواسطه ملف اكسيل '
        ]);
        Permission::where('id',161)->update([
            'name_ar' => 'تعديل مكونات الوجبات'
        ]);

        Permission::where('id',162)->update([
            'name_ar' => 'عرض مكونات الوجبات'
        ]);

        Permission::where('id',163)->update([
            'name_ar' => 'مسح مكونات الوجبات'
        ]);
        Permission::where('id',164)->update([
            'name_ar' => 'عرض الكميات الواجب اعدامها'
        ]);
        Permission::where('id',165)->update([
            'name_ar' => 'عرض المكونات ذات اعاده طلب كبيره'
        ]);
        Permission::where('id',166)->update([
            'name_ar' => 'اضافه منتجات تصنيع'
        ]);
        /**
         * Item module
         */
        Permission::where('id',167)->update([
            'name_ar' => 'المنتجات'
        ]);

        Permission::where('id',168)->update([
            'name_ar' => 'اضف منتج'
        ]);
        Permission::where('id',169)->update([
            'name_ar' => 'اضف متغير للمنتج'
        ]);
        Permission::where('id',170)->update([
            'name_ar' => 'عرض تغير للمنتج'
        ]);
        Permission::where('id',171)->update([
            'name_ar' => 'تعديل منتج'
        ]);

        Permission::where('id',172)->update([
            'name_ar' => 'عرض منتج'
        ]);

        Permission::where('id',173)->update([
            'name_ar' => 'مسح منتج'
        ]);
        /**
         * Menu Category module
         */
        Permission::where('id',174)->update([
            'name_ar' => 'فئات المنيو'
        ]);

        Permission::where('id',175)->update([
            'name_ar' => 'اضف فئات المنيو'
        ]);
        Permission::where('id',176)->update([
            'name_ar' => 'تعديل فئات المنيو'
        ]);

        Permission::where('id',177)->update([
            'name_ar' => 'عرض فئات المنيو'
        ]);

        Permission::where('id',178)->update([
            'name_ar' => 'مسح فئات المنيو'
        ]);
        /**
         * Preparation Area module
         */
        Permission::where('id',179)->update([
            'name_ar' => 'مناطق التحضير'
        ]);

        Permission::where('id',180)->update([
            'name_ar' => 'اضف منطقه تحضير'
        ]);
        Permission::where('id',181)->update([
            'name_ar' => 'تعديل منطقه تحضير'
        ]);

        Permission::where('id',182)->update([
            'name_ar' => 'عرض منطقه تحضير'
        ]);

        Permission::where('id',183)->update([
            'name_ar' => 'مسح منطقه تحضير'
        ]);
        Permission::where('id',184)->update([
            'name_ar' => 'عرض المخزن'
        ]);
        Permission::where('id',185)->update([
            'name_ar' => 'عرض الجرد'
        ]);
        Permission::where('id',186)->update([
            'name_ar' => 'عرض طلبات التحويل الداخلي'
        ]);
        Permission::where('id',187)->update([
            'name_ar' => 'منتجات الحجز'
        ]);
        Permission::where('id',188)->update([
            'name_ar' => 'طلب استرجاع'
        ]);
        Permission::where('id',189)->update([
            'name_ar' => 'عرض طلبات الاستراجاع'
        ]);

        /**
         * Preparation Area Order module
         */
        Permission::where('id',190)->update([
            'name_ar' => 'طلبات منطقه التحضير'
        ]);
        Permission::where('id',191)->update([
            'name_ar' => 'عرض طلبات منطقه التحضير'
        ]);
        Permission::where('id',192)->update([
            'name_ar' => 'اضف طلب منطقه التحضير'
        ]);
        Permission::where('id',193)->update([
            'name_ar' => 'مسح طلب منطقه التحضير'
        ]);
        Permission::where('id',194)->update([
            'name_ar' => 'استلام طلب منطقه التحضير'
        ]);

        Permission::where('id',195)->update([
            'name_ar' => 'الغاء طلب منطقه التحضير'
        ]);
        /**
         * Preparation Area Inventory module
         */
        Permission::where('id',196)->update([
            'name_ar' => 'مخازن منطقه التحضير'
        ]);
        Permission::where('id',197)->update([
            'name_ar' => 'عرض مخازن منطقه التحضير'
        ]);
        Permission::where('id',198)->update([
            'name_ar' => 'استهلاك منطقه التحضير'
        ]);
        /**
         * Point of Sale module
         */
        Permission::where('id',199)->update([
            'name_ar' => 'نقطه البيع'
        ]);

        Permission::where('id',200)->update([
            'name_ar' => 'اضف نقطه بيع'
        ]);
        Permission::where('id',201)->update([
            'name_ar' => 'تعديل نقطه بيع'
        ]);

        Permission::where('id',202)->update([
            'name_ar' => 'عرض نقطه بيع'
        ]);

        Permission::where('id',203)->update([
            'name_ar' => 'مسح نقطه بيع'
        ]);
        Permission::where('id',204)->update([
            'name_ar' => 'عرض المخازن'
        ]);
        Permission::where('id',205)->update([
            'name_ar' => 'عرض المدفوعات'
        ]);
        Permission::where('id',206)->update([
            'name_ar' => 'اضف طلب'
        ]);
        Permission::where('id',207)->update([
            'name_ar' => 'عرض الطلبات قيد التقدم'
        ]);
        Permission::where('id',208)->update([
            'name_ar' => 'تفاصيل الشيفتات'
        ]);
        Permission::where('id',209)->update([
            'name_ar' => 'كل اوردرات نقاط البيع'
        ]);
        Permission::where('id',210)->update([
            'name_ar' => 'طلب ارجاع'
        ]);
        Permission::where('id',211)->update([
            'name_ar' => 'عرض طلبات الارجاع'
        ]);

        /**
         * Point of Sale Order module
         */
        Permission::where('id',212)->update([
            'name_ar' => 'طلبات نقط البيع'
        ]);
        Permission::where('id',213)->update([
            'name_ar' => 'اضف طلبات نقط البيع'
        ]);
        Permission::where('id',214)->update([
            'name_ar' => 'مسح طلبات نقط البيع'
        ]);
        Permission::where('id',215)->update([
            'name_ar' => 'عرض طلبات نقط البيع'
        ]);
        Permission::where('id',216)->update([
            'name_ar' => 'استلام طلب نقط البيع'
        ]);

        Permission::where('id',217)->update([
            'name_ar' => 'الغاء طلب نقط البيع'
        ]);
        /**
         * Point of Sale Inventory module
         */
        Permission::where('id',218)->update([
            'name_ar' => 'مخازن نقط البيع'
        ]);
        Permission::where('id',219)->update([
            'name_ar' => 'عرض مخازن نقط البيع'
        ]);
        Permission::where('id',220)->update([
            'name_ar' => 'استهلاك نقط البيع'
        ]);
        /**
         * Asset Category module
         */
        Permission::where('id',221)->update([
            'name_ar' => 'فئة الأصول'
        ]);

        Permission::where('id',222)->update([
            'name_ar' => 'اضف فئه الأصول'
        ]);
        Permission::where('id',223)->update([
            'name_ar' => 'تعديل فئه الأصول'
        ]);

        Permission::where('id',224)->update([
            'name_ar' => 'عرض فئه الأصول'
        ]);

        Permission::where('id',225)->update([
            'name_ar' => 'مسح فئه الأصول'
        ]);
        /**
         * Asset Product module
         */
        Permission::where('id',226)->update([
            'name_ar' => 'منتجات الاصول الرئيسيه
'
        ]);

        Permission::where('id',227)->update([
            'name_ar' => 'اضف منتجات الاصول الرئيسيه'
        ]);
        Permission::where('id',228)->update([
            'name_ar' => 'تعديل منتجات الاصول الرئيسيه'
        ]);

        Permission::where('id',229)->update([
            'name_ar' => 'عرض منتجات الاصول الرئيسيه'
        ]);

        Permission::where('id',230)->update([
            'name_ar' => 'مسح منتجات الاصول الرئيسيه'
        ]);
        /**
         * Sub Asset Product module
         */
        Permission::where('id',231)->update([
            'name_ar' => 'منتجات الأصول'
        ]);

        Permission::where('id',232)->update([
            'name_ar' => 'اضف منتجات الأصول'
        ]);
        Permission::where('id',233)->update([
            'name_ar' => 'تعديل منتجات الأصول'
        ]);

        Permission::where('id',234)->update([
            'name_ar' => 'عرض منتجات الأصول'
        ]);

        Permission::where('id',235)->update([
            'name_ar' => 'مسح منتجات الأصول'
        ]);
        /**
         * QrMenu module
         */
        Permission::where('id',236)->update([
            'name_ar' => 'QrMenu-Module'
        ]);

        Permission::where('id',237)->update([
            'name_ar' => 'QrMenu-اضف'
        ]);
        Permission::where('id',238)->update([
            'name_ar' => 'QrMenu-تعديل'
        ]);

        Permission::where('id',239)->update([
            'name_ar' => 'QrMenu-عرض'
        ]);

        Permission::where('id',240)->update([
            'name_ar' => 'QrMenu-مسح'
        ]);

        //Rent Services Modules
        /**
         * Rent Space module
         */
        Permission::where('id',241)->update([
            'name_ar' => 'خدمات الايجار'
        ]);

        Permission::where('id',242)->update([
            'name_ar' => 'اضف مساحه ايجار'
        ]);

        Permission::where('id',243)->update([
            'name_ar' => 'تعديل مساحه ايجار'
        ]);

        Permission::where('id',244)->update([
            'name_ar' => 'عرض مساحه ايجار'
        ]);

        Permission::where('id',245)->update([
            'name_ar' => 'مسح مساحه ايجار'
        ]);
        /**
         * Tenant module
         */
        Permission::where('id',246)->update([
            'name_ar' => 'مستاجر'
        ]);

        Permission::where('id',247)->update([
            'name_ar' => 'اضف مستأجر'
        ]);

        Permission::where('id',248)->update([
            'name_ar' => 'تعديل مستأجر'
        ]);

        Permission::where('id',249)->update([
            'name_ar' => 'عرض مستأجر'
        ]);

        Permission::where('id',250)->update([
            'name_ar' => 'مسح مستأجر'
        ]);
        /**
         * Rent Contract module
         */
        Permission::where('id',251)->update([
            'name_ar' => 'عقود الايجار'
        ]);

        Permission::where('id',252)->update([
            'name_ar' => 'اضف عقد ايجار'
        ]);

        Permission::where('id',253)->update([
            'name_ar' => 'تعديل عقد ايجار'
        ]);

        Permission::where('id',254)->update([
            'name_ar' => 'عرض عقد ايجار'
        ]);

        Permission::where('id',255)->update([
            'name_ar' => 'مسح عقد ايجار'
        ]);

        //Gate Services Modules
        /**
         * Ticket Category module
         */
        Permission::where('id',256)->update([
            'name_ar' => 'خدمات البوابه'
        ]);

        Permission::where('id',257)->update([
            'name_ar' => 'اضف فئه تذاكر رئيسية'
        ]);

        Permission::where('id',258)->update([
            'name_ar' => 'تعديل فئه تذاكر رئيسية'
        ]);

        Permission::where('id',259)->update([
            'name_ar' => 'عرض فئه تذاكر رئيسية'
        ]);

        Permission::where('id',260)->update([
            'name_ar' => 'مسح فئه تذاكر رئيسية'
        ]);
        /**
         * Ticket Sub Category module
         */
        Permission::where('id',261)->update([
            'name_ar' => 'فئات التذاكر'
        ]);

        Permission::where('id',262)->update([
            'name_ar' => 'اضف فئه تذاكر'
        ]);

        Permission::where('id',263)->update([
            'name_ar' => 'تعديل فئه تذاكر'
        ]);

        Permission::where('id',264)->update([
            'name_ar' => 'عرض فئه تذاكر'
        ]);

        Permission::where('id',265)->update([
            'name_ar' => 'مسح فئه تذاكر'
        ]);
        /**
         * Ticket Price module
         */
        Permission::where('id',266)->update([
            'name_ar' => 'أسعار التذاكر'
        ]);

        Permission::where('id',267)->update([
            'name_ar' => 'اضف أسعار التذاكر'
        ]);

        Permission::where('id',268)->update([
            'name_ar' => 'تعديل أسعار التذاكر'
        ]);

        Permission::where('id',269)->update([
            'name_ar' => 'عرض أسعار التذاكر'
        ]);
        /**
         * Gate module
         */
        Permission::where('id',270)->update([
            'name_ar' => 'البوابات'
        ]);

        Permission::where('id',271)->update([
            'name_ar' => 'اضف بوابه'
        ]);

        Permission::where('id',272)->update([
            'name_ar' => 'تعديل بوابه'
        ]);

        Permission::where('id',273)->update([
            'name_ar' => 'عرض بوابه'
        ]);
        Permission::where('id',274)->update([
            'name_ar' => 'مسح بوابه'
        ]);
        /**
         * Gate Shift module
         */
        Permission::where('id',275)->update([
            'name_ar' => 'ادارة البوابات'
        ]);

        Permission::where('id',276)->update([
            'name_ar' => 'اضف ادارة البوابات'
        ]);

        Permission::where('id',277)->update([
            'name_ar' => 'تعديل ادارة البوابات'
        ]);

        Permission::where('id',278)->update([
            'name_ar' => 'عرض ادارة البوابات'
        ]);
        Permission::where('id',279)->update([
            'name_ar' => 'مسح ادارة البوابات'
        ]);
        /**
         * Ticket module
         */
        Permission::where('id',280)->update([
            'name_ar' => 'التذاكر'
        ]);

        Permission::where('id',281)->update([
            'name_ar' => 'اضف تذكره'
        ]);

        Permission::where('id',282)->update([
            'name_ar' => 'تعديل تذكره'
        ]);

        Permission::where('id',283)->update([
            'name_ar' => 'عرض تذكره'
        ]);
        Permission::where('id',284)->update([
            'name_ar' => 'مسح تذكره'
        ]);
        /**
         * Gate Shift Sheets module
         */
        Permission::where('id',285)->update([
            'name_ar' => 'تقارير البوابات'
        ]);
        Permission::where('id',286)->update([
            'name_ar' => 'عرض تقارير البوابات'
        ]);
        /**
         * Gate Report module
         */
        Permission::where('id',287)->update([
            'name_ar' => 'زوار اليوم'
        ]);

        Permission::where('id',288)->update([
            'name_ar' => 'زوار الايجارات'
        ]);

        Permission::where('id',289)->update([
            'name_ar' => 'زوار الفندق'
        ]);

        Permission::where('id',290)->update([
            'name_ar' => 'زوار المخازن'
        ]);

        Permission::where('id',291)->update([
            'name_ar' => 'زوار المناسبات'
        ]);
        Permission::where('id',292)->update([
            'name_ar' => 'زوار الانشطه الرياضيه'
        ]);

        //Event Services Modules
        /**
         * Hall module
         */
        Permission::where('id',293)->update([
            'name_ar' => 'خدمات المناسبات'
        ]);

        Permission::where('id',294)->update([
            'name_ar' => 'اضف قاعه'
        ]);

        Permission::where('id',295)->update([
            'name_ar' => 'تعديل قاعه'
        ]);

        Permission::where('id',296)->update([
            'name_ar' => 'عرض قاعه'
        ]);

        Permission::where('id',297)->update([
            'name_ar' => 'مسح قاعه'
        ]);
        /**
         * Supplier Service module
         */
        Permission::where('id',298)->update([
            'name_ar' => 'خدمات الموردين'
        ]);

        Permission::where('id',299)->update([
            'name_ar' => 'اضف خدمات الموردين'
        ]);

        Permission::where('id',300)->update([
            'name_ar' => 'تعديل خدمات الموردين'
        ]);

        Permission::where('id',301)->update([
            'name_ar' => 'عرض خدمات الموردين'
        ]);

        Permission::where('id',302)->update([
            'name_ar' => 'مسح خدمات الموردين'
        ]);
        /**
         * Event Item Type module
         */
        Permission::where('id',303)->update([
            'name_ar' => 'أنواع المعدات'
        ]);

        Permission::where('id',304)->update([
            'name_ar' => 'اضف أنواع المعدات'
        ]);

        Permission::where('id',305)->update([
            'name_ar' => 'تعديل أنواع المعدات'
        ]);

        Permission::where('id',306)->update([
            'name_ar' => 'عرض أنواع المعدات'
        ]);

        Permission::where('id',307)->update([
            'name_ar' => 'مسح أنواع المعدات'
        ]);
        /**
         * Event Item module
         */
        Permission::where('id',308)->update([
            'name_ar' => 'المعدات'
        ]);

        Permission::where('id',309)->update([
            'name_ar' => 'اضف المعدات'
        ]);

        Permission::where('id',310)->update([
            'name_ar' => 'تعديل المعدات'
        ]);

        Permission::where('id',311)->update([
            'name_ar' => 'عرض المعدات'
        ]);

        Permission::where('id',312)->update([
            'name_ar' => 'مسح المعدات'
        ]);
        /**
         * Event module
         */
        Permission::where('id',313)->update([
            'name_ar' => 'المناسبات'
        ]);

        Permission::where('id',314)->update([
            'name_ar' => 'اضف المناسبات'
        ]);

        Permission::where('id',315)->update([
            'name_ar' => 'تعديل المناسبات'
        ]);

        Permission::where('id',316)->update([
            'name_ar' => 'عرض المناسبات'
        ]);

        Permission::where('id',317)->update([
            'name_ar' => 'مسجح المناسبات'
        ]);
        /**
         * Package module
         */
        Permission::where('id',318)->update([
            'name_ar' => 'باكج - الحزم'
        ]);

        Permission::where('id',319)->update([
            'name_ar' => 'اضف حزمه'
        ]);

        Permission::where('id',320)->update([
            'name_ar' => 'تعديل حزمه'
        ]);

        Permission::where('id',321)->update([
            'name_ar' => 'عرض حزمه'
        ]);

        Permission::where('id',322)->update([
            'name_ar' => 'مسح حزمه'
        ]);
        /**
         * Event Reservation module
         */
        Permission::where('id',323)->update([
            'name_ar' => 'الحجوزات'
        ]);

        Permission::where('id',324)->update([
            'name_ar' => 'اضف حجز'
        ]);

        Permission::where('id',325)->update([
            'name_ar' => 'تعديل حجز'
        ]);

        Permission::where('id',326)->update([
            'name_ar' => 'عرض حجز'
        ]);

        Permission::where('id',327)->update([
            'name_ar' => 'مسح حجز'
        ]);
        Permission::where('id',328)->update([
            'name_ar' => 'تأكيد الحجز'
        ]);
        Permission::where('id',329)->update([
            'name_ar' => 'الغاء الحجز'
        ]);
        Permission::where('id',330)->update([
            'name_ar' => 'اضافه دفع'
        ]);
        Permission::where('id',331)->update([
            'name_ar' => 'اضافه دفع للموردين'
        ]);
        /**
         * Report Reservation module
         */
        Permission::where('id',332)->update([
            'name_ar' => 'تقارير الحفالات'
        ]);

        Permission::where('id',333)->update([
            'name_ar' => 'تقارير الحجوزات'
        ]);

        Permission::where('id',334)->update([
            'name_ar' => 'تقارير المبالغ المتبقيه للحفلات'
        ]);

        Permission::where('id',335)->update([
            'name_ar' => 'تقارير عمليات الدفع'
        ]);

        Permission::where('id',336)->update([
            'name_ar' => 'تقارير ارباح الحفلات'
        ]);
        Permission::where('id',337)->update([
            'name_ar' => 'التقرير الثلاثي'
        ]);
        Permission::where('id',338)->update([
            'name_ar' => 'التقارير الارباح المتوقعه'
        ]);
        Permission::where('id',339)->update([
            'name_ar' => 'تقارير صافي الارباح'
        ]);

        //Hotel Services Modules
        /**
         * Hotel module
         */
        Permission::where('id',340)->update([
            'name_ar' => 'خدمات الفندق'
        ]);

        Permission::where('id',341)->update([
            'name_ar' => 'اضف فندق'
        ]);

        Permission::where('id',342)->update([
            'name_ar' => 'تعديل فندق'
        ]);

        Permission::where('id',343)->update([
            'name_ar' => 'عرض فندق'
        ]);
        Permission::where('id',344)->update([
            'name_ar' => 'عرض الفواتير'
        ]);
        Permission::where('id',345)->update([
            'name_ar' => 'عرض المخازن'
        ]);
        Permission::where('id',346)->update([
            'name_ar' => 'مسح فندق'
        ]);
        /**
         * Room Type module
         */
        Permission::where('id',347)->update([
            'name_ar' => 'أنواع الغرف'
        ]);

        Permission::where('id',348)->update([
            'name_ar' => 'اضف أنواع الغرف'
        ]);

        Permission::where('id',349)->update([
            'name_ar' => 'تعديل أنواع الغرف'
        ]);

        Permission::where('id',350)->update([
            'name_ar' => 'عرض أنواع الغرف'
        ]);

        Permission::where('id',351)->update([
            'name_ar' => 'مسح أنواع الغرف'
        ]);
        /**
         * Parent Room module
         */
        Permission::where('id',352)->update([
            'name_ar' => 'الغرف الرئيسيه'
        ]);

        Permission::where('id',353)->update([
            'name_ar' => 'اضف غرف رئيسيه'
        ]);

        Permission::where('id',354)->update([
            'name_ar' => 'تعديل غرف رئيسيه'
        ]);

        Permission::where('id',355)->update([
            'name_ar' => 'عرض غرف رئيسيه'
        ]);

        Permission::where('id',356)->update([
            'name_ar' => 'مسح غرف رئيسيه'
        ]);
        /**
         * Room module
         */
        Permission::where('id',357)->update([
            'name_ar' => 'الغرف'
        ]);

        Permission::where('id',358)->update([
            'name_ar' => 'تعديل الغرفه'
        ]);

        Permission::where('id',359)->update([
            'name_ar' => 'عرض الغرفه'
        ]);

        Permission::where('id',360)->update([
            'name_ar' => 'مسح الغرفه'
        ]);
        /**
         * Hotel Reservation module
         */
        Permission::where('id',361)->update([
            'name_ar' => 'حجوزات الفندق'
        ]);

        Permission::where('id',362)->update([
            'name_ar' => 'اضف حجز فندق'
        ]);

        Permission::where('id',363)->update([
            'name_ar' => 'تعديل حجز فندق'
        ]);
        Permission::where('id',364)->update([
            'name_ar' => 'تعديل تواريخ حجز فندق'
        ]);
        Permission::where('id',365)->update([
            'name_ar' => 'عرض حجز فندق'
        ]);

        Permission::where('id',366)->update([
            'name_ar' => 'مسح حجز فندق'
        ]);
        Permission::where('id',367)->update([
            'name_ar' => 'تسجيل دخول'
        ]);
        Permission::where('id',368)->update([
            'name_ar' => 'عرض الفواتير'
        ]);
        Permission::where('id',369)->update([
            'name_ar' => 'عرض المدفوعات'
        ]);
        Permission::where('id',370)->update([
            'name_ar' => 'اضف ضرر للغرفه'
        ]);
        Permission::where('id',371)->update([
            'name_ar' => 'عرض اضرار الغرفه'
        ]);
        /**
         * Room Maintenance module
         */
        Permission::where('id',372)->update([
            'name_ar' => 'صيانة الغرف'
        ]);

        Permission::where('id',373)->update([
            'name_ar' => 'اضف صيانة الغرف'
        ]);

        Permission::where('id',374)->update([
            'name_ar' => 'تعديل صيانة الغرف'
        ]);

        Permission::where('id',375)->update([
            'name_ar' => 'عرض صيانة الغرف'
        ]);

        Permission::where('id',376)->update([
            'name_ar' => 'مسح صيانة الغرف'
        ]);
        /**
         * Room Loss module
         */
        Permission::where('id',377)->update([
            'name_ar' => 'مفتقدات الغرف'
        ]);

        Permission::where('id',378)->update([
            'name_ar' => 'اضف مفتقدات للغرفه'
        ]);

        Permission::where('id',379)->update([
            'name_ar' => 'تعديل مفتقدات للغرفه'
        ]);

        Permission::where('id',380)->update([
            'name_ar' => 'عرض مفتقدات للغرفه'
        ]);
        Permission::where('id',381)->update([
            'name_ar' => 'بيانات العثور'
        ]);
        /**
         * House Keeping module
         */
        Permission::where('id',382)->update([
            'name_ar' => 'خدمة الغرف(Housekeeping)'
        ]);

        Permission::where('id',383)->update([
            'name_ar' => 'تعديل خدمه الغرف'
        ]);

        Permission::where('id',384)->update([
            'name_ar' => 'عرض خدمه الغرف'
        ]);
        /**
         * Hotel Order module
         */
        Permission::where('id',385)->update([
            'name_ar' => 'طلبات الفنادق'
        ]);

        Permission::where('id',386)->update([
            'name_ar' => 'اضف طلبات الفنادق'
        ]);
        Permission::where('id',387)->update([
            'name_ar' => 'مسح طلبات الفنادق'
        ]);
        Permission::where('id',388)->update([
            'name_ar' => 'عرض طلبات الفنادق'
        ]);
        Permission::where('id',389)->update([
            'name_ar' => 'استلام طلب فندق'
        ]);
        Permission::where('id',390)->update([
            'name_ar' => 'الغاء طلب فندق'
        ]);
        /**
         * Hotel Inventory module
         */
        Permission::where('id',391)->update([
            'name_ar' => 'مخازن الفنادق'
        ]);

        Permission::where('id',392)->update([
            'name_ar' => 'استهلاك مخازن الفنادق'
        ]);

        Permission::where('id',393)->update([
            'name_ar' => 'عرض مخازن الفنادق'
        ]);

        //Laundry Services Modules
        /**
         * Laundry module
         */
        Permission::where('id',394)->update([
            'name_ar' => 'خدمات المغسله'
        ]);

        Permission::where('id',395)->update([
            'name_ar' => 'اضف مغسله'
        ]);

        Permission::where('id',396)->update([
            'name_ar' => 'تعديل مغسله'
        ]);

        Permission::where('id',397)->update([
            'name_ar' => 'عرض مغسله'
        ]);
        Permission::where('id',398)->update([
            'name_ar' => 'عرض المخازن'
        ]);
        Permission::where('id',399)->update([
            'name_ar' => 'مسح المغسله'
        ]);
        /**
         * Laundry services module
         */
        Permission::where('id',400)->update([
            'name_ar' => 'خدمات المغسله'
        ]);

        Permission::where('id',401)->update([
            'name_ar' => 'اضف خدمه مغسله'
        ]);

        Permission::where('id',402)->update([
            'name_ar' => 'تعديل خدمه مغسله'
        ]);

        Permission::where('id',403)->update([
            'name_ar' => 'عرض خدمه مغسله'
        ]);
        Permission::where('id',404)->update([
            'name_ar' => 'مسح خدمه مغسله'
        ]);
        /**
         * Laundry Category module
         */
        Permission::where('id',405)->update([
            'name_ar' => 'فئات المغاسل'
        ]);

        Permission::where('id',406)->update([
            'name_ar' => 'اضف فئات المغاسل'
        ]);

        Permission::where('id',407)->update([
            'name_ar' => 'تعديل فئات المغاسل'
        ]);

        Permission::where('id',408)->update([
            'name_ar' => 'عرض فئات المغاسل'
        ]);
        Permission::where('id',409)->update([
            'name_ar' => 'مسح فئات المغاسل'
        ]);
        /**
         * Laundry Sub Category module
         */
        Permission::where('id',410)->update([
            'name_ar' => 'فئات المغاسل الفرعيه'
        ]);

        Permission::where('id',411)->update([
            'name_ar' => 'اضف فئات المغاسل الفرعيه'
        ]);

        Permission::where('id',412)->update([
            'name_ar' => 'تعديل فئات المغاسل الفرعيه'
        ]);

        Permission::where('id',413)->update([
            'name_ar' => 'عرض المغاسل الفرعيه'
        ]);
        Permission::where('id',414)->update([
            'name_ar' => 'مسح المغاسل الفرعيه'
        ]);
        /**
         * Laundry Order module
         */
        Permission::where('id',415)->update([
            'name_ar' => 'طلبات المغاسل'
        ]);

        Permission::where('id',416)->update([
            'name_ar' => 'اضف طلبات المغاسل'
        ]);
        Permission::where('id',417)->update([
            'name_ar' => 'اضف دفع'
        ]);
        Permission::where('id',418)->update([
            'name_ar' => 'اضف اعاده طلب'
        ]);
        Permission::where('id',419)->update([
            'name_ar' => 'تعديل طلبات المغاسل'
        ]);

        Permission::where('id',420)->update([
            'name_ar' => 'عرض طلبات المغاسل'
        ]);
        Permission::where('id',421)->update([
            'name_ar' => 'عرض التفاصيل'
        ]);
        Permission::where('id',422)->update([
            'name_ar' => 'مسح طلبات المغاسل'
        ]);
        /**
         * Laundry Inventory Order module
         */
        Permission::where('id',423)->update([
            'name_ar' => 'طلبات المخازن'
        ]);

        Permission::where('id',424)->update([
            'name_ar' => 'اضف طلبات المخازن'
        ]);
        Permission::where('id',425)->update([
            'name_ar' => 'مسح طلبات المخازن'
        ]);
        Permission::where('id',426)->update([
            'name_ar' => 'استلام طلب'
        ]);
        Permission::where('id',427)->update([
            'name_ar' => 'الغاء طلب'
        ]);
        Permission::where('id',428)->update([
            'name_ar' => 'عرض طلبات المخازن'
        ]);
        /**
         * Laundry Inventory module
         */
        Permission::where('id',429)->update([
            'name_ar' => 'المخازن'
        ]);

        Permission::where('id',430)->update([
            'name_ar' => 'اضف طلب جديد'
        ]);

        Permission::where('id',431)->update([
            'name_ar' => 'استهلاك مخازن المغسله'
        ]);

        Permission::where('id',432)->update([
            'name_ar' => 'عرض طلب جديد'
        ]);
        //Financial Services Modules
        /**
         * Financial Employee module
         */
        Permission::where('id',433)->update([
            'name' =>'Money',
            'name_ar' => 'خدمات الماليه'
        ]);

        Permission::where('id',434)->update([
            'name_ar' => 'الموظفين المعينين'
        ]);

        Permission::where('id',435)->update([
            'name_ar' => 'الموظفين المؤمن عليهم'
        ]);

        Permission::where('id',436)->update([
            'name_ar' => 'الموظفين المؤقتين'
        ]);
        Permission::where('id',437)->update([
            'name_ar' => 'الموظفين الظباط'
        ]);
        /**
         * Financial Employee Salaries module
         */
        Permission::where('id',438)->update([
            'name_ar' => 'مرتبات الموظفين'
        ]);

        Permission::where('id',439)->update([
            'name_ar' => 'مرتبات الموظفين المعينين '
        ]);

        Permission::where('id',440)->update([
            'name_ar' => 'مرتبات الموظفين المؤمن عليهم'
        ]);

        Permission::where('id',441)->update([
            'name_ar' => 'مرتبات الموظفين المؤقتين'
        ]);
        Permission::where('id',442)->update([
            'name_ar' => 'مرتبات الموظفين الظباط'
        ]);
        /**
         * Financial Account Type module
         */
        Permission::where('id',443)->update([
            'name_ar' => 'انواع الحسابات'
        ]);

        Permission::where('id',444)->update([
            'name_ar' => 'عرض انواع الحسابات'
        ]);
        /**
         * Financial Account module
         */
        Permission::where('id',445)->update([
            'name_ar' => 'الحسابات'
        ]);

        Permission::where('id',446)->update([
            'name_ar' => 'اضف حسابات'
        ]);
        Permission::where('id',447)->update([
            'name_ar' => 'تعديل حسابات'
        ]);

        Permission::where('id',448)->update([
            'name_ar' => 'عرض حسابات'
        ]);
        Permission::where('id',449)->update([
            'name_ar' => 'عرض الورقه الرئيسيه'
        ]);
        Permission::where('id',450)->update([
            'name_ar' => 'مسح حسابات'
        ]);
        /**
         * Financial Sub Account module
         */
        Permission::where('id',451)->update([
            'name_ar' => 'الحسابات الفرعيه'
        ]);

        Permission::where('id',452)->update([
            'name_ar' => 'اضف حساب فرعي'
        ]);
        Permission::where('id',453)->update([
            'name_ar' => 'تعديل حساب فرعي'
        ]);

        Permission::where('id',454)->update([
            'name_ar' => 'عرض حساب فرعي'
        ]);

        Permission::where('id',455)->update([
            'name_ar' => 'مسح حساب فرعي'
        ]);
        /**
         * Financial Journal Entry module
         */
        Permission::where('id',456)->update([
            'name_ar' => 'القيد المحاسبي'
        ]);

        Permission::where('id',457)->update([
            'name_ar' => 'اضف قيد محاسبي'
        ]);
        Permission::where('id',458)->update([
            'name_ar' => 'تعديل قيد محاسبي'
        ]);

        Permission::where('id',459)->update([
            'name_ar' => 'عرض قيد محاسبي'
        ]);

        Permission::where('id',460)->update([
            'name_ar' => 'مسح قيد محاسبي'
        ]);
        /**
         * Financial Daily Account module
         */
        Permission::where('id',461)->update([
            'name_ar' => 'سجل قيود اليومية'
        ]);

        Permission::where('id',462)->update([
            'name_ar' => 'سجل قيود اليوم لم يتم ترحيلها'
        ]);
        Permission::where('id',463)->update([
            'name_ar' => 'سجل القيود المرحله'
        ]);
        /**
         * Financial Department Bills module
         */
        Permission::where('id',464)->update([
            'name_ar' => 'فواتير الاقسام'
        ]);

        Permission::where('id',465)->update([
            'name_ar' => 'فواتير الاقسام الانشطه الرياضيه'
        ]);

        Permission::where('id',466)->update([
            'name_ar' => 'فواتير الاقسام عقود ايجار'
        ]);

        Permission::where('id',467)->update([
            'name_ar' => 'فواتير الاقسام حجوزات الفنادق'
        ]);
        Permission::where('id',468)->update([
            'name_ar' => 'فواتير الاقسام التذاكر'
        ]);
        Permission::where('id',469)->update([
            'name_ar' => 'فواتير الاقسام المناسبات'
        ]);
        Permission::where('id',470)->update([
            'name_ar' => 'فواتير الاقسام المغسله'
        ]);
        Permission::where('id',471)->update([
            'name_ar' => 'فواتير الاقسام نقاط البيع'
        ]);
        /**
         * Financial Balance Sheet module
         */

        Permission::where('id',472)->update([
            'name_ar' => 'عرض ميزان المراجعه'
        ]);
        /**
         * Financial Daily Center module
         */

        Permission::where('id',473)->update([
            'name_ar' => 'اليوميه المركزيه - عرض'
        ]);
        /**
         * Financial Income Statement module
         */

        Permission::where('id',474)->update([
            'name_ar' => 'عرض قوائم الدخل'
        ]);
        /**
         * Financial Statement module
         */
        Permission::where('id',475)->update([
            'name_ar' => 'عرض قائمه المركز المالي'
        ]);
        /**
         * Financial depreciation module
         */
        Permission::where('id',476)->update([
            'name_ar' => 'عرض كشف الاهلاك '
        ]);
    }
}
