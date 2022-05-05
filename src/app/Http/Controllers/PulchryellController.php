<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Product;
use App\Blog;
use Throwable;

class PulchryellController extends Controller
{
    public function index()
    {

        try {
            // 商品の情報を5件取得
            $products = Product::orderBy('id', 'desc')->take(5)->get();

            // ブログ情報の最新3件を取得
            $blogs = Blog::orderBy('id', 'asc')->take(3)->get();

            return view('pages.pulchryell.landing', ['products' => $products, 'blogs' => $blogs]);
        } catch (Throwable $e) {

            // 失敗した原因をログに記録+エラーを通知
            Log::error($e);
            throw $e;
        }
    }

    public function commercial()
    {
        return view('pages.pulchryell.commercial');
    }

    public function company()
    {
        return view('pages.pulchryell.company');
    }

    public function concept()
    {
        return view('pages.pulchryell.concept');
    }

    public function inquiry()
    {
        return view('pages.pulchryell.inquiry');
    }

    public function inquiryComplete()
    {
        return view('pages.pulchryell.inquiryComplete');
    }

    public function privacy()
    {
        return view('pages.pulchryell.privacyPolicy');
    }

    public function question()
    {
        return view('pages.pulchryell.question');
    }

    public function term()
    {
        return view('pages.pulchryell.term');
    }
}
