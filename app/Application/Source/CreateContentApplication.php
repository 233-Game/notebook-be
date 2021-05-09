<?php


namespace App\Application\Source;


use App\Application\Source\Traits\CalculateSize;
use App\Models\Source;

class CreateContentApplication
{
    use CalculateSize;

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
        $this->data['user_id'] = auth('api')->id();
        if (Source::create($this->data + $this->calculateSize($this->data['content']))) {
            return true;
        }
        return false;
    }

}
