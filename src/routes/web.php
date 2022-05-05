<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * 認証系に関するルーティング
 */
Auth::routes();


/**
 * トップページ関連のルーティング
 */
Route::get('/', 'pulchryellController@index')->name('pulchryell.index');
Route::prefix('/pulchryell')->name('pulchryell.')->group(function () {
    Route::get('/privacy', 'pulchryellController@privacy')->name('privacy');
    Route::get('/term', 'pulchryellController@term')->name('term');
    Route::get('/commercial', 'pulchryellController@commercial')->name('commercial');
    Route::get('/company', 'pulchryellController@company')->name('company');
    Route::get('/concept', 'pulchryellController@concept')->name('concept');
    Route::get('/question', 'pulchryellController@question')->name('question');
    Route::get('/inquiry', 'pulchryellController@inquiry')->name('inquiry');
    Route::get('/inquiryConfirm', 'pulchryellController@inquiryConfirm')->name('inquiryConfirm');
    Route::get('/inquiryComplete', 'pulchryellController@inquiryComplate')->name('inquiryComplete');
});


/**
 * ユーザー管理機能に関するルーティング
 */
Route::prefix('/users')->name('users.')->middleware('can:only_user,user')->group(function () {
    Route::get('/show/{user}', 'UserController@show')->name('show');
    Route::get('/edit/{user}', 'UserController@edit')->name('edit');
    Route::get('/update/{user}', 'UserController@update')->name('update');
    Route::get('/delete/{user}', 'UserController@delete')->name('delete');
});
Route::get('/users/myPage', 'UserController@mypage')->name('user.myPage');
// 以下は管理者用の画面出力(一覧)
Route::prefix('/users')->name('users.')->middleware(['can:admin'])->group(function () {
    Route::get('manageIndex', 'UserController@manageIndex')->name('manage.index');
    Route::get('manageShow/{id}', 'UserController@manageShow')->name('manage.show');
    Route::get('manage', 'UserController@manageCsv')->name('manageCsv');
});

/**
 * 商品に関するルーティング
 */
Route::resource('/products', ProductController::class)->except(['index', 'show'])->middleware('can:admin');
Route::resource('/products', ProductController::class)->only(['index', 'show']);
Route::prefix('/product')->name('products.')->middleware('auth')->group(function () {
    Route::get('/{id}/likes', 'ProductController@likes')->name('likes');
    Route::put('/{id}/unlikes', 'ProductController@unlikes')->name('unlikes');
    Route::get('/{id}/carts', 'ProductController@carts')->name('carts');
    Route::put('/{id}/unCarts', 'ProductController@uncarts')->name('unCarts');
});

/*
以下は管理者用の画面出力(一覧、詳細)
編集画面・削除に関しては、上記に定義済み
*/
Route::prefix('/product')->name('products.')->middleware('can:admin')->group(function () {
    Route::get('manageIndex', 'ProductController@manageIndex')->name('manageIndex');
    Route::get('manageShow/{id}', 'ProductController@manageShow')->name('manageShow');
    Route::get('manageCsv', 'ProductController@manageCsv')->name('manageCsv');
});

/**
 * レビューに関するルーティング
 */
Route::resource('/reviews', EvaluationController::class);


/**
 * 注文に関するルーティング（ステータスの変更）
 */
Route::resource('/carts', CartController::class);
Route::prefix('/carts')->name('carts.')->middleware('auth')->group(function () {
    Route::get('/history/{id}', 'CartController@history')->name('history');
    Route::get('/historyDetail/{id}', 'CartController@historyDetail')->name('historyDetail');
});

/**
 * 管理者用の発注に関するルーティング(一覧、作成)
 */
Route::resource('/orders', OrderController::class)->middleware('can:admin');

/**
 * ブログ関連の画面出力
 */
// 以下は管理者用の画面出力(一覧、作成、編集、削除)
Route::resource('/blogs', BlogController::class)->except(['index', 'show'])->middleware('can:admin');
Route::resource('/blogs', BlogController::class)->only(['index', 'show']);
Route::prefix('/blog')->name('blogs.')->middleware('can:admin')->group(function () {
    Route::get('/manageIndex', 'BlogController@manageIndex')->name('manageIndex');
});

// 決済に関するルーティング
Route::group(['prefix' => '/stripe', 'as' => 'stripe.', 'middleware' => 'web'], function () {
    Route::post('/payment', 'PaymentController@payment')->name('payment');
});
