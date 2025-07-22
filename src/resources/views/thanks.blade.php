<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>サンクスページ</title>
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
</head>

<body>
    <h1>お問い合わせありがとうございました</h1>

    <form action="{{ route('contact.form') }}" method="GET">
        <button type="submit">HOME</button>
    </form>
</body>

</html>