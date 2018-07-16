<?php
/**
 * Autor: Paula Aguirre Copyright (c) 2018.
 */

namespace App\Policies;

use App\User;
use App\Expediente;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExpedientePolicy
{
    use HandlesAuthorization;

    public function before ($user, $ability)
    {
        if (in_array ($user->role_id, [1,2])){
            return true;
        }

    }


    /**
     * Determine whether the user can view the expediente.
     *
     * @param  \App\User  $user
     * @param  \App\Expediente  $expediente
     * @return mixed
     */

    public function show (User $user, Expediente $expediente)
    {
        if ($user->id === $expediente->user_id)
        {
            return true;
        }
        else{
            if ($expediente->creador->funcionario)
            {
                if ($user->area->id == $expediente->creador->funcionario->departamento_id )
                {
                    return true;
                }
                elseif ($user->area->id == $expediente->creador->funcionario->departamento->dependencia_id)
                {
                    return true;
                }

            }
            elseif ($expediente->creador->area)
            {
                if ($user->area->id == $expediente->creador->area->dependencia_id)
                {
                    return true;
                }
            }



        }

    }

    public function edit(User $user, Expediente $expediente)
    {
        return $user->id === $expediente->user_id;
    }

    public function update (User $user, Expediente $expediente)
    {
        return $user->id === $expediente->user_id;
    }


}
