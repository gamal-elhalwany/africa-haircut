<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions_array = [

            'الصلاحيات',
         //    'انشاء-صلاحية',
         //    'تعديل صلاحية',
         //    'حذف-صلاحية',
 
            'المستدمين',
         //    'انشاء-مستخدم',
         //    'تعديل-مستخدم',
         //    'حذف-مستخدم',
 
            'الفروع',
         //    'انشاء-فرع',
         //    'تعديل-فرع',
         //    'حذف-فرع',
 
            'الكراسي',
         //    'انشاء-كرسي',
         //    'تعديل-كرسي',
         //    'حذف-كرسي',
 
            'الوظائف',
         //    'انشاء-وظيفة',
         //    'تعديل-وظيفة',
         //    'حذف-وظيفة',
 
            'المنتجات',
         //    'انشاء-منتج',
         //    'تعديل-منتج',
         //    'حذف-منتج',
 
            'المرتبات',
 
 
            'حضوروانصراف',
         //    'انصراف',
         //    'فتح-فاتورة',
         //    'حجز-كرسي'
 
         ];
        $permissions = collect($permissions_array)->map(function($permission){
            return ['name'=>$permission,'guard_name'=>'web'];
         });   

        Permission::insert($permissions->toArray());
        $role = Role::create(['name' => 'super_admin','guard_name'=>'web']);
        $role->givePermissionTo($permissions_array);
         
         $branch = Branch::create([
            'name'=>'القاهرة'
         ]);
        //Admin Seeder
        $user = User::create([
            'name' => 'Africa',
            'email' => 'admin@laraveltuts.com',
            'password' => bcrypt('password'),
            'username'=>'africa',
            'national_id'=>2637485967463748,
            'emp_id'=>1,
            'hiring_date'=>'2023-04-12 00:43:11.000000',
            'job_id'=>0,
            'salary_system'=>'basic',
            'salary'=>32443,
            'work_days'=>24,
            'work_hours'=>8,
            'gender'=>'male',
            'branch_id'=>$branch->id,
        ]);
        $user->assignRole($role);
        

    }
}
