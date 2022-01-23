<?php

namespace App\Http\Controllers;

use App\Helpers\Enums;
use App\Helpers\RecommendHelper;
use App\Helpers\Search;
use App\Models\Platform;
use App\Models\Tag;
use Illuminate\Http\Request;

/**
 * @group tag
 * 标签
 */
class TagController extends ApiController
{
    /**
     * search tag
     * @queryParam  q required 搜索词
     */
    public function find(Request $request)
    {
        $query = $request->input('q');
        $where = [
            ['type', Enums::key('tag.types.CLASSIFIED')],
        ];
        if ($query) {
            $where[] = ['name', 'like', $query . '%'];
        }

        $tags = Tag::select('id', 'name')
            ->where($where)
            ->limit(config('eetree.limit'))
            ->get();
        return $this->success($tags);
    }

    public function items(Request $request, Tag $tag, $type = 'doc')
    {
        $params = $request->all();
        $params['tag_id'] = $tag->id;
        if ($type === 'doc') {
            $docs = Search::doc($params);
            return view('doc/index', [
                'pageId' => 'tag',
                'currentTag' => $tag,
                'searchQ' => '',
                'pageTitle' => '标签-' . $tag->name,
                'docs' => $docs,
                'hotTags' => RecommendHelper::getRecommends('recommend.area.HOT_TAG'),
            ]);
        } elseif ($type === 'project') {
            $projects = Search::project($params);
            return view('project/index', [
                'pageId' => 'tag',
                'currentTag' => $tag,
                'searchQ' => '',
                'searchParams' => $request->all(),
                'pageTitle' => '标签-' . $tag->name,
                'projects' => $projects,
                'platforms' => Platform::allPlatforms(),
                'projectEnums' => [
                    'type' => Enums::values('project.type'),
                ],
            ]);
        } else {
            abort(404);
        }
    }
}
