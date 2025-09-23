<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>タグ管理ページ</title>
    <style>
        body { font-family: sans-serif; }
        .form-container { display: flex; flex-direction: column; width: 300px; margin-top: 20px; }
        .tag-list li { margin-bottom: 5px; }
        .tag-list a, .tag-list button { text-decoration: none; margin-left: 10px; padding: 5px 10px; border: 1px solid #ccc; background-color: #f0f0f0; border-radius: 5px; cursor: pointer; }
    </style>
</head>
<body>
    <h1>タグ管理ページ</h1>
    <a href="{{ route('saves') }}">トップに戻る</a>
    
    <!-- タグ作成・編集フォーム -->
    <h2>@if(isset($tagToEdit)) タグを編集 @else タグを作成 @endif</h2>
    <form action="@if(isset($tagToEdit)) {{ route('tag.update', ['id' => $tagToEdit->id]) }} @else {{ route('tag.store') }} @endif" method="POST" class="form-container">
        @csrf
        @if(isset($tagToEdit))
            @method('PUT')
        @endif
        
        <label for="name">タグ名</label>
        <input type="text" name="name" id="name" placeholder="タグ名を入力" required value="@if(isset($tagToEdit)){{ $tagToEdit->name }}@endif">
        
        <button type="submit" style="margin-top:10px;">@if(isset($tagToEdit)) 更新する @else 作成する @endif</button>
        
        @if(isset($tagToEdit))
            <a href="{{ route('tag') }}" style="margin-top: 10px; text-align: center;">キャンセル</a>
        @endif
    </form>

    <!-- エラーメッセージ表示 -->
    @if ($errors->any())
    <div style="color: red; margin-top: 10px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <hr>

    <!-- 既存のタグ一覧 -->
    <h2>既存のタグ一覧</h2>
    <ul class="tag-list">
        @foreach ($tags as $tag)
            <li>
                {{ $tag->name }}
                <a href="{{ route('tag.edit', ['id' => $tag->id]) }}">編集</a>
                <form action="{{ route('tag.destroy', ['id' => $tag->id]) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>