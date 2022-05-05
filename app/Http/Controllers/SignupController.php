<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    /**
     * 新規登録画面を表示
     *
     * @return Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('signup');
    }

    /**
     * 新規登録処理
     *
     * @param SignupRequest $request
     * @return Illuminate\Routing\Redirector
     */
    public function store(SignupRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        auth()->login($user);

        return redirect('mypage/posts');
    }
}
