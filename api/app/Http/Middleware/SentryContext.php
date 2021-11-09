<?php

namespace App\Http\Middleware;

use Closure;
use function Sentry\configureScope;
use Sentry\State\Scope;

class SentryContext
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request['user_id'] && app()->bound('sentry')) {
            configureScope(function (Scope $scope) use ($request): void {
                $scope->setUser([
                    'id' => $request['user_id'],
                ]);
            });
        }

        return $next($request);
    }
}
