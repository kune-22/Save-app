<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>保存したリンクの一覧</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        h1 { margin-bottom: 10px; }
        .tag-nav { margin-top: 10px; margin-bottom: 20px; }
        .tag-nav a { text-decoration: none; padding: 5px 10px; border: 1px solid #ccc; border-radius: 5px; margin-right: 5px; background-color: #f0f0f0; }
        .tag-nav a.active { background-color: #007bff; color: white; border-color: #007bff; }
        .tag-list-item { display: inline-block; border: 1px solid #000; padding: 2px 5px; margin-right: 5px; border-radius: 3px; }
    </style>
</head>
<body>
    <h1>保存したリンクの一覧</h1>
    <a href="{{ route('saves.top') }}">トップに戻る</a>
    <hr>

    <!-- タグでの絞り込みナビゲーション -->
    <div class="tag-nav">
        <a href="{{ route('list') }}" class="{{ !request()->query('tag_id') ? 'active' : '' }}">すべてのリンク</a>
        <a href="{{ route('list', ['tag_id' => 'none']) }}" class="{{ request()->query('tag_id') === 'none' ? 'active' : '' }}">タグなし</a>
        @foreach ($tags as $tag)
            <a href="{{ route('list', ['tag_id' => $tag->id]) }}" class="{{ request()->query('tag_id') == $tag->id ? 'active' : '' }}">{{ $tag->name }}</a>
        @endforeach
    </div>

    <!-- 選択中のタグ名を表示 -->
    @if ($selectedTag)
        <h2>タグ: {{ $selectedTag->name }}</h2>
    @elseif (request()->query('tag_id') === 'none')
        <h2>タグなしのリンク</h2>
    @endif
    
    @if ($links->isEmpty())
        <p>リンクが見つかりませんでした。</p>
    @else
        <ul>
            @foreach ($links as $link)
                <li>
                    <a href="{{ $link->url }}" target="_blank">{{ $link->title ?? $link->url }}</a>
                    @if ($link->is_favorite)
                        <span>★</span>
                    @endif
                    @foreach ($link->tags as $tag)
                        <span class="tag-list-item">{{ $tag->name }}</span>
                    @endforeach
                    <a href="{{ route("link.edit", ["id" => $link->id]) }}">編集</a>
                    <a href="{{ route("saves.show", ["id" => $link->id]) }}">詳細</a>
                    <form action="{{ route('link.destroy', ['id' => $link->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>
