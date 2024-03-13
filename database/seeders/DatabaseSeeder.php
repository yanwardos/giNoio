<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();


        // roles first
        DB::table('roles')->insert(
            [
                [
                    'id' => 1,
                    'name' => 'admin'
                ],
                [
                    'id' => 2,
                    'name' => 'medis'
                ],
                [
                    'id' => 3,
                    'name' => 'pasien'
                ]
            ]
        );

        // admin
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@localhost.com',
            'password' => Hash::make('password'),
            'role_id' => 1
        ]);

        // medis
        DB::table('users')->insert([
            'name' => 'dr. Medis',
            'email' => 'medis@localhost.com',
            'password' => Hash::make('password'),
            'role_id' => 2
        ]);
    }
}
