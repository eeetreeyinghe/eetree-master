<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class DocResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'published' => $this->publish_at === null ? 0 : 1,
            'user' => [
                'nickname' => $this->user->nickname,
            ],
            'url' => route('doc.detail', ['doc' => $this->id]),
        ];
        $routeName = $request->route()->getName();
        if ($routeName == 'admin.doc.index') {
            if ($this->dt_is_top === null) {
                $row['docTop'] = false;
            } else {
                $docTop = array();
                foreach ($this->getAttributes() as $key => $value) {
                    if (strpos($key, 'dt_') === 0) {
                        $key = substr($key, 3);
                        $docTop[$key] = $value;
                    }
                }
                $docTop['date'] = [$docTop['start_at'], $docTop['end_at']];
                unset($docTop['start_at'], $docTop['end_at']);
                $row['docTop'] = $docTop;
            }
        }
        return $row;
    }
}
