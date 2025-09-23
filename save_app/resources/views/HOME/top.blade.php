<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOP</title>
</head>
<body>
    <h1>トップページ</h1>
    <hr>
    <form action="{{ route('saves.store') }}" method="POST" style="display: flex; flex-direction: column; width: 300px;">
        @csrf
        <label for="url">URL</label>
        <input type="text" name="url" id="url">

        <label for="title">タイトル</label>
        <input type="text" name="title" id="title">

        <label for="is_favorite">お気に入り登録</label>
        <input type="checkbox" name="is_favorite" id="is_favorite" value="1">

        <div style="flex-direction: column; margin-top: 10px;">
            <label for="tag_id">既存タグから選択</label>
            <select name="tag_id" id="tag_id" style="height: 20px; overflow-y: scroll; width: 100px;">
                <option value="">--選択しない--</option>
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>

            <label for="new_tag" style="margin-top:10px; display: flex;">新しいタグ名を入力</label>
            <input type="text" name="new_tag" id="new_tag" placeholder="新規タグ名">

            <button type="submit" style="margin-top:10px;">保存する</button>
        </div>
    </form>
    <a href="{{ route('list') }}">タグを作成する</a>
    <hr>
    <h1>保存したリンク</h1>
    <ul>
        @foreach ($links as $link)
            <li>
                @if ($link->title)
                <a href="{{ $link->url }}" target="_blank">{{ $link->title }}</a>
                @elseif ($link->title === null)
                <a href="{{ $link->url }}" target="_blank">{{ $link->url }}</a>
                @endif
                @if ($link->is_favorite)
                    <span>★</span>
                @endif
                <div>
                    @foreach ($link->tags as $tag)
                        <span style="border: 1px solid #000; padding: 2px; margin-right: 5px;">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </li>
        @endforeach
    </ul>
</body>
</html>