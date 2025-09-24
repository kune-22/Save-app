<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>サインアップページ</title>
    <link rel="stylesheet" href="{{ asset('css/sign_up.css') }}">
</head>
<body>
    <form action="{{ route('sign_up.store') }}" method="POST">
        <h1>サインアップページ</h1>
        {{-- 【重要】sign_up.storeのルーティングは後で作成する --}}
        @csrf
        <label>名前</label>
        <input type="text" name="name">

        <label>メールアドレス</label>
        <input type="email" name="email">

        <label>パスワード</label>
        <input type="password" name="password">

        <label>パスワード確認</label>
        <input type="password" name="passwordConfirmation">

        <button type="submit">サインアップ</button>
        <div style="text-align: center; margin-top: 15px;">
        すでにアカウントをお持ちですか？ <br><a href="{{ route('login') }}">ログインはこちら</a>
        </div>
    </form>
</body>
</html>
