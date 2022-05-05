<?php

namespace App\Http\Controllers;

use App\Evaluation;
use Illuminate\Http\Request;
use Throwable;

class EvaluationController extends Controller
{
    /**
     * レビューの一覧表示
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            // レビュー内容を取得
            $evaluation = Evaluation::all();

            // フロントまだのためデバッグのみ
            ddd($evaluation);

            return view('pages.reviews.index',['evaluation' => $evaluation]);

        } catch(Throwable $e) {

            // 失敗した原因をログに記録+エラーを通知
            Log::error($e);
            throw $e;

        }

    }

    /**
     * レビューの登録画面へ
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {

            // 登録画面へ
            return view('pages.reviews.create');

        } catch(Throwable $e) {

            // 失敗した原因をログに記録+エラーを通知
            Log::error($e);
            throw $e;

        }

    }

    /**
     * レビューを新規登録後、一覧画面へ
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Evaluation $evaluation)
    {
        try {

            // 送信された情報を登録
            $evaluation->fill($request->all());
            $evaluation->user_id = $request->user()->id;
            $evaluation->save();


            return redirect()->route('pages.reviews.index')->with('message','レビューを投稿しました。');

        } catch(Throwable $e) {

            // ロールバック・ログに記載・ビューに表記
            DB::rollback();
            Log::error($e);
            throw $e;

        }

    }

    /**
     * レビューの詳細情報を表示
     *
     * @param  \App\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluation $evaluation)
    {
        try {

            // フロントまだのためデバッグ
            ddd($evaluation);

            // レビューの詳細情報を取得
            return view('pages.reviews.show', ['evaluation' => $evaluation]);

        } catch(Throwable $e) {

            // 失敗した原因をログに記録+エラーを通知
            Log::error($e);
            throw $e;

        }

    }

    /**
     * 編集画面を表示
     *
     * @param  \App\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluation $evaluation)
    {
        try {

            // フロントまだのためデバッグ
            ddd($evaluation);

            // 編集するレビュー情報を取得
            return view('pages.reviews.edit', ['evaluation' => $evaluation]);

        } catch(Throwable $e) {

            // 失敗した原因をログに記録+エラーを通知
            Log::error($e);
            throw $e;

        }

    }

    /**
     * レビュー情報を更新し、編集画面へ戻る
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        try {

            // 更新する
            $evaluation->fill($request->all())->save();

            return redirect()->back()->with('message','編集が完了しました');

        } catch(Throwable $e) {

            // ロールバック・ログに記載・ビューに表記
            DB::rollback();
            Log::error($e);
            throw $e;

        }
    }

    /**
     * レビュー情報を削除し、
     *
     * @param  \App\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluation $evaluation)
    {
        try {

            // レービュー情報を削除する
            $evaluation->delete();

            return redirect()->route('pages.reviews.index')->with('message', 'レビューを削除しました。');

        } catch(Throwable $e) {

            // ロールバック・ログに記載・ビューに表記
            DB::rollback();
            Log::error($e);
            throw $e;

        }
    }
}
