<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\XformRequest;
use App\Http\Resources\Api\XformResource;
use App\Models\Xform;
use Illuminate\Http\Request;

class XformController extends Controller
{
    //返回平台列表
    public function index(Request $request)
    {
        $title = $request->input('title');
        $simple = $request->input('simple');
        $where = [];
        if ($title) {
            $where[] = ['name', 'like', '%' . $title . '%'];
        }
        $query = Xform::where($where);
        if ($simple) {
            $query->select('id', 'name');
        }
        $xforms = $query->orderBy('id')->get();
        return $this->success(XformResource::collection($xforms));
    }

    //删除平台
    public function delete(Xform $xform)
    {
        $xform->delete();
        return $this->success();
    }

    public function store(XformRequest $request)
    {
        $data = $request->validated();
        $xform = Xform::create($data);
        return $this->success(new XformResource($xform));
    }

    public function update(Xform $xform, XformRequest $request)
    {
        $data = $request->validated();
        $xform->update($data);
        return $this->success();
    }
}
