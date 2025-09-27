<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum Permission: string
{
    case ViewUsers = 'view_users';
    case CreateUsers = 'create_users';
    case EditUsers = 'edit_users';
    case DeleteUsers = 'delete_users';
    case ViewRoles = 'view_roles';
    case CreateRoles = 'create_roles';
    case EditRoles = 'edit_roles';
    case DeleteRoles = 'delete_roles';
}
