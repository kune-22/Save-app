<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>保存リンクの編集</h1>
    <form action="{{ route('saves.update', ['id' => $link["id"]]) }}" method="POST" style="display: flex; flex-direction: column; width: 300px; margin-top: 20px;">
        @csrf
        @method('PUT')
        <label for="url">URL</label>
        <input type="url" name="url" id="url" value="{{ $link["url"] }}" required>

        <label for="title">タイトル</label>
        <input type="text" name="title" id="title" value="{{ $link["title"] }}">

        <label for="is_favorite">お気に入り登録</label>
        <input type="checkbox" name="is_favorite" id="is_favorite" value="1" {{ $link["is_favorite"] ? 'checked' : '' }}>

        <div style="flex-direction: column; margin-top: 10px;">
            <label for="tag_id">既存タグから選択</label>
            <select name="tag_id[]" id="tag_id" multiple style="height: 100px; overflow-y: scroll; width: 100px;">
                <option value="">--選択しない--</option>
                @foreach ($tags as $tag)
                    <option value="{{ $tag["id"] }}" {{ $link->tags->contains($tag["id"]) ? 'selected' : '' }}>
                        {{ $tag["name"] }}
                    </option>
                @endforeach
            </select>

            <label for="new_tag" style="margin-top:10px; display: flex;">新しいタグ名を入力</label>
            <input type="text" name="new_tag" id="new_tag" placeholder="新規タグ名">

            <button type="submit" style="margin-top:10px;">更新する</button>
        </div>
    </form>
    <a href="{{ route('saves') }}">一覧に戻る</a>
</body>
</html>