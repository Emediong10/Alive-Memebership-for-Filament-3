<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::create([
            'firstname' => 'Admin',
            'middlename' => 'admins',
            'lastname' => 'Addmin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('11111111')
        ]);

        $user->assignRole('admin');
    }
}
