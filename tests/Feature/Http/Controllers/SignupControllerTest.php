<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class SignupControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ユーザー登録画面が開ける
     *
     * @test
     */
    public function showSignup()
    {
        $this->get('signup')
            ->assertOK();
    }

    /**
     * ユーザー登録できる
     *
     * @test
     */
    public function canSignup()
    {
        //データ検証
        //DBに保存
        ///ログインされてからマイページへリダイレクト
        $valiData = [
            'name' => '太郎',
            'email' => 'aaa@gmail.com',
            'password' => 'password',
        ];

        $this->post('signup', $valiData)
            ->assertRedirect('mypage/posts');

        unset($valiData['password']);

        $this->assertDatabaseHas('users', $valiData);
        $user = User::firstWhere($valiData);
        $this->assertTrue(Hash::check('password', $user->password));
        $this->assertAuthenticatedAs($user);
    }

    /**
     * ユーザー登録で不正なデータは登録できない
     *
     * @test
     */
    public function signupValidate()
    {
        $url = 'signup';
        User::factory()->create(['email' => 'aaa@bbb.com']);

        $this->get('signup');
        $this->post($url, [])
            ->assertRedirect('signup');

        $this->post($url, ['name' => ''])->assertInvalid(['name' => '指定']);
        $this->post($url, ['name' => str_repeat('あ', 21)])->assertInvalid(['name' => '20文字以下']);
        $this->post($url, ['email' => ''])->assertInvalid(['email' => '指定']);
        $this->post($url, ['email' => 'aa@bb@cc'])->assertInvalid(['email' => '有効']);
        $this->post($url, ['email' => 'aaa@bbb.com'])->assertInvalid(['email' => '既に存在']);
        $this->post($url, ['password' => ''])->assertInvalid(['password' => '指定']);
        $this->post($url, ['password' => '1234567'])->assertInvalid(['password' => '文字以上']);
        $this->post($url, ['password' => '12345678'])->assertValid('password');
    }
}
