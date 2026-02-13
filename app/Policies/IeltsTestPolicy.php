<?php

namespace App\Policies;

use App\Models\User;
use App\Models\IeltsTest;

class IeltsTestPolicy
{
    public function create(User $user)
    {
        return $user->role === 'admin' || $user->role === 'teacher';
    }

    public function update(User $user, IeltsTest $test)
    {
        return $user->id === $test->created_by || $user->role === 'admin';
    }

    public function delete(User $user, IeltsTest $test)
    {
        return $user->id === $test->created_by || $user->role === 'admin';
    }
}
