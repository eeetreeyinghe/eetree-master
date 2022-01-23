<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectScheduleResource;
use App\Models\ProjectSchedule;
use Illuminate\Http\Request;

/**
 * @group schedules
 * 进度列表
 */
class ProjectScheduleController extends ApiController
{
    /**
     * list schedules
     * @queryParam  pid required 项目ID
     */
    public function index(Request $request)
    {
        $projectId = (int) $request->input('pid');
        $projectSchedules = ProjectSchedule::where('project_id', $projectId)->get();
        return $this->success(ProjectScheduleResource::collection($projectSchedules));
    }
}
