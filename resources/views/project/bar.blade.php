@if ($project->type == config('enums.project.type.ACTIVITY.k') && $project->end_at)
<div role="progressbar" aria-valuenow="{{ $project->rate }}"
    aria-valuemin="0" aria-valuemax="100" class="el-progress el-progress--line el-progress--text-inside">
    <div class="el-progress-bar">
        <div class="el-progress-bar__outer" style="height:20px;">
            <div class="el-progress-bar__inner" style="width: {{ $project->rate > 100 ? 100 : $project->rate }}%;">
                <div class="el-progress-bar__innerTitle">进度</div>
                <div class="el-progress-bar__innerText">{{ $project->rate }}%</div>
            </div>
            <div class="el-progress-bar__rightText"></div>
        </div>
    </div>
</div>
@if ($project->end_at)
<div class="flex flex-center-v margin-b-15"><h4>时间</h4><h4 class="hover-color"> {{ $preview ? 'xxxx年xx月xx日 xx:xx - xxxx年xx月xx日 xx:xx' : $project->activedate }}</h4></div>
@endif

@elseif ($project->fund_goal > 0)
<div role="progressbar" aria-valuenow="{{ $project->rate }}"
    aria-valuemin="0" aria-valuemax="100" class="el-progress el-progress--line el-progress--text-inside">
    <div class="el-progress-bar">
        <div class="el-progress-bar__outer" style="height:20px;">
            <div class="el-progress-bar__inner" style="width: {{ $project->rate > 100 ? 100 : $project->rate }}%;">
                <div class="el-progress-bar__innerTitle">获得支持</div>
                <div class="el-progress-bar__innerText">{{ $project->rate }}%</div>
            </div>
            <div class="el-progress-bar__rightText"></div>
        </div>
    </div>
</div>
<div class="progress-bottom-text flex flex-between margin-b-15">
    <h4>目标 ¥{{ $project->fund_goal }}</h4>
    <h4>{{ $project->schedule_count > 0 ? '更新' . $project->schedule_count . '次' : '' }}</h4>
    <h4> {{ $preview ? 'xx' : $project->backers }}人 </h4>
</div>
@endif
<div class="flex flex-center-v margin-b-15">
    <a href="{{ route('user.home', ['user' => $project->user, 'tab' => 'projects']) }}"><img class="user-avatar" src="{{ $project->user->avatar }}"><span class="user-name">{{ $project->user->nickname }}</span></a>
</div>
<div class="flex flex-center-v margin-b-15"><h4>更新</h4><h4 class="hover-color"> {{ $preview ? 'xxxx年xx月xx日' : $project->last_publish_at->format('Y年m月d日') }}</h4></div>

@if ($project->tags->isNotEmpty())
<div class="flex flex-center-v margin-b-15 details-tags">
    <h4>标签</h4>
    <ul>
        @foreach ($project->tags as $tag)
        <li class="tag-btn">
            <a class="el-button el-button--default" href="{{ route('tag.items', ['tag' => $tag, 'type' => 'project']) }}" target="_blank">
                {{$tag->name}}
            </a>
        </li>
        @endforeach
    </ul>
</div>
@endif
@if ($project->fund_goal > 0)
<div class="price-ground flex flex-end-v">
    <div class="price-hover hover-color">¥{{ $preview ? 'xxx' : $project->fund_crowd }}</div>
    <h4 class="price-text">获得支持</h4>
</div>
@endif
