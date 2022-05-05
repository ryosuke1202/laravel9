<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * トップページでブログ一覧表示
     *
     * @return Illuminate\Contracts\View\View
     */
    public function index()
    {
        //withCountで関連モデルのカウント数を同時に取得
        $posts = Post::query()
            ->onlyOpen()
            ->with('user')
            ->orderByDesc('comments_count')
            ->withCount('comments')
            ->get();

        return view('index', ['posts' => $posts]);
    }

    /**
     * ブログの詳細画面表示
     *
     * @param Post $post
     * @return Illuminate\Contracts\View\View
     */
    public function show(Post $post)
    {
        abort_if($post->isClosed(), 403);

        $random = \Str::random(10);

        return view('posts.show', [
            'post' => $post,
            'random' => $random
        ]);
    }
}
