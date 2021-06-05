<?php


namespace App\Application\Notebook;


use App\Enums\Source\SourceType;
use App\Models\NoteCatalog;
use App\Models\Source;

class SourceBindCatalogApplication
{
    private $source_id;
    private $note_catalog_id;

    /**
     * @param $note_catalog_id
     * @param $source_id
     * @return $this
     */
    public function setParameter($note_catalog_id, $source_id): SourceBindCatalogApplication
    {
        $this->source_id = $source_id;
        $this->note_catalog_id = $note_catalog_id;
        return $this;
    }

    public function execute()
    {
        return Source::where('source_id', $this->source_id)->update([
            'note_catalog_id' => $this->note_catalog_id
        ]);

    }
}
