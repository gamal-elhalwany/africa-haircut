<?php

namespace Database\Seeders;

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
            'branch_id'=>0
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
