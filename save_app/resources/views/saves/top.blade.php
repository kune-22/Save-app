<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOP</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/saves.css') }}">
</head>
<body>
    <header class="header">
        <div class="header-container">
            <div class="logo">
                <a href="#">HOME</a>
            </div>
            <nav class="nav-links">
                <a href="{{ route('saves.top') }}">HOME</a>
                <a href="{{ route('link') }}">リンク管理</a>
                <a href="{{ route('tag') }}">タグの管理</a>
                <a href="{{ route('list') }}">保存リンクの一覧</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <p class="user-info">ログイン中：{{ auth()->user()->name }}</p>
        
        <h2>最近保存したリンク</h2>
        @if ($latestLinks->isEmpty())
            <p class="no-links">保存されたリンクはありません。</p>
        @else
            <ul class="link-list">
                @foreach ($latestLinks as $link)
                    <li class="link-item">
                        <div style="display: flex; align-items: center;">
                            <a href="{{ $link['url'] }}" target="_blank">{{ $link['title'] ?? $link['url'] }}</a>
                            @if ($link['is_favorite'])
                                <span class="favorite-star">★</span>
                            @endif
                        </div>
                        <div class="tags-container" style="margin-top: 5px;">
                            @foreach ($link->tags as $tag)
                                <span class="tag-list-item">{{ $tag['name'] }}</span>
                            @endforeach
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</body>
</html>
