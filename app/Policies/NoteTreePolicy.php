<?php

namespace App\Policies;

use App\Models\NoteTree;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NoteTreePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {

    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\NoteTree  $noteTree
     * @return mixed
     */
    public function view(User $user, NoteTree $noteTree)
    {
        return $user->id === $noteTree->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\NoteTree  $noteTree
     * @return mixed
     */
    public function update(User $user, NoteTree $noteTree)
    {
        return $user->id === $noteTree->user_id;

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\NoteTree  $noteTree
     * @return mixed
     */
    public function delete(User $user, NoteTree $noteTree)
    {
        return $user->id === $noteTree->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\NoteTree  $noteTree
     * @return mixed
     */
    public function restore(User $user, NoteTree $noteTree)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\NoteTree  $noteTree
     * @return mixed
     */
    public function forceDelete(User $user, NoteTree $noteTree)
    {
        //
    }
}
