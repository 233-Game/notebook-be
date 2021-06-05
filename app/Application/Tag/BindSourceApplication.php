<?php


namespace App\Application\Tag;


use App\Models\Source;
use App\Models\SourceTag;

class BindSourceApplication
{
    protected $source_id;
    protected $tag_ids;

    public function setParameter($tag_ids, $source_id): BindSourceApplication
    {
        $this->tag_ids = is_array($tag_ids) ? $tag_ids : [$tag_ids];
        $this->source_id = $source_id;
        return $this;
    }

    public function execute(): array
    {
        $successIds = [];
        $errIds = [];
        foreach ($this->tag_ids as $tag_id) {
            try {
                Source::find($this->source_id)->tags()->attach($tag_id);
                $successIds[] = $tag_id;
            } catch (\Exception $exception) {
                $errIds[] = $tag_id;
            }
        }
        return compact('successIds', 'errIds');
        // return    Source::find($this->source_id)->tags()->sync($this->tag_ids)
    }

}
