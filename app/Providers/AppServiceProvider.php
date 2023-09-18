<?php

namespace App\Providers;

use App\Models\Category;
use App\Queries\EloquentBuilder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Schema::defaultStringLength(191); //максимальный размер столбца - 767 байт. Т.к. у нас utf-8mb64, каждый символ занимает 4 байта, а значит, 191 - максимальный размер

        view()->composer('layouts.header', function($view) {

            if (\Illuminate\Support\Facades\Auth::check()) {
                $user = \Illuminate\Support\Facades\Auth::user();
            } else {
                $user = null;
            }

            $view->with('user', $user);
        });


        view()->composer('layouts.sidebar', function($view) {

            $categories = Category::with('products')->withCount('products')->get();
            $view->with('categories', $categories);

        });

        view()->composer('*', function($view) { // для всех шаблонов будут доступны текущие get-параметры

            $get_params_mass = [];

            if (count($_GET)) {
                foreach ($_GET as $key => $value) {
                    $get_params_mass += [$key => $value];
                }
            }

            $view->with('get_params_mass', $get_params_mass);

        });
//        Schema::defaultStringLength(191);
//
//        DB::listen(function ($query) {
//            if (config('app.debug'))
//            {
//                dump($query->sql);
//            }
//
//        });
    }
}
