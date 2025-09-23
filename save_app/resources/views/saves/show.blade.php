<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>{{ $link["title"] ?? $link["url"] }} 詳細</h1>
    <p>URL: <a href="{{ $link["url"] }}" target="_blank">{{ $link["url"] }}</a></p>
    <p>お気に入り: {{ $link["is_favorite"] ? '⭐' : '☆' }}</p>
    <p>タグ:
        @foreach ($link["tags"] as $tag)
            <span style="border: 1px solid #000; padding: 2px; margin-right: 5px;">{{ $tag["name"] }}</span>
        @endforeach
    </p>
    <form action="{{ route('saves.destroy', ['id' => $link['id']]) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
    </form>
    <a href="{{ route('saves') }}">一覧に戻る</a>
</body>
</html>