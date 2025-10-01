<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = 'Admin';
    case POLICE = 'Police';
    case VERIFIER = 'Verifier';
}
