<?php


namespace App\Application\Source;


use App\Models\NoteBook;
use App\Models\Source;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;

class GetSourceListApplication
{
    private $userId;
    private $noteBookId;
    private $tagId;
    private $search;

    public function setParameter($userId, $noteBookId, $tagId, $search = ""): GetSourceListApplication
    {
        $this->userId = $userId;
        $this->noteBookId = $noteBookId;
        $this->tagId = $tagId;
        $this->search = $search;
        return $this;
    }

    public function execute()
    {
        if ($this->noteBookId) {
            $notebook = NoteBook::find($this->noteBookId);
            Gate::authorize('view', $notebook);
            $source = $notebook->sources();
        } else if ($this->tagId) {
            $tag = Tag::find($this->tagId);
            Gate::authorize('view', $tag);
            $source = $tag->sources();
        } else {
            $source = Source::query();
        }
        if ($this->userId) {
            $source = $source->where('user_id', $this->userId);
        }

        if (!empty($search)) {
            // 后期改造es
            $source->where(function ($query) use ($search) {
                return $query->where('title', 'like', '%' . $this->search . '%')->orWhere('content', 'regexp', '{"type":%,"data":%' . $this->search . '%"}');
            });
        }
        return $source->paginate();
    }
}
