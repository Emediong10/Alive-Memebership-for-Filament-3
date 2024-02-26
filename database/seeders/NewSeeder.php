<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
