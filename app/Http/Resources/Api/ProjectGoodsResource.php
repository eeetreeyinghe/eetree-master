<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectGoodsResource extends JsonResource
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
            'name' => $this->name,
            'price' => $this->price,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
        $routeName = $request->route()->getName();
        if ($routeName == 'admin.projectGoods.index') {
            $row['xform'] = $this->xform ? [
                'id' => $this->xform->id,
                'name' => $this->xform->name,
            ] : null;
            if ($this->pj_title) {
                $project = [
                    'url' => route('project.detail', ['project' => $this->project_id]),
                ];
                foreach ($this->getAttributes() as $key => $value) {
                    if (strpos($key, 'pj_') === 0) {
                        $key = substr($key, 3);
                        $project[$key] = $value;
                    }
                }
                $row['project'] = $project;
            }
            if ($this->ur_nickname) {
                $user = [];
                foreach ($this->getAttributes() as $key => $value) {
                    if (strpos($key, 'ur_') === 0) {
                        $key = substr($key, 3);
                        $user[$key] = $value;
                    }
                }
                $row['user'] = $user;
            }
            if ($this->dt_threshold === null) {
                $row['goodsPromote'] = false;
            } else {
                $goodsPromote = array();
                foreach ($this->getAttributes() as $key => $value) {
                    if (strpos($key, 'dt_') === 0) {
                        $key = substr($key, 3);
                        $goodsPromote[$key] = $value;
                    }
                }
                $goodsPromote['date'] = [$goodsPromote['start_at'], $goodsPromote['end_at']];
                unset($goodsPromote['start_at'], $goodsPromote['end_at']);
                $row['goodsPromote'] = $goodsPromote;
            }
        }
        return $row;
    }
}
