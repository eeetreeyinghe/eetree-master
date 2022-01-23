<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectCourseDraftRequest;
use App\Http\Resources\ProjectCourseDraftResource;
use App\Models\ProjectCourseDraft;
use App\Models\ProjectDraft;
use Illuminate\Http\Request;

/**
 * @group project
 * 项目商品
 */
class ProjectCourseDraftController extends ApiController
{
    /**
     * list course
     */
    public function index(Request $request)
    {
        $projectDraftId = $request->input('draft_id');
        $projectDraft = ProjectDraft::find($projectDraftId);
        $projectDraft->checkPermission();
        $courses = ProjectCourseDraft::with('cloud')->where('project_draft_id', $projectDraftId)->orderBy('id', 'asc')->get();
        return $this->success(ProjectCourseDraftResource::collection($courses));
    }

    /**
     * add course
     * @bodyParam  draft_id int 项目草稿ID
     * @bodyParam  title string 标题
     * @bodyParam  description string 描述
     * @bodyParam  cloud_id string 图片ID
     * @bodyParam  link string 链接
     */
    public function store(ProjectCourseDraftRequest $request)
    {
        $projectDraftId = $request->input('draft_id');
        $projectDraft = ProjectDraft::find($projectDraftId);
        $projectDraft->checkPermission();
        $data = $request->validated();
        $data['project_draft_id'] = $projectDraft->id;
        $course = ProjectCourseDraft::create($data);
        return $this->success(new ProjectCourseDraftResource($course));
    }

    public function edit(ProjectCourseDraft $courseDraft)
    {
        $projectDraft = ProjectDraft::find($courseDraft->project_draft_id);
        $projectDraft->checkPermission();

        return view('project/course_draft_edit', [
            'courseDraft' => $courseDraft->toArray(),
        ]);
    }

    /**
     * update course
     * @urlParam courseDraft 案例ID
     * @bodyParam  title string 标题
     * @bodyParam  description string 描述
     * @bodyParam  cloud_id string 图片ID
     * @bodyParam  link string 链接
     */
    public function update(ProjectCourseDraft $courseDraft, ProjectCourseDraftRequest $request)
    {
        $projectDraft = ProjectDraft::find($courseDraft->project_draft_id);
        $projectDraft->checkPermission();

        $data = $request->validated();
        $courseDraft->update($data);
        return $this->success(new ProjectCourseDraftResource($courseDraft));
    }

    /**
     * delete course
     * @urlParam courseDraft 商品ID
     */
    public function delete(ProjectCourseDraft $courseDraft)
    {
        $projectDraft = ProjectDraft::find($courseDraft->project_draft_id);
        $projectDraft->checkPermission();

        $courseDraft->delete();

        return $this->success();
    }
}
