<?php

namespace App\Http\Controllers;

use App\Helpers\Enums;
use App\Http\Resources\ProjectCloudDraftResource;
use App\Models\ProjectCloudDraft;
use App\Models\ProjectDraft;
use Illuminate\Http\Request;

/**
 * @group project
 * 项目文件、图片
 */
class ProjectCloudDraftController extends ApiController
{
    /**
     * list files/images
     * @queryParam  draft_id 项目ID
     * @queryParam  type 类型：电路图/附件（enums.project.cloudTypes）
     */
    public function index(Request $request)
    {
        $type = (int) $request->input('type');
        $projectDraftId = $request->input('draft_id');
        $projectDraft = ProjectDraft::find($projectDraftId);
        $projectDraft->checkPermission();
        $where = [
            ['project_draft_id', $projectDraftId],
        ];
        if ($type) {
            $where[] = ['type', $type];
        }
        $clouds = ProjectCloudDraft::where($where)->orderBy('id', 'asc')->get();
        return $this->success(ProjectCloudDraftResource::collection($clouds));
    }
}
