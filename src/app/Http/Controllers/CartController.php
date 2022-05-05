<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Status;
use App\TotalFee;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use Throwable;

class CartController extends Controller
{
    /**
     * ユーザーごとのカート内商品一覧を表示
     *
     * @return \Illuminate\Http\Response
     */
    public function history()
    {

        try {

            // カート内商品を取得
            $carts = Cart::all()->where('id', Auth::id());

            // フロント完成まではデバッグ
            ddd($carts);

            return view('pages.carts.history', ['carts' => $carts]);
        } catch (Throwable $e) {
            // 失敗時に、原因とログを出力
            Log::error($e);
            throw $e;
        }
    }

    /**
     * カート内商品の詳細を表示
     * これ不要ではないか
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function historyDetail(Cart $cart)
    {

        try {
            // カート内商品の詳細を表示？
            return view('pages.historyDetail', ['cart' => $cart]);
        } catch (Throwable $e) {
            // 失敗時に、原因とログを出力
            Log::error($e);
            throw $e;
        }
    }

    /**
     * 注文された情報を一覧表示
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            //管理者のみ
            Gate::authorize('admin');
            // 注文された情報を20件取得
            $carts = Cart::whereIn('status_id', [2, 3, 4])->with(['statuses', 'users', 'totalFee'])->paginate(7);
            $orderNumbers = Cart::all()->map(function ($cart) {
                return $cart->order_number;
            });

            return view('pages.carts.index', ['carts' => $carts, 'orderNumbers' => $orderNumbers]);
        } catch (Throwable $e) {
            // 失敗した原因をログに記録+エラーを通知
            Log::error($e);
            throw $e;
        }
    }

    /**
     * 注文された商品の詳細を表示
     *
     * @param  \App\Cart $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        try {
            //管理者のみ
            Gate::authorize('admin');
            // 注文番号より、注文情報を取得
            $carts = Cart::where('order_number', $request->cart)
                ->with(['statuses', 'users', 'totalFee', 'products', 'types', 'tags'])
                ->get();

            // 郵便番号をハイフンありにする
            $zipCode = substr($carts[0]->users->zip_code, 0, 3) . "-" . substr($carts[0]->users->zip_code, 3);

            // ユーザー情報のみを変数に定義
            $user = $carts[0]->users;

            return view('pages.carts.show', ['carts' => $carts, 'zipCode' => $zipCode, 'user' => $user]);
        } catch (Throwable $e) {
            // 失敗した原因をログに記録+エラーを通知
            Log::error($e);
            throw $e;
        }
    }

    /**
     * 発送した注文のステータスを変更する（管理者用）
     *
     * @param  \App\Cart $cart
     * @return \Illuminate\Http\Response
     */
    // public function update(Cart $cart)
    public function update(Request $request)
    {

        try {
            //管理者のみ
            Gate::authorize('admin');
            // 送られてきたリクエストをidをもとに情報を取得
            $cart = Cart::where('id', $request['request'])->first();

            // ステータスを送信済み(3)に変更。
            $cart->status_id = 3;

            // データ内容で更新
            $cart->save();

            // 受信したデータを返す
            return $cart;
        } catch (Throwable $e) {
            // ロールバック・ログに記載・ビューに表記
            DB::rollback();
            Log::error($e);
            throw $e;
        }
    }

    /**
     * 注文をキャンセルする（ユーザー用）
     * 実際には、ソフトデリートする
     *
     * @param  \App\Cart $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {

        try {

            // ステータスを３に変更し、保存する
            $cart->status_id = 4;
            $cart->save();

            // メッセージを送信する
            return redirect()->route('products.index')->with('message', '注文をキャンセルしました。');
        } catch (Throwable $e) {
            // ロールバック・ログに記載・ビューに表記
            Log::error($e);
            throw $e;
        }
    }
}
