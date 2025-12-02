<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Support Sales',
                'email' => 'sales@kirstensupport.com',
                'password' => Hash::make('password123'),
                'role' => 'sales',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Support Accounts',
                'email' => 'accounts@kirstensupport.com',
                'password' => Hash::make('password123'),
                'role' => 'accounts',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Support IT',
                'email' => 'it@kirstensupport.com',
                'password' => Hash::make('password123'),
                'role' => 'it',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
