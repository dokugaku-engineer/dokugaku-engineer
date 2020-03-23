<?php

namespace App\Http\Middleware;

use Closure;
use Auth0\SDK\JWTVerifier;
use App\Traits\JsonRespondController;

/**
 * Machine to machine用のアクセストークンを検証する
 * clientをbuildする際のトークン付きアクセスの検証に用いる
 */
class CheckM2MJWT
{
    use JsonRespondController;

    /**
     * JWTアクセストークンを検証する
     *
     * @param  \Illuminate\Http\Request  $request - Illuminate HTTP Request object.
     * @param  \Closure  $next - Function to call when middleware is complete.
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $scopeRequired = null)
    {
        $accessToken = $request->bearerToken();
        if (empty($accessToken)) {
            return $this->respondUnauthorized('Bearer token missing');
        }

        $laravelConfig = config('laravel-auth0');
        $jwtConfig = [
            'authorized_iss' => $laravelConfig['authorized_issuers'],
            'valid_audiences' => [$laravelConfig['management_api_api_identifier']],
            'supported_algs' => $laravelConfig['supported_algs'],
        ];

        try {
            $jwtVerifier = new JWTVerifier($jwtConfig);
            $decodedToken = $jwtVerifier->verifyAndDecode($accessToken);
        } catch (\Exception $e) {
            return $this->respondUnauthorized($e->getMessage());
        }

        return $next($request);
    }
}
