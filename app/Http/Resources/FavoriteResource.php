<?php

namespace App\Http\Resources;

use App\Helpers\Enums;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->type == Enums::key('types.DOC')) {
            return [
                'id' => $this->id,
                'fav_id' => $this->fav_id,
                'type' => $this->type,
                'title' => $this->doc->title,
                'created_at' => $this->created_at->format('Y-m-d'),
                'url' => route('doc.detail', ['doc' => $this->doc->id]),
            ];
        } else {
            return [
                'id' => $this->id,
                'fav_id' => $this->fav_id,
                'type' => $this->type,
                'title' => $this->project->title,
                'created_at' => $this->created_at->format('Y-m-d'),
                'url' => route('project.detail', ['project' => $this->project->id]),
            ];
        }
    }
}
