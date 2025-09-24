<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>リンク管理</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all_func.css') }}">
</head>
<body>
    <header class="header">
        <div class="header-container">
            <div class="logo">
                <a href="#">リンク管理</a>
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
        <div class="form-container">
            <!-- 登録・編集フォーム -->
            <h2>@if(isset($linkToEdit)) リンクを編集 @else リンクを新規登録 @endif</h2>
            <form action="@if(isset($linkToEdit)){{ route('link.update', ['id' => $linkToEdit->id]) }}@else{{ route('link.store') }}@endif" method="POST">
                @csrf
                @if(isset($linkToEdit))
                    @method('PUT')
                @endif
                
                <div class="form-group">
                    <label for="url">URL</label>
                    <input type="url" name="url" id="url" required value="{{ old('url', $linkToEdit->url ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="title">タイトル</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $linkToEdit->title ?? '') }}">
                </div>

                <div class="form-group checkbox-group">
                    <input type="checkbox" name="is_favorite" id="is_favorite" value="1" @if(isset($linkToEdit) && $linkToEdit->is_favorite) checked @endif>
                    <label for="is_favorite">お気に入り登録</label>
                </div>
                
                <div class="form-group">
                    <label for="tag_id">既存タグから選択</label>
                    <select name="tag_id[]" id="tag_id" multiple>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}" @if(isset($linkToEdit) && $linkToEdit->tags->contains($tag->id)) selected @endif>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="new_tag">新しいタグ名を入力</label>
                    <input type="text" name="new_tag" id="new_tag" placeholder="新規タグ名">
                </div>
                
                <button type="submit">@if(isset($linkToEdit)) 更新する @else 登録する @endif</button>
                
                @if(isset($linkToEdit))
                    <a href="{{ route('link') }}" class="btn-cancel">キャンセル</a>
                @endif
            </form>

            <!-- エラーメッセージ -->
            @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        
        <div class="link-list-container">
            
            <!-- リンク一覧 -->
            @if(isset($links))
            <h2>保存したリンク一覧</h2>
            <ul class="link-list">
                @foreach ($links as $link)
                    <li class="link-item">
                        <div class="link-header">
                            <a href="{{ $link->url }}" target="_blank">{{ $link->title ?? $link->url }}</a>
                            @if ($link->is_favorite)
                                <span class="favorite-icon active">★</span>
                            @else
                                <span class="favorite-icon">★</span>
                            @endif
                        </div>
                        
                        <div class="tags-container">
                            @foreach ($link->tags as $tag)
                                <span class="tag-list-item">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                        <div class="actions">
                            <a href="{{ route("link.edit", ["id" => $link->id]) }}" class="edit-btn">編集</a>
                            <form action="{{ route('link.destroy', ['id' => $link->id]) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" onclick="return confirm('本当に削除しますか？')">削除</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
</body>
</html>
