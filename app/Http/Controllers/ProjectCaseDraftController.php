<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectCaseDraftRequest;
use App\Http\Resources\ProjectCaseDraftResource;
use App\Models\ProjectCaseDraft;
use App\Models\ProjectDraft;
use Illuminate\Http\Request;

/**
 * @group project
 * 项目商品
 */
class ProjectCaseDraftController extends ApiController
{
    /**
     * list case
     */
    public function index(Request $request)
    {
        $projectDraftId = $request->input('draft_id');
        $projectDraft = ProjectDraft::find($projectDraftId);
        $projectDraft->checkPermission();
        $cases = ProjectCaseDraft::with('cloud')->where('project_draft_id', $projectDraftId)->orderBy('order', 'asc')->get();
        return $this->success(ProjectCaseDraftResource::collection($cases));
    }

    /**
     * add case
     * @bodyParam  draft_id int 项目草稿ID
     * @bodyParam  title string 标题
     * @bodyParam  description string 描述
     * @bodyParam  cloud_id string 图片ID
     * @bodyParam  link string 链接
     */
    public function store(ProjectCaseDraftRequest $request)
    {
        $projectDraftId = $request->input('draft_id');
        $projectDraft = ProjectDraft::find($projectDraftId);
        $projectDraft->checkPermission();
        $data = $request->validated();
        $data['project_draft_id'] = $projectDraft->id;
        $data['order'] = 1;
        ProjectCaseDraft::where('project_draft_id', $projectDraft->id)->increment('order');
        $case = ProjectCaseDraft::create($data);
        return $this->success(new ProjectCaseDraftResource($case));
    }

    public function edit(ProjectCaseDraft $caseDraft)
    {
        $projectDraft = ProjectDraft::find($caseDraft->project_draft_id);
        $projectDraft->checkPermission();

        return view('project/case_draft_edit', [
            'caseDraft' => $caseDraft->toArray(),
        ]);
    }

    /**
     * update case
     * @urlParam caseDraft 案例ID
     * @bodyParam  title string 标题
     * @bodyParam  description string 描述
     * @bodyParam  cloud_id string 图片ID
     * @bodyParam  link string 链接
     */
    public function update(ProjectCaseDraft $caseDraft, ProjectCaseDraftRequest $request)
    {
        $projectDraft = ProjectDraft::find($caseDraft->project_draft_id);
        $projectDraft->checkPermission();

        $data = $request->validated();
        $caseDraft->update($data);
        return $this->success(new ProjectCaseDraftResource($caseDraft));
    }

    /**
     * delete case
     * @urlParam caseDraft 案例ID
     */
    public function delete(ProjectCaseDraft $caseDraft)
    {
        $projectDraft = ProjectDraft::find($caseDraft->project_draft_id);
        $projectDraft->checkPermission();

        ProjectCaseDraft::where('order', '>', $caseDraft->order)->decrement('order');
        $caseDraft->delete();

        return $this->success();
    }

    public function move(ProjectCaseDraft $caseDraft, Request $request)
    {
        $projectDraft = ProjectDraft::find($caseDraft->project_draft_id);
        $projectDraft->checkPermission();
        $destOrder = (int) $request->input('order');
        $maxOrder = ProjectCaseDraft::where('project_draft_id', $caseDraft->project_draft_id)->max('order');
        if ($destOrder !== $caseDraft->order && $destOrder > 0 && $destOrder <= $maxOrder) {
            \DB::transaction(function () use ($caseDraft, $destOrder) {
                if ($caseDraft->order > $destOrder) {
                    ProjectCaseDraft::where('project_draft_id', $caseDraft->project_draft_id)
                        ->where('order', '>=', $destOrder)
                        ->where('order', '<', $caseDraft->order)
                        ->increment('order');
                } else {
                    ProjectCaseDraft::where('project_draft_id', $caseDraft->project_draft_id)
                        ->where('order', '>', $caseDraft->order)
                        ->where('order', '<=', $destOrder)
                        ->decrement('order');
                }
                $caseDraft->update(['order' => $destOrder]);
            });
        }

        return $this->success();
    }
}
