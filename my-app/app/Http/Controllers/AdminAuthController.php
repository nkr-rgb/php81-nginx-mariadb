<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        //リクエストからemailとpasswordだけ抜き出す
        $credentials = $request->only('email', 'password');

        //config/auth.phpのガードを使ってemailとpasswordの一致をチェック
        if (Auth::guard('admin')->attempt($credentials)) {
            //セキュリティのためにセッション再生成
            $request->session()->regenerate();
            //ログイン前の遷移先へ移動 or 遷移先が存在しなければ'admin/dashboard'へ
            return redirect()->intended('admin/dashboard');
        }

        //emailとpasswordが一致しなかった場合、sessionの'email'キーに文言入れて返す
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        //管理者のログイン状態だけを解除
        Auth::guard('admin')->logout();
        //セッションハイジャックのリスクを避けるため、セッションIDを破棄
        $request->session()->invalidate();
        //CSRFトークン再生成 ログアウト後も正常にフォーム送信をさせるため
        $request->session()->regenerateToken();
        //トップページへ遷移
        return redirect('/');
    }
}
