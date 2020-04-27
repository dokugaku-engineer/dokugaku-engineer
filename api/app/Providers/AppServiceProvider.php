<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Cache;
use Auth0\Login\LaravelCacheWrapper;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // リクエストごとにJWKsを取得するのを避けるためにキャッシュを設定する
        $this->app->bind(
            '\Auth0\SDK\Helpers\Cache\CacheHandler',
            function () {
                static $cacheWrapper = null;
                if ($cacheWrapper === null) {
                    $cache = Cache::store();
                    $cacheWrapper = new LaravelCacheWrapper($cache);
                }
                return $cacheWrapper;
            }
        );
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
