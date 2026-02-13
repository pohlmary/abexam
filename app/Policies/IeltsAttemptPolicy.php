<?php

namespace App\Policies;

use App\Models\User;
use App\Models\IeltsAttempt;

class IeltsAttemptPolicy
{
    public function view(User $user, IeltsAttempt $attempt)
    {
        return $user->id === $attempt->user_id || $user->role === 'admin';
    }

    public function update(User $user, IeltsAttempt $attempt)
    {
        return $user->id === $attempt->user_id;
    }
}
