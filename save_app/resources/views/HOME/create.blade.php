<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>タグ管理ページ</h1>
    <a href="{{ route('saves') }}">トップに戻る</a>
    <form action="{{ route('tag.store') }}" method="POST" style="display: flex; flex-direction: column; width: 300px; margin-top: 20px;">
        @csrf
        <label for="name">タグ名</label>
        <input type="text" name="name" id="name" placeholder="タグ名を入力" required>
        <button type="submit" style="margin-top:10px;">タグを作成する</button>
    </form>
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
    <h2>既存のタグ一覧</h2>
    <ul>
        @foreach ($tags as $tag)
            <li>{{ $tag["name"] }}</li>
        @endforeach
    </ul>
</body>
</html>