<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    // 認可の処理。今回は全ユーザーに許可するので true を返す
    public function authorize(): bool
    {
        return true;
    }

    // バリデーションルールを定義
    public function rules(): array
    {
        return [
            'last_name' => 'required',                    // 姓（必須）
            'first_name' => 'required',                   // 名（必須）
            'gender' => 'required',                       // 性別（必須）
            'email' => 'required|email',                  // メールアドレス（必須・形式）
            'tel1' => 'required|numeric|digits_between:1,5',
            'tel2' => 'required|numeric|digits_between:1,5',
            'tel3' => 'required|numeric|digits_between:1,5',
            'address' => 'required',                      // 住所（必須）
            'category_id' => 'required',                  // 問い合わせの種類（必須）
            'detail' => 'required|max:120',              // 問い合わせ内容（必須・120文字以内）
        ];
    }

    // エラーメッセージをカスタマイズ
    public function messages(): array
    {
        return [
            'last_name.required' => '姓を入力してください',
            'first_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'tel1.required' => '電話番号を入力してください',
            'tel1.numeric' => '電話番号は5桁までの数字で入力してください',
            'tel1.digits_between' => '電話番号は5桁までの数字で入力してください',
            'tel2.required' => '電話番号を入力してください',
            'tel2.numeric' => '電話番号は5桁までの数字で入力してください',
            'tel2.digits_between' => '電話番号は5桁までの数字で入力してください',
            'tel3.required' => '電話番号を入力してください',
            'tel3.numeric' => '電話番号は5桁までの数字で入力してください',
            'tel3.digits_between' => '電話番号は5桁までの数字で入力してください',
            'address.required' => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max' => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}
