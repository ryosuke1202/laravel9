<?php

namespace Tests\Feature\Http\Controllers\Mypage;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostManageControllerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * ゲストはブログを管理できない
     *
     * @test
     */
    public function guestCanNotShowMypage()
    {
        $loginUrl = 'mypage/login';
        
        $this->get('mypage/posts')->assertRedirect($loginUrl);
        $this->get('mypage/posts/create')->assertRedirect($loginUrl);
        $this->post('mypage/posts/create', [])->assertRedirect($loginUrl);
        $this->get('mypage/posts/edit/1')->assertRedirect($loginUrl);
        $this->post('mypage/posts/edit/1', [])->assertRedirect($loginUrl);
        $this->delete('mypage/posts/delete/1')->assertRedirect($loginUrl);
    }
    /**
     * マイページ、ブログ一覧で自分のデータのみ表示される
     *
     * @test
     */
    public function onlyMyBlogShow()
    {
        $user = $this->login();
        $other = Post::factory()->create();
        $myPost = Post::factory()->create(['user_id' => $user->id]);
        $this->get('mypage/posts')
            ->assertOk()
            ->assertDontSee($other->title)
            ->assertSee($myPost->title);
    }

    /**
     * ブログ新規投稿画面を表示できる
     *
     * @test
     */
    public function showBlogCreate()
    {
        $this->login();
        $this->get('mypage/posts/create')
            ->assertOk();
    }
    /**
     * ブログ新規登録できる。公開の場合
     *
     * @test
     */
    public function canCreateBlogOpen()
    {
        [$taro, $me, $jiro] = User::factory(3)->create();
        $this->login($me);

        $validData = [
            'title' => '私のブログタイトル',
            'body' => '私のブログ本文',
            'status' => Post::OPEN,
        ];

        $response = $this->post('mypage/posts/create', $validData);
        $post = Post::first();
        $response->assertRedirect('mypage/posts/edit/' . $post->id);
        $this->assertDatabaseHas('posts', array_merge($validData, ['user_id' => $me->id]));
    }
    /**
     * ブログ新規登録できる。非公開の場合
     *
     * @test
     */
    public function canCreateBlogClosed()
    {
        [$taro, $me, $jiro] = User::factory(3)->create();
        $this->login($me);

        $validData = [
            'title' => '私のブログタイトル',
            'body' => '私のブログ本文',
        ];

        $this->post('mypage/posts/create', $validData);
        
        $this->assertDatabaseHas('posts', array_merge($validData, [
            'user_id' => $me->id,
            'status' => Post::CLOSED,
        ]));
    }
    /**
     * ブログ新規登録時の入力チェック
     *
     * @test
     */
    public function blogCreateValidate()
    {
        $url = 'mypage/posts/create';

        $this->login();
        $this->from($url)->post($url, [])
            ->assertRedirect($url);

        $this->post($url, ['title' => ''])->assertInvalid(['title' => '指定']);
        $this->post($url, ['title' => str_repeat('a', 256)])->assertInvalid(['title' => '255文字以下']);
        $this->post($url, ['title' => str_repeat('a', 255)])->assertValid('title');
        $this->post($url, ['body' => ''])->assertInvalid(['body' => '指定']);
    }

    /** 
     * 自分のブログの編集画面を開ける
     * 
     * @test 
     */
    function myBlogShowEdit()
    {
        $user = $this->login();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $this->get('mypage/posts/edit/' . $post->id)
            ->assertOk();
    }

    /** 
     * 他人のブログの編集画面は開けない
     * 
     * @test 
     */
    function canNotShowOtherBlogEdit()
    {
        $this->login();
        $post = Post::factory()->create();
        $this->get('mypage/posts/edit/' . $post->id)
            ->assertForbidden();
    }

    /** 
     * 自分のブログは更新できる
     * 
     * @test 
     */
    function canUpdateMyBlog()
    {
        $validData = [
            'title' => '新タイトル',
            'body' => '新本文',
            'status' => '1',
        ];

        $post = Post::factory()->create();

        $this->login($post->user);

        $this->post('mypage/posts/edit/' . $post->id, $validData)
            ->assertRedirect('mypage/posts/edit/'.$post->id);

        $this->get('mypage/posts/edit/' . $post->id)
            ->assertSee('ブログを更新しました');

        $this->assertDatabaseHas('posts', $validData);
        //DBに保存されていることは確認したが、新規で追加されたかもしれない。なのでcountも確認
        $this->assertCount(1, Post::all());

        //freshで最新データを再取得する（項目が少ないときはfreshを使って）
        $this->assertSame('新タイトル', $post->fresh()->title);
        $this->assertSame('新本文', $post->fresh()->body);

        //項目が多いときはrefreshを使って
        // $post->refresh();
        // $this->assertSame('新タイトル', $post->title);
        // $this->assertSame('新本文', $post->body);
    }

    /** 
     * 他人のブログは更新できない
     * 
     * @test 
     */
    function canNotUpdateOtherBlog()
    {
        $validData = [
            'title' => '新タイトル',
            'body' => '新本文',
            'status' => '1',
        ];

        $post = Post::factory()->create(['title' => '元のタイトル']);

        $this->login();

        $this->post('mypage/posts/edit/' . $post->id, $validData)
            ->assertForbidden();

        $this->assertSame('元のタイトル', $post->fresh()->title);
    }

    /**
     * 自分のブログは削除できる、かつ付随するコメントも削除される
     *
     * @test
     */
    public function deleteOnlyMyBlog()
    {
        $post = Post::factory()->create();
        $myPostComment = Comment::factory()->create(['post_id' => $post->id]);
        $otherPostComment = Comment::factory()->create();

        $this->login($post->user);

        $this->delete('mypage/posts/delete/' . $post->id)
            ->assertRedirect(('mypage/posts'));

        //ブログ削除の確認(assertDeleteはVer.9で削除された)
        $this->assertModelMissing($post);
        
        //コメント削除の確認
        $this->assertModelMissing($myPostComment);
        $this->assertModelExists($otherPostComment);

    }

    /** 
     * 他人のブログを削除はできない
     * 
     * @test 
     */
    function canNotDeleteOtherBlog()
    {
        $post = Post::factory()->create();

        $this->login();

        $this->delete('mypage/posts/delete/' . $post->id)
            ->assertForbidden();
        
        $this->assertModelExists($post);
    }
}
