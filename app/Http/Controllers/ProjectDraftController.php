<?php

namespace App\Http\Controllers;

use App\Helpers\Enums;
use App\Http\Requests\ProjectDraftRequest;
use App\Http\Resources\ProjectDraftResource;
use App\Models\ProjectDraft;
use App\Models\ProjectGoodsDraft;
use App\Models\ProjectProductDraft;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @group project
 * 项目管理
 */
class ProjectDraftController extends ApiController
{
    /**
     * list projects
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        $projects = ProjectDraft::with('cloud')
            ->where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->paginate(config('eetree.limit'));
        return $this->success(ProjectDraftResource::collection($projects));
    }

    /**
     * add project
     */
    public function store()
    {
        $projectDraft = ProjectDraft::create([
            'title' => '未命名',
            'cloud_id' => config('eetree.default_cloud.project_cover_image'),
            'has_agreement' => 0,
            'fund_goal' => 0,
            'promote' => 0,
            'description' => '',
            'user_id' => Auth::id(),
        ]);
        return $this->success(new ProjectDraftResource($projectDraft));
    }

    public function edit(ProjectDraft $projectDraft)
    {
        $projectDraft->checkPermission();

        return $this->success(new ProjectDraftResource($projectDraft));
    }

    /**
     * update project
     * @urlParam projectDraft 项目ID
     * @bodyParam  title string required 标题
     * @bodyParam  description string required 描述
     */
    public function update(ProjectDraft $projectDraft, ProjectDraftRequest $request)
    {
        $projectDraft->checkPermission();
        $projectDraft->checkEdit();

        $data = $request->validated();
        $tags = $data['tags'];
        unset($data['tags']);
        if (!empty($data['video_code'])) {
            $data['video_code'] = clean($data['video_code'], 'video');
        }
        if (!empty($data['description'])) {
            $data['description'] = clean($data['description']);
        }
        if (!Auth::user()->isAdmin()) {
            unset($data['has_agreement']);
            unset($data['agreement']);
            unset($data['rule']);
            if ($data['type'] == Enums::key('project.type.ACTIVITY')) {
                return $this->failed('您没有添加活动项目的权限');
            }
        }
        if ($data['type'] == Enums::key('project.type.SHARE')) {
            $data['fund_goal'] = 0;
        }
        $projectDraft->update($data);
        $tagIds = [];
        foreach ($tags as $tag) {
            if (is_int($tag)) {
                $tagIds[] = $tag;
            } else {
                $exist = Tag::where('name', $tag)->first();
                if ($exist) {
                    $tagIds[] = $exist->id;
                } else {
                    $tag = Tag::create([
                        'name' => $tag,
                    ]);
                    $tagIds[] = $tag->id;
                }
            }
        }
        $projectDraft->tags()->sync($tagIds);
        return $this->success(new ProjectDraftResource($projectDraft));
    }

    /**
     * update project
     * @urlParam projectDraft 项目ID
     * @bodyParam  products array required 产品ID列表
     */
    public function updateProducts(ProjectDraft $projectDraft, ProjectDraftRequest $request)
    {
        $projectDraft->checkPermission();
        $projectDraft->checkEdit();
        $data = $request->validated();
        $projectDraft->products()->sync($data['products']);
        if (!empty($data['vProducts'])) {
            $now = \Carbon\Carbon::now();
            $projectProducts = [];
            foreach ($data['vProducts'] as $vProduct) {
                $tmp = [];
                $valid = true;
                foreach (['vendor', 'name', 'description', 'link'] as $dataKey) {
                    if (isset($vProduct[$dataKey])) {
                        $tmp[$dataKey] = $vProduct[$dataKey];
                    } else {
                        $valid = false;
                        break;
                    }
                }
                $tmp['image'] = $vProduct['image'] ?: '';
                if (!$valid) {
                    continue;
                }
                $projectProducts[] = [
                    'project_draft_id' => $projectDraft->id,
                    'product_id' => 0,
                    'data' => json_encode($tmp),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            if (!empty($projectProducts)) {
                \App\Models\ProjectProductDraft::insert($projectProducts);
            }
        }
        return $this->success();
    }

    /**
     * update project
     * @urlParam projectDraft 项目ID
     * @bodyParam  clouds array required 文档ID列表
     */
    public function updateClouds(ProjectDraft $projectDraft, ProjectDraftRequest $request)
    {
        $projectDraft->checkPermission();
        $projectDraft->checkEdit();

        $data = $request->validated();

        $clouds = [];
        foreach ($data['clouds'] as $cloud) {
            if (is_numeric($cloud['id']) && in_array($cloud['type'], Enums::keys('project.cloudTypes'))) {
                $clouds[$cloud['id']] = ['type' => $cloud['type'], 'description' => isset($cloud['description']) ? $cloud['description'] : null];
            }
        }
        if (!empty($clouds)) {
            $projectDraft->clouds()->sync($clouds);
        }
        return $this->success();
    }

    /**
     * update project
     * @urlParam projectDraft 项目ID
     * @bodyParam  relates array required 关联项目ID列表
     */
    public function updateRelates(ProjectDraft $projectDraft, ProjectDraftRequest $request)
    {
        $projectDraft->checkPermission();
        $projectDraft->checkEdit();

        $data = $request->validated();

        if (!empty($data['relates'])) {
            $projectDraft->relates()->sync($data['relates']);
        }
        return $this->success();
    }

    /**
     * delete project
     * @urlParam projectDraft ID
     */
    public function delete(ProjectDraft $projectDraft)
    {
        $projectDraft->checkPermission();

        if ($projectDraft->project_id > 0) {
            return $this->failed('项目已发布，无法删除，请联系管理员');
        }
        $projectDraft->delete();

        return $this->success();
    }

    public function cancel(ProjectDraft $projectDraft, Request $request)
    {
        $projectDraft->unsetReview();

        return $this->success(new ProjectDraftResource($projectDraft));
    }

    public function publish(ProjectDraft $projectDraft, Request $request)
    {
        $checkRet = $this->_checkPublish($projectDraft);
        if ($checkRet === true) {
            $projectDraft->setReview();

            return $this->success();
        } else {
            return $this->failed($checkRet);
        }
    }

    private function _checkPublish($projectDraft)
    {
        if ($projectDraft->status == Enums::key('status.SUBMIT')) {
            return '项目正在审核中，请稍后再试';
        }
        foreach (['title', 'description'] as $key) {
            if (empty($projectDraft->$key)) {
                return '基本信息请补充完整';
            }
        }
        if ($projectDraft->type != Enums::key('project.type.SHARE')) {
            $goodsCnt = ProjectGoodsDraft::where('project_draft_id', $projectDraft->id)->count();
            if ($goodsCnt <= 0) {
                return '请添加商品';
            }
        }
        return true;
    }

    public function preview(ProjectDraft $projectDraft)
    {
        if ($projectDraft->user_id != Auth::id()) {
            $value = \Illuminate\Support\Facades\Cache::pull('ProjectDraft:Preview:' . $projectDraft->id);
            if (!$value) {
                abort(404);
            }
        }

        // project clouds
        $tmpClouds = $projectDraft->projectClouds()->get();
        // relates
        $relates = $projectDraft->relates()->get()->map(function ($item, $key) {
            return (Object) [
                'name' => $item->title,
                'description' => $item->summary,
                'cloud_id' => $item->cloud_id,
                'link' => route('project.detail', ['project' => $item->id]),
            ];
        });
        // products
        $tmpProducts = $projectDraft->products()->get();
        // vendor products
        $vProducts = ProjectProductDraft::where([
            ['project_draft_id', $projectDraft->id],
            ['product_id', 0],
        ])->withCasts(['data' => 'Object'])->get();
        // team
        $teams = $projectDraft->teams()->with('user')->get();
        // courses
        $courses = $projectDraft->courses()->get();
        // cases
        $cases = $projectDraft->cases()->get();
        // goods
        $goods = $projectDraft->goods()->get();
        // related projects
        $relatedProjects = \App\Helpers\Search::relatedProjects($projectDraft, 3);
        // get clouds
        $pItems = [$tmpClouds, $tmpProducts, $relates, $teams, $courses, $cases, $goods, $relatedProjects];
        $cloudIds = [$projectDraft->cloud_id];
        if ($projectDraft->college && $projectDraft->college->cloud_id) {
            $cloudIds = [$projectDraft->college->cloud_id];
        }
        foreach ($pItems as $items) {
            $cloudIds = array_merge($cloudIds, $items->pluck('cloud_id')->toArray());
        }
        $cloudIds = array_filter(array_unique($cloudIds), function ($item) {
            return $item > 0;
        });
        $clouds = [];
        if (!empty($cloudIds)) {
            $tmp = \App\Models\Cloud::whereIn('id', $cloudIds)->get();
            foreach ($tmp as $cloud) {
                $clouds[$cloud->id] = $cloud;
            }
        }
        if (isset($clouds[$projectDraft->cloud_id])) {
            $projectDraft->cloud = $clouds[$projectDraft->cloud_id];
        }
        if ($projectDraft->college && $projectDraft->college->cloud_id && isset($clouds[$projectDraft->college->cloud_id])) {
            $projectDraft->college->cloud = $clouds[$projectDraft->college->cloud_id];
        }
        foreach ($pItems as $items) {
            foreach ($items as $row) {
                if (isset($clouds[$row->cloud_id])) {
                    $row->cloud_fname = $clouds[$row->cloud_id]->fname;
                    $row->cloud_url = $clouds[$row->cloud_id]->url;
                } else {
                    $row->cloud_url = null;
                }
            }
        }

        $teams->each(function ($item) {
            if ($item->user) {
                $item->getFromUser('detail');
            }
        });

        $pClouds = [];
        foreach (Enums::get('project.cloudTypes') as $cloudKey => $cloudType) {
            $pClouds[$cloudKey] = [];
            foreach ($tmpClouds as $cloud) {
                if ($cloud->type == $cloudType['k']) {
                    $pClouds[$cloudKey][] = $cloud;
                }
            }
        }
        $products = [];
        foreach (Enums::get('product.types') as $productKey => $productType) {
            $products[$productKey] = [];
            foreach ($tmpProducts as $product) {
                if ($product->type == $productType['k']) {
                    $products[$productKey][] = $product;
                }
            }
        }
        if ($vProducts->isNotEmpty()) {
            if (!isset($products['COMPONENT'])) {
                $products['COMPONENT'] = [];
            }
            foreach ($vProducts as $vProduct) {
                $tmp = clone $vProduct->data;
                $tmp->cloud_url = $vProduct->data->image;
                $products['COMPONENT'][] = $tmp;
            }
        }

        $projectDraft->rate = 50;
        return view('project/preview', [
            'project' => $projectDraft,
            'schedules' => $projectDraft->schedules()->get(),
            'pClouds' => $pClouds,
            'products' => $products,
            'relates' => $relates,
            'teams' => $teams,
            'courses' => $courses,
            'cases' => $cases,
            'goods' => $goods,
            'relatedProjects' => $relatedProjects,
            'defaultTab' => $projectDraft->type == Enums::key('project.type.ACTIVITY') && $cases->isNotEmpty() ? 'case' : 'basic',
        ]);
    }
}
