<?php

namespace App\Http\Controllers\Mypage;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * ログイン画面表示
     *
     * @return Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('mypage.login');
    }

    /**
     * Undocumented function
     *
     * @param LoginRequest $request
     * @return Illuminate\Routing\Redirector
     * @return Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        $requestArray = $request->toArray();
        unset($requestArray['_token']);
        if (Auth::attempt($requestArray)) {
            $request->session()->regenerate();

            return redirect('mypage/posts');
        }
        
        return back()->withErrors([
            'email' => 'メールアドレスかパスワードが間違っています。',
        ])->withInput();
    }

    /**
     * ログアウト処理
     *
     * @param Request $request
     * @return Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'))->with('status', 'ログアウトしました');
    }
}
