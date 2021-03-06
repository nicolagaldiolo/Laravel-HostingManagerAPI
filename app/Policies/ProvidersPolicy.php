<?php

namespace App\Policies;

use App\User;
use App\Provider;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProvidersPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the providers.
     *
     * @param  \App\User  $user
     * @param  \App\Provider  $providers
     * @return mixed
     */
    public function view(User $user, Provider $providers)
    {
        return $user->id === $providers->user_id;
    }

    /**
     * Determine whether the user can create providers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the providers.
     *
     * @param  \App\User  $user
     * @param  \App\Provider  $providers
     * @return mixed
     */
    public function update(User $user, Provider $providers)
    {
        return $user->id === $providers->user_id;
    }

    /**
     * Determine whether the user can delete the providers.
     *
     * @param  \App\User  $user
     * @param  \App\Provider  $providers
     * @return mixed
     */
    public function delete(User $user, Provider $providers)
    {
        return $user->id === $providers->user_id;
    }
}
