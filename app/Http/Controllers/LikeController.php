<?php

namespace App\Http\Controllers;

use App\Helpers\Enums;
use App\Models\Likes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @group likes
 * 收藏接口
 */
class LikeController extends ApiController
{
    /**
     * add like
     * @bodyParam  like_id int required 目标ID
     * @bodyParam  type int 收藏类型
     */
    public function store(Request $request)
    {
        $likeId = (int) $request->input('like_id');
        $type = (int) $request->input('type', Enums::key('types.DOC'));
        if ($likeId <= 0 || !in_array($type, Enums::keys('types'))) {
            abort(500);
        }
        $response = [];
        \DB::transaction(function () use ($likeId, $type, &$response) {
            $like = Likes::create([
                'user_id' => Auth::id(),
                'like_id' => $likeId,
                'type' => $type,
            ]);
            $like->liked();
            $response = [
                'id' => $like->id,
            ];
        });

        return $this->success($response);
    }

    /**
     * cancel like
     * @urlParam like required id
     */
    public function delete(Likes $like)
    {
        \DB::transaction(function () use ($like) {
            $this->_checkLike($like);
            $like->unliked();
            $like->delete();
        });

        return $this->success();
    }

    private function _checkLike($like)
    {
        $userId = Auth::id();
        if ($like->user_id != $userId) {
            abort(403);
        }
    }
}
