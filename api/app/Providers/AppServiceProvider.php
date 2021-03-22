<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Cashier::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // リソースレスポンスがJSONに変換されるときに data キーでラッピングしない
        Resource::withoutWrapping();
    }
}
