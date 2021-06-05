<?php


namespace App\Application\Source;


use App\Enums\Source\EditorType;
use App\Http\Resources\SourceResource;
use App\Models\Source;
use Illuminate\Support\Facades\Gate;

class UpdateContentApplication
{
    private $data;
    private $id;

    public function setParameter($id, $data): UpdateContentApplication
    {
        $this->id = $id;
        $this->data = $data;
        return $this;
    }

    public function execute()
    {
        $source = Source::find($this->id);
        Gate::authorize('update',$source);
        if (empty($source)) {
            return false;
        }
        if (!is_array($this->data['content'])) {
            $data = $source->content;
            $data['data'] = $this->data['content'];
            $this->data['content'] = $data;
        }
        $res = $source->update($this->data);
        // 需要创建快照,
        return $res ? new SourceResource($source, true) : false;
    }

}
