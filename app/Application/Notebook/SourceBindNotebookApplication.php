<?php


namespace App\Application\Notebook;


use App\Enums\Source\SourceType;
use App\Models\NoteBook;
use App\Models\NoteCatalog;
use App\Models\Source;
use Illuminate\Support\Facades\Gate;

class SourceBindNotebookApplication
{
    private $source_id;
    private $notebook_id;

    public function setParameter($notebook_id, $source_id): SourceBindNotebookApplication
    {
        $this->source_id = $source_id;
        $this->notebook_id = $notebook_id;
        return $this;
    }

    public function execute()
    {
        $notebook = NoteBook::find($this->notebook_id);
        Gate::authorize('view', $notebook);
        $noteCatalog = NoteCatalog::where('notebook_id', $this->notebook_id)->first();
        if (empty($noteCatalog)) {
            $noteCatalog = NoteCatalog::create([
                'notebook_id' => $this->notebook_id,
                'title' => '默认列表'
            ]);
        }
        return Source::where('id', $this->source_id)->update([
            'note_catalog_id' => $noteCatalog->id
        ]);

    }
}
