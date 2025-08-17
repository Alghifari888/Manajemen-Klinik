<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case DOKTER = 'dokter';
    case KASIR = 'kasir';
    case PASIEN = 'pasien';
}