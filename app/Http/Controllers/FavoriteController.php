<?php

namespace App\Http\Controllers;

use App\Helpers\Enums;
use App\Http\Resources\FavoriteResource;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @group favorites
 * 收藏接口
 */
class FavoriteController extends ApiController
{
    /**
     * list
     * @queryParam  type 类型（enums.types.DOC.k、enums.types.PROJECT.k）
     */
    public function index(Request $request)
    {
        $type = (int) $request->input('type', Enums::key('types.DOC'));
        if ($type == Enums::key('types.DOC')) {
            $model = Favorite::with('doc');
        } else {
            $model = Favorite::with('project');
        }
        $lists = $model->where('user_id', Auth::id())
            ->where('type', $type)
            ->orderBy('created_at', 'desc')
            ->paginate(config('eetree.limit'));
        return $this->success(FavoriteResource::collection($lists));
    }

    /**
     * add favorites
     * @bodyParam  fav_id int required 目标ID
     * @bodyParam  type int 收藏类型
     */
    public function store(Request $request)
    {
        $favId = (int) $request->input('fav_id');
        $type = (int) $request->input('type', Enums::key('types.DOC'));
        if ($favId <= 0 || !in_array($type, Enums::keys('types'))) {
            abort(500);
        }
        $response = [];
        \DB::transaction(function () use ($favId, $type, &$response) {
            $favorite = Favorite::create([
                'user_id' => Auth::id(),
                'fav_id' => $favId,
                'type' => $type,
            ]);
            $favorite->favorited();
            $response = [
                'id' => $favorite->id,
            ];
        });

        return $this->success($response);
    }

    /**
     * cancel favorites
     * @urlParam favorite required id
     */
    public function delete(Favorite $favorite)
    {
        \DB::transaction(function () use ($favorite) {
            $this->_checkFavorite($favorite);
            $favorite->unfavorited();
            $favorite->delete();
        });

        return $this->success();
    }

    private function _checkFavorite($favorite)
    {
        $userId = Auth::id();
        if ($favorite->user_id != $userId) {
            abort(403);
        }
    }
}
