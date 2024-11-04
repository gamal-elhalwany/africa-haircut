<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            // 'قائمة-الصلاحيات',
            'انشاء-صلاحية',
            'تعديل صلاحية',
            'حذف-صلاحية',

            // 'قائمة-المستدمين',
            'انشاء-مستخدم',
            'تعديل-مستخدم',
            'حذف-مستخدم',

            // 'قائمة-الفروع',
            'انشاء-فرع',
            'تعديل-فرع',
            'حذف-فرع',

            // 'قائمة-الكراسي',
            'انشاء-كرسي',
            'تعديل-كرسي',
            'حذف-كرسي',

            // 'قائمة-الوظائف',
            'انشاء-وظيفة',
            'تعديل-وظيفة',
            'حذف-وظيفة',

            // 'قائمة-المنتجات',
            'انشاء-منتج',
            'تعديل-منتج',
            'حذف-منتج',

            // 'المرتبات',
            'انشاء-مرتب',
            'تعديل-مرتب',
            'حذف-مرتب',
            'خصم',

            'حضور',
            'انصراف',
            'فتح-فاتورة',
            'حجز-كرسي',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
