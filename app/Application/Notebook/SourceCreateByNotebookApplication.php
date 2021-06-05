<?php


namespace App\Application\Notebook;


use App\Application\Source\CreateContentApplication;
use App\Enums\Source\SourceType;
use App\Models\NoteBook;
use Illuminate\Support\Facades\DB;

class SourceCreateByNotebookApplication
{
    private $createContentApplication;
    private $sourceBindNotebookApplication;
    private $data;
    private $notebook_id;

    public function __construct(CreateContentApplication $createContentApplication,
                                SourceBindNotebookApplication $sourceBindNotebookApplication)
    {
        $this->createContentApplication = $createContentApplication;
        $this->sourceBindNotebookApplication = $sourceBindNotebookApplication;
    }

    public function setParameter($notebook_id, $data)
    {
        $this->data = $data;
        $this->notebook_id = $notebook_id;
        return $this;
    }

    public function execute()
    {
        DB::beginTransaction();
        try {
            $res = $this->createContentApplication->setParameter($this->data,SourceType::NOTEBOOK)->execute();
            $this->sourceBindNotebookApplication->setParameter($this->notebook_id, $res)->execute();
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            return false;
        }
    }

}
