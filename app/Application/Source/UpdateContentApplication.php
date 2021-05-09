<?php


namespace App\Application\Source;


use App\Application\Source\Traits\CalculateSize;
use App\Models\Source;

class UpdateContentApplication
{
    use CalculateSize;

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
        if (Source::find($this->id)->update($this->data + $this->calculateSize($this->data['content']))) {
            return true;
        }
        return false;
    }

}
