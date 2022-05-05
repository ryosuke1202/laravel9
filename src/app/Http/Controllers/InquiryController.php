<?php

namespace App\Http\Controllers;

use App\Inquiry;
use DB;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Log;
use Throwable;

class InquiryController extends Controller
{
    /**
     * 問い合わせ一覧
     *
     * @return Application|Factory|Response|View
     * @throws Throwable
     */
    public function index()
    {
        try{

            $inquiries = Inquiry::all();

            // フロントまだなのでデバッグ
            ddd($inquiries);

            return view('pages.inquiry.index',['inquiries' => $inquiries]);


        }catch(Throwable $e){

            // 失敗した原因をログに記録+エラーを通知
            Log::error($e);
            throw $e;

        }
    }

    /**
     * 問い合わせ登録ページ
     *
     * @return Application|Factory|Response|View
     * @throws Throwable
     */
    public function create()
    {
        try{

            return view('pages.inquiry.create');

        }catch(Throwable $e){

            // 失敗した原因をログに記録+エラーを通知
            Log::error($e);
            throw $e;

        }
    }

    /**
     * 保存処理
     *
     * @param Request $request
     * @param Inquiry $inquiry
     * @return RedirectResponse|null
     * @throws Throwable
     */
    public function store(Request $request, Inquiry $inquiry): ?RedirectResponse
    {
        try{

            $inquiry->fill($request->all());
            $inquiry->save();

            return redirect()->back();

        }catch (Throwable $e) {

            // ロールバック・ログに記載・ビューに表記
            DB::rollback();
            Log::error($e);
            throw $e;

        }

    }

    /**
     * 問い合わせの詳細表示メソッド
     *
     * @param Inquiry $inquiry
     * @return Application|Factory|Response|View
     * @throws Throwable
     */
    public function show(Inquiry $inquiry)
    {
        try{

            // フロントまだなのでデバッグ
            ddd($inquiry);

            return view('pages.inquiry.show',['inquiry' => $inquiry]);

        }catch(Throwable $e){

            // 失敗した原因をログに記録+エラーを通知
            Log::error($e);
            throw $e;

        }
    }

    /**
     * 不要な問い合わせの削除メソッド
     *
     * @param Inquiry $inquiry
     * @return RedirectResponse|null
     * @throws Throwable
     */
    public function destroy(Inquiry $inquiry): ?RedirectResponse
    {
        try{

            $inquiry->delete();
            return redirect()->route('pages.inquiry.index')->with('message', '問い合わせを削除しました。');

        }catch (Throwable $e) {

            // ログに記載・ビューに表記
            Log::error($e);
            throw $e;

        }
    }
}
