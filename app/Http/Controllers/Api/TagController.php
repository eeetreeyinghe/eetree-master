<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Enums;
use App\Http\Requests\Api\TagRequest;
use App\Http\Resources\Api\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    //返回平台列表
    public function index(Request $request)
    {
        $title = $request->input('title');
        $where = [];
        if ($title) {
            $where[] = ['name', 'like', '%' . $title . '%'];
        }
        if ($request->input('ptag') === '0') {
            $tags = Tag::where($where)->orderBy('id', 'desc')->paginate(config('eetree.adminLimit'));
        } else {
            $tags = Tag::with('ptag')->where($where)->orderBy('id', 'desc')->paginate(config('eetree.adminLimit'));
        }
        return $this->success(TagResource::collection($tags));
    }

    //删除平台
    public function delete(Tag $tag)
    {
        $tag->delete();
        Tag::where('pid', $tag->id)->update(['pid' => 0]);
        return $this->success();
    }

    public function store(TagRequest $request)
    {
        $data = $request->validated();
        $data['type'] = Enums::key('tag.types.CLASSIFIED');
        $tag = Tag::create($data);
        return $this->success(new TagResource($tag));
    }

    public function update(Tag $tag, TagRequest $request)
    {
        $data = $request->validated();
        if (isset($data['pid']) && $data['pid'] == $tag->id) {
            return $this->failed('不能归类到本身');
        }
        if (isset($data['pid'])) {
            $ptag = Tag::find($data['pid']);
            if (!$ptag) {
                return $this->failed('参数有误');
            }
            if ($ptag->type != Enums::key('tag.types.CLASSIFIED')) {
                $ptag->update(['type' => Enums::key('tag.types.CLASSIFIED')]);
            }
        }
        if (isset($data['type']) && $data['type'] == Enums::key('tag.types.USER')) {
            $hasChildren = Tag::where('pid', $tag->id)->count();
            if ($hasChildren > 0) {
                return $this->failed('已有标签归类于本标签，不能修改类型');
            }
        }
        $tag->update($data);
        return $this->success(new TagResource($tag));
    }
}
