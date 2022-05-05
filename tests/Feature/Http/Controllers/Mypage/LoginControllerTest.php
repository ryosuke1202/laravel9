<?php

namespace Tests\Feature\Http\Controllers\Mypage;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ログイン画面を開ける
     *
     * @test
     */
    public function showLogin()
    {
        $this->get('mypage/login')
            ->assertOK();
    }

    /**
     * ログイン時の入力チェック
     *
     * @test
     */
    public function loginValidate()
    {
        $url = 'mypage/login';

        $this->from($url)->post($url, [])
            ->assertRedirect($url);

        $this->post($url, ['email' => ''])->assertInvalid(['email' => '指定']);
        $this->post($url, ['email' => 'aa@bb@cc'])->assertInvalid(['email' => '有効']);
        $this->post($url, ['email' => 'aa@ああ.いい'])->assertInvalid(['email' => '有効']);
        $this->post($url, ['password' => ''])->assertInvalid(['password' => '指定']);
    }

    /**
     * ログインできる
     *
     * @test
     */
    public function canLogin()
    {
        $user = User::factory()->create([
            'email' => 'aaa@bbb.com',
            'password' => Hash::make('abcd123')
        ]);

        $url = 'mypage/login';
        $this->post($url, [
            'email' => 'aaa@bbb.com',
            'password' => 'abcd123'
        ])->assertRedirect('mypage/posts');

        $this->assertAuthenticatedAs($user);
    }

    /**
     * パスワードを間違えているのでログインできず、適切なエラーメッセージが表示される
     *
     * @test
     */
    public function showErrorMessage()
    {
        $user = User::factory()->create([
            'email' => 'aaa@bbb.com',
            'password' => Hash::make('abcd123')
        ]);

        $url = 'mypage/login';
        $this->from($url)->post($url, [
            'email' => 'aaa@bbb.com',
            'password' => '1111111'
        ])->assertRedirect($url);

        $this->get($url)
            ->assertOk()
            ->assertSee('メールアドレスかパスワードが間違っています。');

    }

    /**
     * 認証エラーなのでvalidationExceptionの例外が発生する
     *
     * @test
     */
    public function happenvalidationException()
    {
        $this->withoutExceptionHandling();

        // $this->expectException(ValidationException::class);

        try {
            $this->post('mypage/login', [])
                ->assertRedirect();
            $this->fail('例外が発生しませんでしたよ。');
        } catch (ValidationException $e) {
            $this->assertSame('メールアドレスは必ず指定してください。',
                $e->errors()['email'][0]
            );
        }
    }

    /**
     * 認証OKなのでvalidationExceptionの例外が発生しない
     *
     * @test
     */
    public function notHappenvalidationException()
    {
        $this->withoutExceptionHandling();

        User::factory()->create([
            'email' => 'aaa@bbb.net',
            'password' => Hash::make('abcd1234'),
        ]);

        try {
            $this->post('mypage/login', [
                'email' => 'aaa@bbb.net',
                'password' => 'abcd1234',
            ])->assertRedirect();
        } catch (ValidationException) {
            $this->fail('例外が発生してしまいましたよ。');
        }
    }

    /**
     * ログアウトできる
     *
     * @test
     */
    public function canLogout()
    {
        $this->login();

        $this->post('mypage/logout')
            ->assertRedirect('mypage/login');
            
        $this->get('mypage/login')
            ->assertSee('ログアウトしました');

        $this->assertGuest();
            
    }
    
}
