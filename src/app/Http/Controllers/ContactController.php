<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * 入力フォーム画面を表示
     */
    public function form()
    {
        $categories = Category::all();
        return view('form', compact('categories'));
    }

    /**
     * 確認画面を表示（POSTされたフォームデータを受け取る）
     */
    public function confirm(ContactRequest $request)  //バリデーションをContactRequestに定義
    {
        // 全てのフォームデータを取得して変数にまとめる
        $formData = $request->all();

        // 電話番号を連結して1つにまとめる
        $formData['tel'] = $request->input('tel1') . '-' . $request->input('tel2') . '-' . $request->input('tel3');

        // category_id からカテゴリ名を取得
        $category = Category::find($formData['category_id']);
        $formData['category_name'] = $category ? $category->content : '';

        // confirm.blade.php にデータを渡して表示
        // dd($formData)['detail'];
        return view('confirm', compact('formData'));
    }

    /**
     * 送信完了画面を表示
     */
    public function thanks()
    {
        // thanks.blade.php を表示する
        return view('thanks');
    }

    //修正ボタンを押したときの処理
    public function fix(Request $request)
    {
        // 直前の確認画面の入力値をセッションに保存
        return redirect()->route('contact.form')->withInput();
    }
    
    //送信処理（データベースに保存して、サンクスページへ）
    public function send(Request $request)
    {
        //フォームの全データを取得
        $formData = $request->all();

        //データベースに保存
        Contact::create([
            'last_name' => $formData['last_name'],
            'first_name' => $formData['first_name'],
            'gender' => $formData['gender'],
            'email' => $formData['email'],
            'tel' => $formData['tel'],
            'address' => $formData['address'],
            'building' => $formData['building'],
            'category_id' => $formData['category_id'],
            'detail' => $formData['detail'], // ←ここが重要！！
        ]);

        //サンクスページへリダイレクト
        return redirect()->route('contact.thanks');
    }
}