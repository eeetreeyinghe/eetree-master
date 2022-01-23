<?php

namespace App\Http\Controllers;

use App\Http\Resources\GoodsTrialResource;
use App\Models\GoodsTrial;
use Illuminate\Http\Request;

/**
 * @group trials
 * 产品试用接口
 */
class GoodsTrialController extends ApiController
{
    /**
     * list goods trials
     * @queryParam  project_id required 项目ID
     */
    public function index(Request $request)
    {
        $projectId = (int) $request->input('project_id');
        $goodsTrials = GoodsTrial::with(['user', 'cloud', 'attachment'])
            ->select('id', 'user_id', 'cloud_id', 'attachment_id', 'title', 'description', 'publish_at', 'cloud_id')
            ->where('project_id', $projectId)
            ->whereNotNull('publish_at')
            ->paginate(config('eetree.limit'));
        return $this->success(GoodsTrialResource::collection($goodsTrials));
    }
}
