<?php
/**
 * Autor: Paula Aguirre Copyright (c) 2018.
 */

namespace App\Policies;

use App\User;
use App\History;
use Illuminate\Auth\Access\HandlesAuthorization;

class HistoryPolicy
{
    use HandlesAuthorization;

    public function before ($user, $ability)
    {
        if (in_array ($user->role_id, [1,2])){
            return true;
        }
    }

    /**
     * Determine whether the user can view the history.
     *
     * @param  \App\User  $user
     * @param  \App\History  $history
     * @return mixed
     */
    public function view(User $user, History $history)
    {
        //
    }

    /**
     * Determine whether the user can create histories.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the history.
     *
     * @param  \App\User  $user
     * @param  \App\History  $history
     * @return mixed
     */

    public function edit(User $user, History $history)
    {
        if ($history->estado == 'rechazado')
        {
            return $user->id ===$history->expediente->user_id;
        }
        elseif ($history->estado == 'pendiente')
        {
            return $user->id === $history->area->user_id;
        }

    }

    public function update(User $user, History $history)
    {
        if ($history->estado == 'rechazado')
        {
            return $user->id ===$history->expediente->user_id;
        }
        elseif ($history->estado == 'pendiente')
        {
            return $user->id === $history->area->user_id;
        }
    }

    /**
     * Determine whether the user can delete the history.
     *
     * @param  \App\User  $user
     * @param  \App\History  $history
     * @return mixed
     */
    public function delete(User $user, History $history)
    {
        //
    }
}
