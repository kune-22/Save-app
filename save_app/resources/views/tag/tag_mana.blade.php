<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>タグ管理ページ</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tag.css') }}">
</head>
<body>
    <header class="header">
        <div class="header-container">
            <div class="logo">
                <a href="#">タグ管理</a>
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
        <!-- タグ作成・編集フォーム -->
        <h2>@if(isset($tagToEdit)) タグを編集 @else タグを作成 @endif</h2>
        <form action="@if(isset($tagToEdit)) {{ route('tag.update', ['id' => $tagToEdit->id]) }} @else {{ route('tag.store') }} @endif" method="POST">
            @csrf
            @if(isset($tagToEdit))
                @method('PUT')
            @endif
            
            <div class="form-group">
                <label for="name">タグ名</label>
                <input type="text" name="name" id="name" placeholder="タグ名を入力" required value="{{ $tagToEdit->name ?? '' }}">
            </div>
            
            <button type="submit">@if(isset($tagToEdit)) 更新する @else 作成する @endif</button>
            
            @if(isset($tagToEdit))
                <a href="{{ route('tag') }}" class="btn-cancel">キャンセル</a>
            @endif
        </form>

        <!-- エラーメッセージ表示 -->
        @if ($errors->any())
        <div class="error-message">
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
                <li class="tag-item">
                    <span>{{ $tag->name }}</span>
                    <div class="actions">
                        <a href="{{ route('tag.edit', ['id' => $tag->id]) }}" class="edit-btn">編集</a>
                        <form action="{{ route('tag.destroy', ['id' => $tag->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn" onclick="return confirm('本当に削除しますか？')">削除</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
