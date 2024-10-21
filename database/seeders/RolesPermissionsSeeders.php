<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionsSeeders extends Seeder
{
    public function run()
    {
        Role::insert([
            ['name' => 'Admin', 'title_ar' => 'مدير', 'title_en' => 'Admin', 'guard_name' => 'admin'],
            ['name' => 'Agent', 'title_ar' => 'وكيل', 'title_en' => 'Agent', 'guard_name' => 'admin'],
        ]);

        Permission::insert([
            ['name' => 'dashboard', 'title_ar' => 'لوحه التحكم', 'title_en' => 'Dashboard', 'guard_name' => 'admin'],

            ['name' => 'admins-list', 'title_ar' => 'قائمة المسؤولين', 'title_en' => 'Admins List', 'guard_name' => 'admin'],
            ['name' => 'admins-create', 'title_ar' => 'إنشاء المسؤولين', 'title_en' => 'Admins Create', 'guard_name' => 'admin'],
            ['name' => 'admins-edit', 'title_ar' => 'تعديل المسؤولين', 'title_en' => 'Admins Edit', 'guard_name' => 'admin'],
            ['name' => 'admins-delete', 'title_ar' => 'حذف المسؤولين', 'title_en' => 'Admins Delete', 'guard_name' => 'admin'],

            ['name' => 'agents-list', 'title_ar' => 'قائمة الوكلاء', 'title_en' => 'Agents List', 'guard_name' => 'admin'],
            ['name' => 'agents-create', 'title_ar' => 'إنشاء الوكلاء', 'title_en' => 'Agents Create', 'guard_name' => 'admin'],
            ['name' => 'agents-edit', 'title_ar' => 'تعديل الالوكلاء', 'title_en' => 'Agents Edit', 'guard_name' => 'admin'],
            ['name' => 'agents-delete', 'title_ar' => 'حذف الوكلاء', 'title_en' => 'Agents Delete', 'guard_name' => 'admin'],

            ['name' => 'clients-list', 'title_ar' => 'قائمة العملاء', 'title_en' => 'Clients List', 'guard_name' => 'admin'],
            ['name' => 'clients-create', 'title_ar' => 'إنشاء العملاء', 'title_en' => 'Clients Create', 'guard_name' => 'admin'],
            ['name' => 'clients-edit', 'title_ar' => 'تعديل العملاء', 'title_en' => 'Clients Edit', 'guard_name' => 'admin'],
            ['name' => 'clients-delete', 'title_ar' => 'حذف العملاء', 'title_en' => 'Clients Delete', 'guard_name' => 'admin'],

            ['name' => 'roles-list', 'title_ar' => 'قائمة الاذونات', 'title_en' => 'Roles List', 'guard_name' => 'admin'],
            ['name' => 'roles-create', 'title_ar' => 'إنشاء الاذونات', 'title_en' => 'Roles Create', 'guard_name' => 'admin'],
            ['name' => 'roles-edit', 'title_ar' => 'تعديل الاذونات', 'title_en' => 'Roles Edit', 'guard_name' => 'admin'],
            ['name' => 'roles-delete', 'title_ar' => 'حذف الاذونات', 'title_en' => 'Roles Delete', 'guard_name' => 'admin'],

            ['name' => 'permissions-list', 'title_ar' => 'أذونات القائمة', 'title_en' => 'Permissions List', 'guard_name' => 'admin'],
            ['name' => 'permission-edit', 'title_ar' => 'تعديل إذن', 'title_en' => 'Permission Edit', 'guard_name' => 'admin'],

            ['name' => 'faq-list', 'title_ar' => 'قائمة التعليمات', 'title_en' => 'Faq List', 'guard_name' => 'admin'],
            ['name' => 'faq-create', 'title_ar' => 'إنشاء التعليمات', 'title_en' => 'Faq Create', 'guard_name' => 'admin'],
            ['name' => 'faq-edit', 'title_ar' => 'تعديل التعليمات', 'title_en' => 'Faq Edit', 'guard_name' => 'admin'],
            ['name' => 'faq-delete', 'title_ar' => 'حذف التعليمات', 'title_en' => 'Faq Delete', 'guard_name' => 'admin'],

            ['name' => 'contact-list', 'title_ar' => 'قائمة الاتصال', 'title_en' => 'Contact List', 'guard_name' => 'admin'],
            ['name' => 'contact-delete', 'title_ar' => 'حذف اتصال', 'title_en' => 'Contact Delete', 'guard_name' => 'admin'],

            ['name' => 'settings-list', 'title_ar' => 'إعدادات القائمة', 'title_en' => 'Settings List', 'guard_name' => 'admin'],
            ['name' => 'settings-edit', 'title_ar' => 'تعديل الإعدادات', 'title_en' => 'Settings Edit', 'guard_name' => 'admin'],

            ['name' => 'payments-list', 'title_ar' => 'قائمة المدفوعات', 'title_en' => 'Payments List', 'guard_name' => 'admin'],
            ['name' => 'payments-create', 'title_ar' => 'إنشاء المدفوعات', 'title_en' => 'Payments Create', 'guard_name' => 'admin'],
            ['name' => 'payments-edit', 'title_ar' => 'تعديل المدفوعات', 'title_en' => 'Payments Edit', 'guard_name' => 'admin'],
            ['name' => 'payments-delete', 'title_ar' => 'حذف المدفوعات', 'title_en' => 'Payments Delete', 'guard_name' => 'admin'],

            ['name' => 'images-list', 'title_ar' => 'قائمة الصور', 'title_en' => 'Images List', 'guard_name' => 'admin'],
            ['name' => 'images-create', 'title_ar' => 'إنشاء الصور', 'title_en' => 'Images Create', 'guard_name' => 'admin'],
            ['name' => 'images-edit', 'title_ar' => 'تعديل الصور', 'title_en' => 'Images Edit', 'guard_name' => 'admin'],
            ['name' => 'images-delete', 'title_ar' => 'حذف الصور', 'title_en' => 'Images Delete', 'guard_name' => 'admin'],

            ['name' => 'imagetypes-list', 'title_ar' => 'قائمة أنواع الصور', 'title_en' => 'Imagetypes List', 'guard_name' => 'admin'],
            ['name' => 'imagetypes-create', 'title_ar' => 'إنشاء أنواع الصور', 'title_en' => 'Imagetypes Create', 'guard_name' => 'admin'],
            ['name' => 'imagetypes-edit', 'title_ar' => 'تعديل أنواع الصور', 'title_en' => 'Imagetypes Edit', 'guard_name' => 'admin'],
            ['name' => 'imagetypes-delete', 'title_ar' => 'حذف أنواع الصور', 'title_en' => 'Imagetypes Delete', 'guard_name' => 'admin'],

            ['name' => 'countries-list', 'title_ar' => 'قائمة البلدان', 'title_en' => 'Countries List', 'guard_name' => 'admin'],
            ['name' => 'countries-create', 'title_ar' => 'إنشاء البلدان', 'title_en' => 'Countries Create', 'guard_name' => 'admin'],
            ['name' => 'countries-edit', 'title_ar' => 'تعديل الدول', 'title_en' => 'Countries Edit', 'guard_name' => 'admin'],
            ['name' => 'countries-delete', 'title_ar' => 'حذف البلدان', 'title_en' => 'Countries Delete', 'guard_name' => 'admin'],

            ['name' => 'regions-list', 'title_ar' => 'قائمة المناطق', 'title_en' => 'Regions List', 'guard_name' => 'admin'],
            ['name' => 'regions-create', 'title_ar' => 'إنشاء المناطق', 'title_en' => 'Regions Create', 'guard_name' => 'admin'],
            ['name' => 'regions-edit', 'title_ar' => 'تعديل المناطق', 'title_en' => 'Regions Edit', 'guard_name' => 'admin'],
            ['name' => 'regions-delete', 'title_ar' => 'حذف المناطق', 'title_en' => 'Regions Delete', 'guard_name' => 'admin'],

            ['name' => 'address-list', 'title_ar' => 'عنوان القائمة', 'title_en' => 'Address List', 'guard_name' => 'admin'],
            ['name' => 'address-create', 'title_ar' => 'إنشاء عنوان', 'title_en' => 'Address Create', 'guard_name' => 'admin'],
            ['name' => 'address-edit', 'title_ar' => 'تعديل العنوان', 'title_en' => 'Address Edit', 'guard_name' => 'admin'],
            ['name' => 'address-delete', 'title_ar' => 'حذف العنوان', 'title_en' => 'Address Delete', 'guard_name' => 'admin'],

            ['name' => 'branches-list', 'title_ar' => 'قائمة الفروع', 'title_en' => 'Branches List', 'guard_name' => 'admin'],
            ['name' => 'branches-create', 'title_ar' => 'إنشاء الفروع', 'title_en' => 'Branches Create', 'guard_name' => 'admin'],
            ['name' => 'branches-edit', 'title_ar' => 'تعديل الفروع', 'title_en' => 'Branches Edit', 'guard_name' => 'admin'],
            ['name' => 'branches-delete', 'title_ar' => 'حذف الفروع', 'title_en' => 'Branches Delete', 'guard_name' => 'admin'],

            ['name' => 'categories-list', 'title_ar' => 'فئات القائمة', 'title_en' => 'Categories List', 'guard_name' => 'admin'],
            ['name' => 'categories-create', 'title_ar' => 'إنشاء الفئات', 'title_en' => 'Categories Create', 'guard_name' => 'admin'],
            ['name' => 'categories-edit', 'title_ar' => 'تعديل الفئات', 'title_en' => 'Categories Edit', 'guard_name' => 'admin'],
            ['name' => 'categories-delete', 'title_ar' => 'حذف الفئات', 'title_en' => 'Categories Delete', 'guard_name' => 'admin'],

            ['name' => 'products-list', 'title_ar' => 'قائمة المنتجات', 'title_en' => 'Products List', 'guard_name' => 'admin'],
            ['name' => 'products-create', 'title_ar' => 'إنشاء المنتجات', 'title_en' => 'Products Create', 'guard_name' => 'admin'],
            ['name' => 'products-edit', 'title_ar' => 'تعديل المنتجات', 'title_en' => 'Products Edit', 'guard_name' => 'admin'],
            ['name' => 'products-delete', 'title_ar' => 'حذف المنتجات', 'title_en' => 'Products Delete', 'guard_name' => 'admin'],

            ['name' => 'sizes-list', 'title_ar' => 'أحجام القائمة', 'title_en' => 'Sizes List', 'guard_name' => 'admin'],
            ['name' => 'sizes-create', 'title_ar' => 'إنشاء الأحجام', 'title_en' => 'Sizes Create', 'guard_name' => 'admin'],
            ['name' => 'sizes-edit', 'title_ar' => 'تعديل الأحجام', 'title_en' => 'Sizes Edit', 'guard_name' => 'admin'],
            ['name' => 'sizes-delete', 'title_ar' => 'احذف الأحجام', 'title_en' => 'Sizes Delete', 'guard_name' => 'admin'],

            ['name' => 'colors-list', 'title_ar' => 'قائمة الألوان', 'title_en' => 'Colors List', 'guard_name' => 'admin'],
            ['name' => 'colors-create', 'title_ar' => 'إنشاء الألوان', 'title_en' => 'Colors Create', 'guard_name' => 'admin'],
            ['name' => 'colors-edit', 'title_ar' => 'تعديل الألوان', 'title_en' => 'Colors Edit', 'guard_name' => 'admin'],
            ['name' => 'colors-delete', 'title_ar' => 'حذف الألوان', 'title_en' => 'Colors Delete', 'guard_name' => 'admin'],

            ['name' => 'additions-list', 'title_ar' => 'إضافات القائمة', 'title_en' => 'Additions List', 'guard_name' => 'admin'],
            ['name' => 'additions-create', 'title_ar' => 'إنشاء الإضافات', 'title_en' => 'Additions Create', 'guard_name' => 'admin'],
            ['name' => 'additions-edit', 'title_ar' => 'تعديل الإضافات', 'title_en' => 'Additions Edit', 'guard_name' => 'admin'],
            ['name' => 'additions-delete', 'title_ar' => 'حذف الإضافات', 'title_en' => 'Additions Delete', 'guard_name' => 'admin'],

            ['name' => 'deliveries-list', 'title_ar' => 'قائمة التسليم', 'title_en' => 'Deliveries List', 'guard_name' => 'admin'],
            ['name' => 'deliveries-create', 'title_ar' => 'إنشاء عمليات التسليم', 'title_en' => 'Deliveries Create', 'guard_name' => 'admin'],
            ['name' => 'deliveries-edit', 'title_ar' => 'تعديل التسليمات', 'title_en' => 'Deliveries Edit', 'guard_name' => 'admin'],
            ['name' => 'deliveries-delete', 'title_ar' => 'حذف عمليات التسليم', 'title_en' => 'Deliveries Delete', 'guard_name' => 'admin'],

            ['name' => 'weights-list', 'title_ar' => 'قائمة الأوزان', 'title_en' => 'Weights List', 'guard_name' => 'admin'],
            ['name' => 'weights-create', 'title_ar' => 'إنشاء الأوزان', 'title_en' => 'Weights Create', 'guard_name' => 'admin'],
            ['name' => 'weights-edit', 'title_ar' => 'تعديل الأوزان', 'title_en' => 'Weights Edit', 'guard_name' => 'admin'],
            ['name' => 'weights-delete', 'title_ar' => 'حذف الأوزان', 'title_en' => 'Weights Delete', 'guard_name' => 'admin'],

            ['name' => 'currencies-list', 'title_ar' => 'قائمة العملات', 'title_en' => 'Currencies List', 'guard_name' => 'admin'],
            ['name' => 'currencies-create', 'title_ar' => 'إنشاء العملات', 'title_en' => 'Currencies Create', 'guard_name' => 'admin'],
            ['name' => 'currencies-edit', 'title_ar' => 'تعديل العملات', 'title_en' => 'Currencies Edit', 'guard_name' => 'admin'],
            ['name' => 'currencies-delete', 'title_ar' => 'حذف العملات', 'title_en' => 'Currencies Delete', 'guard_name' => 'admin'],

            ['name' => 'coupons-list', 'title_ar' => 'قائمة القسائم', 'title_en' => 'Coupons List', 'guard_name' => 'admin'],
            ['name' => 'coupons-create', 'title_ar' => 'إنشاء كوبونات', 'title_en' => 'Coupons Create', 'guard_name' => 'admin'],
            ['name' => 'coupons-edit', 'title_ar' => 'تعديل القسائم', 'title_en' => 'Coupons Edit', 'guard_name' => 'admin'],
            ['name' => 'coupons-delete', 'title_ar' => 'حذف القسائم', 'title_en' => 'Coupons Delete', 'guard_name' => 'admin'],

            ['name' => 'theme-pages-list', 'title_ar' => 'قائمة صفحات الثيمات', 'title_en' => 'Theme pages List', 'guard_name' => 'admin'],
            ['name' => 'theme-pages-create', 'title_ar' => 'إنشاء صفحات الثيمات', 'title_en' => 'Theme pages Create', 'guard_name' => 'admin'],
            ['name' => 'theme-pages-edit', 'title_ar' => 'تعديل صفحات الثيمات', 'title_en' => 'Edit Theme pages', 'guard_name' => 'admin'],
            ['name' => 'theme-pages-delete', 'title_ar' => 'حذف صفحات الثيمات', 'title_en' => 'Theme pages Delete', 'guard_name' => 'admin'],

            ['name' => 'themes-list', 'title_ar' => 'قائمة المواضيع', 'title_en' => 'Themes List', 'guard_name' => 'admin'],
            ['name' => 'themes-create', 'title_ar' => 'إنشاء المواضيع', 'title_en' => 'Themes Create', 'guard_name' => 'admin'],
            ['name' => 'themes-edit', 'title_ar' => 'تعديل السمات', 'title_en' => 'Edit Themes', 'guard_name' => 'admin'],
            ['name' => 'themes-delete', 'title_ar' => 'حذف المواضيع', 'title_en' => 'Themes Delete', 'guard_name' => 'admin'],

            ['name' => 'offertypes-list', 'title_ar' => 'قائمة الطوابع', 'title_en' => 'Offertypes List', 'guard_name' => 'admin'],
            ['name' => 'offertypes-create', 'title_ar' => 'إنشاء الطوابع الخارجية', 'title_en' => 'Offertypes Create', 'guard_name' => 'admin'],
            ['name' => 'offertypes-edit', 'title_ar' => 'تعديل الطباع', 'title_en' => 'Offertypes Edit', 'guard_name' => 'admin'],
            ['name' => 'offertypes-delete', 'title_ar' => 'حذف الطباع', 'title_en' => 'Offertypes Delete', 'guard_name' => 'admin'],

            ['name' => 'offers-list', 'title_ar' => 'قائمة العروض', 'title_en' => 'Offers List', 'guard_name' => 'admin'],
            ['name' => 'offers-create', 'title_ar' => 'إنشاء العروض', 'title_en' => 'Offers Create', 'guard_name' => 'admin'],
            ['name' => 'offers-edit', 'title_ar' => 'تعديل العروض', 'title_en' => 'Offers Edit', 'guard_name' => 'admin'],
            ['name' => 'offers-delete', 'title_ar' => 'حذف العروض', 'title_en' => 'Offers Delete', 'guard_name' => 'admin'],
        ]);
        Role::first()->givePermissionTo(Permission::get());
    }
}
