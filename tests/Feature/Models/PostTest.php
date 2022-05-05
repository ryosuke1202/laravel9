<?php

namespace Tests\Feature\Models;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * userリレーションを返す
     * 
     * @test
     */
    public function userRelation()
    {
        $post = Post::factory()->create();

        $this->assertInstanceOf(User::class, $post->user);
    }

    /**
     * commentsリレーションを返す
     * 
     * @test
     */
    public function commentsRelation()
    {
        $post = Post::factory()->create();

        $this->assertInstanceOf(Collection::class, $post->comments);
    }

    /**
     * ブログの公開非公開のscope
     * 
     * @test
     */
    public function blogOpenClosedScope()
    {
        $post1 = Post::factory()->closed()->create();
        $post2 = Post::factory()->create();

        $posts = Post::onlyOpen()->get();

        $this->assertFalse($posts->contains($post1));
        $this->assertTrue($posts->contains($post2));
    }

    /**
     * ブログが非公開の時はtrueを返し、公開の時はfalseを返す
     * 
     * @test
     */
    public function whenClosedReturnTrue()
    {
        //createじゃなくてmakeにするとDBに保存せずにインスタンスだけを受け取れる。データが大容量の時には速度が少し速くなる
        $closed = Post::factory()->closed()->make();
        $open = Post::factory()->make();

        $this->assertTrue($closed->isClosed());
        $this->assertFalse($open->isClosed());
    }
}
