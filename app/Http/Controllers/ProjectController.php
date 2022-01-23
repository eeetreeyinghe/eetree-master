<?php

namespace App\Http\Controllers;

use App\Helpers\Enums;
use App\Helpers\Search;
use App\Models\Favorite;
use App\Models\Platform;
use App\Models\Project;
use App\Models\ProjectProduct;
use App\Models\ProjectTop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends ApiController
{
    public function all(Request $request)
    {
        $title = $request->input('title');
        $excludeId = (int) $request->input('exclude');
        $where = [
            ['last_publish_at', '<>', null],
        ];
        if ($title) {
            $where[] = ['title', 'like', '%' . $title . '%'];
        }
        if ($excludeId) {
            $where[] = ['id', '<>', $excludeId];
        }
        $projects = Project::with('cloud')
            ->where($where)
            ->paginate(config('eetree.limit'));
        $collection = $projects->map(function ($item, $key) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'summary' => $item->summary,
                'image' => $item->cloud->url,
                'url' => route('project.detail', ['project' => $item->id]),
            ];
        });
        return $this->success($collection);
    }

    public function index(Request $request)
    {
        $projects = Search::project($request->all());
        if ($projects->currentPage() == 1) {
            $topProjects = ProjectTop::getTops();
            $topProjectIds = $topProjects->pluck('id');
            if ($topProjectIds && $projects->isNotEmpty()) {
                $filters = $projects->filter(function ($value, $key) use ($topProjectIds) {
                    return !$topProjectIds->contains($value->id);
                });
                $projects->setCollection($filters);
            }
        }
        return view('project/index', [
            'pageId' => 'project',
            'searchQ' => $request->input('q') ?: '',
            'searchParams' => $request->all(),
            'pageTitle' => '最新项目',
            'topProjects' => isset($topProjects) ? $topProjects : collect(),
            'projects' => $projects,
            'platforms' => Platform::allPlatforms(),
            'projectEnums' => [
                'type' => Enums::values('project.type'),
            ],
        ]);
    }

    public function detail(Project $project, Request $request)
    {
        if (!$project->last_publish_at) {
            abort(404);
        }
        // project clouds
        $tmpClouds = $project->clouds()->get();
        // relates
        $relates = $project->relates()->get()->map(function ($item, $key) {
            return (Object) [
                'name' => $item->title,
                'description' => $item->summary,
                'cloud_id' => $item->cloud_id,
                'link' => route('project.detail', ['project' => $item->id]),
            ];
        });
        // products
        $tmpProducts = $project->products()->get();
        // vendor products
        $vProducts = ProjectProduct::where([
            ['project_id', $project->id],
            ['product_id', 0],
        ])->withCasts(['data' => 'Object'])->get();
        // team
        $teams = $project->teams()->with('user')->get();
        // courses
        $courses = $project->courses()->get();
        // cases
        $cases = $project->cases()->get();
        $caseProjects = $project->caseProjects()->get();
        $caseProjects->each(function ($element) use ($cases) {
            $cases->push((object) [
                'title' => $element->title,
                'cloud_id' => $element->cloud_id,
                'description' => $element->summary,
                'link' => route('project.detail', ['project' => $element]),
            ]);
        });
        $cases = $cases->shuffle();
        // goods
        $goods = $project->goods()->get();
        // related projects
        $relatedProjects = \App\Helpers\Search::relatedProjects($project, 3);
        // get clouds
        $pItems = [$tmpClouds, $tmpProducts, $relates, $teams, $courses, $cases, $goods, $relatedProjects];
        $cloudIds = [$project->cloud_id];
        if ($project->college && $project->college->cloud_id) {
            $cloudIds = [$project->college->cloud_id];
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
        if (isset($clouds[$project->cloud_id])) {
            $project->cloud = $clouds[$project->cloud_id];
        }
        if ($project->college && $project->college->cloud_id && isset($clouds[$project->college->cloud_id])) {
            $project->college->cloud = $clouds[$project->college->cloud_id];
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
                    // download attachment
                    if ($cloudKey == 'ATTACHMENT' && $cloud->cloud_url) {
                        $cloud->cloud_url .= '?attname=' . urlencode($cloud->cloud_fname);
                    }
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
        if ($project->promote == 1) {
            $promoteGoods = \App\Models\GoodsPromote::getPromotes($project->user_id, $goods->pluck('id')->toArray());
        } else {
            $promoteGoods = collect([]);
        }
        $userId = Auth::id();
        if ($userId) {
            $favorite = Favorite::where([
                ['fav_id', $project->id],
                ['type', Enums::key('types.PROJECT')],
                ['user_id', $userId],
            ])->first();
        }
        $project->favorite_id = empty($favorite) ? 0 : $favorite->id;

        $project->increment('view_count');

        $now = \Carbon\Carbon::now();
        $viewData = [
            'metaTitle' => $project->title,
            'project' => $project,
            'prjActive' => (!$project->start_at || $project->start_at < $now) && (!$project->end_at || $project->end_at > $now),
            'schedules' => $project->schedules()->orderBy('submit_at', 'asc')->get(),
            'pClouds' => $pClouds,
            'products' => $products,
            'relates' => $relates,
            'teams' => $teams,
            'courses' => $courses,
            'cases' => $cases,
            'goods' => $goods,
            'promoteGoods' => $promoteGoods,
            'relatedProjects' => $relatedProjects,
            'defaultTab' => $project->type == Enums::key('project.type.ACTIVITY') && $cases->isNotEmpty() ? 'case' : 'basic',
            'projectType' => Enums::key('types.PROJECT'),
        ];
        $agent = new \Jenssegers\Agent\Agent();
        if ($agent->match('MicroMessenger')) {
            $wx = \EasyWeChat::officialAccount();
            $viewData['wxJssdk'] = $wx->jssdk->buildConfig(array('updateAppMessageShareData', 'updateTimelineShareData'));
        }
        return view('project/detail', $viewData);
    }
}
