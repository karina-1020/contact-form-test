<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>お問い合わせフォーム</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
</head>

<body>
    <h1>FashionablyLate</h1>
    <h2>Contact</h2>

    <form method="POST" action="{{ route('contact.confirm') }}" novalidate>
        @csrf

        {{-- お名前 --}}
        <div class="form-group">
            <label class="required">お名前</label>
            <div class="name-group">
                <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="例：山田">
                <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="例：太郎">
            </div>
            @error('last_name')<div class="error">{{ $message }}</div>@enderror
            @error('first_name')<div class="error">{{ $message }}</div>@enderror
        </div>

        {{-- 性別 --}}
        <div class="form-group">
            <label class="required">性別</label>
            <label><input type="radio" name="gender" value="1" {{ old('gender') == '1' ? 'checked' : '' }}> 男性</label>
            <label><input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}> 女性</label>
            <label><input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}> その他</label>
            @error('gender')<div class="error">{{ $message }}</div>@enderror
        </div>

        {{-- メールアドレス --}}
        <div class="form-group">
            <label class="required">メールアドレス</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="例：test@example.com">
            @error('email')<div class="error">{{ $message }}</div>@enderror
        </div>

        {{-- 電話番号 --}}
        <div class="form-group">
            <label class="required">電話番号</label>
            <div class="tel-group">
                <input type="text" name="tel1" placeholder="080" value="{{ old('tel1') }}">
                -
                <input type="text" name="tel2" placeholder="1234" value="{{ old('tel2') }}">
                -
                <input type="text" name="tel3" placeholder="5678" value="{{ old('tel3') }}">
            </div>
            @error('tel1')<div class="error">{{ $message }}</div>@enderror
            @error('tel2')<div class="error">{{ $message }}</div>@enderror
            @error('tel3')<div class="error">{{ $message }}</div>@enderror
        </div>

        {{-- 住所 --}}
        <div class="form-group">
            <label class="required">住所</label>
            <input type="text" name="address" value="{{ old('address') }}" placeholder="例：東京都千駄ヶ谷1-2-3">
            @error('address')<div class="error">{{ $message }}</div>@enderror
        </div>

        {{-- 建物名 --}}
        <div class="form-group">
            <label>建物名</label>
            <input type="text" name="building" value="{{ old('building') }}" placeholder="例：千駄ヶ谷マンション101">
        </div>

        {{-- お問い合わせの種類 --}}
        <div class="form-group">
            <label class="required">お問い合わせの種類</label>
            <select name="category_id" required>
                <option value="" hidden {{ old('category_id') ? '' : 'selected' }}>選択してください</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->content }}
                </option>
                @endforeach
            </select>
            @error('category_id')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        {{-- お問い合わせ内容 --}}
        <div class="form-group">
            <label class="required">お問い合わせ内容</label>
            <textarea name="detail" rows="5" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
            @error('detail')<div class="error">{{ $message }}</div>@enderror
        </div>

        {{-- 確認ボタン --}}
        <div class="form-group">
            <button type="submit">確認画面へ</button>
        </div>
    </form>
</body>

</html>