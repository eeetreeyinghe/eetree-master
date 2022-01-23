<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\PlatformRequest;
use App\Http\Resources\Api\PlatformResource;
use App\Models\Platform;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    //返回平台列表
    public function index(Request $request)
    {
        $platforms = Platform::orderBy('order', 'asc')->orderBy('id')->get();
        return $this->success(PlatformResource::collection($platforms));
    }

    //删除平台
    public function delete(Platform $platform)
    {
        Platform::where('order', '>', $platform->order)->decrement('order');
        $platform->delete();
        Platform::clear();
        return $this->success();
    }

    public function store(PlatformRequest $request)
    {
        $data = $request->validated();
        if ($data['order'] == 0) {
            $data['order'] = 1;
        }
        Platform::where('order', '>=', $data['order'])->increment('order');
        $platform = Platform::create($data);
        Platform::clear();
        return $this->success(new PlatformResource($platform));
    }

    public function update(Platform $platform, PlatformRequest $request)
    {
        $data = $request->validated();
        if (isset($data['move_id'])) {
            $movePlatform = Platform::find($data['move_id']);
            if (!$movePlatform) {
                $this->failed('出错了');
            }
            $changeOrder = $platform->order;
            $platform->update(['order' => $movePlatform->order]);
            $movePlatform->update(['order' => $changeOrder]);
        } else {
            $platform->update($data);
        }
        Platform::clear();
        return $this->success();
    }
}
