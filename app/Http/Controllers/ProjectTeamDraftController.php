<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectTeamDraftRequest;
use App\Http\Resources\ProjectTeamDraftResource;
use App\Models\ProjectDraft;
use App\Models\ProjectTeamDraft;
use Illuminate\Http\Request;

/**
 * @group project
 * 团队成员
 */
class ProjectTeamDraftController extends ApiController
{
    /**
     * list team
     */
    public function index(Request $request)
    {
        $projectDraftId = $request->input('draft_id');
        $projectDraft = ProjectDraft::find($projectDraftId);
        $projectDraft->checkPermission();
        $teams = ProjectTeamDraft::where('project_draft_id', $projectDraftId)->orderBy('id', 'asc')->get();
        return $this->success(ProjectTeamDraftResource::collection($teams));
    }

    /**
     * add team
     * @bodyParam  draft_id int 项目草稿ID
     * @bodyParam  name string 姓名
     * @bodyParam  cloud_id string 图片ID
     * @bodyParam  description string 介绍
     */
    public function store(ProjectTeamDraftRequest $request)
    {
        $projectDraftId = $request->input('draft_id');
        $projectDraft = ProjectDraft::find($projectDraftId);
        $projectDraft->checkPermission();
        $data = $request->validated();
        $data['project_draft_id'] = $projectDraft->id;
        if (isset($data['user_id'])) {
            $data['name'] = '';
            $data['cloud_id'] = 0;
            $data['description'] = '';
        } else {
            $data['user_id'] = 0;
        }
        $team = ProjectTeamDraft::create($data);
        return $this->success(new ProjectTeamDraftResource($team));
    }

    public function edit(ProjectTeamDraft $teamDraft)
    {
        $projectDraft = ProjectDraft::find($teamDraft->project_draft_id);
        $projectDraft->checkPermission();

        return view('project/team_draft_edit', [
            'teamDraft' => $teamDraft->toArray(),
        ]);
    }

    /**
     * update team
     * @urlParam teamDraft 商品ID
     * @bodyParam  name string 姓名
     * @bodyParam  cloud_id string 图片ID
     * @bodyParam  description string 介绍
     */
    public function update(ProjectTeamDraft $teamDraft, ProjectTeamDraftRequest $request)
    {
        $projectDraft = ProjectDraft::find($teamDraft->project_draft_id);
        $projectDraft->checkPermission();

        $data = $request->validated();
        if (isset($data['user_id'])) {
            $data['name'] = '';
            $data['cloud_id'] = 0;
            $data['description'] = '';
        } else {
            $data['user_id'] = 0;
        }
        $teamDraft->update($data);
        return $this->success(new ProjectTeamDraftResource($teamDraft));
    }

    /**
     * delete team
     * @urlParam teamDraft 成员ID
     */
    public function delete(ProjectTeamDraft $teamDraft)
    {
        $projectDraft = ProjectDraft::find($teamDraft->project_draft_id);
        $projectDraft->checkPermission();

        $teamDraft->delete();

        return $this->success();
    }
}
