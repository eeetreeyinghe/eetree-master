<?php

namespace App\Http\Controllers;

use App\Helpers\RecommendHelper;
use App\Helpers\Search;
use App\Http\Resources\DocResource;
use App\Models\Category;
use App\Models\Doc;
use App\Models\DocCategory;
use App\Models\DocHistory;
use App\Models\DocTop;
use App\Models\Favorite;
use App\Models\Likes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class DocController extends ApiController
{
    public function index(Request $request)
    {
        $params = $request->all();
        $docs = Search::doc($params);
        if ($docs->currentPage() == 1) {
            $topDocs = DocTop::getTops([['page_index', 1]]);
            $topDocIds = $topDocs->pluck('id');
            if ($topDocIds && $docs->isNotEmpty()) {
                $filters = $docs->filter(function ($value, $key) use ($topDocIds) {
                    return !$topDocIds->contains($value->id);
                });
                $docs->setCollection($filters);
            }
        }
        return view('doc/index', [
            'pageId' => 'doc',
            'searchQ' => isset($params['q']) ? $params['q'] : '',
            'pageTitle' => empty($params['q']) ? '最新文档' : "\"${params['q']}\"的搜索结果",
            'topDocs' => isset($topDocs) ? $topDocs : collect(),
            'docs' => $docs,
            'hotTags' => RecommendHelper::getRecommends('recommend.area.HOT_TAG'),
        ]);
    }

    public function test(Request $request)
    {
        abort(403);
        return view('test');
    }

    public function detail(Doc $doc, Request $request)
    {
        $from = $request->input('from');
        if (!$doc->publish_at) {
            abort(404);
        }
        $userId = Auth::id();
        if ($userId) {
            $favorite = Favorite::where([
                ['fav_id', $doc->id],
                ['user_id', $userId],
            ])->first();
            $like = Likes::where([
                ['like_id', $doc->id],
                ['user_id', $userId],
            ])->first();
        }
        $docCategory = DocCategory::where('doc_id', $doc->id)->first();
        $doc->increment('view_count');
        if ($from === 't') {
            // from doc top
            DocTop::where('top_id', $doc->id)->increment('click_count');
        }

        $doc->favorite_id = empty($favorite) ? 0 : $favorite->id;
        $doc->like_id = empty($like) ? 0 : $like->id;

        $useJs = true;
        $agent = new Agent();
        if ($agent->isRobot()) {
            $useJs = false;
        } else {
            $browser = $agent->browser();
            if ($browser == 'IE') {
                $version = $agent->version($browser);
                if ((float) $version < 9) {
                    $useJs = false;
                }
            }
        }

        //weixin
        $viewData = [
            'useJs' => $useJs,
            'doc' => $doc,
            'docUser' => User::find($doc->user_id),
            'docHistory' => DocHistory::where('doc_id', $doc->id)->get(),
            'docBreadcrumbs' => empty($docCategory) ? [] : Category::breadcrumbs($docCategory->category_id),
        ];

        if ($agent->match('MicroMessenger')) {
            $wx = \EasyWeChat::officialAccount();
            $viewData['wxJssdk'] = $wx->jssdk->buildConfig(array('updateAppMessageShareData', 'updateTimelineShareData'));
        }
        return view('doc/detail', $viewData);
    }

    public function mindmap(Doc $doc)
    {
        if (!$doc->publish_at) {
            abort(404);
        }
        return view('doc/mindmap', [
            'doc' => $doc,
        ]);
    }

    public function doclist(Request $request)
    {
        $q = $request->input('q');
        $where = [];
        if (!empty($q)) {
            $where[] = ['title', 'like', '%' . $q . '%'];
        }
        $docs = Doc::where($where)->paginate(config('eetree.limit'));
        return $this->success(DocResource::collection($docs));
    }

    public function templates()
    {
        return $this->success(config('eetree.templates'));
    }

    public function lock(Doc $doc)
    {
        if ($doc->publish_at) {
            $doc->publish_at = null;
        } else {
            $doc->publish_at = \Carbon\Carbon::now();
        }
        $doc->save();
        return $this->success();
    }
}
