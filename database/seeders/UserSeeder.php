<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Reset cached roles and permissions
         app()[PermissionRegistrar::class]->forgetCachedPermissions();

         // create permissions
         Permission::create([
            'name' => 'create record',
            'guard_name' => 'web']);
        Permission::create([
                'name' => 'view record',
                'guard_name' => 'web']);
         Permission::create([
            'name' => 'edit record',
            'guard_name' => 'web']);
         Permission::create([
            'name' => 'delete record',
            'guard_name' => 'web'
        ]);


         // create roles and assign existing permissions
         $role1 = Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);
        // $role1 = Role::where('name','admin')->first();
         $role1->givePermissionTo('edit record');
         $role1->givePermissionTo('create record');
         $role1->givePermissionTo('view record');
         $role1->givePermissionTo('delete record');

         $role2 = Role::create([
            'name' => 'member',
            'guard_name' => 'web'
        ]);
         $role2->givePermissionTo('edit record');
         $role2->givePermissionTo('create record');
         $role2->givePermissionTo('view record');
         $role2->givePermissionTo('delete record');




         // gets all permissions via Gate::before rule; see AuthServiceProvider

         // create demo users
         $user = \App\Models\User::create([
            'firstname' => 'Admin',
            'middlename' => 'admin',
            'lastname' => 'Default',
            'email' => 'admin@example.com',
            'password' => Hash::make('1234pass')
         ]);
         $user->assignRole($role1);

         $user = \App\Models\User::create([
            'firstname' => 'Member',
            'middlename' => 'users',
            'lastname' => 'Default',
            'email' => 'member@example.com',
            'password' => Hash::make('1234pass')
         ]);
         $user->assignRole($role2);



    }
}
