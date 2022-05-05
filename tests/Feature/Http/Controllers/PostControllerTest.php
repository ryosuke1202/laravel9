<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Middleware\PostShowLimit;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class PostController extends TestCase
{
    //これ重要！！
    use RefreshDatabase;
    
    /**
     * トップページでブログ一覧が表示される
     * 
     * @test
     */
    public function showBlogList()
    {
        $post1 = Post::factory()->hasComments(3)->create(['title' => 'ブログタイトル1']);
        $post2 = Post::factory()->hasComments(5)->create(['title' => 'ブログタイトル2']);
        Post::factory()->hasComments(1)->create();

        // $response = $this->get('/');//実行
        // $response->assertOk()//検証
        //     ->assertSee($post1->title)
        //     ->assertSee($post2->title);

        $this->get('/')
            ->assertOk()//エラーメッセージを的確に出すためにもこれは必ず入れるようにするs
            ->assertSee('ブログタイトル1')
            ->assertSee('ブログタイトル2')
            ->assertSee($post1->user->name)
            ->assertSee($post2->user->name)
            ->assertSee('（3件のコメント）')
            ->assertSee('（5件のコメント）')
            ->assertSeeInOrder([
                '（5件のコメント）',
                '（3件のコメント）',
                '（1件のコメント）'
            ]);
    }

    /**
     * 公開フラグのブログ一覧が表示される
     * 
     * @test
     */
    public function showBlogListOnlyOpenStatus()
    {
        $post1 = Post::factory()->closed()->create([
            'title' => 'これは非公開のブログです'
        ]);
        $post2 = Post::factory()->create([
            'title' => 'これは公開済みのブログです'
        ]);

        $this->get('/')
        ->assertSee('これは公開済みのブログです')
        ->assertDontSee('これは非公開のブログです');
    }

    /**
     * ブログの詳細画面が表示できる
     * 
     * @test
     */
    public function canShowBlogDetail()
    {
        $post = Post::factory()->create();

        $this->get('posts/' . $post->id)
            ->assertOk()
            ->assertSee($post->title)
            ->assertSee($post->user->name);
    }

    /**
     * ブログの詳細画面でコメントが古い順に表示される
     * 
     * @test
     */
    public function showCommentOlest()
    {
        // $this->withoutMiddleware(PostShowLimit::class);

        $post = Post::factory()->create();
        [$comment1, $comment2, $comment3] = Comment::factory()->createMany([
            ['created_at' => now()->sub('2 days'), 'name' => 'コメント太郎', 'post_id' => $post->id],
            ['created_at' => now()->sub('3 days'), 'name' => 'コメント二郎', 'post_id' => $post->id],
            ['created_at' => now()->sub('1 days'), 'name' => 'コメント三郎', 'post_id' => $post->id]
        ]);

        $this->get('posts/' . $post->id)
            ->assertOk()
            ->assertSeeInOrder([
                'コメント二郎',
                'コメント太郎',
                'コメント三郎'
            ]);
    }

    /**
     * ブログが非公開のものは詳細画面は表示できない
     * 
     * @test
     */
    public function canNotShowBlogDetailClosedStatus()
    {
        $post = Post::factory()->closed()->create();

        $this->get('posts/' . $post->id)
            ->assertForbidden();
    }

    /**
     * クリスマスの日はメリークリスマスと表示される
     * 
     * @test
     */
    public function showMerryChristmas()
    {
        $post = Post::factory()->create();

        Carbon::setTestNow('2022-12-24');

        $this->get('posts/' . $post->id)
            ->assertOK()
            ->assertDontSee('メリークリスマス');

        Carbon::setTestNow('2022-12-25');

        $this->get('posts/' . $post->id)
            ->assertOK()
            ->assertSee('メリークリスマス');
    }

    /**
     * ブログの詳細画面でランダムな文字列が表示されているか
     * 
     * @test
     */
    public function showRandomString()
    {        
        $post = Post::factory()->create();
        
        $this->get('posts/' . $post->id)
            ->assertOk();
    }
}
