<?php

namespace App\Http\Controllers;

use App\Helpers\RecommendHelper;
use App\Helpers\Search;
use App\Models\Category;
use App\Models\Doc;
use App\Models\DocTop;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Category $category, Request $request)
    {
        $params = $request->all();
        $params['category_id'] = $category->descendantIds();
        $params['category_id'][] = $category->id;
        $docs = Search::doc($params);
        if ($docs->currentPage() == 1) {
            $topDocs = DocTop::getTops([['page_category', 1]], $params['category_id']);
            $topDocIds = $topDocs->pluck('id');
            if ($topDocIds && $docs->isNotEmpty()) {
                $filters = $docs->filter(function ($value, $key) use ($topDocIds) {
                    return !$topDocIds->contains($value->id);
                });
                $docs->setCollection($filters);
            }
        }

        return view('doc/index', [
            'pageId' => 'category',
            'metaTitle' => '分类 - ' . $category->name,
            'pageTitle' => $category->name,
            'docs' => $docs,
            'topDocs' => isset($topDocs) ? $topDocs : collect(),
            'hotTags' => RecommendHelper::getRecommends('recommend.area.HOT_TAG'),
        ]);
    }
}
