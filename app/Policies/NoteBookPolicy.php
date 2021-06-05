<?php

namespace App\Policies;

use App\Models\NoteBook;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NoteBookPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\NoteBook $noteBook
     * @return mixed
     */
    public function view(User $user, NoteBook $noteBook)
    {
        return $user->id === $noteBook->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\NoteBook $noteBook
     * @return mixed
     */
    public function update(User $user, NoteBook $noteBook)
    {
        return $user->id === $noteBook->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\NoteBook $noteBook
     * @return mixed
     */
    public function delete(User $user, NoteBook $noteBook)
    {
        return $user->id === $noteBook->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\NoteBook $noteBook
     * @return mixed
     */
    public function restore(User $user, NoteBook $noteBook)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\NoteBook $noteBook
     * @return mixed
     */
    public function forceDelete(User $user, NoteBook $noteBook)
    {
        //
    }
}
