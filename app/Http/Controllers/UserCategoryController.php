<?php

namespace App\Http\Controllers;

use App\Helpers\Tree;
use App\Http\Requests\Api\UserCategoryRequest;
use App\Http\Resources\DocDraftResource;
use App\Http\Resources\UserCategoryResource;
use App\Models\Doc;
use App\Models\DocDraft;
use App\Models\UserCategory;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCategoryController extends ApiController
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        $categories = UserCategory::where([
            ['user_id', $userId],
        ])->orderBy('order', 'asc')->get();

        return $this->success(UserCategoryResource::collection($categories));
    }

    public function folder(UserCategory $category = null, Request $request)
    {
        $userId = Auth::id();
        $parentId = $category ? $category->id : 0;

        $categories = UserCategory::where([
            ['user_id', $userId],
            ['parent_id', $parentId],
        ])->orderBy('order', 'asc')->get();

        $docs = DocDraft::with('tags')
            ->where([
                ['user_id', $userId],
                ['user_category_id', $parentId],
                ['type', Doc::TYPE_DOC],
            ])->orderBy('last_edit_at', 'desc')->get();

        return $this->success([
            'category' => $category ? new UserCategoryResource($category) : [],
            'categories' => UserCategoryResource::collection($categories),
            'docs' => DocDraftResource::collection($docs),
        ]);
    }

    public function store(UserCategoryRequest $request)
    {
        $userId = Auth::id();
        $data = $request->validated();
        $parentId = $data['parent_id'];
        $cCount = UserCategory::where([
            ['user_id', $userId],
            ['parent_id', $parentId],
        ])->count();
        $dCount = DocDraft::where([
            ['user_id', $userId],
            ['user_category_id', $parentId],
        ])->count();
        if ($cCount > 0 && $cCount + $dCount >= config('eetree.usercategory.max')) {
            return $this->failed('当前文件夹已满，无法创建');
        }
        $data['order'] = $cCount;
        $category = new UserCategory;
        $category->fill($data);
        $category->user_id = $userId;
        $category->last_edit_at = Carbon::now();
        $category->save();
        return $this->success(new UserCategoryResource($category));
    }

    public function update(UserCategory $category, UserCategoryRequest $request)
    {
        $this->_checkCategory($category);
        $data = $request->validated();
        $category->fill($data);
        $category->last_edit_at = Carbon::now();
        $category->save();
        return $this->success(new UserCategoryResource($category));
    }

    public function delete(UserCategory $category)
    {
        $this->_checkCategory($category);
        $userId = Auth::id();
        $all = UserCategory::getTree($userId);
        $subTree = Tree::children($all, $category->id);
        $deleteIds = Tree::ids($subTree);
        $deleteIds[] = $category->id;
        \DB::transaction(function () use ($category, $deleteIds) {
            UserCategory::whereIn('id', $deleteIds)->delete();
            UserCategory::where('parent_id', $category->parent_id)
                ->where('order', '>', $category->order)
                ->decrement('order');
        });

        return $this->success();
    }

    public function move(UserCategory $category, Request $request)
    {
        $userId = Auth::id();
        $this->_checkCategory($category);
        $destId = (int) $request->input('dest');
        if ($category->id === $destId || $category->parent_id === $destId) {
            return $this->failed('参数有误');
        }
        if ($destId !== 0) {
            $destCategory = UserCategory::find($destId);
            if ($destCategory->user_id !== $userId) {
                return $this->failed('参数有误');
            }
        }
        DB::transaction(function () use ($category, $destId, $userId) {
            UserCategory::where('parent_id', $category->parent_id)
                ->where('order', '>', $category->order)
                ->decrement('order');
            // inner
            $order = UserCategory::where([
                ['user_id', $userId],
                ['parent_id', $destId],
            ])->count();
            $category->update(['parent_id' => $destId, 'order' => $order]);
        });

        return $this->success();
    }

    private function _checkCategory($category)
    {
        $userId = Auth::id();
        if ($category->user_id != $userId) {
            abort(403);
        }
    }
}
