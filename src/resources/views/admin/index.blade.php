<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>FashionablyLate - 管理画面</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>
    <!-- ヘッダー -->
    <div class="header">
        <h1>FashionablyLate</h1>

        <!-- ログアウトボタンを右上に配置 -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-button">logout</button>
        </form>
    </div>
    <h2>Admin</h2>

    <!-- 検索フォーム -->
    <form method="GET" action="{{ route('admin.index') }}">
        <table>
            <tr>
                <td>
                    <input type="text" name="keyword" class="input-name" value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力してください">

                    <select name="gender" class="input-gender">
                        <option value="">性別</option>
                        <option value="1" {{ request('gender') == 1 ? 'selected' : '' }}>男性</option>
                        <option value="2" {{ request('gender') == 2 ? 'selected' : '' }}>女性</option>
                        <option value="3" {{ request('gender') == 3 ? 'selected' : '' }}>その他</option>
                    </select>

                    <select name="category_id" class="input-category">
                        <option value="">お問い合わせの種類</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->content }}
                        </option>
                        @endforeach
                    </select>

                    <input type="date" name="contact_date" class="input-date" value="{{ request('contact_date') }}">
                </td>
                <td><button type="submit">検索</button></td>
                <td><a href="{{ route('admin.index') }}">リセット</a></td>
            </tr>
        </table>
    </form>

    <!-- エクスポートボタン -->
    <div class="export-pagination-wrapper">
        <!-- 検索条件を引き継いでエクスポート -->
        <form method="GET" action="{{ route('admin.export') }}">
            <input type="hidden" name="last_name" value="{{ request('last_name') }}">
            <input type="hidden" name="first_name" value="{{ request('first_name') }}">
            <input type="hidden" name="email" value="{{ request('email') }}">
            <input type="hidden" name="gender" value="{{ request('gender') }}">
            <input type="hidden" name="category_id" value="{{ request('category_id') }}">
            <input type="hidden" name="from" value="{{ request('from') }}">
            <input type="hidden" name="until" value="{{ request('until') }}">
            <button type="submit" class="export-btn">エクスポート</button>
        </form>

        <!-- ページネーション（検索条件引き継ぎ） -->
        <div class="pagination">
            {{ $contacts->appends(request()->query())->links() }}
        </div>
    </div>

    <!-- テーブル一覧 -->
    <table>
        <thead>
            <tr>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td>{{ $contact->gender_label }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->category->content }}</td>
                <td>
                    <a href="{{ route('admin.index', ['modal' => $contact->id]) }}">詳細</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- モーダルウィンドウ（GETパラメータで制御） -->
    @if(request('modal'))
    @php
    $contact = \App\Models\Contact::with('category')->find(request('modal'));
    @endphp
    @if($contact)
    <div class="modal-overlay">
        <div class="modal-content">
            <p><strong>お名前</strong> {{ $contact->last_name }} {{ $contact->first_name }}</p>
            <p><strong>性別</strong>
                @if ($contact->gender == 1)
                男性
                @elseif ($contact->gender == 2)
                女性
                @elseif ($contact->gender == 3)
                その他
                @else
                不明
                @endif
            </p>
            <p><strong>メールアドレス</strong> {{ $contact->email }}</p>
            <p><strong>電話番号</strong> {{ $contact->tel }}</p>
            <p><strong>住所</strong> {{ $contact->address }}</p>
            <p><strong>建物名</strong> {{ $contact->building }}</p>
            <p><strong>お問い合わせの種類</strong> {{ $contact->category->content }}</p>
            <p><strong>お問い合わせ内容</strong><br>{{ $contact->detail }}</p>

            <!-- モーダルデータを削除-->
            <form action="{{ route('admin.destroy', ['id' => $contact->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn">削除</button>
            </form>

            <!-- モーダル内閉じるリンク -->
            <a href="{{ route('admin.index') }}" class="close-btn">✕</a>
        </div>
    </div>
    @endif
    @endif

</body>

</html>