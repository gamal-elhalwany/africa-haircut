<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
//            'قائمة-الصلاحيات',
//            'انشاء-صلاحية',
//            'تعديل صلاحية',
//            'حذف-صلاحية',
//
//            'قائمة-المستدمين',
//            'انشاء-مستخدم',
//            'تعديل-مستخدم',
//            'حذف-مستخدم',
//
//            'قائمة-الفروع',
//            'انشاء-فرع',
//            'تعديل-فرع',
//            'حذف-فرع',
//
//            'قائمة-الكراسي',
//            'انشاء-كرسي',
//            'تعديل-كرسي',
//            'حذف-كرسي',
//
//            'قائمة-الوظائف',
//            'انشاء-وظيفة',
//            'تعديل-وظيفة',
//            'حذف-وظيفة',
//
//            'قائمة-المنتجات',
//            'انشاء-منتج',
//            'تعديل-منتج',
//            'حذف-منتج',
//
//            'المرتبات',
//
//
//            'حضور',
//            'انصراف',
//            'فتح-فاتورة',
//            'حجز-كرسي'

        //Permissions
        $permissions = [



//            'role-list',
//            'role-create',
//            'role-edit',
//            'role-delete',

            'show-branches',
            'add-branch',
            'delete-branch',
            'edit-branch',


            'show-users',
            'create-user',
            'edit-user',
            'delete-user',

//manager
            'chair-control',
//casher
            'money-control'

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
