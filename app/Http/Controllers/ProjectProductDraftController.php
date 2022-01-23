<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectProductDraftResource;
use App\Models\ProjectDraft;
use App\Models\ProjectProductDraft;
use Illuminate\Http\Request;

/**
 * @group project
 * 项目使用的软硬件
 */
class ProjectProductDraftController extends ApiController
{
    /**
     * list products
     */
    public function index(Request $request)
    {
        $projectDraftId = $request->input('draft_id');
        $projectDraft = ProjectDraft::find($projectDraftId);
        $projectDraft->checkPermission();
        $where = [
            ['project_draft_id', $projectDraftId],
        ];
        $products = ProjectProductDraft::with(['product.cloud', 'product.supplier'])->where($where)->orderBy('id', 'asc')->get();
        return $this->success(ProjectProductDraftResource::collection($products));
    }
}
