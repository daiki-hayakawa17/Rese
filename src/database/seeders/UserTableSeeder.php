<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'testadmin',
                'email' => 'test@example.com',
                'password' => Hash::make('adminpassword'),
                'role' => 'admin',
            ],
            [
                'name' => 'tonyOwner',
                'email' => 'test1@example.com',
                'password' => Hash::make('password'),
                'role' => 'owner',
            ],
            [
                'name' => 'testuser',
                'email' => 'test2@example.com',
                'password' => Hash::make('password2'),
                'role' => 'user',
            ],
        ]);

        DB::table('users')->insert([
            [
                'id' => '99',
                'name' => 'testowner',
                'email' => 'test0@example.com',
                'password' => Hash::make('ownerpassword'),
                'role' => 'owner'
            ],
        ]);
    }
}
