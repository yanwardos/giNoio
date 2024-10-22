<?php

namespace Database\Seeders;

use App\Enum\RoleEnum;
use App\Models\Admin;
use App\Models\Device;
use App\Models\Medis;
use App\Models\Pasien;
use App\Models\User;
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
                    'id' => RoleEnum::ADMIN->value,
                    'name' => 'admin'
                ],
                [
                    'id' => RoleEnum::MEDIS->value,
                    'name' => 'medis'
                ],
                [
                    'id' => RoleEnum::PASIEN->value,
                    'name' => 'pasien'
                ]
            ]
        );
        
        // admin
        Admin::factory()
        ->count(1)
        ->create();

        // medis
        Medis::factory()
        ->count(1)
        ->create();

        // pasien
        // Pasien::factory()
        // ->count(2) 
        // ->create();

        // device
        // Device::factory()
        // ->count(2)
        // ->create();
    }
}
