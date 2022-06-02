<?php

namespace App\Policies;

use App\Models\Booktype;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BooktypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('booktypes.read');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Booktype  $booktype
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Booktype $booktype)
    {
        return $user->can('booktypes.read');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('booktypes.create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Booktype  $booktype
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Booktype $booktype)
    {
        return $user->can('booktypes.update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Booktype  $booktype
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Booktype $booktype)
    {
        return $user->can('booktypes.delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Booktype  $booktype
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Booktype $booktype)
    {
        return $user->can('booktypes.update');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Booktype  $booktype
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Booktype $booktype)
    {
        return $user->can('booktypes.delete');
    }
}
