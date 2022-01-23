<nav class="phone-hide navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <div class="navbar-nav mr-auto">
                <div class="nav-item dropdown">
                    <!-- aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" -->
                    <a class="nav-link dropdown-toggle" href="{{ route('explore.doc') }}" role="button"  >
                        文档<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-nocart" role="menu" aria-labelledby="dropdownMenu">
                    @foreach($navs as $nav)
                        @if (empty($nav['children']))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $nav['url'] }}">{{ $nav['name'] }}</a>
                            </li>
                        @else
                            <li class="dropdown-submenu">
                                <a tabindex="-1" class="dropdown-item" href="{{ $nav['url'] }}">{{ $nav['name'] }}</a>
                                <ul class="dropdown-menu dropdown-menu-new">
                                    <div class="menu-new-part">
                                        @include('layouts/_nav_child', ['navs' => $nav['children']])
                                    </div>
                                </ul>
                            </li>
                        @endif
                    @endforeach
                    </ul>
                </div>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('explore.project') }}">项目</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/wiki" target="_blank">百科</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="@if($isWeixin) //wxb04f9fe0f7b92b52.h5.xiaoe-tech.com @else //class.eetree.cn @endif" target="_blank">硬禾学堂</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/war/circuitjs.html?lang=zh" target="_blank">电路仿真</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="//bbs.eetree.cn" target="_blank">论坛</a>
                </li>
            </div>
            <form id="navSearch" class="navbar-search form-inline mt-2 mt-md-0" action="{{ route('explore.doc') }}">
                <input class="form-control navbar-search-q" type="text" name="q" placeholder="请输入关键词" aria-label="Search" value="@isset($searchQ){{ $searchQ }}@endisset">
                <img class="navbar-search-btn" src="/img/icons/search-icon.svg">
            </form>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.center') }}">发布项目</a>
                </li>
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link no-login" href="{{ route('login') }}">登录</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">注册</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item flex flex-center-v">
                        <a class="nav-link" title="@if($noticeUnread){{ $noticeUnread }}条新消息@endif" href="{{ route('user.center') }}#/notice/list">
                            <div class="el-badge item">
                                <i class="el-icon-bell" style="font-size:20px;" aria-hidden="true"></i>
                                @if($noticeUnread)
                                <sup class="el-badge__content el-badge__content--undefined is-fixed">
                                    {{ $noticeUnread }}
                                </sup>
                                @endif
                            </div>
                        </a>
                    </li>
                    <li class="nav-item dropdown user-name-dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <img class="user-avatar"  src="{{ Auth::user()->avatar }}"><span class="user-name">{{ Auth::user()->nickname }}</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('user.center') }}">
                                <i class="el-icon-user-solid"></i>
                                个人中心
                            </a>
                            <!-- <a class="dropdown-item" href="{{ route('user.center') }}">我的文档</a> -->
                            <a class="dropdown-item" href="{{ route('user.home', ['user' => Auth::id()]) }}">
                                <i class="el-icon-data-board"></i>
                                我的主页
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="el-icon-switch-button"></i>
                                登出
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<div class="phone-show phone-navbar-new">
    <div class="border-t-b flex flex-between flex-center-v">
        <a class="logo-left" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <div class="form-right flex flex-between flex-center-v">
            <form id="navSearch"  action="{{ route('explore.doc') }}">
                <input class="form-control navbar-search-q" type="text" name="q" placeholder="请输入关键词" aria-label="Search" value="@isset($searchQ){{ $searchQ }}@endisset">
                <img class="navbar-search-btn" src="/img/icons/search-icon.svg">
            </form>
            <ul class="right-list">
            @guest
                <li class="nav-item">
                    <a class="nav-link no-login" href="{{ route('login') }}">登录</a>
                </li>
            @else
                <li class="nav-item"><img class="user-avatar"  src="{{ Auth::user()->avatar }}"></li>
            @endguest
            </ul>
        </div>
    </div>
    <div class="navbar-phone-tabs">
        <div class="tabs-header flex flex-between flex-center-v">
            <div class="tabs-item"><a class="nav-link" href="/explore/doc">文档</a></div>
            <div class="tabs-item"> <a class="nav-link" href="/explore/project">项目</a></div>
            <div class="tabs-item"><a class="nav-link" href="/wiki">百科</a></div>
            <div class="tabs-item"><a class="nav-link" href="@if($isWeixin) //wxb04f9fe0f7b92b52.h5.xiaoe-tech.com @else //class.eetree.cn @endif">硬禾学堂</a></div>
            <div class="tabs-item"><a class="nav-link" href="/war/circuitjs.html?lang=zh">电路仿真</a></div>
        </div>
    </div>
</div>
