<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ProjectRequest;
use App\Http\Requests\Api\ProjectTopRequest;
use App\Http\Resources\Api\ProjectResource;
use App\Models\Project;
use App\Models\ProjectTop;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //返回项目列表
    public function index(Request $request)
    {
        $sType = $request->input('sType');
        $publish = $request->input('publish', null);
        $title = $request->input('title');
        $simple = $request->input('simple');
        $type = $request->input('type');
        $where = [];
        if ($sType === 'top') {
            $where[] = ['project_top.is_top', 1];
        }
        if ($title) {
            $where[] = ['project.title', 'like', '%' . $title . '%'];
        }
        if ($publish) {
            $where[] = ['last_publish_at', '<>', null];
        }
        if ($type) {
            $where[] = ['type', $type];
        }
        if ($simple) {
            $projects = Project::where($where)->limit(config('eetree.adminLimit'))->get();
        } else {
            $projects = Project::with(['user', 'cloud'])
                ->leftJoin('project_top', 'project.id', 'project_top.top_id')
                ->select('project.*', 'threshold as dt_threshold', 'project_top.view_count as dt_view_count', 'project_top.click_count as dt_click_count', 'project_top.start_at as dt_start_at', 'project_top.end_at as dt_end_at', 'is_top as dt_is_top')
                ->orderBy('id', 'desc')
                ->where($where)
                ->paginate(config('eetree.adminLimit'));
        }
        return $this->success(ProjectResource::collection($projects));
    }

    private function publish($project)
    {
        if ($project->last_publish_at) {
            return $this->failed('失败，已是上线状态');
        }
        $project->last_publish_at = Carbon::now();
        $project->save();
        return $this->success();
    }

    private function unpublish($project)
    {
        if (!$project->last_publish_at) {
            return $this->failed('失败，已是下线状态');
        }
        $project->last_publish_at = null;
        $project->save();
        return $this->success();
    }

    public function update(Project $project, ProjectRequest $request)
    {
        $publish = (int) $request->input('publish');
        if ($publish === 1) {
            return $this->publish($project);
        } elseif ($publish === 0) {
            return $this->unpublish($project);
        }
        $project->update($request->validated());
        return $this->success();
    }

    public function top(Project $project, ProjectTopRequest $request)
    {
        $data = $request->validated();
        $projectTop = ProjectTop::where('top_id', $project->id)->first();
        if ($projectTop) {
            $projectTop->fill([
                'threshold' => $data['threshold'],
                'start_at' => $data['date'][0],
                'end_at' => $data['date'][1],
                'is_top' => 1,
                'toped_at' => Carbon::now(),
            ]);
            $projectTop->save();
        } else {
            ProjectTop::create([
                'top_id' => $project->id,
                'threshold' => $data['threshold'],
                'start_at' => $data['date'][0],
                'end_at' => $data['date'][1],
                'is_top' => 1,
                'toped_at' => Carbon::now(),
            ]);
        }
        return $this->success();
    }

    public function untop(Project $project)
    {
        ProjectTop::where('top_id', $project->id)->update(['is_top' => 0]);
        return $this->success();
    }
}
