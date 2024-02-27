<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
            'name' => 'outreach',
            'guard_name' => 'web'
        ]);
         $role2->givePermissionTo('edit record');
         $role2->givePermissionTo('create record');
         $role2->givePermissionTo('view record');
         $role2->givePermissionTo('delete record');

         $role3 = Role::create([
            'name' => 'financial',
            'guard_name' => 'web'
        ]);
         $role3->givePermissionTo('edit record');
         $role3->givePermissionTo('create record');
         $role3->givePermissionTo('view record');
         $role3->givePermissionTo('delete record');

         $role4 = Role::create([
            'name' => 'volunteer',
            'guard_name' => 'web'
        ]);
         $role4->givePermissionTo('edit record');
         $role4->givePermissionTo('create record');
         $role4->givePermissionTo('view record');
         $role4->givePermissionTo('delete record');




         // gets all permissions via Gate::before rule; see AuthServiceProvider

         // create demo users
         $user = \App\Models\User::create([
            'firstname' => 'Admin',
            'middlename' => 'admin',
            'lastname' => 'Default',
            'email' => 'admin@example.com',
            'password' => Hash::make('1234pass')
         ]);
         $user->assignRole('admin');

         $user = \App\Models\User::create([
            'firstname' => 'Member',
            'middlename' => 'users',
            'lastname' => 'Default',
            'email' => 'member@example.com',
            'password' => Hash::make('1234pass')
         ]);
         $user->assignRole('outreach');

         $user = User::create([
            'firstname' => 'Example',
            'middlename' => 'James',
            'lastname' => 'financial',
            'email' => 'financial@example.com',
            'password' => Hash::make('1234pass'),
        ]);

        $user->assignRole('financial');

        $user = User::create([
            'firstname' => 'Example',
            'middlename' => 'Esther',
            'lastname' => 'volunteer',
            'email' => 'volunteer@example.com',
            'password' => Hash::make('1234pass'),
        ]);

        $user->assignRole('volunteer');


    }
}
