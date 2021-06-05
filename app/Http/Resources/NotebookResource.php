<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotebookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'desc' => $this->desc,
            'config' => $this->config,
            'version' => $this->version,
            'cover' => $this->cover ? url($this->cover) : 'default',
            'status' => $this->status,
            'type' => $this->type,
            'view_count' => $this->view_count,
            'collect_count' => $this->collect_count,
            'fork_count' => $this->fork_count,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
