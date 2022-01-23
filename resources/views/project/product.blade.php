<div class="main-list-mini">
    @foreach ($products as $product)
    <div class="content-list-mini">
        @if ($product->cloud_url)
        <div class="content-list-img">
            <img src="{{ $product->cloud_url }}">
        </div>
        @endif
        <div class="list-mini-desc">
            @if ($product->link)
            <a href="{{ $product->link }}" target="_blank" class="title">
                {{ $product->name }}
                <i class="el-icon-link"></i>
            </a>
            @else
            {{ $product->name }}
            @endif
            <p class="over-ellipsis">{{ $product->description }}</p>
        </div>
    </div>
    @endforeach
</div>
