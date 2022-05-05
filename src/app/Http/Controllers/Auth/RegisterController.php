<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Rules\Password;
use App\Rules\PhoneRule;
use App\Rules\ZipCode;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Password $password, ZipCode $zip_code, PhoneRule $phone)
    {
        $this->middleware('guest');
        $this->password = $password;
        $this->zip_code = $zip_code;
        $this->phone = $phone;
    }

    /**
     * ユーザー情報のバリデーション
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', $this->password],
            'phone' => ['required','unique:users', $this->phone],
            'sex' => ['required', 'integer'],
            'zip_code' => ['required', $this->zip_code],
            'prefecture' => ['required', 'string'],
            'city' => ['required', 'string'],
            'building' => ['required', 'string'],
        ]);
    }

    /**
     * ユーザー情報の新規登録
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'sex' => $data['sex'],
            'zip_code' => $data['zip_code'],
            'prefecture' => $data['prefecture'],
            'city' => $data['city'],
            'building' => $data['building'],
            'status' => 0,//制限なし
            'role_id' => 2,//変更予定(一旦管理者として作る)
        ]);
    }
}
