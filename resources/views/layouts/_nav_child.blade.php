@foreach ($navs as $key=>$nav)
    @if (empty($nav['children']))
    <li class="submenu-new" data-index="{{$key}}"><a href="{{ $nav['url'] }}">{{ $nav['name'] }}</a></li>
    @else
    <li class="submenu-new" data-index="{{$key}}">
        <a tabindex="-1" href="{{ $nav['url'] }}">{{ $nav['name'] }}</a>
    </li>
    @endif
@endforeach
