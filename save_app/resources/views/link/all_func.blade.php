<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>リンク管理</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .form-container { display: flex; flex-direction: column; width: 300px; margin-top: 20px; }
        .tag-select { height: 100px; overflow-y: scroll; width: 100px; }
        ul { list-style: none; padding: 0; }
        li { margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        .tag-list-item { border: 1px solid #000; padding: 2px 5px; margin-right: 5px; border-radius: 3px; }
        .success-message { color: green; margin-top: 10px; }
    </style>
</head>
<body>
    <h1>リンク管理</h1>
    <a href="{{ route('saves.top') }}">トップに戻る</a>
    
    <!-- 登録・編集フォーム -->
    <h2>@if(isset($linkToEdit)) リンクを編集 @else リンクを新規登録 @endif</h2>
    <form action="@if(isset($linkToEdit)){{ route('link.update', ['id' => $linkToEdit->id]) }}@else{{ route('link.store') }}@endif" method="POST" class="form-container">
        @csrf
        @if(isset($linkToEdit))
            @method('PUT')
        @endif
        
        <label for="url">URL</label>
        <input type="url" name="url" id="url" required value="{{ old('url', $linkToEdit->url ?? '') }}">

        <label for="title" style="margin-top: 10px;">タイトル</label>
        <input type="text" name="title" id="title" value="{{ old('title', $linkToEdit->title ?? '') }}">

        <label for="is_favorite" style="margin-top: 10px;">お気に入り登録</label>
        <input type="checkbox" name="is_favorite" id="is_favorite" value="1" @if(isset($linkToEdit) && $linkToEdit->is_favorite) checked @endif>
        
        <div style="flex-direction: column; margin-top: 10px;">
            <label for="tag_id">既存タグから選択</label>
            <select name="tag_id[]" id="tag_id" multiple class="tag-select">
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}" @if(isset($linkToEdit) && $linkToEdit->tags->contains($tag->id)) selected @endif>
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>
            <label for="new_tag" style="margin-top:10px; display: flex;">新しいタグ名を入力</label>
            <input type="text" name="new_tag" id="new_tag" placeholder="新規タグ名">
            
            <button type="submit" style="margin-top:10px;">@if(isset($linkToEdit)) 更新する @else 登録する @endif</button>
            
            @if(isset($linkToEdit))
                <a href="{{ route('link') }}" style="margin-top: 10px; text-align: center;">キャンセル</a>
            @endif
        </div>
    </form>
    
    <!-- エラーメッセージ -->
    @if ($errors->any())
    <div style="color: red; margin-top: 10px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <hr style="margin-top: 30px;">
    
    <!-- リンク一覧 -->
    @if(isset($links))
    <h2>保存したリンク一覧</h2>
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
