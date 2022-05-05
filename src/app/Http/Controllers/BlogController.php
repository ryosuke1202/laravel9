<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Http\Requests\BlogCreateRequest;
use App\Product;
use DB;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Log;
use Throwable;

class BlogController extends Controller
{
    /**
     * 一覧表示
     *
     * @return Application|Factory|Response|View
     * @throws Throwable
     */
    public function index()
    {
        try{

            $blogs = Blog::all();

            // フロントまだなのでデバッグ
            ddd($blogs);

            return view('pages.blogs.index',['blogs' => $blogs]);


        }catch(Throwable $e){

            // 失敗した原因をログに記録+エラーを通知
            Log::error($e);
            throw $e;

        }

    }

    /**
     * 新規投稿ページ
     *
     * @return Application|Factory|Response|View
     * @throws Throwable
     */
    public function create(Blog $blog)
    {
        try{

            //blog作成にはpuducts_idが必要のため取得
            $products = Product::all();
            $title = 'ブログ作成';
            $submit = '投稿する';
            return view('pages.blogs.entry',[
                'blog' => $blog, 
                'products' => $products,
                'title' => $title,
                'submit' => $submit
            ]);

        }catch(Throwable $e){

            // 失敗した原因をログに記録+エラーを通知
            Log::error($e);
            throw $e;

        }

    }

    /**
     * フォームから取得した値を保存
     *
     * @param Request $request
     * @param Blog $blog
     * @return RedirectResponse
     */
    public function store(BlogCreateRequest $request, Blog $blog): RedirectResponse
    {
        try{

            $blog->fill($request->all());
            $blog->save();
            return redirect()->route('blogs.manageIndex')->with('message', '投稿完了しました');

        }catch (Throwable $e) {

            // ロールバック・ログに記載・ビューに表記
            DB::rollback();
            Log::error($e);
            throw $e;

        }

    }

    /**
     * 記事の詳細表示用
     *
     * @param Blog $blog
     * @return Application|Factory|Response|View
     * @throws Throwable
     */
    public function show(Blog $blog)
    {
        try{

            // フロントまだなのでデバッグ
            ddd($blog);

            return view('pages.blogs.show',['blog' => $blog]);

        }catch(Throwable $e){

            // 失敗した原因をログに記録+エラーを通知
            Log::error($e);
            throw $e;

        }

    }

    /**
     * 編集画面：一致するデータを返すだけ
     *
     * @param Blog $blog
     * @return Application|Factory|Response|View
     * @throws Throwable
     */
    public function edit(Blog $blog)
    {
        try{

            //blog作成にはpuducts_idが必要のため取得
            $products = Product::all();
            $title = 'ブログ編集';
            $submit = '変更する';
            return view('pages.blogs.entry',[
                'blog' => $blog, 
                'products' => $products,
                'title' => $title,
                'submit' => $submit
            ]);

        }catch(Throwable $e){

            // 失敗した原因をログに記録+エラーを通知
            Log::error($e);
            throw $e;

        }

    }

    /**
     * 更新メソッド：リダイレクトは編集画面へ戻す。
     *
     * @param Request $request
     * @param Blog $blog
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(BlogCreateRequest $request, Blog $blog): RedirectResponse
    {
        try{

            $blog->fill($request->all())->save();
            return redirect()->route('blogs.manageIndex')->with('message', '編集が完了しました');

        }catch (Throwable $e) {

            // ロールバック・ログに記載・ビューに表記
            DB::rollback();
            Log::error($e);
            throw $e;

        }
    }

    /**
     * 削除：リダイレクトはindex
     *
     * @param Blog $blog
     * @return RedirectResponse
     * @throws Exception|Throwable
     */
    public function destroy(Blog $blog): RedirectResponse
    {
        try{

            $blog->delete();
            return redirect()->route('blogs.manageIndex')->with('message', 'ブログ記事を削除しました。');

        }catch (Throwable $e) {

            // ログに記載・ビューに表記
            Log::error($e);
            throw $e;

        }

    }

    public function manageIndex()
    {
        try{

            $blogs = Blog::with('product')->paginate(7);
            return view('pages.blogs.manage.index',['blogs' => $blogs]);

        }catch(Throwable $e){

            // 失敗した原因をログに記録+エラーを通知
            Log::error($e);
            throw $e;

        }
    }

}
