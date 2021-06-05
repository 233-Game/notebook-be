<?php

namespace App\Observers;

use App\Models\NoteBook;

class NoteBookObserver
{

    public function creating(NoteBook $noteBook){
        if (empty($noteBook['config'])){
            $noteBook['config'] = [];
        }
        if (empty($noteBook['version'])){
            $noteBook['version'] = 0;
        }
        if (empty($noteBook['desc'])){
            $noteBook['desc'] = '';
        }
    }

    /**
     * Handle the NoteBook "created" event.
     *
     * @param  \App\Models\NoteBook  $noteBook
     * @return void
     */
    public function created(NoteBook $noteBook)
    {
        //
    }

    /**
     * Handle the NoteBook "updated" event.
     *
     * @param  \App\Models\NoteBook  $noteBook
     * @return void
     */
    public function updated(NoteBook $noteBook)
    {
        //
    }

    /**
     * Handle the NoteBook "deleted" event.
     *
     * @param  \App\Models\NoteBook  $noteBook
     * @return void
     */
    public function deleted(NoteBook $noteBook)
    {
        //
    }

    /**
     * Handle the NoteBook "restored" event.
     *
     * @param  \App\Models\NoteBook  $noteBook
     * @return void
     */
    public function restored(NoteBook $noteBook)
    {
        //
    }

    /**
     * Handle the NoteBook "force deleted" event.
     *
     * @param  \App\Models\NoteBook  $noteBook
     * @return void
     */
    public function forceDeleted(NoteBook $noteBook)
    {
        //
    }
}
