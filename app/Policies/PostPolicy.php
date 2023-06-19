<?php

namespace App\Policies;

use App\Models\User;
use App\Enums\RolesEnum;

class PostPolicy
{
    public function block(User $user)
    {
        return $user->role === RolesEnum::MODERATOR;
    }
}
