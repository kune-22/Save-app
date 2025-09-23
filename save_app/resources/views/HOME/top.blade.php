<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOP</title>
</head>
<body>
    <h1>トップページ</h1>
    <a href="{{ route('tag') }}">タグを作成する</a>
    <p>{{ auth()->user()->name }}</p>
    <hr>
    <form action="{{ route('saves.store') }}" method="POST" style="display: flex; flex-direction: column; width: 300px;">
        @csrf
        <label for="url">URL</label>
        <input type="url" name="url" id="url" placeholder="https://example.com" required>

        <label for="title">タイトル</label>
        <input type="text" name="title" id="title">

        <label for="is_favorite">お気に入り登録</label>
        <input type="checkbox" name="is_favorite" id="is_favorite" value="1">

        <div style="flex-direction: column; margin-top: 10px;">
            <label for="tag_id">既存タグから選択</label>
            <select name="tag_id" id="tag_id" style="height: 20px; overflow-y: scroll; width: 100px;">
                <option value="">--選択しない--</option>
                @foreach ($tags as $tag)
                    <option value="{{ $tag["id"] }}">{{ $tag["name"] }}</option>
                @endforeach
            </select>

            <label for="new_tag" style="margin-top:10px; display: flex;">新しいタグ名を入力</label>
            <input type="text" name="new_tag" id="new_tag" placeholder="新規タグ名">

            <button type="submit" style="margin-top:10px;">保存する</button>
        </div>
    </form>
    <hr>
    <h1>保存したリンク</h1>
    <ul>
        @foreach ($links as $link)
            <li>
                <a href="{{ $link["url"] }}" target="_blank">{{ $link["title"] ?? $link["url"] }}</a>
                @if ($link["is_favorite"])
                    <span>★</span>
                @endif
                @foreach ($link["tags"] as $tag)
                <span style="border: 1px solid #000; padding: 2px; margin-right: 5px;">{{ $tag["name"] }}</span>
                @endforeach
                <a href="{{ route("saves.edit", ["id" => $link["id"] ] ) }}">編集</a>
            </li>
        @endforeach
    </ul>
    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</body>
</html>