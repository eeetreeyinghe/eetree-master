<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CollegeRequest;
use App\Http\Resources\Api\CollegeResource;
use App\Models\College;
use Illuminate\Http\Request;

class CollegeController extends Controller
{
    //返回厂商列表
    public function index(Request $request)
    {
        $title = $request->input('title');
        $id = $request->input('id');
        $where = [];
        if ($title) {
            $where[] = ['name', 'like', '%' . $title . '%'];
        }
        $query = College::with(['cloud'])->where($where);
        if ($id) {
            $query->orWhere('id', $id);
        }
        $colleges = $query->orderBy('id', 'desc')->paginate(config('eetree.adminLimit'));
        return $this->success(CollegeResource::collection($colleges));
    }

    //删除厂商
    public function delete(College $college)
    {
        $college->delete();
        return $this->success();
    }

    public function store(CollegeRequest $request)
    {
        $data = $request->validated();
        $college = College::create($data);
        return $this->success(new CollegeResource($college));
    }

    public function update(College $college, CollegeRequest $request)
    {
        $data = $request->validated();
        $college->update($data);
        return $this->success(new CollegeResource($college));
    }
}
