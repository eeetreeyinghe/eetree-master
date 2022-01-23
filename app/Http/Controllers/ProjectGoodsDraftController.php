<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectGoodsDraftRequest;
use App\Http\Resources\ProjectGoodsDraftResource;
use App\Models\ProjectDraft;
use App\Models\ProjectGoodsDraft;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @group project
 * 项目商品
 */
class ProjectGoodsDraftController extends ApiController
{
    /**
     * list goods
     */
    public function index(Request $request)
    {
        $projectDraftId = $request->input('draft_id');
        $projectDraft = ProjectDraft::find($projectDraftId);
        $projectDraft->checkPermission();
        $goods = ProjectGoodsDraft::with('cloud')->where('project_draft_id', $projectDraftId)->orderBy('id', 'asc')->get();
        return $this->success(ProjectGoodsDraftResource::collection($goods));
    }

    /**
     * add goods
     * @bodyParam  draft_id int 项目草稿ID
     * @bodyParam  name string 商品名
     * @bodyParam  cloud_id string 图片ID
     * @bodyParam  price float 价格
     * @bodyParam  link string 链接
     * @bodyParam  description string 描述
     */
    public function store(ProjectGoodsDraftRequest $request)
    {
        $projectDraftId = $request->input('draft_id');
        $projectDraft = ProjectDraft::find($projectDraftId);
        $projectDraft->checkPermission();
        $data = $request->validated();
        $data['project_draft_id'] = $projectDraft->id;
        if (!Auth::user()->isAdmin()) {
            unset($data['link']);
        }
        $goods = ProjectGoodsDraft::create($data);
        return $this->success(new ProjectGoodsDraftResource($goods));
    }

    public function edit(ProjectGoodsDraft $goodsDraft)
    {
        $projectDraft = ProjectDraft::find($goodsDraft->project_draft_id);
        $projectDraft->checkPermission();

        return view('project/goods_draft_edit', [
            'goodsDraft' => $goodsDraft->toArray(),
        ]);
    }

    /**
     * update goods
     * @urlParam goodsDraft 商品ID
     * @bodyParam  name string 商品名
     * @bodyParam  cloud_id string 图片ID
     * @bodyParam  price float 价格
     * @bodyParam  link string 链接
     * @bodyParam  description string 描述
     */
    public function update(ProjectGoodsDraft $goodsDraft, ProjectGoodsDraftRequest $request)
    {
        $projectDraft = ProjectDraft::find($goodsDraft->project_draft_id);
        $projectDraft->checkPermission();

        $data = $request->validated();
        if (!Auth::user()->isAdmin()) {
            unset($data['link']);
        }
        $goodsDraft->update($data);
        return $this->success(new ProjectGoodsDraftResource($goodsDraft));
    }

    /**
     * delete goods
     * @urlParam goodsDraft 商品ID
     */
    public function delete(ProjectGoodsDraft $goodsDraft)
    {
        $projectDraft = ProjectDraft::find($goodsDraft->project_draft_id);
        $projectDraft->checkPermission();

        $goodsDraft->delete();

        return $this->success();
    }
}
