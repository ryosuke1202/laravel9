<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function payment()
    {
        try{

            $id = Auth::id();
            $carts = Cart::where('user_id', $id)->with('products')->get();

            //cartが空で決済画面に来たらカート画面にリダイレクト
            if ($carts->isEmpty()) {
                return redirect(route('carts.history'));
            }
    
            $line_items = [];
            foreach ($carts as $cart) {
                $line_item = [
                    'name'        => $cart->products->name,
                    'description' => $cart->products->description,//商品説明要らなければ削除
                    'amount'      => $cart->products->price,
                    'currency'    => 'jpy',
                    'quantity'    => $cart->quantity,
                ];
                $line_items[] = $line_item;
            }
            
            //.envファイルにstripeの公開可能キーとシークレットキーを設定
            \Stripe\Stripe::setApiKey(config('services.stripe.st_key'));
    
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items'           => [$line_items],
                'success_url'          => route('blogs.manageIndex'),//決済成功後のリダイレクト先(仮)
                'cancel_url'           => route('blogs.manageIndex'),
            ]);
    
            return view('pages.payment.checkout',[
                    'session' => $session,
                    'publicKey' => config('services.stripe.pb_key'),
                    'url' => route('carts.index'),
            ]);

        }catch(Throwable $e){

            // 失敗した原因をログに記録+エラーを通知
            Log::error($e);
            throw $e;

        }
    }
}
