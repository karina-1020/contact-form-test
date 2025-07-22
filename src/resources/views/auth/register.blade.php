<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <!-- CSSファイルを読み込む -->
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>

<body>
    <!-- ヘッダー：ロゴとloginボタン -->
    <div class="header">
        <h1>FashionablyLate</h1>
        <!-- loginページへのリンク -->
        <a href="{{ route('login') }}" class="login-btn">login</a>
    </div>

    <!-- 登録フォームの外枠 -->
    <div class="register-container">
        <h2>Register</h2>

        <!-- バリデーションエラーがある場合に表示 -->
        @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
            <!-- エラー内容を赤字で表示 -->
            <li style="color: red;">{{ $error }}</li>
            @endforeach
        </ul>
        @endif

        <!-- 登録フォーム本体 -->
        <form method="POST" action="{{ route('register') }}">
            @csrf <!-- CSRFトークンを追加（セキュリティ対策） -->

            <!-- 名前入力欄 -->
            <div>
                <label>お名前</label>
                <input type="text" name="name" required placeholder="例：山田 太郎" value="{{ old('name') }}">
            </div>

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

            <!-- 登録ボタン -->
            <button type="submit">登録</button>
        </form>
    </div>
</body>

</html>