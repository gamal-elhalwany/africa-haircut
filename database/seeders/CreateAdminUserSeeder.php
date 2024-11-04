<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Chair;
use App\Models\User;
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
      // $permissions_array = [
      //    // 'قائمة-الصلاحيات',
      //    'انشاء-صلاحية',
      //    'تعديل-صلاحية',
      //    'حذف-صلاحية',

      //    // 'قائمة-المستدمين',
      //    'انشاء-مستخدم',
      //    'تعديل-مستخدم',
      //    'حذف-مستخدم',

      //    // 'قائمة-الفروع',
      //    'انشاء-فرع',
      //    'تعديل-فرع',
      //    'حذف-فرع',

      //    // 'قائمة-الكراسي',
      //    'انشاء-كرسي',
      //    'تعديل-كرسي',
      //    'حذف-كرسي',
      //    'حجز-كرسي',

      //    // 'قائمة-الوظائف',
      //    'انشاء-وظيفة',
      //    'تعديل-وظيفة',
      //    'حذف-وظيفة',

      //    // 'قائمة-المنتجات',
      //    'انشاء-منتج',
      //    'تعديل-منتج',
      //    'حذف-منتج',

      //    // 'المرتبات',
      //    'انشاء-مرتب',
      //    'تعديل-مرتب',
      //    'حذف-مرتب',
      //    'خصم',

      //    'حضور',
      //    'انصراف',
      //    'فتح-فاتورة',
      // ];

      // $permissions = collect($permissions_array)->map(function ($permission) {
      //    // Now, it'll ask for the column guard_name, so you have to make the default value of this field 'web'. Now, you can avoid the error that is supposed to happen by repeating it as it is unique.
      //    return ['name' => $permission];
      // });

      // Permission::insert($permissions->toArray());
      // $role = Role::create(['name' => 'super_admin']);
      // $role->givePermissionTo($permissions_array);

      $branch = Branch::create([
         'name' => 'القاهرة',
         'address' => '2 ش سليمان باشاو القاهرة',
      ]);

      //Admin Seeder
      $user = User::create([
         'name' => 'gamal',
         'email' => 'g@all.com',
         'password' => bcrypt('00000000'),
         'username' => 'gimy',
         'national_id' => 2637485967463748,
         'emp_id' => 1,
         'hiring_date' => '2023-04-12 00:43:11.000000',
         'job_id' => 0,
         'salary_system' => 'basic',
         'salary' => 32443,
         'work_days' => 24,
         'work_hours' => 8,
         'gender' => 'male',
         'branch_id' => $branch->id,
      ]);

      // $user->assignRole($role);

      Chair::create([
         'number' => 1,
         'branch_id' => $branch->id,
      ]);
   }
}
