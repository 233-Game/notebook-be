<?php


namespace App\Application\Notebook;


use App\Application\Source\CreateContentApplication;
use App\Models\NoteBook;

class SourceCreateByNotebookApplication
{
    private $createContentApplication;
    private $data;
    private $notebook_id;

    public function __construct(CreateContentApplication $createContentApplication)
    {
        $this->createContentApplication = $createContentApplication;
    }

    public function setParameter($notebook_id, $data)
    {
        $this->data = $data;
        $this->notebook_id = $notebook_id;
        return $this;
    }

    public function execute()
    {
        $res = $this->createContentApplication->setParameter($this->data)->execute();
        if ($res) {
            return NoteBook::find($this->notebook_id)->update(['source_id' => $res->id]);
        }
        return false;
    }

}
