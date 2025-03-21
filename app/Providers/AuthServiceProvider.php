<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //講師のみ
        // Gate::define('admin_only', function ($user) {
        //     return ($user->role === 1);
        //         // usersテーブルのカラム名role
        // });
        // Gate::define('admin_only', function ($user) {
        //     return ($user->role === 2);
        // });
        // Gate::define('admin_only', function ($user) {
        //     return ($user->role === 3);
        // });
        // 分けて書くと最後ののみ反映されて３の講師にしか出ない形になる。下記のように一緒に書く
        Gate::define('admin_only', function ($user){
            return in_array($user->role,[1,2,3]);
        });
    }
}
