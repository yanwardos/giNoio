<?php

namespace App\Enum;

enum RoleEnum:int {
    case ADMIN = 1;
    case MEDIS = 2;
    case PASIEN = 3;
}