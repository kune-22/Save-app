<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ログインページ</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <form action="{{ route("login.store") }}" method="POST">
        <h1>ログインページ</h1>
        {{-- 【重要】login.storeのルーティングは後で作成する --}}
        {{-- フォームのメソッドがPOSTの場合は、csrfトークンを設定する必要がある --}}
        {{-- （@csrfと書くだけでOK） --}}
        @csrf
        <label for="email">メールアドレス</label>
        <input type="email" name="email">

        <label for="password">パスワード</label>
        <input type="password" name="password">

        <button type="submit">ログイン</button>
        <div style="text-align: center; margin-top: 15px;">
        アカウントをお持ちでないですか？ <br><a href="{{ route('sign_up') }}">サインアップはこちら</a>
        </div>
    </form>
</body>
</html>
