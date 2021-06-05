<?php

namespace App\Http\Resources;

use App\Enums\Source\SourceStatus;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class SourceResource extends JsonResource
{
    protected $summary = true;

    public function __construct($resource, $summary = true)
    {
        $this->summary = is_numeric($summary) ? true : $summary;
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'content' => '',
            'type' => $this->content['type'] ?? 1,
            'size' => $this->size,
            'collect' => $this->status === SourceStatus::COLLECTED,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans()
        ];
        if ($this->summary) {
            $data['content'] = Str::substr($this->content['data'], 0, 50);
        } else {
            $data['content'] = $this->content['data'] ?? $this->content;
            $data['tags'] = TagResource::collection($this->tags);
            $data['notebook'] = new  NotebookResource($this->notebook);
        }
        return $data;
    }
}
