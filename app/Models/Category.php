<?php

namespace App\Models;

use App\Helpers\Tree;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    protected $table = 'category';

    protected $fillable = [
        'parent_id', 'name', 'order',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }

    public static function getTree($clearCache = false)
    {
        if ($clearCache) {
            static::clearTree();
        }
        return Cache::remember('category:tree', config('eetree.cache.ttl'), function () {
            $all = static::orderBy('order', 'asc')->get();
            return Tree::make($all);
        });
    }

    public static function clearTree()
    {
        Cache::forget('category:tree');
    }

    public function descendantIds($clearCache = false)
    {
        $tree = static::getTree($clearCache);
        $subTree = Tree::children($tree, $this->id);
        return Tree::ids($subTree);
    }

    public static function breadcrumbs($id)
    {
        $breadcrumbs = [];
        $tree = static::getTree();
        $parents = Tree::parents($tree, $id);
        if (!empty($parents)) {
            foreach ($parents as $category) {
                $breadcrumbs[] = [
                    'name' => $category->name,
                    'url' => route('category.list', ['category' => $category->id]),
                ];
            }
        }
        return $breadcrumbs;
    }

    public static function getNavs()
    {
        $tree = static::getTree();
        return static::formatNav($tree);
    }

    public static function formatNav($category)
    {
        return $category->map(function ($item) {
            $tmp = [
                'name' => $item->name,
                'url' => route('category.list', ['category' => $item->id]),
            ];
            if ($item->has('children') && $item->children->isNotEmpty()) {
                $tmp['children'] = static::formatNav($item->children);
            }
            return $tmp;
        });
    }
}
