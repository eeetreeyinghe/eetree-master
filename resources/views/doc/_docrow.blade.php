@empty($node['children'])
    <div>
@else
    <div class="has-child">
@endempty
        <div class="title no-child">
            <span class="dot-content"></span>
            <span class="dot"></span>
            @isset($node['data']['hyperlink'])
                <a href="{{ $node['data']['hyperlink'] }}" target="_blank">{{ $node['data']['text'] }}</a>
            @else
                {{ $node['data']['text'] }}
            @endisset
            @isset($node['data']['note'])
                <i class="fa fa-file-text-o noteicon"></i>
                <p class="previewer-content d-none">{{ $node['data']['note'] }}</p>
            @endisset
            @isset($node['data']['image'])
                <img src="{{ $node['data']['image'] }}">
            @endisset
            @isset($node['data']['video'])
                <div class="doc-video">{!! $node['data']['video'] !!}</div>
            @endisset
        </div>
        @if (!empty($node['children']))
        <div class="card-list card-list-{{$depth}}">
            @foreach($node['children'] as $row)
                @include('doc/_docrow', ['node' => $row, 'depth' => ++$depth])
            @endforeach
        </div>
        @endif
    </div>
