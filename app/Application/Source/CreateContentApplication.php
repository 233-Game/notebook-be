<?php


namespace App\Application\Source;


use App\Models\Source;

class CreateContentApplication
{
    private $data;

    public function setParameter($data): CreateContentApplication
    {
        $this->data = $data;
        return $this;
    }


    public function execute()
    {
        if (is_file($this->data['content'])) {
            // doSomething
        }
        return Source::create($this->data);
    }

}
