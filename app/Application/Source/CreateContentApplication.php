<?php


namespace App\Application\Source;


use App\Enums\Source\EditorType;
use App\Enums\Source\SourceType;
use App\Models\Source;

class CreateContentApplication
{
    private $data;
    private $type;


    public function setParameter($data, $type = SourceType::DEFAULT): CreateContentApplication
    {
        $this->data = $data;
        $this->type = $type;
        return $this;
    }


    public function execute(): int
    {
        if (is_file($this->data['content'])) {
            // doSomething
        }
        if (!is_array($this->data['content'])) {
            $this->data['content'] = [
                'type' => EditorType::MARKDOWN,
                'data' => $this->data['content']
            ];
        }
        $this->data['type'] = $this->type;
        $source = Source::create($this->data);
        return $source->id;
    }

}
