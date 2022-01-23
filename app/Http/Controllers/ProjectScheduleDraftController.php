<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectScheduleDraftRequest;
use App\Http\Resources\ProjectScheduleDraftResource;
use App\Models\ProjectDraft;
use App\Models\ProjectScheduleDraft;
use Illuminate\Http\Request;

/**
 * @group project
 * 项目进度
 */
class ProjectScheduleDraftController extends ApiController
{
    /**
     * list schedule
     */
    public function index(Request $request)
    {
        $projectDraftId = $request->input('draft_id');
        $projectDraft = ProjectDraft::find($projectDraftId);
        $projectDraft->checkPermission();
        $schedules = ProjectScheduleDraft::where('project_draft_id', $projectDraftId)->orderBy('submit_at', 'asc')->get();
        return $this->success(ProjectScheduleDraftResource::collection($schedules));
    }

    /**
     * add schedule
     * @bodyParam  draft_id int 项目草稿ID
     * @bodyParam  title string 标题
     * @bodyParam  description string 描述
     */
    public function store(ProjectScheduleDraftRequest $request)
    {
        $projectDraftId = $request->input('draft_id');
        $projectDraft = ProjectDraft::find($projectDraftId);
        $projectDraft->checkPermission();
        $data = $request->validated();
        if (!empty($data['video_code'])) {
            $data['video_code'] = clean($data['video_code'], 'video');
        }
        if (!empty($data['description'])) {
            $data['description'] = clean($data['description']);
        }
        $data['project_draft_id'] = $projectDraft->id;
        $schedule = ProjectScheduleDraft::create($data);
        return $this->success(new ProjectScheduleDraftResource($schedule));
    }

    /**
     * update schedule
     * @urlParam scheduleDraft 进度ID
     * @bodyParam  title string 标题
     * @bodyParam  description string 描述
     */
    public function update(ProjectScheduleDraft $scheduleDraft, ProjectScheduleDraftRequest $request)
    {
        $projectDraft = ProjectDraft::find($scheduleDraft->project_draft_id);
        $projectDraft->checkPermission();

        $data = $request->validated();
        if (!empty($data['video_code'])) {
            $data['video_code'] = clean($data['video_code'], 'video');
        }
        if (!empty($data['description'])) {
            $data['description'] = clean($data['description']);
        }
        $scheduleDraft->update($data);
        return $this->success(new ProjectScheduleDraftResource($scheduleDraft));
    }

    /**
     * delete schedule
     * @urlParam scheduleDraft 进度ID
     */
    public function delete(ProjectScheduleDraft $scheduleDraft)
    {
        $projectDraft = ProjectDraft::find($scheduleDraft->project_draft_id);
        $projectDraft->checkPermission();

        $scheduleDraft->delete();

        return $this->success();
    }
}
