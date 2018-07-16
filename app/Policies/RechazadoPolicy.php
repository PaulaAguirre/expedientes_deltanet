<?php
/**
 * Autor: Paula Aguirre Copyright (c) 2018.
 */

namespace App\Policies;

use App\History;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RechazadoPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before ($user, $ability)
    {
        if (in_array ($user->role_id, [1,2])){
            return true;
        }
    }

    public function edit(User $user, History $history)
    {
        return $user->id === $history->expediente->user_id;
    }

    public function update(User $user, History $history)
    {
        return $user->id === $history->expediente->user_id;
    }
}
