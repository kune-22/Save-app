<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $link["title"] ?? $link["url"] }} 詳細</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
</head>
<body>
    <header class="header">
        <div class="header-container">
            <div class="logo">
                <a href="#">リンク詳細</a>
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
        <h1 class="page-title">{{ $link["title"] ?? $link["url"] }} 詳細</h1>
        <p class="detail-item"><strong>URL:</strong> <a href="{{ $link["url"] }}" target="_blank">{{ $link["url"] }}</a></p>
        <p class="detail-item"><strong>お気に入り:</strong> <span class="favorite-status">{{ $link["is_favorite"] ? '⭐' : '☆' }}</span></p>
        <p class="detail-item">
            <strong>タグ:</strong>
            @foreach ($link["tags"] as $tag)
                <span class="tag-list-item">{{ $tag["name"] }}</span>
            @endforeach
        </p>
        
        <div class="action-buttons">
            <a href="{{ route('list') }}" class="back-btn">一覧に戻る</a>
            <form action="{{ route('link.destroy', ['id' => $link['id']]) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('本当に削除しますか？')" class="delete-btn">削除</button>
            </form>
        </div>
    </div>
</body>
</html>
