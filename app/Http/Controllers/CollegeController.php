<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\Project;
use Illuminate\Http\Request;

/**
 * @group project
 * 高校
 */
class CollegeController extends ApiController
{
    /**
     * list colleges
     */
    public function index(Request $request)
    {
        $q = $request->input('q');
        $id = (int) $request->input('id');
        $where = [];
        if ($q) {
            $where[] = ['name', 'like', '%' . $q . '%'];
        }
        $colleges = College::select('id', 'name')->where($where)->orderBy('id', 'asc')->limit(20)->get();
        if ($id) {
            $defCollege = College::select('id', 'name')->find($id);
            $colleges->prepend($defCollege);
        }
        return $this->success($colleges);
    }

    public function detail(College $college)
    {
        $items = Project::with(['cloud', 'user:id,avatar,nickname'])->where('college_id', $college->id)->whereNotNull('last_publish_at')->orderBy('last_publish_at', 'desc')->paginate(config('eetree.limit'));

        return view('college/detail', [
            'college' => $college,
            'items' => $items,
        ]);
    }
}
