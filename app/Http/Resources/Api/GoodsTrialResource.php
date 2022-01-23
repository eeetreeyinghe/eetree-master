<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class GoodsTrialResource extends JsonResource
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
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'published' => $this->publish_at === null ? 0 : 1,
            'user' => [
                'nickname' => $this->user->nickname,
            ],
        ];
        $routeName = $request->route()->getName();
        if ($routeName == 'admin.goodsTrial.index') {
            if ($this->pj_id) {
                $project = [
                    'url' => route('project.detail', ['project' => $this->pj_id]),
                ];
                foreach ($this->getAttributes() as $key => $value) {
                    if (strpos($key, 'pj_') === 0) {
                        $key = substr($key, 3);
                        $project[$key] = $value;
                    }
                }
                $row['project'] = $project;
            }
            if ($this->gd_name) {
                $goods = [];
                foreach ($this->getAttributes() as $key => $value) {
                    if (strpos($key, 'gd_') === 0) {
                        $key = substr($key, 3);
                        $goods[$key] = $value;
                    }
                }
                $row['goods'] = $goods;
            }
        }
        return $row;
    }
}
