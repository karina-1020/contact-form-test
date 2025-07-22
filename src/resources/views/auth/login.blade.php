<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- loginページ専用CSSを読み込む -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <!-- ヘッダー部分 -->
    <div class="header">
        <h1>FashionablyLate</h1>
        <!-- registerページへのリンク -->
        <a href="{{ route('register') }}" class="register-btn">register</a>
    </div>

    <!-- ログインフォームの外枠 -->
    <div class="login-container">
        <h2>Login</h2>

        <!-- ログインフォーム本体 -->
        <form method="POST" action="{{ route('login') }}">
            @csrf <!-- CSRFトークン -->

            <!-- メールアドレス入力欄 -->
            <div>
                <label>メールアドレス</label>
                <input type="email" name="email" required placeholder="例：test@example.com" value="{{ old('email') }}">
            </div>

            <!-- パスワード入力欄 -->
            <div>
                <label>パスワード</label>
                <input type="password" name="password" required placeholder="例：coachtecht1120">
            </div>

            <!-- ログインボタン -->
            <button type="submit">ログイン</button>
        </form>
    </div>
</body>

</html>