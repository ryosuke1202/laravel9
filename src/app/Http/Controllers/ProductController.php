<?php

namespace App\Http\Controllers;

use App\Product;
use App\Tag;
use App\Type;
use App\Http\Requests\ProductCreateRequest;
use Illuminate\Http\Request;
use Log;
use Throwable;
use DB;

class ProductController extends Controller
{
    /**
     * 商品の一覧ページ
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            // 全商品の情報を取得
            $products = Product::all();

            // フロント未完成のため、デバッグ処理
            ddd($products);

            return view('product.index', ['products' => $products]);

        } catch(Throwable $e) {

            // 失敗した原因をログに記録+エラーを通知
            Log::error($e);
            throw $e;
        }
    }

    /**
     * 新規商品登録ページ
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        try {
            
            //商品登録にtagとtypeの情報が必要なため取得
            $tags = Tag::all();
            $types = Type::all();
            $title = '商品登録';
            $submit = '新規登録する';
            return view('pages.products.entry',[
                'product' => $product,
                'tags' => $tags,
                'types' => $types,
                'title' => $title,
                'submit' => $submit
            ]);

        } catch(Throwable $e) {

            // 失敗した原因をログに記録+エラーを通知
            Log::error($e);
            throw $e;

        }
    }

    /**
     * 新規商品登録処理後、登録画面へ
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request, Product $product)
    {
        try {

            //新規登録の時だけ画像は必須に
            $validated = $request->validate([
                'image' => 'required'
            ]);
            //画像の保存
            $imageName = request()->file('image')->getClientOriginalName();
            request()->file('image')->move('storage/images', $imageName);
            $product->image = $imageName;
            // 受信したデータを保存する
            $product->fill($request->except(['image']));
            $product->save();

            return redirect()->back()->with('message', '商品登録完了しました。');

        } catch(Throwable $e) {

            // ロールバック・ログに記載・ビューに表記
            DB::rollback();
            Log::error($e);
            throw $e;
        }
    }

    /**
     * 商品詳細ページ
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        try {

            // フロント未完成のため、デバッグ処理
            ddd($product);

            return view('product.show', ['product' => $product]);

        } catch(Throwable $e) {

            // 失敗した原因をログに記録+エラーを通知
            Log::error($e);
            throw $e;
        }
    }

    /**
     * 商品情報編集ページ
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        try {

            //商品登録にtagとtypeの情報が必要なため取得
            $tags = Tag::all();
            $types = Type::all();
            $title = '商品編集';
            $submit = '更新する';
            return view('pages.products.entry', [
                'product' => $product,
                'tags' => $tags,
                'types' => $types,
                'title' => $title,
                'submit' => $submit,
            ]);
        } catch(Throwable $e) {

            // 失敗した原因をログに記録+エラーを通知
            Log::error($e);
            throw $e;
        }
    }

    /**
     * 商品情報の更新後、編集画面へ
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductCreateRequest $request, Product $product)
    {
        try {

            //更新は画像は必須じゃない
            if ($request->image){
                //画像の保存
                $imageName = request()->file('image')->getClientOriginalName();
                request()->file('image')->move('storage/images', $imageName);
                $product->image = $imageName;
            }
            // 受信したデータを保存する
            $product->fill($request->except(['image']));
            $product->save();

            return redirect()->route('products.manageIndex')->with('message', '商品情報を更新しました。');

        } catch(Throwable $e) {

            // ロールバック・ログに記載・ビューに表記
            DB::rollback();
            Log::error($e);
            throw $e;
        }
    }

    /**
     * 商品の削除後、一覧画面へ
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {

            $product->delete();
            return redirect()->route('products.manageIndex')->with('message', '商品情報を削除しました。');

        } catch(Throwable $e) {

            // ロールバック・ログに記載・ビューに表記
            Log::error($e);
            throw $e;
        }
    }

    public function manageIndex(Product $product)
    {
        try{
            
            $products = Product::with('type')->paginate(10);
            
            return view('pages.products.index',['products' => $products]);

        }catch(Throwable $e){

            // 失敗した原因をログに記録+エラーを通知
            Log::error($e);
            throw $e;

        }
    }

    public function manageShow(int $id)
    {
        $product = Product::with('tag', 'type')->find($id);

        return view('pages.products.show',['product' => $product]);
    }

    public function manageCsv(Product $product)
    {
        try{
            //CSV出力するため配列を取得
            $productsArray = $product->getProductArray();
            //CSV形式で情報をファイルに出力のための準備
            $csvFileName = '/tmp/' . time() . rand() . '.csv';
            $stream = fopen($csvFileName, 'w');
            // ヘッダーの取得
            $header = $product->csvHeader();
            //文字化け防止
            $header = mb_convert_encoding($header, "SJIS", "UTF-8");
            fputcsv($stream, $header);
            if (empty($productsArray)) {
                //文字化け防止
                $noData = mb_convert_encoding(['データがありません'], "SJIS", "UTF-8");
                fputcsv($stream, $noData);
            } else {
                foreach ($productsArray as $row) {
                    //文字化け防止
                    $row = mb_convert_encoding($row, "SJIS", "UTF-8");
                    //CSV出力するデータを取得
                    $data = $product->csvProduct($row);
                    fputcsv($stream, $data);
                }
            }
            // ファイルを閉じる
            fclose($stream);
    
            // ダウンロード開始
            header('Content-Type: application/octet-stream');
            // ここで渡されるファイルがダウンロード時のファイル名になる
            header('Content-Disposition: attachment; filename=商品一覧.csv'); 
            header('Content-Transfer-Encoding: binary');
            readfile($csvFileName);

        }catch(Throwable $e){

            // 失敗した原因をログに記録+エラーを通知
            Log::error($e);
            throw $e;

        }
    }
}
