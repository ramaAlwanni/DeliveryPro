<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin User
        $superAdmin = User::create([
            'full_name' => 'Javed Ur Rehman',
            'email' => 'javed@allphptricks.com',
            'password' => Hash::make('javed1234'),
            'phone_number' => '0000000000'
        ]);
        $superAdmin->assignRole('Super Admin');

        // Creating Admin User
        $admin = User::create([
            'full_name' => 'Syed Ahsan Kamal',
            'email' => 'ahsan@allphptricks.com',
            'password' => Hash::make('ahsan1234'),
            'phone_number' => '0000000000'
        ]);
        $admin->assignRole('Admin');

        // Creating Product Manager User
        $productManager = User::create([
            'full_name' => 'Abdul Muqeet',
            'email' => 'muqeet@allphptricks.com',
            'password' => Hash::make('muqeet1234'),
            'phone_number' => '0000000000'
        ]);
        $productManager->assignRole('Product Manager');

        // Creating Application User
        $user = User::create([
            'full_name' => 'Nagham Ali',
            'email' => 'Nagham@allphptricks.com',
            'password' => Hash::make('Nagham1234'),
            'phone_number' => '0000000000'
        ]);
        $user->assignRole('User');
    }
}
