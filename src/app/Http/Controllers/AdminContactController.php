<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
// StreamedResponse を使用して、CSV をストリーム形式で返す
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminContactController extends Controller
{
    /**
     * 管理画面：お問い合わせ一覧を表示
     */
    public function index(Request $request)
    {
        // カテゴリー一覧を取得（検索フォーム用）
        $categories = Category::all();

        // お問い合わせ一覧を取得（検索条件付き）
        $query = Contact::with('category');

        //部分一致・完全一致
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;

            $query->where(function ($q) use ($keyword) {
                $q->where('last_name', 'like', "%{$keyword}%")   // 姓に部分一致
                    ->orWhere('first_name', 'like', "%{$keyword}%") // 名に部分一致
                    ->orWhereRaw("REPLACE(CONCAT(last_name, first_name), ' ', '') LIKE ?", ["%{$keyword}%"]); // フルネームに部分一致
            });
        }

        if ($request->filled('last_name')) {
            $query->where('last_name', 'like', '%' . $request->last_name . '%');
        }

        if ($request->filled('first_name')) {
            $query->where('first_name', 'like', '%' . $request->first_name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('gender') && $request->gender !== '性別') {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }

        if ($request->filled('until')) {
            $query->whereDate('created_at', '<=', $request->until);
        }

        // ページネーション + 検索条件保持
        $contacts = $query->paginate(7)->appends($request->all());

        // ビューにデータを渡す
        return view('admin.index', compact('contacts', 'categories'));
    }

    public function export(Request $request): StreamedResponse
    {
        // 条件付きでデータ取得（フィルターを検索条件で反映）
        $query = Contact::query();

        if ($request->filled('last_name')) {
            $query->where('last_name', 'like', '%' . $request->last_name . '%');
        }

        if ($request->filled('first_name')) {
            $query->where('first_name', 'like', '%' . $request->first_name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }

        if ($request->filled('until')) {
            $query->whereDate('created_at', '<=', $request->until);
        }

        // 該当データを取得
        $contacts = $query->get();

        // CSVヘッダー情報を設定（ダウンロード用）
        $csvHeader = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ];

        // ストリーム出力のコールバック関数
        $callback = function () use ($contacts) {
            $handle = fopen('php://output', 'w');

            // 【ここ】BOMを先頭に書き込むことでExcelの文字化けを防ぐ!!
            fputs($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // ヘッダー行の出力
            fputcsv($handle, ['名前', '性別',  'メールアドレス', 'お問い合わせ種類', 'お問い合わせ内容']);

            // 各行のデータ出力
            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->last_name . ' ' . $contact->first_name,
                    $contact->gender,
                    $contact->email,
                    optional($contact->category)->content,
                    $contact->contact,
                ]);
            }

            fclose($handle);
        };

        // レスポンスとしてCSVを返す
        return response()->stream($callback, 200, $csvHeader);
    }

    public function destroy($id)
    {
        // 対象のデータを削除
        Contact::findOrFail($id)->delete();

        // 削除後に管理画面へ戻す
        return redirect()->route('admin.index')->with('success', '削除しました');
    }

    
}