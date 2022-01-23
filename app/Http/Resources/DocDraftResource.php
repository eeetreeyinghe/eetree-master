<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DocDraftResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $row = [
            'id' => $this->id,
            'doc_id' => $this->doc_id,
            'title' => $this->title,
            'last_edit_at' => $this->last_edit_at->format('Y-m-d'),
            'shared_at' => $this->shared_at ? $this->shared_at->format('Y-m-d') : '',
            'docPublish' => $this->docPublish ? [
                'status' => $this->docPublish->status,
            ] : null,
        ];
        $routeName = $request->route()->getName();
        if ($routeName == 'userCategory.folder') {
            $row['tags'] = [];
            $row['tag_ids'] = $this->tags->pluck('id');
            $this->tags->each(function ($tag) use (&$row) {
                $row['tags'][] = [
                    'id' => $tag->id,
                    'name' => $tag->name,
                ];
            });
        }
        return $row;
    }
}
