<?php

namespace App\Providers;

use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
// use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //管理者(全機能)
        Gate::define('admin', function (User $user) {
            return ($user->role_id == User::ADMIN_USER);
        });
        //ユーザー情報は自分の情報だけ見れるように制御(クロージャの第1引数はログインユーザー,第2引数はパラメーターで送られてきたモデル)
        Gate::define('only_user', function (User $user, User $model) {
            return ($user->id == $model->id);
        });
        /**
         * Collectionに対して paginate できるようにするマクロ
         *
         * @param int $perPage
         * @param int $total
         * @param int $page
         * @param string $pageName
         * @return array
         */
        // Collection::macro('paginate', function ($perPage, $total = null, $page = null, $pageName = 'page') {
        //     $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
        //     return new LengthAwarePaginator(
        //         $this->forPage($page, $perPage),
        //         $total ?: $this->count(),
        //         $perPage,
        //         $page,
        //         [
        //             'path' => LengthAwarePaginator::resolveCurrentPath(),
        //             'pageName' => $pageName,
        //         ]
        //     );
        // });
    }
}
