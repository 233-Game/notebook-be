<?php

namespace App\Observers;

use App\Models\NoteTree;

class NoteTreeObserver
{

    public function creating(NoteTree $noteTree)
    {
        if ($pid = $noteTree['pid']) {
            $parent = NoteTree::find($pid);
            $noteTree['path'] = $parent->path . '/' . $pid;
        } else {
            $noteTree['path'] = '';
        }
    }


    public function updating(NoteTree $noteTree)
    {

    }

    /**
     * Handle the NoteTree "created" event.
     *
     * @param \App\Models\NoteTree $noteTree
     * @return void
     */
    public function created(NoteTree $noteTree)
    {
        //
    }

    /**
     * Handle the NoteTree "updated" event.
     *
     * @param \App\Models\NoteTree $noteTree
     * @return void
     */
    public function updated(NoteTree $noteTree)
    {
        //
    }

    /**
     * Handle the NoteTree "deleted" event.
     *
     * @param \App\Models\NoteTree $noteTree
     * @return void
     */
    public function deleted(NoteTree $noteTree)
    {
        //
    }

    /**
     * Handle the NoteTree "restored" event.
     *
     * @param \App\Models\NoteTree $noteTree
     * @return void
     */
    public function restored(NoteTree $noteTree)
    {
        //
    }

    /**
     * Handle the NoteTree "force deleted" event.
     *
     * @param \App\Models\NoteTree $noteTree
     * @return void
     */
    public function forceDeleted(NoteTree $noteTree)
    {
        //
    }
}
