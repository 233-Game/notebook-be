<?php


namespace App\Application\Source;


use App\Models\Source;

class UpdateContentApplication
{
    private $data;
    private $id;

    public function setParameter($id, $data)
    {
        $this->id = $id;
        $this->data = $data;
        return $this;
    }

    public function execute()
    {
        $source = Source::find($this->id);
        if (!empty($source)) {
            return true;
        }
        // 需要创建快照,
        return $source->update($this->data);
    }

}
