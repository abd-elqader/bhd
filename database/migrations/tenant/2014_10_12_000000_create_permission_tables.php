<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\PermissionRegistrar;

class CreatePermissionTables extends Migration
{
    public function up()
    {
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');
        $teams = config('permission.teams');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        }
        if ($teams && empty($columnNames['team_foreign_key'] ?? null)) {
            throw new \Exception('Error: team_foreign_key on config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        }

        Schema::create($tableNames['permissions'], function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');       // For MySQL 8.0 use string('name', 125);
            $table->string('title_ar')->nullable();       // For MySQL 8.0 use string('title_ar', 125);
            $table->string('title_en')->nullable();       // For MySQL 8.0 use string('title_en', 125);
            $table->string('guard_name'); // For MySQL 8.0 use string('guard_name', 125);
            $table->timestamps();

            $table->unique(['name', 'guard_name']);
        });

        Schema::create($tableNames['roles'], function (Blueprint $table) use ($teams, $columnNames) {
            $table->bigIncrements('id');
            if ($teams || config('permission.testing')) { // permission.testing is a fix for sqlite testing
                $table->unsignedBigInteger($columnNames['team_foreign_key'])->nullable();
                $table->index($columnNames['team_foreign_key'], 'roles_team_foreign_key_index');
            }
            $table->string('name');       // For MySQL 8.0 use string('name', 125);
            $table->string('title_ar')->nullable();       // For MySQL 8.0 use string('title_ar', 125);
            $table->string('title_en')->nullable();       // For MySQL 8.0 use string('title_en', 125);
            $table->string('guard_name'); // For MySQL 8.0 use string('guard_name', 125);
            $table->timestamps();
            if ($teams || config('permission.testing')) {
                $table->unique([$columnNames['team_foreign_key'], 'name', 'guard_name']);
            } else {
                $table->unique(['name', 'guard_name']);
            }
        });

        Schema::create($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $columnNames, $teams) {
            $table->unsignedBigInteger(PermissionRegistrar::$pivotPermission);

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_permissions_model_id_model_type_index');

            $table->foreign(PermissionRegistrar::$pivotPermission)
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');
            if ($teams) {
                $table->unsignedBigInteger($columnNames['team_foreign_key']);
                $table->index($columnNames['team_foreign_key'], 'model_has_permissions_team_foreign_key_index');

                $table->primary([$columnNames['team_foreign_key'], PermissionRegistrar::$pivotPermission, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_permissions_permission_model_type_primary');
            } else {
                $table->primary([PermissionRegistrar::$pivotPermission, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_permissions_permission_model_type_primary');
            }
        });

        Schema::create($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $columnNames, $teams) {
            $table->unsignedBigInteger(PermissionRegistrar::$pivotRole);

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_roles_model_id_model_type_index');

            $table->foreign(PermissionRegistrar::$pivotRole)
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');
            if ($teams) {
                $table->unsignedBigInteger($columnNames['team_foreign_key']);
                $table->index($columnNames['team_foreign_key'], 'model_has_roles_team_foreign_key_index');

                $table->primary([$columnNames['team_foreign_key'], PermissionRegistrar::$pivotRole, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary');
            } else {
                $table->primary([PermissionRegistrar::$pivotRole, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary');
            }
        });

        Schema::create($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames) {
            $table->unsignedBigInteger(PermissionRegistrar::$pivotPermission);
            $table->unsignedBigInteger(PermissionRegistrar::$pivotRole);

            $table->foreign(PermissionRegistrar::$pivotPermission)
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->foreign(PermissionRegistrar::$pivotRole)
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary([PermissionRegistrar::$pivotPermission, PermissionRegistrar::$pivotRole], 'role_has_permissions_permission_id_role_id_primary');
        });

        app('cache')
            ->store(config('permission.cache.store') != 'default' ? config('permission.cache.store') : null)
            ->forget(config('permission.cache.key'));
            
        \Spatie\Permission\Models\Role::insert(array(
            array('name' => 'Admin','title_ar' => 'مدير','title_en' => 'Manager','guard_name' => 'admin'),
            array('name' => 'Agent','title_ar' => 'مساعد المدير','title_en' => 'Sub Manager','guard_name' => 'admin')
        ));
        
            
        \Spatie\Permission\Models\Permission::insert(array(
            array('name' => 'dashboard','title_ar' => 'لوحه التحكم','title_en' => 'Dashboard','guard_name' => 'admin'),
            array('name' => 'admins-list','title_ar' => 'قائمة المسؤولين','title_en' => 'Admins List','guard_name' => 'admin'),
            array('name' => 'admins-create','title_ar' => 'إنشاء المسؤولين','title_en' => 'Admins Create','guard_name' => 'admin'),
            array('name' => 'admins-edit','title_ar' => 'تعديل المسؤولين','title_en' => 'Admins Edit','guard_name' => 'admin'),
            array('name' => 'admins-delete','title_ar' => 'حذف المسؤولين','title_en' => 'Admins Delete','guard_name' => 'admin'),
            array('name' => 'agents-list','title_ar' => 'قائمة الوكلاء','title_en' => 'Agents List','guard_name' => 'admin'),
            array('name' => 'agents-create','title_ar' => 'إنشاء الوكلاء','title_en' => 'Agents Create','guard_name' => 'admin'),
            array('name' => 'agents-edit','title_ar' => 'تعديل الالوكلاء','title_en' => 'Agents Edit','guard_name' => 'admin'),
            array('name' => 'agents-delete','title_ar' => 'حذف الوكلاء','title_en' => 'Agents Delete','guard_name' => 'admin'),
            array('name' => 'clients-list','title_ar' => 'قائمة العملاء','title_en' => 'Clients List','guard_name' => 'admin'),
            array('name' => 'clients-create','title_ar' => 'إنشاء العملاء','title_en' => 'Clients Create','guard_name' => 'admin'),
            array('name' => 'clients-edit','title_ar' => 'تعديل العملاء','title_en' => 'Clients Edit','guard_name' => 'admin'),
            array('name' => 'clients-delete','title_ar' => 'حذف العملاء','title_en' => 'Clients Delete','guard_name' => 'admin'),
            array('name' => 'roles-list','title_ar' => 'قائمة الاذونات','title_en' => 'Roles List','guard_name' => 'admin'),
            array('name' => 'roles-create','title_ar' => 'إنشاء الاذونات','title_en' => 'Roles Create','guard_name' => 'admin'),
            array('name' => 'roles-edit','title_ar' => 'تعديل الاذونات','title_en' => 'Roles Edit','guard_name' => 'admin'),
            array('name' => 'roles-delete','title_ar' => 'حذف الاذونات','title_en' => 'Roles Delete','guard_name' => 'admin'),
            array('name' => 'permissions-list','title_ar' => 'أذونات القائمة','title_en' => 'Permissions List','guard_name' => 'admin'),
            array('name' => 'permission-edit','title_ar' => 'تعديل إذن','title_en' => 'Permission Edit','guard_name' => 'admin'),
            array('name' => 'faq-list','title_ar' => 'قائمة التعليمات','title_en' => 'Faq List','guard_name' => 'admin'),
            array('name' => 'faq-create','title_ar' => 'إنشاء التعليمات','title_en' => 'Faq Create','guard_name' => 'admin'),
            array('name' => 'faq-edit','title_ar' => 'تعديل التعليمات','title_en' => 'Faq Edit','guard_name' => 'admin'),
            array('name' => 'faq-delete','title_ar' => 'حذف التعليمات','title_en' => 'Faq Delete','guard_name' => 'admin'),
            array('name' => 'contact-list','title_ar' => 'قائمة الاتصال','title_en' => 'Contact List','guard_name' => 'admin'),
            array('name' => 'contact-delete','title_ar' => 'حذف اتصال','title_en' => 'Contact Delete','guard_name' => 'admin'),
            array('name' => 'settings-list','title_ar' => 'إعدادات القائمة','title_en' => 'Settings List','guard_name' => 'admin'),
            array('name' => 'settings-edit','title_ar' => 'تعديل الإعدادات','title_en' => 'Settings Edit','guard_name' => 'admin'),
            array('name' => 'payments-list','title_ar' => 'قائمة المدفوعات','title_en' => 'Payments List','guard_name' => 'admin'),
            array('name' => 'payments-create','title_ar' => 'إنشاء المدفوعات','title_en' => 'Payments Create','guard_name' => 'admin'),
            array('name' => 'payments-edit','title_ar' => 'تعديل المدفوعات','title_en' => 'Payments Edit','guard_name' => 'admin'),
            array('name' => 'payments-delete','title_ar' => 'حذف المدفوعات','title_en' => 'Payments Delete','guard_name' => 'admin'),
            array('name' => 'images-list','title_ar' => 'قائمة الصور','title_en' => 'Images List','guard_name' => 'admin'),
            array('name' => 'images-create','title_ar' => 'إنشاء الصور','title_en' => 'Images Create','guard_name' => 'admin'),
            array('name' => 'images-edit','title_ar' => 'تعديل الصور','title_en' => 'Images Edit','guard_name' => 'admin'),
            array('name' => 'images-delete','title_ar' => 'حذف الصور','title_en' => 'Images Delete','guard_name' => 'admin'),
            array('name' => 'countries-list','title_ar' => 'قائمة البلدان','title_en' => 'Countries List','guard_name' => 'admin'),
            array('name' => 'countries-create','title_ar' => 'إنشاء البلدان','title_en' => 'Countries Create','guard_name' => 'admin'),
            array('name' => 'countries-edit','title_ar' => 'تعديل الدول','title_en' => 'Countries Edit','guard_name' => 'admin'),
            array('name' => 'countries-delete','title_ar' => 'حذف البلدان','title_en' => 'Countries Delete','guard_name' => 'admin'),
            array('name' => 'regions-list','title_ar' => 'قائمة المناطق','title_en' => 'Regions List','guard_name' => 'admin'),
            array('name' => 'regions-create','title_ar' => 'إنشاء المناطق','title_en' => 'Regions Create','guard_name' => 'admin'),
            array('name' => 'regions-edit','title_ar' => 'تعديل المناطق','title_en' => 'Regions Edit','guard_name' => 'admin'),
            array('name' => 'regions-delete','title_ar' => 'حذف المناطق','title_en' => 'Regions Delete','guard_name' => 'admin'),
            array('name' => 'address-list','title_ar' => 'عنوان القائمة','title_en' => 'Address List','guard_name' => 'admin'),
            array('name' => 'address-create','title_ar' => 'إنشاء عنوان','title_en' => 'Address Create','guard_name' => 'admin'),
            array('name' => 'address-edit','title_ar' => 'تعديل العنوان','title_en' => 'Address Edit','guard_name' => 'admin'),
            array('name' => 'address-delete','title_ar' => 'حذف العنوان','title_en' => 'Address Delete','guard_name' => 'admin'),
            array('name' => 'branches-list','title_ar' => 'قائمة الفروع','title_en' => 'Branches List','guard_name' => 'admin'),
            array('name' => 'branches-create','title_ar' => 'إنشاء الفروع','title_en' => 'Branches Create','guard_name' => 'admin'),
            array('name' => 'branches-edit','title_ar' => 'تعديل الفروع','title_en' => 'Branches Edit','guard_name' => 'admin'),
            array('name' => 'branches-delete','title_ar' => 'حذف الفروع','title_en' => 'Branches Delete','guard_name' => 'admin'),
            array('name' => 'categories-list','title_ar' => 'فئات القائمة','title_en' => 'Categories List','guard_name' => 'admin'),
            array('name' => 'categories-create','title_ar' => 'إنشاء الفئات','title_en' => 'Categories Create','guard_name' => 'admin'),
            array('name' => 'categories-edit','title_ar' => 'تعديل الفئات','title_en' => 'Categories Edit','guard_name' => 'admin'),
            array('name' => 'categories-delete','title_ar' => 'حذف الفئات','title_en' => 'Categories Delete','guard_name' => 'admin'),
            array('name' => 'products-list','title_ar' => 'قائمة المنتجات','title_en' => 'Products List','guard_name' => 'admin'),
            array('name' => 'products-create','title_ar' => 'إنشاء المنتجات','title_en' => 'Products Create','guard_name' => 'admin'),
            array('name' => 'products-edit','title_ar' => 'تعديل المنتجات','title_en' => 'Products Edit','guard_name' => 'admin'),
            array('name' => 'products-delete','title_ar' => 'حذف المنتجات','title_en' => 'Products Delete','guard_name' => 'admin'),
            array('name' => 'sizes-list','title_ar' => 'أحجام القائمة','title_en' => 'Sizes List','guard_name' => 'admin'),
            array('name' => 'sizes-create','title_ar' => 'إنشاء الأحجام','title_en' => 'Sizes Create','guard_name' => 'admin'),
            array('name' => 'sizes-edit','title_ar' => 'تعديل الأحجام','title_en' => 'Sizes Edit','guard_name' => 'admin'),
            array('name' => 'sizes-delete','title_ar' => 'احذف الأحجام','title_en' => 'Sizes Delete','guard_name' => 'admin'),
            array('name' => 'colors-list','title_ar' => 'قائمة الألوان','title_en' => 'Colors List','guard_name' => 'admin'),
            array('name' => 'colors-create','title_ar' => 'إنشاء الألوان','title_en' => 'Colors Create','guard_name' => 'admin'),
            array('name' => 'colors-edit','title_ar' => 'تعديل الألوان','title_en' => 'Colors Edit','guard_name' => 'admin'),
            array('name' => 'colors-delete','title_ar' => 'حذف الألوان','title_en' => 'Colors Delete','guard_name' => 'admin'),
            array('name' => 'additions-list','title_ar' => 'إضافات القائمة','title_en' => 'Additions List','guard_name' => 'admin'),
            array('name' => 'additions-create','title_ar' => 'إنشاء الإضافات','title_en' => 'Additions Create','guard_name' => 'admin'),
            array('name' => 'additions-edit','title_ar' => 'تعديل الإضافات','title_en' => 'Additions Edit','guard_name' => 'admin'),
            array('name' => 'additions-delete','title_ar' => 'حذف الإضافات','title_en' => 'Additions Delete','guard_name' => 'admin'),
            array('name' => 'deliveries-list','title_ar' => 'قائمة التسليم','title_en' => 'Deliveries List','guard_name' => 'admin'),
            array('name' => 'deliveries-create','title_ar' => 'إنشاء عمليات التسليم','title_en' => 'Deliveries Create','guard_name' => 'admin'),
            array('name' => 'deliveries-edit','title_ar' => 'تعديل التسليمات','title_en' => 'Deliveries Edit','guard_name' => 'admin'),
            array('name' => 'deliveries-delete','title_ar' => 'حذف عمليات التسليم','title_en' => 'Deliveries Delete','guard_name' => 'admin'),
            array('name' => 'coupons-list','title_ar' => 'قائمة القسائم','title_en' => 'Coupons List','guard_name' => 'admin'),
            array('name' => 'coupons-create','title_ar' => 'إنشاء كوبونات','title_en' => 'Coupons Create','guard_name' => 'admin'),
            array('name' => 'coupons-edit','title_ar' => 'تعديل القسائم','title_en' => 'Coupons Edit','guard_name' => 'admin'),
            array('name' => 'coupons-delete','title_ar' => 'حذف القسائم','title_en' => 'Coupons Delete','guard_name' => 'admin'),
            array('name' => 'offertypes-list','title_ar' => 'قائمة الطوابع','title_en' => 'Offertypes List','guard_name' => 'admin'),
            array('name' => 'offertypes-create','title_ar' => 'إنشاء الطوابع الخارجية','title_en' => 'Offertypes Create','guard_name' => 'admin'),
            array('name' => 'offertypes-edit','title_ar' => 'تعديل الطباع','title_en' => 'Offertypes Edit','guard_name' => 'admin'),
            array('name' => 'offertypes-delete','title_ar' => 'حذف الطباع','title_en' => 'Offertypes Delete','guard_name' => 'admin'),
            array('name' => 'offers-list','title_ar' => 'قائمة العروض','title_en' => 'Offers List','guard_name' => 'admin'),
            array('name' => 'offers-create','title_ar' => 'إنشاء العروض','title_en' => 'Offers Create','guard_name' => 'admin'),
            array('name' => 'offers-edit','title_ar' => 'تعديل العروض','title_en' => 'Offers Edit','guard_name' => 'admin'),
            array('name' => 'offers-delete','title_ar' => 'حذف العروض','title_en' => 'Offers Delete','guard_name' => 'admin')
        ));
        
    }

    public function down()
    {
        $tableNames = config('permission.table_names');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');
        }

        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['model_has_roles']);
        Schema::drop($tableNames['model_has_permissions']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permissions']);
    }
}
