<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>保存リンクの編集</title>
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
                <a href="{{ route('tag') }}">タグの管理</a>
                <a href="{{ route('list') }}">保存リンクの一覧</a>
                <a href="{{ route('link') }}">リンク管理</a>
            </nav>
        </div>
    </header>
    
    <div class="main-container">
        <h1>保存リンクの編集</h1>
        <form action="{{ route('link.update', ['id' => $link["id"]]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="url">URL</label>
                <input type="url" name="url" id="url" value="{{ old('url', $link["url"]) }}" required>
            </div>

            <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" name="title" id="title" value="{{ old('title', $link["title"]) }}">
            </div>

            <div class="form-group checkbox-group">
                <input type="checkbox" name="is_favorite" id="is_favorite" value="1" {{ old('is_favorite', $link["is_favorite"]) ? 'checked' : '' }}>
                <label for="is_favorite">お気に入り登録</label>
            </div>

            <div class="form-group">
                <label for="tag_id">既存タグから選択</label>
                <select name="tag_id[]" id="tag_id" multiple>
                    <option value="">--選択しない--</option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag["id"] }}" {{ $link->tags->contains($tag["id"]) ? 'selected' : '' }}>
                            {{ $tag["name"] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="new_tag">新しいタグ名を入力</label>
                <input type="text" name="new_tag" id="new_tag" placeholder="新規タグ名">
            </div>

            <button type="submit" class="btn btn-primary">更新する</button>
        </form>
        <a href="{{ route('saves.top') }}" class="btn btn-link">トップページに戻る</a>
    </div>
</body>
</html>
