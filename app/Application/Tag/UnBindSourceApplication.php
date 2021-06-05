<?php


namespace App\Application\Tag;


use App\Models\Source;
use App\Models\SourceTag;

class UnBindSourceApplication
{
    protected $source_id;
    protected $tag_ids;

    public function setParameter($tag_ids, $source_id): UnBindSourceApplication
    {
        $this->tag_ids = $tag_ids;
        $this->source_id = $source_id;
        return $this;
    }

    public function execute(): bool
    {
        Source::find($this->source_id)->tags()->detach($this->tag_ids);
        return true;
    }
}
