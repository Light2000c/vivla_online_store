<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class viewServiceProvider extends ServiceProvider
{


    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

        View::composer('*', function ($view) {

                $categories = Category::orderBy("created_at", "DESC")->take(10)->get();
                View::share('globalCategories', $categories);
        });
    }
}
