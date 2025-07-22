<?php

namespace App\Providers;

use App\Http\Requests\RegisterRequest;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\RegisterUserViaRequest;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // ログイン画面を指定（auth/login.blade.phpを表示）
        Fortify::loginView(function () {
            return view('auth.login');
        }); 

        // 登録画面を指定（auth/register.blade.phpを表示）
        Fortify::registerView(function () {
            return view('auth.register');
        });

        // 新規ユーザー登録処理のクラスを指定（FormRequest経由でユーザー作成）
        Fortify::createUsersUsing(RegisterUserViaRequest::class);

        // ログイン認証処理
        Fortify::authenticateUsing(function (LoginRequest $request) {
            // メールアドレスに一致するユーザーを検索
            $user = User::where('email', $request->email)->first();

            // パスワードが一致すればユーザーを返す
            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }

            // 一致しなければnull（ログイン失敗）
            return null;
        });
    }
}