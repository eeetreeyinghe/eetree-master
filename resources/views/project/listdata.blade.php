<div class="content-list">
    <a href="{{ $project->link ?: route('project.detail', ['project' => $project->id]) }}" target="_blank">
        <img class="content-list-img" src="{{ $project->cloud->url }}" alt="{{ $project->title }}">
    </a>
    <div class="content-list-desc">
        <a href="{{ $project->link ?: route('project.detail', ['project' => $project->id]) }}" target="_blank" class="max-height-90">
            <h4 class="title">{{ $project->title }}</h4>
            <p class="description">@if (!empty($project->summary)) {{ $project->summary }} @else {{ mb_substr(strip_tags($project->description), 0, 120) }} @endif</p>
        </a>
    </div>
    <ul class="list-desc-bottom flex flex-center-v">
        <li>
            <img class="avatar margin-r-8" src="{{ $project->user->avatar }}">
            <span>{{ $project->user->nickname }}</span>
        </li>
        <li>
            <i class="el-icon-view margin-r-8"></i>
            <span>{{ $project->view_count }}</span>
        </li>
        <li>
            <i class="el-icon-time margin-r-8"></i>
            <span>{{ $project->last_publish_at->format('y/m/d') }}</span>
        </li>
    </ul>
</div>
