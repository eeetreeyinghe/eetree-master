<?php

namespace App\Http\Controllers\Api;

use App\Helpers\DBHelper;
use App\Helpers\Enums;
use App\Http\Requests\Api\ProjectReviewRequest;
use App\Http\Resources\Api\ProjectDraftResource;
use App\Models\Notice;
use App\Models\Project;
use App\Models\ProjectDraft;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProjectDraftController extends Controller
{
    //返回项目列表
    public function index(Request $request)
    {
        $status = (int) $request->input('status');
        $title = $request->input('title');
        $where = [
            ['status', $status],
        ];
        if ($title) {
            $where[] = ['title', 'like', '%' . $title . '%'];
        }

        $projects = ProjectDraft::with(['user', 'project:id,pid'])
            ->orderBy('id', 'desc')
            ->where($where)
            ->paginate(config('eetree.adminLimit'));
        return $this->success(ProjectDraftResource::collection($projects));
    }

    public function review(ProjectDraft $projectDraft, ProjectReviewRequest $request)
    {
        if (empty($projectDraft) || !in_array($projectDraft->status, [Enums::key('status.SUBMIT'), Enums::key('status.REFUSE')])) {
            return $this->failed('参数有误');
        }
        \DB::transaction(function () use ($request, $projectDraft) {
            $data = $request->validated();
            $data['status'] = (int) $data['status'];
            if ($data['status'] === Enums::key('status.PASS')) {
                $isNew = false;
                if ($projectDraft->project_id) {
                    $project = Project::find($projectDraft->project_id);
                } else {
                    $isNew = true;
                    $project = new Project;
                    $project->user_id = $projectDraft->user_id;
                    $project->first_publish_at = Carbon::now();
                }
                $project->title = $projectDraft->title;
                $project->summary = $projectDraft->summary;
                $project->description = $projectDraft->description;
                $project->rule = $projectDraft->rule;
                $project->has_agreement = $projectDraft->has_agreement;
                $project->agreement = $projectDraft->agreement;
                $project->video_code = $projectDraft->video_code;
                $project->cloud_id = $projectDraft->cloud_id;
                $project->type = $projectDraft->type;
                $project->start_at = $projectDraft->start_at;
                $project->end_at = $projectDraft->end_at;
                $project->fund_goal = $projectDraft->fund_goal;
                $project->platform_id = $projectDraft->platform_id;
                $project->college_id = $projectDraft->college_id;
                $project->team_intro = $projectDraft->team_intro;
                $project->promote = $projectDraft->promote;
                $project->last_publish_at = Carbon::now();
                $project->pid = $data['pid'];
                $schedules = \App\Models\ProjectScheduleDraft::where('project_draft_id', $projectDraft->id)->get();

                $project->schedule_count = $schedules->count();
                $project->save();

                if ($isNew) {
                    $data['project_id'] = $project->id;
                }
                unset($data['pid']);
                $projectDraft->update($data);

                // 草稿 => 上线
                DBHelper::syncProject('project_schedule', $isNew, $project->id, $schedules);
                DBHelper::syncProject('project_course', $isNew, $project->id, \App\Models\ProjectCourseDraft::where('project_draft_id', $projectDraft->id)->get());
                DBHelper::syncProject('project_case', $isNew, $project->id, \App\Models\ProjectCaseDraft::where('project_draft_id', $projectDraft->id)->get());
                DBHelper::syncProject('project_goods', $isNew, $project->id, \App\Models\ProjectGoodsDraft::where('project_draft_id', $projectDraft->id)->get());
                DBHelper::syncProject('project_cloud', $isNew, $project->id, \App\Models\ProjectCloudDraft::where('project_draft_id', $projectDraft->id)->get());
                DBHelper::syncProject('project_product', $isNew, $project->id, \App\Models\ProjectProductDraft::where('project_draft_id', $projectDraft->id)->get());
                DBHelper::syncProject('project_relate', $isNew, $project->id, \App\Models\ProjectRelateDraft::where('project_draft_id', $projectDraft->id)->get());
                DBHelper::syncProject('project_team', $isNew, $project->id, \App\Models\ProjectTeamDraft::where('project_draft_id', $projectDraft->id)->get());
                // tags
                $project->tags()->sync($projectDraft->tags->pluck('id')->toArray());

                Notice::create(array(
                    'user_id' => $project->user_id,
                    'content' => sprintf(config('notices.project_passed'), $projectDraft->title, route('project.detail', ['project' => $project->id])),
                ));
            } else {
                $projectDraft->update($data);
                Notice::create(array(
                    'user_id' => $projectDraft->user_id,
                    'content' => sprintf(config('notices.project_refused'), $projectDraft->title, sprintf('%s%s/%d', route('user.center'), config('eetree.ucenter.project_edit'), $projectDraft->id), $projectDraft->review_remarks),
                ));
            }
        });
        return $this->success();
    }

    public function previewKey(ProjectDraft $projectDraft)
    {
        \Illuminate\Support\Facades\Cache::put('ProjectDraft:Preview:' . $projectDraft->id, 1, 60);
        return $this->success(['url' => route('projectDraft.preview', ['projectDraft' => $projectDraft->id])]);
    }
}
