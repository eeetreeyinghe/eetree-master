<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="@yield('keywords')eetree,电子森林">
    <meta name="description" content="@yield('description')">

    <title>@hasSection('title') @yield('title') -  @endif{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('layouts.modal')
        @include('layouts.nav')

        <main class="py-4">
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>

    <!-- Scripts -->
    @yield('beforeScripts')
    <script src="{{ mix('js/pages/manifest.js') }}"></script>
    <script src="{{ mix('js/pages/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('vendor/prism/prism.js') }}"></script>
    @yield('scripts')

    <script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
    <script>
        let hoverE = $('.dropdown-menu-nocart').find('.dropdown-submenu')
        $(hoverE).hover(item=>{
            let currentClick = item.currentTarget
            $(currentClick).addClass('hover').siblings().removeClass('hover')
        })
        // 首页大图切换
        $(function() {
            var sWidth = $("#focus").width(); //获取焦点图的宽度（显示面积）
            var len = $("#focus ul li").length; //获取焦点图个数
            var index = 0;
            var picTimer;

            //以下代码添加数字按钮和按钮后的半透明条，还有上一页、下一页两个按钮

            var btn = "<div class='preNext pre'>＜</div><div class='preNext next'>＞</div> <div class='btn-list'>";
            for(var i=0; i < len; i++) {
                btn += "<span></span>";
            }
            btn += "</div> ";

            $("#focus").append(btn);
            $("#focus .btnBg").css("opacity",0.5);

            //为小按钮添加鼠标滑入事件，以显示相应的内容
            $("#focus .btn-list span").click(function(e) {
                index = $("#focus .btn-list span").index(this);
                console.log('点击了那张图片：',index,e)
                showPics(index);
            }).eq(0).trigger("click");

            //上一页、下一页按钮透明度处理
            $("#focus .preNext").css("opacity",0.08).hover(function() {
                $(this).stop(true,false).animate({"opacity":"0.5"},300);
            },function() {
                $(this).stop(true,false).animate({"opacity":"0.08"},300);
            });

            //上一页按钮
            $("#focus .pre").click(function() {
                index -= 1;
                if(index == -1) {index = len - 1;}
                showPics(index);
            });

            //下一页按钮
            $("#focus .next").click(function() {
                index += 1;
                if(index == len) {index = 0;}
                showPics(index);
            });

            //本例为左右滚动，即所有li元素都是在同一排向左浮动，所以这里需要计算出外围ul元素的宽度
            $("#focus ul").css("width",sWidth * (len));

            //鼠标滑上焦点图时停止自动播放，滑出时开始自动播放
            $("#focus").hover(function() {
                clearInterval(picTimer);
            },function() {
            picTimer = setInterval(function() {
                showPics(index);
                index++;
                if(index == len) {index = 0;}
            },4000); //此4000代表自动播放的间隔，单位：毫秒
            }).trigger("mouseleave");

        //显示图片函数，根据接收的index值显示相应的内容
        function showPics(index) { //普通切换
            var nowLeft = -index*sWidth; //根据index值计算ul元素的left值
            $("#focus ul li").eq(index).show(300).siblings().hide(300)
            // $("#focus ul").stop(true,false).animate({"left":nowLeft},300); //通过animate()调整ul元素滚动到计算出的position
            $("#focus .btn-list span").removeClass("on").eq(index).addClass("on"); //为当前的按钮切换到选中的效果
            // $("#focus .btn-list span").stop(true,false).animate({"opacity":"0.4"},300).eq(index).stop(true,false).animate({"opacity":"0.6"},300); //为当前的按钮切换到选中的效果
        }
    });
    </script>

    <!-- Google Analytics -->
    <script type="text/javascript">
        window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
        ga("create", "UA-135936562-2", "auto");
        ga("send", "pageview");
    </script>
    <script type="text/javascript" async="" src="//www.google-analytics.com/analytics.js"></script>
    <!-- End Google Analytics -->
    <script>
        var _hmt = _hmt || [];
        (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?64dd9a5ee37934f24a10fd37a20dc63c";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
        })();
    </script>
</body>
</html>
