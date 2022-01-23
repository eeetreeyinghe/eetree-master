<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectRelateDraftResource;
use App\Models\ProjectDraft;
use App\Models\ProjectRelateDraft;
use Illuminate\Http\Request;

/**
 * @group project
 * 关联项目（平台）
 */
class ProjectRelateDraftController extends ApiController
{
    /**
     * list relate projects
     * @queryParam  draft_id 项目ID
     */
    public function index(Request $request)
    {
        $projectDraftId = $request->input('draft_id');
        $projectDraft = ProjectDraft::find($projectDraftId);
        $projectDraft->checkPermission();
        $where = [
            ['project_draft_id', $projectDraftId],
        ];
        $relates = ProjectRelateDraft::with('project.cloud')->where($where)->orderBy('id', 'asc')->get();
        return $this->success(ProjectRelateDraftResource::collection($relates));
    }
}
