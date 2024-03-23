<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);
        DB::table('roles')->insert(
            [
            'name' => 'admin'
            ],
           
        );
        DB::table('roles')->insert(
            [
            'name' => 'manager'
            ],
           
        );
        DB::table('roles')->insert(
            [
            'name' => 'developer'
            ],
           
        );
    }
}
