<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Workout;

class WorkoutPolicy
{
    /**
     * Determine if the user can manage workouts.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function manageWorkouts(User $user)
    {
        return $user->usertype === 'admin';
    }
}

