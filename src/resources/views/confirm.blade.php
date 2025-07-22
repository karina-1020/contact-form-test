<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>確認画面</title>
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
</head>

<body>
    <h1>FashionablyLate</h1>
    <h2>Confirm</h2>

    <table>
        <tr>
            <th>お名前</th>
            <td>{{ $formData['last_name'] }} {{ $formData['first_name'] }}</td>
        </tr>
        <tr>
            <th>性別</th>
            <td>
                @if($formData['gender'] == 1) 男性
                @elseif($formData['gender'] == 2) 女性
                @else その他
                @endif
            </td>
        </tr>
        <tr>
            <th>メールアドレス</th>
            <td>{{ $formData['email'] }}</td>
        </tr>
        <tr>
            <th>電話番号</th>
            <td>{{ $formData['tel1'] . $formData['tel2'] . $formData['tel3'] }}</td>
        </tr>
        <tr>
            <th>住所</th>
            <td>{{ $formData['address'] }}</td>
        </tr>
        <tr>
            <th>建物名</th>
            <td>{{ $formData['building'] }}</td>
        </tr>
        <tr>
            <th>お問い合わせの種類</th>
            <td>{{ $formData['category_name'] }}</td>
        </tr>
        <tr>
            <th>お問い合わせ内容</th>
            <td>{{ $formData['detail'] }}</td>
        </tr>
    </table>

    <div class="button-area">
        <form method="POST" action="{{ route('contact.send') }}">
            @csrf
            <input type="hidden" name="last_name" value="{{ $formData['last_name'] }}">
            <input type="hidden" name="first_name" value="{{ $formData['first_name'] }}">
            <input type="hidden" name="gender" value="{{ $formData['gender'] }}">
            <input type="hidden" name="email" value="{{ $formData['email'] }}">
            <input type="hidden" name="tel" value="{{ $formData['tel'] }}">
            <input type="hidden" name="address" value="{{ $formData['address'] }}">
            <input type="hidden" name="building" value="{{ $formData['building'] }}">
            <input type="hidden" name="category_id" value="{{ $formData['category_id'] }}">
            <input type="hidden" name="detail" value="{{ $formData['detail'] }}">
            <button type="submit" class="submit-btn">送信</button>
        </form>

        <form method="POST" action="{{ route('contact.fix') }}">
            @csrf
            @foreach ($formData as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <button type="submit" class="back-btn">修正</button>
        </form>
    </div>