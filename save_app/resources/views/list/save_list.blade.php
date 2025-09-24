<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>保存したリンクの一覧</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/list.css') }}">
</head>
<body>
    <header class="header">
        <div class="header-container">
            <div class="logo">
                <a href="#">保存リンク一覧</a>
            </div>
            <nav class="nav-links">
                <a href="{{ route('saves.top') }}">HOME</a>
                <a href="{{ route('link') }}">リンク管理</a>
                <a href="{{ route('tag') }}">タグの管理</a>
                <a href="{{ route('list') }}">保存リンクの一覧</a>
            </nav>
        </div>
    </header>

    <div class="main-container">
        <!-- ログイン中ユーザー表示 -->
        <p class="user-info">ログイン中：{{ auth()->user()->name }}</p>

        <!-- タグでの絞り込みナビゲーション -->
        <div class="tag-nav">
            <a href="{{ route('list') }}" class="tag-link {{ !request()->query('tag_id') ? 'active' : '' }}">すべてのリンク</a>
            <a href="{{ route('list', ['tag_id' => 'none']) }}" class="tag-link {{ request()->query('tag_id') === 'none' ? 'active' : '' }}">タグなし</a>
            @foreach ($tags as $tag)
                <a href="{{ route('list', ['tag_id' => $tag->id]) }}" class="tag-link {{ request()->query('tag_id') == $tag->id ? 'active' : '' }}">{{ $tag->name }}</a>
            @endforeach
        </div>
        <hr>

        <!-- 選択中のタグ名を表示 -->
        @if ($selectedTag)
            <h2>タグ: {{ $selectedTag->name }}</h2>
        @elseif (request()->query('tag_id') === 'none')
            <h2>タグなしのリンク</h2>
        @else
            <h2>すべてのリンク</h2>
        @endif
        
        @if ($links->isEmpty())
            <p class="no-links">リンクが見つかりませんでした。</p>
        @else
            <ul class="link-list">
                @foreach ($links as $link)
                    <li class="link-item">
                        <div class="link-header">
                            <a href="{{ $link->url }}" target="_blank">{{ $link->title ?? $link->url }}</a>
                            @if ($link->is_favorite)
                                <span class="favorite-star">★</span>
                            @endif
                        </div>
                        <p class="url-text">{{ $link->url }}</p>
                        <div class="tags-container">
                            @foreach ($link->tags as $tag)
                                <span class="tag-list-item">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                        <div class="actions">
                            <a href="{{ route("link.edit", ["id" => $link->id]) }}" class="edit-btn">編集</a>
                            <a href="{{ route("saves.show", ["id" => $link->id]) }}" class="detail-btn">詳細</a>
                            <form action="{{ route('link.destroy', ['id' => $link->id]) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" onclick="return confirm('本当に削除しますか？')">削除</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</body>
</html>
