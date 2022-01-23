<?php

namespace App\Helpers;

use App\Helpers\Enums;
use App\Models\Doc;
use App\Models\Project;
use App\Models\Recommend;

class RecommendHelper
{
    public static function getRecommends($areas)
    {
        if (is_array($areas)) {
            $areaIds = [];
            $areaMap = [];
            foreach ($areas as $name) {
                $areaId = Enums::key($name);
                $areaMap[$name] = $areaId;
                $areaIds[] = $areaId;
            }
            $tmpRecommends = Recommend::with('cloud')->whereIn('area_id', $areaIds)->orderBy('order', 'asc')->get();
            $tmpRecommends = static::formartRecommends($tmpRecommends);
            $recommends = [];
            foreach ($areaMap as $name => $areaId) {
                $recommends[$name] = [];
                foreach ($tmpRecommends as $recommend) {
                    if ($areaId == $recommend->area_id) {
                        $recommends[$name][] = [
                            'obj_type' => $recommend->obj_type,
                            'obj_data' => $recommend->obj_data ?: null,
                            'title' => $recommend->title,
                            'description' => $recommend->description,
                            'link' => $recommend->link,
                            'cloud_url' => $recommend->cloud->url,
                        ];
                    }
                }
            }
        } else {
            $areaId = Enums::key($areas);
            $tmpRecommends = Recommend::with('cloud')->where('area_id', $areaId)->get();
            $tmpRecommends = static::formartRecommends($tmpRecommends);
            $recommends = [];
            foreach ($tmpRecommends as $recommend) {
                $recommends[] = [
                    'obj_type' => $recommend->obj_type,
                    'obj_data' => $recommend->obj_data ?: null,
                    'title' => $recommend->title,
                    'description' => $recommend->description,
                    'link' => $recommend->link,
                    'cloud_url' => $recommend->cloud->url,
                ];
            }
        }
        return $recommends;
    }

    public static function formartRecommends($recommends)
    {
        $docIds = [];
        $projectIds = [];
        foreach ($recommends as $recommend) {
            if ($recommend->obj_id > 0) {
                if ($recommend->obj_type === Enums::key('types.DOC')) {
                    $docIds[] = $recommend->obj_id;
                } elseif ($recommend->obj_type === Enums::key('types.PROJECT')) {
                    $projectIds[] = $recommend->obj_id;
                }
            }
        }
        if (!empty($docIds)) {
            $docs = Doc::select('id', 'user_id', 'view_count', 'like_count', 'publish_at')->with('user:id,avatar,nickname')->whereIn('id', $docIds)->whereNotNull('publish_at')->get()->keyBy('id');

            foreach ($recommends as $k => $recommend) {
                if ($recommend->obj_id > 0) {
                    if ($recommend->obj_type === Enums::key('types.DOC')) {
                        if ($docs->has($recommend->obj_id)) {
                            $model = $docs->get($recommend->obj_id);
                            $objData = $model->toArray();
                            $objData['publish_at'] = $model->publish_at->format('y/m/d');
                            $recommend->obj_data = $objData;
                        } else {
                            unset($recommends[$k]);
                        }
                    }
                }
            }
        }
        if (!empty($projectIds)) {
            $projects = Project::select('id', 'user_id', 'view_count', 'last_publish_at')->with('user:id,avatar,nickname')->whereIn('id', $projectIds)->whereNotNull('last_publish_at')->get()->keyBy('id');
            foreach ($recommends as $k => $recommend) {
                if ($recommend->obj_id > 0) {
                    if ($recommend->obj_type === Enums::key('types.PROJECT')) {
                        if ($projects->has($recommend->obj_id)) {
                            $model = clone $projects->get($recommend->obj_id);
                            $model->title = $recommend->title;
                            $model->description = $recommend->description;
                            $model->link = $recommend->link;
                            $model->cloud = $recommend->cloud;
                            $recommend->obj_data = $model;
                        } else {
                            unset($recommends[$k]);
                        }
                    }
                }
            }
        }
        return $recommends;
    }
}
