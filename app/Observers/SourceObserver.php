<?php

namespace App\Observers;

use App\Models\Source;

class SourceObserver
{
    private function calculateSize($data): int
    {
        return 1;
    }

    private function setInfo(Source $source)
    {
        if (!$source['note_catalog_id']){
            $source['note_catalog_id']=0;
        }
        $source['user_id'] = auth()->id();
        $source['size'] = $this->calculateSize($source['content']);
    }

    public function creating(Source $source)
    {
        $this->setInfo($source);
    }

    public function updating(Source $source)
    {
        $this->setInfo($source);
    }
}
