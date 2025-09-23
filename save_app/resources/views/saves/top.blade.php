<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOP</title>
</head>
<body>
    <h1>HOME</h1>
    <p>ログイン中のアカウント：{{ auth()->user()->name }}</p>
    <a href="{{ route('tag') }}">タグの管理</a>
    <a href="{{ route('list') }}">保存リンクの一覧</a>
    <a href="{{ route('link') }}">リンク管理</a>
    <hr>
    <h2>最近保存したリンク</h2>
    @if ($latestLinks->isEmpty())
        <p>保存されたリンクはありません。</p>
    @else
        <ul>
            @foreach ($latestLinks as $link)
                <li>
                    <a href="{{ $link["url"] }}" target="_blank">{{ $link["title"] ?? $link["url"] }}</a>
                    @if ($link["is_favorite"])
                        <span>★</span>
                    @endif
                    @foreach ($link->tags as $tag)
                        <span style="border: 1px solid #000; padding: 2px; margin-right: 5px; border-radius: 3px;">{{ $tag["name"] }}</span>
                    @endforeach
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>