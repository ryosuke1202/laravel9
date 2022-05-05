<?php

namespace App\Http\Controllers\Mypage;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBlogRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostManageController extends Controller
{
    /**
     * 自分の投稿記事の表示
     *
     * @return Illuminate\Contracts\View\View
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::id())->get();

        return view('mypage.posts.index', ['posts' => $posts]);
    }

    /**
     * ブログ新規投稿画面
     *
     * @return Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('mypage.posts.create');
    }

    /**
     * ブログ新登録処理
     *
     * @param CreateBlogRequest $request
     * @param Post $post
     * @return Illuminate\Routing\Redirector
     */
    public function store(CreateBlogRequest $request, Post $post)
    {
        $data = $request->only('title', 'body');
        $post->fill($data);
        $post->user_id = Auth::id();
        //右辺がtrueだったら1が左辺に入りfalseだったら0が入る
        $post->status = $request->boolean('status');
        $post->save();
        $posts = Post::latest()->first();

        return redirect('mypage/posts/edit/' . $posts->id)
            ->with('status', 'ブログを登録しました');
    }

    /**
     * 編集画面を表示
     *
     * @param Post $post
     * @return Illuminate\Contracts\View\View
     */
    public function edit(Post $post)
    {
        abort_if (Auth::id() !== $post->user_id, 403);

        $data = old() ?: $post;

        return view('mypage.posts.edit', ['data' => $data]);
    }

    /**
     * ブログの更新処理
     *
     * @param CreateBlogRequest $request
     * @param Post $post
     * @return Illuminate\Routing\Redirector
     */
    public function update(CreateBlogRequest $request, Post $post)
    {
        //権限チェック
        abort_if (Auth::id() !== $post->user_id, 403);
        $data = $request->only('title', 'body');
        $post->fill($data);
        //右辺がtrueだったら1が左辺に入りfalseだったら0が入る
        $post->status = $request->boolean('status');
        $post->save();

        return redirect(route('posts.edit', $post))
            ->with('status', 'ブログを更新しました');
    }

    /**
     * ブログの削除処理
     *
     * @param Post $post
     * @return Illuminate\Routing\Redirector
     */
    public function destroy(Post $post)
    {
        //権限チェック
        abort_if (Auth::id() !== $post->user_id, 403);
        $post->delete();//付随するコメントはDBの制約を使って削除する(cascadeOnDelete)

        return redirect(route('mypage.posts'));
    }
}
