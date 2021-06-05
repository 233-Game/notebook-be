<?php

namespace App\Observers;

use App\Models\Tag;

class TagObserver
{
    public function creating(Tag $tag){
        if (empty($tag['desc'])){
            $tag['desc']='';
        }
    }
    public function updating(Tag $tag){
        if (empty($tag['desc'])){
            $tag['desc']='';
        }
    }
}
