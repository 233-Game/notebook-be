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
            'user_id' => $this->user_id,
            'name' => $this->name,
            'desc' => $this->desc,
            'config' => $this->config,
            'version' => $this->version,
            'cover' => $this->cover,
            'status' => $this->status,
            'type' => $this->type,
            'view_count' => $this->view_count,
            'collect_count' => $this->collect_count,
            'fork_count' => $this->fork_count,
        ];
    }
}
