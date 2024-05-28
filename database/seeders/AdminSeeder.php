<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('admins')->insert([
            'name' => 'Admin',
            'username' => 'Admin',
            'phone_number' => '0569465465',
            'email' => 'test@test.test',
            'password' => Hash::make('password'),

        ]);

    }
}
