<?php

namespace App\Policies;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class FeedbackPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param  \App\Models\User  $user
     * @param  string  $ability
     * @return void|bool
     */
    public function before(User $user, $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('feedbacks.read');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Feedback $feedback)
    {
        return $user->can('feedbacks.read') && $user->id == $feedback->user_id ? Response::allow()
                                                                               : Response::deny('You do not own the feedback');;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('feedbacks.create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Feedback $feedback)
    {
        return $user->can('feedbacks.update') && $user->id == $feedback->user_id ? Response::allow()
                                                                                 : Response::deny('You do not own the feedback');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Feedback $feedback)
    {
        return $user->can('feedbacks.delete') && $user->id == $feedback->user_id ? Response::allow()
                                                                                 : Response::deny('You do not own the feedback');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Feedback $feedback)
    {
        return $user->can('feedbacks.create') && $user->id == $feedback->user_id ? Response::allow()
                                                                                 : Response::deny('You do not own the feedback');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Feedback $feedback)
    {
        return $user->can('feedbacks.delete') && $user->id == $feedback->user_id ? Response::allow()
                                                                                 : Response::deny('You do not own the feedback');
    }
}
