<?php

namespace App\Enum;

enum RoleEnum:int {
    case ADMIN = 1;
    case MEDIS = 2;
    case PASIEN = 3;

    public function id(): int{
        return match($this){
            RoleEnum::ADMIN, RoleEnum::ADMIN => 1,
            RoleEnum::MEDIS, RoleEnum::MEDIS => 2,
            RoleEnum::PASIEN, RoleEnum::PASIEN => 3,
        };
    }

    public function name() {
        return match($this){
            RoleEnum::ADMIN, RoleEnum::ADMIN => "admin",
            RoleEnum::MEDIS, RoleEnum::MEDIS => "medis",
            RoleEnum::PASIEN, RoleEnum::PASIEN => "pasien", 
        };
    }
}