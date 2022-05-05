<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log as FacadesLog;
use Log;
use Throwable;

class UserController extends Controller
{
    // マイページの表示
    public function myPage()
    {
        try {

            // ログイン情報より、ユーザー情報を取得
            $user = Auth::user();
            // フロント未完成のため、デバッグのみ
            ddd($user);

            return view('pages.users.myPage', ['user' => $user]);
        } catch (Throwable $e) {

            // ログに記載・ビューに表記
            Log::error($e);
            throw $e;
        }
    }

    /**
     * ユーザー情報の詳細画面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        try {

            // フロント未完成のため、デバッグのみ
            ddd($user);

            return view('pages.users.show', ['user' => $user]);
        } catch (Throwable $e) {

            // ログに記載・ビューに表記
            Log::error($e);
            throw $e;
        }
    }

    /**
     * ユーザー情報編集画面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        try {

            // フロント未完成のため、デバッグのみ
            ddd($user);
            
            return view('pages.users.edit', ['user' => $user]);
        } catch (Throwable $e) {

            // ログに記載・ビューに表記
            Log::error($e);
            throw $e;
        }
    }

    /**
     * ユーザー情報を更新し、マイページ画面に遷移
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        public function update(Request $request, User $user)
        {
            try {

                // 入力された情報をもとに更新
                $user->fill($request->all())->save();

                // フロント未完成のため、デバッグのみ
                ddd($user);

                return redirect()->route('user.myPage');

            } catch(Throwable $e) {
                // ロールバック・ログに記載・ビューに表記
                DB::rollback();
                Log::error($e);
                throw $e;

            }
        }

        /**
         * ユーザー情報の削除し、マイページに遷移
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy(User $user)
        {
            try {

                // ユーザー情報を削除
                $user->delete();

                return redirect()->route('user.myPage');

            } catch(Throwable $e) {

                // ロールバック・ログに記載・ビューに表記
                DB::rollback();
                Log::error($e);
                throw $e;
            }

        }

    public function manageIndex(User $user)
    {
        try {

            $users = $user->getUserCollection();
            return view('pages.users.manage.index', ['users' => $users]);
        } catch (Throwable $e) {

            // 失敗した原因をログに記録+エラーを通知
            Log::error($e);
            throw $e;
        }
    }

    public function manageShow(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);

            User::setUserInf($user);

            return view('pages.users.manage.show', ['user' => $user]);
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }
    }

    public function manageCsv(User $user)
    {
        try {
            //CSV出力するため配列で取得
            $users = User::all()->toArray();
            //CSV形式で情報をファイルに出力のための準備
            $csvFileName = '/tmp/' . time() . rand() . '.csv';
            $stream = fopen($csvFileName, 'w');
            // ヘッダーの取得
            $header = $user->csvHeader();
            //文字化け防止
            $header = mb_convert_encoding($header, "SJIS", "UTF-8");
            fputcsv($stream, $header);
            if (empty($users)) {
                //文字化け防止
                $noData = mb_convert_encoding(['データがありません'], "SJIS", "UTF-8");
                fputcsv($stream, $noData);
            } else {
                foreach ($users as $row) {
                    //文字化け防止
                    $row = mb_convert_encoding($row, "SJIS", "UTF-8");
                    //CSV出力するデータを取得
                    $data = $user->csvUser($row);
                    fputcsv($stream, $data);
                }
            }
            // ファイルを閉じる
            fclose($stream);

            // ダウンロード開始
            header('Content-Type: application/octet-stream');
            // ここで渡されるファイルがダウンロード時のファイル名になる
            header('Content-Disposition: attachment; filename=顧客一覧.csv');
            header('Content-Transfer-Encoding: binary');
            readfile($csvFileName);
        } catch (Throwable $e) {

            // 失敗した原因をログに記録+エラーを通知
            Log::error($e);
            throw $e;
        }
    }
}
